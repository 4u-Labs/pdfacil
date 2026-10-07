<?php
$pageTitle = "Termos de Uso — PDFácil";
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
        h2 { font-size: 1.25rem; font-weight: 700; margin-top: 1.8rem; margin-bottom: 0.75rem; color: #fff; border-left: 4px solid #e11d48; padding-left: 0.75rem; }
        p { margin-bottom: 1rem; font-size: 0.95rem; color: #cbd5e1; }
        ul { margin-left: 1.5rem; margin-bottom: 1.25rem; font-size: 0.95rem; color: #cbd5e1; }
        li { margin-bottom: 0.5rem; }
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
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Voltar ao PDFácil</a>
        <h1>Termos de Uso</h1>
        <p>Bem-vindo ao <strong>PDFácil</strong>, uma aplicação utilitária desenvolvida pela plataforma <strong>4U.IA.BR</strong>. Ao acessar e utilizar este serviço, você concorda com os termos e condições descritos abaixo.</p>

        <h2>1. Finalidade do Serviço</h2>
        <p>O PDFácil fornece ferramentas utilitárias para manipulação, conversão, assinatura, divisão, união, compressão e visualização de arquivos no formato Portable Document Format (PDF) e imagens relacionadas.</p>

        <h2>2. Responsabilidade sobre os Conteúdos</h2>
        <p>Você é o único e exclusivo responsável pelo conteúdo dos documentos processados na plataforma. É expressamente proibido utilizar o PDFácil para:</p>
        <ul>
            <li>Processar, converter ou manipular documentos fraudulentos, falsificados ou ilícitos;</li>
            <li>Violar direitos autorais, patentes, segredos comerciais ou propriedade intelectual de terceiros;</li>
            <li>Tentar sobrecarregar a infraestrutura por meio de requisições automatizadas abusivas ou scripts maliciosos.</li>
        </ul>

        <h2>3. Isenção de Garantias e Limitação de Responsabilidade</h2>
        <p>O serviço é fornecido "no estado em que se encontra" (<em>as is</em>). Embora empreguemos as mais rigorosas práticas de engenharia de software e segurança, a 4U.IA.BR não garante que o serviço será 100% livre de erros ou interrupções decorrentes de instabilidades de rede ou formatos de arquivos corrompidos.</p>

        <h2>4. Propriedade Intelectual</h2>
        <p>A marca, a interface visual, a arquitetura e os logotipos pertencem ao ecossistema 4U.IA.BR. Você mantém a titularidade total e irrestrita sobre quaisquer arquivos que venha a processar no sistema.</p>

        <h2>5. Alterações nos Termos</h2>
        <p>Reservamo-nos o direito de atualizar estes termos periodicamente para refletir melhorias no serviço ou exigências legais. O uso continuado da plataforma constitui concordância com as atualizações.</p>
    </div>
</body>
</html>
