<?php
/**
 * API Backend do PDFácil
 * Suporte a conversões via LibreOffice, Ghostscript, Poppler e Tesseract OCR.
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

$storageDir = __DIR__ . '/storage';
if (!is_dir($storageDir)) {
    @mkdir($storageDir, 0755, true);
}

// 1. Limpeza automática de arquivos temporários com mais de 30 minutos (Retenção Zero)
$now = time();
if ($handle = opendir($storageDir)) {
    while (false !== ($file = readdir($handle))) {
        if ($file !== '.' && $file !== '..' && $file !== '.htaccess' && $file !== 'messages_log.json') {
            $filePath = $storageDir . '/' . $file;
            if (is_file($filePath) && ($now - filemtime($filePath) > 1800)) {
                @unlink($filePath);
            }
        }
    }
    closedir($handle);
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

// Função auxiliar de resposta JSON
function respond($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// Rota de Status do Sistema
if ($action === 'status') {
    $hasGs = !empty(shell_exec('which gs 2>/dev/null'));
    $hasLibreOffice = !empty(shell_exec('which libreoffice 2>/dev/null'));
    $hasTesseract = !empty(shell_exec('which tesseract 2>/dev/null'));
    $hasPdftoppm = !empty(shell_exec('which pdftoppm 2>/dev/null'));

    respond([
        'status' => 'online',
        'serverTime' => date('c'),
        'features' => [
            'compress_ghostscript' => $hasGs,
            'office_convert' => $hasLibreOffice,
            'ocr_tesseract' => $hasTesseract,
            'pdf_to_ppm' => $hasPdftoppm
        ]
    ]);
}

// Download de arquivos gerados
if ($action === 'download') {
    $file = basename($_GET['file'] ?? '');
    if (!$file) {
        respond(['error' => 'Arquivo não especificado'], 400);
    }
    $targetPath = $storageDir . '/' . $file;
    if (!file_exists($targetPath) || !is_file($targetPath)) {
        respond(['error' => 'Arquivo expirado ou não encontrado'], 404);
    }

    $ext = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
    $mimeMap = [
        'pdf' => 'application/pdf',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'zip' => 'application/zip',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'txt' => 'text/plain'
    ];
    $contentType = $mimeMap[$ext] ?? 'application/octet-stream';

    header('Content-Type: ' . $contentType);
    header('Content-Disposition: attachment; filename="' . ($file) . '"');
    header('Content-Length: ' . filesize($targetPath));
    header('Cache-Control: no-cache, no-store, must-revalidate');
    readfile($targetPath);
    exit;
}

// Ações que exigem upload de arquivo
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['error' => 'Método inválido. Use POST.'], 405);
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    respond(['error' => 'Nenhum arquivo enviado ou erro no upload'], 400);
}

$uploadedFile = $_FILES['file'];
$origName = pathinfo($uploadedFile['name'], PATHINFO_FILENAME);
$origExt = strtolower(pathinfo($uploadedFile['name'], PATHINFO_EXTENSION));
$cleanOrigName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $origName);
$uid = uniqid('pdfacil_', true);

$tempInput = $storageDir . '/' . $uid . '_in.' . $origExt;
if (!move_uploaded_file($uploadedFile['tmp_name'], $tempInput)) {
    respond(['error' => 'Falha ao salvar arquivo temporário'], 500);
}

// 1. COMPRESSÃO VIA GHOSTSCRIPT
if ($action === 'compress') {
    $level = $_POST['level'] ?? 'ebook'; // screen, ebook, printer, prepress
    $settingsMap = [
        'extreme' => '/screen',
        'recommended' => '/ebook',
        'low' => '/printer'
    ];
    $pdfSettings = $settingsMap[$level] ?? '/ebook';

    $tempOutput = $storageDir . '/' . $uid . '_compressed.pdf';
    $cmd = sprintf(
        'gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=%s -dNOPAUSE -dQUIET -dBATCH -sOutputFile=%s %s 2>&1',
        escapeshellarg($pdfSettings),
        escapeshellarg($tempOutput),
        escapeshellarg($tempInput)
    );

    exec($cmd, $output, $returnCode);

    if (file_exists($tempOutput) && filesize($tempOutput) > 0) {
        $origSize = filesize($tempInput);
        $newSize = filesize($tempOutput);
        
        // Se por algum motivo o arquivo ficou maior, mantemos o original
        if ($newSize >= $origSize) {
            $reduction = 0;
        } else {
            $reduction = round((($origSize - $newSize) / $origSize) * 100);
        }

        @unlink($tempInput);

        respond([
            'success' => true,
            'downloadUrl' => 'api.php?action=download&file=' . basename($tempOutput),
            'filename' => $cleanOrigName . '_otimizado.pdf',
            'originalSize' => $origSize,
            'compressedSize' => $newSize,
            'reductionPercent' => $reduction
        ]);
    } else {
        @unlink($tempInput);
        respond(['error' => 'Falha ao comprimir documento PDF com Ghostscript'], 500);
    }
}

// 2. CONVERSÃO DE WORD/EXCEL/PPT PARA PDF (via LibreOffice)
if ($action === 'to_pdf') {
    $allowedOfficeExts = ['docx', 'doc', 'xlsx', 'xls', 'pptx', 'ppt', 'odt', 'ods', 'odp', 'rtf', 'txt'];
    if (!in_array($origExt, $allowedOfficeExts)) {
        @unlink($tempInput);
        respond(['error' => 'Formato não suportado para conversão em PDF: .' . $origExt], 400);
    }

    $cmd = sprintf(
        'libreoffice --headless --convert-to pdf --outdir %s %s 2>&1',
        escapeshellarg($storageDir),
        escapeshellarg($tempInput)
    );

    exec($cmd, $output, $returnCode);

    $expectedPdf = $storageDir . '/' . pathinfo($tempInput, PATHINFO_FILENAME) . '.pdf';
    if (file_exists($expectedPdf) && filesize($expectedPdf) > 0) {
        @unlink($tempInput);
        respond([
            'success' => true,
            'downloadUrl' => 'api.php?action=download&file=' . basename($expectedPdf),
            'filename' => $cleanOrigName . '.pdf',
            'fileSize' => filesize($expectedPdf)
        ]);
    } else {
        @unlink($tempInput);
        respond(['error' => 'Falha ao converter arquivo para PDF via motor LibreOffice'], 500);
    }
}

// 3. CONVERSÃO DE PDF PARA WORD (.docx)
if ($action === 'to_word') {
    if ($origExt !== 'pdf') {
        @unlink($tempInput);
        respond(['error' => 'Envie um arquivo PDF válido para conversão em Word'], 400);
    }

    $cmd = sprintf(
        'libreoffice --headless --infilter="writer_pdf_import" --convert-to docx --outdir %s %s 2>&1',
        escapeshellarg($storageDir),
        escapeshellarg($tempInput)
    );

    exec($cmd, $output, $returnCode);

    $expectedDocx = $storageDir . '/' . pathinfo($tempInput, PATHINFO_FILENAME) . '.docx';
    if (file_exists($expectedDocx) && filesize($expectedDocx) > 0) {
        @unlink($tempInput);
        respond([
            'success' => true,
            'downloadUrl' => 'api.php?action=download&file=' . basename($expectedDocx),
            'filename' => $cleanOrigName . '.docx',
            'fileSize' => filesize($expectedDocx)
        ]);
    } else {
        @unlink($tempInput);
        respond(['error' => 'Falha ao converter PDF para Word via motor LibreOffice'], 500);
    }
}

// 4. OCR DE PDF / EXTRAÇÃO DE TEXTO (via Tesseract)
if ($action === 'ocr') {
    $lang = $_POST['lang'] ?? 'por+eng';
    $tempImgPrefix = $storageDir . '/' . $uid . '_page';
    
    // Converte primeira página em imagem PNG usando pdftoppm
    $cmdPpm = sprintf(
        'pdftoppm -png -r 200 -f 1 -l 3 %s %s 2>&1',
        escapeshellarg($tempInput),
        escapeshellarg($tempImgPrefix)
    );
    exec($cmdPpm);

    // Encontra páginas geradas
    $extractedText = "";
    $pageImages = glob($tempImgPrefix . '-*.png');
    
    if (!empty($pageImages)) {
        foreach ($pageImages as $img) {
            $cmdOcr = sprintf(
                'tesseract %s stdout -l %s 2>/dev/null',
                escapeshellarg($img),
                escapeshellarg($lang)
            );
            $pageText = shell_exec($cmdOcr);
            if ($pageText) {
                $extractedText .= trim($pageText) . "\n\n--- [Fim de Página] ---\n\n";
            }
            @unlink($img);
        }
    } else {
        // Tenta OCR direto no arquivo se for imagem enviada
        $cmdOcrDirect = sprintf(
            'tesseract %s stdout -l %s 2>/dev/null',
            escapeshellarg($tempInput),
            escapeshellarg($lang)
        );
        $extractedText = shell_exec($cmdOcrDirect);
    }

    @unlink($tempInput);

    if (!empty($extractedText)) {
        respond([
            'success' => true,
            'text' => trim($extractedText),
            'wordCount' => str_word_count($extractedText)
        ]);
    } else {
        respond(['error' => 'Nenhum texto pôde ser reconhecido neste documento escaneado'], 400);
    }
}

@unlink($tempInput);
respond(['error' => 'Ação não reconhecida: ' . htmlspecialchars($action)], 400);
