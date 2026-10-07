<?php
$pageTitle = "Política de Privacidade — PDFácil";
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
        .highlight-box {
            background: rgba(225, 29, 72, 0.1);
            border: 1px solid rgba(225, 29, 72, 0.25);
            border-radius: 16px;
            padding: 1.25rem;
            margin: 1.5rem 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Voltar ao PDFácil</a>
        <h1>Política de Privacidade & LGPD</h1>
        <p>A sua privacidade e a confidencialidade dos seus documentos são o compromisso central do <strong>PDFácil</strong>. Desenvolvemos esta ferramenta sob o princípio do <em>Privacy by Design</em> e <strong>Retenção Zero de Arquivos</strong>.</p>

        <div class="highlight-box">
            <h3 style="margin: 0 0 0.5rem 0; color: #fb7185; font-size: 1.1rem;"><i class="fa-solid fa-shield-halved"></i> 100% dos Processamentos Rápidos Ocorrem no seu Navegador</h3>
            <p style="margin: 0; font-size: 0.9rem;">Operações como juntar PDFs, dividir, girar, excluir páginas, marcar d'água e assinar são executadas de forma puramente local via JavaScript. Seus arquivos confidenciais nem sequer saem do seu computador ou celular.</p>
        </div>

        <h2>1. Política de Retenção Zero no Servidor</h2>
        <p>Para ferramentas que necessitam de processamento de máquina (como conversão de formatos de texto ou compressão de alta complexidade):</p>
        <ul>
            <li>Os arquivos enviados são processados em áreas isoladas de memória temporária;</li>
            <li>Nenhum operador humano possui acesso visual aos conteúdos;</li>
            <li><strong>Os arquivos gerados são irrevogavelmente excluídos de forma automática</strong> em até 30 minutos após o término da tarefa.</li>
        </ul>

        <h2>2. Conformidade com a LGPD (Lei nº 13.709/2018)</h2>
        <p>O PDFácil cumpre integralmente os princípios da Lei Geral de Proteção de Dados:</p>
        <ul>
            <li><strong>Finalidade e Adequação:</strong> Nenhum dado contido nos documentos é indexado, catalogado, compartilhado ou utilizado para treinamento de modelos de IA;</li>
            <li><strong>Livre Acesso e Segurança:</strong> Seus dados não são comercializados nem fornecidos a terceiros.</li>
        </ul>

        <h2>3. Logs Técnicos Mínimos</h2>
        <p>Para prevenir ataques cibernéticos, ataques de negação de serviço (DDoS) e manter a estabilidade do sistema, registramos apenas métricas anônimas de uso e requisições HTTP normais de infraestrutura.</p>

        <h2>4. Contato do Encarregado</h2>
        <p>Dúvidas sobre o tratamento de dados e termos de privacidade podem ser encaminhadas diretamente para <strong>contato@4u.ia.br</strong>.</p>
    </div>
</body>
</html>
