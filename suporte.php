<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
$pageTitle = "Suporte & FAQ — PDFácil";
$msgSent = false;
$msgError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? 'Suporte PDFácil');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        $logDir = __DIR__ . '/storage';
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0755, true);
        }
        $logFile = $logDir . '/messages_log.json';
        $logs = [];
        if (file_exists($logFile)) {
            $logs = json_decode(file_get_contents($logFile), true) ?: [];
        }
        $logs[] = [
            'timestamp' => date('Y-m-d H:i:s'),
            'nome' => $nome,
            'email' => $email,
            'assunto' => $assunto,
            'mensagem' => $mensagem,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0'
        ];
        file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $to = 'contato@4u.ia.br';
        $emailSubject = '[PDFácil Suporte] ' . $assunto . ' - ' . $nome;
        $body = "Nome: $nome\nE-mail: $email\nAssunto: $assunto\nData: " . date('d/m/Y H:i:s') . "\n\nMensagem:\n$mensagem";
        $headers = "From: contato@4u.ia.br\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

        @mail($to, $emailSubject, $body, $headers);
        $msgSent = true;
    } else {
        $msgError = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: #07090e;
            color: #e2e8f0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.7;
            padding: 2rem 1rem;
            margin: 0;
        }
        .container {
            max-width: 820px;
            margin: 0 auto;
            background: rgba(15, 18, 28, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.6);
        }
        h1 { font-size: 2.2rem; font-weight: 900; margin-bottom: 0.5rem; color: #fff; }
        h2 { font-size: 1.25rem; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem; color: #fff; border-left: 4px solid #e11d48; padding-left: 0.75rem; }
        p { margin-bottom: 1rem; font-size: 0.95rem; color: #cbd5e1; }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #fb7185;
            text-decoration: none;
            font-weight: 700;
            margin-bottom: 1.5rem;
            transition: color 0.2s;
        }
        .back-link:hover { color: #f43f5e; }

        /* Accordion FAQ */
        .faq-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            margin-bottom: 0.75rem;
            overflow: hidden;
            transition: all 0.2s;
        }
        .faq-item:hover { border-color: rgba(225, 29, 72, 0.3); }
        .faq-header {
            padding: 1rem 1.25rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 700;
            color: #fff;
            user-select: none;
        }
        .faq-header i { color: #fb7185; transition: transform 0.3s; }
        .faq-body {
            padding: 0 1.25rem 1rem 1.25rem;
            font-size: 0.92rem;
            color: #cbd5e1;
            display: none;
        }
        .faq-item.active .faq-body { display: block; }
        .faq-item.active .faq-header i { transform: rotate(180deg); }

        /* Form */
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-weight: 600; margin-bottom: 0.4rem; color: #e2e8f0; font-size: 0.9rem; }
        input, select, textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            padding: 0.8rem 1rem;
            color: #fff;
            font-size: 0.95rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #e11d48;
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.25);
        }
        .btn-submit {
            background: linear-gradient(135deg, #e11d48, #be123c);
            color: #fff;
            border: none;
            padding: 0.9rem 1.75rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(225, 29, 72, 0.4);
        }
        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        .alert-success { background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; }
        .alert-error { background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Voltar ao PDFácil</a>
        <h1>Central de Suporte & FAQ</h1>
        <p>Tire suas dúvidas técnicas sobre o uso das ferramentas do <strong>PDFácil</strong> ou envie uma mensagem direta para a equipe de desenvolvimento.</p>

        <?php if ($msgSent): ?>
            <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> Mensagem enviada com sucesso! Responderemos em breve em seu e-mail.</div>
        <?php elseif ($msgError): ?>
            <div class="alert alert-error"><i class="fa-solid fa-triangle-exclamation"></i> Por favor, preencha todos os campos obrigatórios.</div>
        <?php endif; ?>

        <h2>Perguntas Frequentes (FAQ)</h2>
        <div class="faq-list">
            <div class="faq-item">
                <div class="faq-header" onclick="toggleFaq(this)">
                    <span>Os meus documentos ficam salvos no servidor?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="faq-body">
                    <strong>Não!</strong> A esmagadora maioria das ferramentas do PDFácil (juntar, dividir, girar, assinar, extrair páginas, marca d'água) opera de forma 100% local no seu navegador. Quando uma conversão pesada precisa do servidor, os arquivos são processados temporariamente em memória e excluídos em no máximo 30 minutos.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header" onclick="toggleFaq(this)">
                    <span>Existe limite de tamanho ou quantidade de arquivos?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="faq-body">
                    O PDFácil suporta arquivos de até 100 MB de forma totalmente gratuita e sem marca d'água forçada ou limitação de uso diário.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header" onclick="toggleFaq(this)">
                    <span>Como funciona a ferramenta de Assinatura de PDF?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="faq-body">
                    Você pode desenhar sua assinatura diretamente na tela (com o mouse ou dedo no celular), digitar seu nome com uma fonte cursiva elegante ou subir uma foto/carimbo com fundo transparente. Depois, basta arrastar e posicionar no documento.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header" onclick="toggleFaq(this)">
                    <span>Posso usar no celular sem instalar aplicativo da loja?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="faq-body">
                    Sim! O PDFácil é um PWA (Progressive Web App). Basta clicar em "Instalar App" no cabeçalho ou usar o menu do seu navegador e tocar em "Adicionar à Tela de Início".
                </div>
            </div>
        </div>

        <h2>Fale com a Gente</h2>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Seu Nome *</label>
                <input type="text" id="nome" name="nome" required placeholder="Digite seu nome completo">
            </div>
            <div class="form-group">
                <label for="email">Seu E-mail *</label>
                <input type="email" id="email" name="email" required placeholder="seu@email.com">
            </div>
            <div class="form-group">
                <label for="assunto">Assunto</label>
                <select id="assunto" name="assunto">
                    <option value="Dúvida Técnica">Dúvida Técnica</option>
                    <option value="Sugestão de Nova Ferramenta">Sugestão de Nova Ferramenta</option>
                    <option value="Relato de Bug ou Erro">Relato de Bug ou Erro</option>
                    <option value="Parceria ou Outro">Parceria ou Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="mensagem">Mensagem *</label>
                <textarea id="mensagem" name="mensagem" rows="5" required placeholder="Como podemos ajudar você hoje?"></textarea>
            </div>
            <button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> Enviar Mensagem</button>
        </form>
    </div>

    <script>
        function toggleFaq(el) {
            const item = el.parentElement;
            item.classList.toggle('active');
        }
    </script>
</body>
</html>
