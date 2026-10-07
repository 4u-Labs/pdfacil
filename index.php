<?php
$appName = "PDFácil";
$appVersion = "1.0";
$pageTitle = "PDFácil — O Canivete Suíço de PDFs e Documentos | 4U.IA.BR";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <title><?= $pageTitle ?></title>

    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#e11d48">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <meta name="description" content="PDFácil: Junte, divida, comprima, assine, converta e proteja arquivos PDF direto no navegador. 100% gratuito, sem limite de uso e com máxima privacidade.">
    <meta name="keywords" content="pdfacil, juntar pdf, comprimir pdf, dividir pdf, assinar pdf, converter word em pdf, pdf para word, i love pdf, 4u.ia.br">
    <meta name="author" content="4U.IA.BR">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="PDFácil — O Canivete Suíço de PDFs e Documentos">
    <meta property="og:description" content="Todas as ferramentas para resolver qualquer problema com PDFs em segundos, direto no seu navegador.">
    <meta property="og:image" content="https://4u.ia.br/app/pdfacil/icon-512.png">
    <meta property="og:url" content="https://4u.ia.br/app/pdfacil/">

    <!-- Fontes & Ícones -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bibliotecas essenciais de PDF (Locais para máxima velocidade e offline PWA) -->
    <script src="assets/libs/pdf-lib.min.js"></script>
    <script src="assets/libs/pdf.min.js"></script>
    <script src="assets/libs/jszip.min.js"></script>
    <script src="assets/libs/sortable.min.js"></script>

    <script>
        if (typeof pdfjsLib !== 'undefined') {
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'assets/libs/pdf.worker.min.js';
        }
    </script>

    <style>
        :root {
            --primary: #e11d48;
            --primary-hover: #f43f5e;
            --primary-glow: rgba(225, 29, 72, 0.35);
            --bg-dark: #07090e;
            --card-bg: rgba(14, 18, 30, 0.75);
            --card-border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 15% 15%, rgba(225, 29, 72, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(59, 130, 246, 0.06) 0%, transparent 45%);
            background-attachment: fixed;
        }

        /* Container */
        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 1.25rem;
            width: 100%;
        }

        /* Header */
        header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(7, 9, 14, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--card-border);
            padding: 0.85rem 0;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            text-decoration: none;
            color: inherit;
        }

        .brand-logo {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            object-fit: cover;
            box-shadow: 0 0 20px var(--primary-glow);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .brand-name {
            font-size: 1.35rem;
            font-weight: 900;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #fff 40%, #fb7185 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-badge {
            font-size: 0.65rem;
            font-weight: 800;
            background: rgba(225, 29, 72, 0.2);
            color: #fb7185;
            padding: 2px 7px;
            border-radius: 99px;
            border: 1px solid rgba(225, 29, 72, 0.35);
            margin-left: 6px;
        }

        .brand-subtitle {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .btn-header {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--card-border);
            color: var(--text-main);
            padding: 0.5rem 0.9rem;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-header:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .btn-pwa {
            background: linear-gradient(135deg, rgba(225, 29, 72, 0.25), rgba(244, 63, 94, 0.15));
            border-color: rgba(225, 29, 72, 0.4);
            color: #fecdd3;
        }

        .btn-pwa:hover {
            background: linear-gradient(135deg, rgba(225, 29, 72, 0.4), rgba(244, 63, 94, 0.25));
            border-color: #f43f5e;
            box-shadow: 0 0 15px var(--primary-glow);
        }

        /* Hero */
        .hero-section {
            padding: 3rem 0 2rem;
            text-align: center;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(225, 29, 72, 0.12);
            border: 1px solid rgba(225, 29, 72, 0.3);
            color: #fb7185;
            padding: 0.4rem 1rem;
            border-radius: 99px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            box-shadow: 0 0 20px rgba(225, 29, 72, 0.15);
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3.25rem);
            font-weight: 900;
            letter-spacing: -1px;
            line-height: 1.15;
            margin-bottom: 1rem;
        }

        .hero-title span {
            background: linear-gradient(135deg, #fb7185 0%, #e11d48 50%, #f43f5e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: clamp(0.95rem, 2vw, 1.15rem);
            color: var(--text-muted);
            max-width: 680px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        /* Search & Filter Bar */
        .search-bar-wrap {
            max-width: 640px;
            margin: 0 auto 1.5rem;
            position: relative;
        }

        .search-input {
            width: 100%;
            background: rgba(18, 22, 38, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            padding: 1rem 1.25rem 1rem 3.25rem;
            font-size: 0.95rem;
            color: #fff;
            outline: none;
            transition: all 0.25s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-glow);
        }

        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1.1rem;
            pointer-events: none;
        }

        .filter-tags {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 2.5rem;
        }

        .filter-btn {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--card-border);
            color: var(--text-muted);
            padding: 0.45rem 0.95rem;
            border-radius: 99px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: rgba(225, 29, 72, 0.18);
            border-color: rgba(225, 29, 72, 0.45);
            color: #fff;
            box-shadow: 0 0 15px rgba(225, 29, 72, 0.2);
        }

        /* Tools Grid */
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 1.25rem;
            margin-bottom: 4rem;
        }

        .tool-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            text-align: left;
        }

        .tool-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--card-accent, var(--primary)), transparent);
            opacity: 0;
            transition: opacity 0.25s;
        }

        .tool-card:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4), 0 0 20px var(--card-glow, var(--primary-glow));
        }

        .tool-card:hover::before {
            opacity: 1;
        }

        .tool-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            margin-bottom: 1.15rem;
            background: var(--icon-bg, rgba(225, 29, 72, 0.15));
            color: var(--icon-color, #fb7185);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.2s;
        }

        .tool-card:hover .tool-icon-wrap {
            transform: scale(1.08);
        }

        .tool-badge {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 99px;
            background: rgba(255, 255, 255, 0.08);
            color: var(--text-muted);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .tool-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.45rem;
            letter-spacing: -0.3px;
        }

        .tool-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
            flex-grow: 1;
            margin-bottom: 1.15rem;
        }

        .tool-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--card-accent, #fb7185);
            padding-top: 0.75rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .tool-footer i {
            transition: transform 0.2s;
        }

        .tool-card:hover .tool-footer i {
            transform: translateX(4px);
        }

        /* Workspace Modal / Drawer */
        .workspace-modal {
            position: fixed;
            inset: 0;
            z-index: 100;
            background: rgba(4, 6, 10, 0.92);
            backdrop-filter: blur(20px);
            display: none;
            flex-direction: column;
            overflow-y: auto;
        }

        .workspace-modal.active {
            display: flex;
        }

        .workspace-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(10, 13, 22, 0.9);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .workspace-title {
            font-size: 1.25rem;
            font-weight: 900;
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .btn-close-ws {
            background: rgba(255, 255, 255, 0.08);
            border: none;
            color: #fff;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all 0.2s;
        }

        .btn-close-ws:hover {
            background: rgba(225, 29, 72, 0.4);
            transform: rotate(90deg);
        }

        .workspace-body {
            flex: 1;
            max-width: 960px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Dropzone */
        .dropzone-box {
            border: 2px dashed rgba(225, 29, 72, 0.4);
            border-radius: 24px;
            background: rgba(225, 29, 72, 0.03);
            padding: 3.5rem 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
        }

        .dropzone-box:hover,
        .dropzone-box.dragover {
            border-color: var(--primary);
            background: rgba(225, 29, 72, 0.08);
            box-shadow: 0 0 30px var(--primary-glow);
        }

        .dropzone-icon {
            font-size: 3.25rem;
            color: #fb7185;
            margin-bottom: 1rem;
            animation: bounceSoft 2.5s infinite;
        }

        @keyframes bounceSoft {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .btn-select-file {
            background: linear-gradient(135deg, #e11d48, #be123c);
            color: #fff;
            font-weight: 800;
            padding: 0.9rem 2rem;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            margin-top: 1.25rem;
            box-shadow: 0 8px 24px var(--primary-glow);
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-select-file:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(225, 29, 72, 0.5);
        }

        /* Preview Area */
        .file-preview-area {
            display: none;
            flex-direction: column;
            gap: 1.5rem;
        }

        .pages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 1rem;
            max-height: 480px;
            overflow-y: auto;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.35);
            border-radius: 18px;
            border: 1px solid var(--card-border);
        }

        .page-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 0.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            cursor: grab;
            transition: all 0.2s;
            user-select: none;
        }

        .page-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .page-card.deleted {
            opacity: 0.35;
            filter: grayscale(1);
            border-color: rgba(239, 68, 68, 0.4);
        }

        .page-thumb-canvas {
            width: 100%;
            height: auto;
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.4);
        }

        .page-badge-num {
            position: absolute;
            top: 8px;
            left: 8px;
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
            font-size: 0.7rem;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 6px;
        }

        .page-actions {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            margin-top: 0.5rem;
        }

        .btn-page-action {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
            width: 26px;
            height: 26px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .btn-page-action:hover {
            background: var(--primary);
        }

        /* Action Controls & Options */
        .tool-options-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 1.5rem;
        }

        .options-title {
            font-size: 1rem;
            font-weight: 800;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #fff;
        }

        .control-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .control-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-muted);
        }

        .control-input,
        .control-select {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            color: #fff;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s;
        }

        .control-input:focus,
        .control-select:focus {
            border-color: var(--primary);
        }

        .btn-process {
            background: linear-gradient(135deg, #e11d48, #be123c);
            color: #fff;
            border: none;
            padding: 1.1rem 2.25rem;
            border-radius: 16px;
            font-size: 1.05rem;
            font-weight: 800;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            box-shadow: 0 8px 25px var(--primary-glow);
            transition: all 0.25s;
        }

        .btn-process:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(225, 29, 72, 0.5);
        }

        .btn-process:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Result View */
        .result-box {
            display: none;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.98); }
            to { opacity: 1; transform: scale(1); }
        }

        .result-icon {
            font-size: 3rem;
            color: #34d399;
            margin-bottom: 0.75rem;
        }

        .result-title {
            font-size: 1.4rem;
            font-weight: 900;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .result-info {
            font-size: 0.9rem;
            color: #a7f3d0;
            margin-bottom: 1.5rem;
        }

        .btn-download {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            text-decoration: none;
            padding: 1rem 2.5rem;
            border-radius: 14px;
            font-size: 1.05rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
            transition: all 0.2s;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.5);
        }

        /* Signature Canvas Pad */
        #signCanvas {
            background: #ffffff;
            border-radius: 14px;
            cursor: crosshair;
            box-shadow: inset 0 2px 6px rgba(0,0,0,0.1);
            touch-action: none;
            width: 100%;
            height: 200px;
        }

        /* Progress Bar */
        .progress-wrap {
            display: none;
            margin: 1.5rem 0;
        }

        .progress-bar-bg {
            height: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 99px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #fb7185, #e11d48);
            border-radius: 99px;
            transition: width 0.3s;
        }

        .progress-text {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 0.5rem;
            text-align: center;
        }

        /* Footer (Padrão 4U.IA.BR) */
        .footer-clean {
            margin-top: auto;
            border-top: 1px solid var(--card-border);
            background: rgba(7, 9, 14, 0.95);
            padding: 2.5rem 0 1.5rem;
            text-align: center;
        }

        .footer-brand {
            font-size: 1.15rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .footer-links {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.65rem 1rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.25rem;
        }

        .footer-links a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .footer-links .sep {
            color: rgba(255, 255, 255, 0.15);
        }

        .donate-link {
            color: #fbbf24 !important;
            font-weight: 700;
        }

        .footer-copyright {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.3);
        }

        /* Responsividade */
        @media (max-width: 640px) {
            .tools-grid {
                grid-template-columns: 1fr;
            }
            .header-content {
                gap: 0.5rem;
            }
            .btn-header span {
                display: none;
            }
            .btn-header {
                padding: 0.5rem;
            }
            .btn-pwa span {
                display: inline;
            }
            .dropzone-box {
                padding: 2.5rem 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header>
        <div class="container header-content">
            <a href="index.php" class="brand-link">
                <img src="logo.png" alt="PDFácil Logo" class="brand-logo" onerror="this.src='icon-192.png'">
                <div>
                    <div style="display: flex; align-items: center;">
                        <span class="brand-name">PDFácil</span>
                        <span class="brand-badge">PRO</span>
                    </div>
                    <div class="brand-subtitle">Canivete Suíço de PDFs</div>
                </div>
            </a>

            <div class="header-actions">
                <button type="button" id="btn-pwa-install" class="btn-header btn-pwa" style="display: none;">
                    <i class="fa-solid fa-cloud-arrow-down"></i>
                    <span>Instalar App</span>
                </button>
                <a href="https://4u.ia.br/loja/" class="btn-header" title="Voltar ao 4u Hub">
                    <i class="fa-solid fa-shapes"></i>
                    <span>4u Hub</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-pill">
                <i class="fa-solid fa-bolt"></i> Processamento Instantâneo & 100% Privado
            </div>
            <h1 class="hero-title">
                Todas as ferramentas de PDF.<br>
                <span>Fáceis. Rápidas. Gratuitas.</span>
            </h1>
            <p class="hero-desc">
                Junte, divida, comprima, assine, converta e proteja seus documentos com a velocidade e elegância do PDFácil. Sem limite de arquivos e com privacidade de ponta a ponta.
            </p>

            <!-- Search Bar -->
            <div class="search-bar-wrap">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" id="toolSearch" class="search-input" placeholder="Buscar ferramenta (ex: juntar, comprimir, assinar, word, imagem)...">
            </div>

            <!-- Category Filter Pills -->
            <div class="filter-tags">
                <button type="button" class="filter-btn active" data-cat="all">🌟 Todas as Ferramentas</button>
                <button type="button" class="filter-btn" data-cat="organize">📑 Organizar</button>
                <button type="button" class="filter-btn" data-cat="optimize">🗜️ Otimizar</button>
                <button type="button" class="filter-btn" data-cat="convert">🔄 Converter</button>
                <button type="button" class="filter-btn" data-cat="edit">✍️ Editar & Assinar</button>
            </div>
        </section>

        <!-- Tools Grid -->
        <section class="tools-grid" id="toolsGrid">

            <!-- 1. Juntar PDF -->
            <div class="tool-card" data-tool="merge" data-cat="organize" style="--card-accent: #e11d48; --card-glow: rgba(225, 29, 72, 0.3); --icon-bg: rgba(225, 29, 72, 0.15); --icon-color: #fb7185;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-object-group"></i></div>
                <span class="tool-badge">Popular</span>
                <h3 class="tool-title">Juntar PDF</h3>
                <p class="tool-desc">Combine múltiplos arquivos em um único PDF na ordem que desejar com reordenação visual.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 2. Dividir PDF -->
            <div class="tool-card" data-tool="split" data-cat="organize" style="--card-accent: #f97316; --card-glow: rgba(249, 115, 22, 0.3); --icon-bg: rgba(249, 115, 22, 0.15); --icon-color: #fb923c;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-scissors"></i></div>
                <h3 class="tool-title">Dividir PDF</h3>
                <p class="tool-desc">Separe páginas individuais, extraia intervalos específicos ou divida em múltiplos documentos.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 3. Comprimir PDF -->
            <div class="tool-card" data-tool="compress" data-cat="optimize" style="--card-accent: #10b981; --card-glow: rgba(16, 185, 129, 0.3); --icon-bg: rgba(16, 185, 129, 0.15); --icon-color: #34d399;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-file-zipper"></i></div>
                <span class="tool-badge">Servidor Turbo</span>
                <h3 class="tool-title">Comprimir PDF</h3>
                <p class="tool-desc">Reduza drasticamente o tamanho do arquivo mantendo texto e imagens em alta nitidez.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 4. Assinar PDF -->
            <div class="tool-card" data-tool="sign" data-cat="edit" style="--card-accent: #8b5cf6; --card-glow: rgba(139, 92, 246, 0.3); --icon-bg: rgba(139, 92, 246, 0.15); --icon-color: #a78bfa;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-signature"></i></div>
                <span class="tool-badge">Interativo</span>
                <h3 class="tool-title">Assinar PDF</h3>
                <p class="tool-desc">Desenhe sua rubrica, digite seu nome ou carimbe seu visto em qualquer página do documento.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 5. Imagens para PDF -->
            <div class="tool-card" data-tool="img_to_pdf" data-cat="convert" style="--card-accent: #06b6d4; --card-glow: rgba(6, 182, 212, 0.3); --icon-bg: rgba(6, 182, 212, 0.15); --icon-color: #22d3ee;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-images"></i></div>
                <h3 class="tool-title">Imagens para PDF</h3>
                <p class="tool-desc">Transforme fotos JPG, PNG e WebP em um documento PDF unificado com ajuste de margem.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 6. PDF para Imagens -->
            <div class="tool-card" data-tool="pdf_to_img" data-cat="convert" style="--card-accent: #3b82f6; --card-glow: rgba(59, 130, 246, 0.3); --icon-bg: rgba(59, 130, 246, 0.15); --icon-color: #60a5fa;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-file-image"></i></div>
                <h3 class="tool-title">PDF para Imagens</h3>
                <p class="tool-desc">Extraia cada página do PDF como imagem em alta resolução para download individual ou ZIP.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 7. Word / Office para PDF -->
            <div class="tool-card" data-tool="to_pdf" data-cat="convert" style="--card-accent: #2563eb; --card-glow: rgba(37, 99, 235, 0.3); --icon-bg: rgba(37, 99, 235, 0.15); --icon-color: #93c5fd;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-file-word"></i></div>
                <span class="tool-badge">Motor OCI</span>
                <h3 class="tool-title">Word para PDF</h3>
                <p class="tool-desc">Converta arquivos DOCX, DOC, XLSX e PPTX em PDFs com fidelidade de layout impecável.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 8. PDF para Word -->
            <div class="tool-card" data-tool="to_word" data-cat="convert" style="--card-accent: #0284c7; --card-glow: rgba(2, 132, 199, 0.3); --icon-bg: rgba(2, 132, 199, 0.15); --icon-color: #38bdf8;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-file-lines"></i></div>
                <span class="tool-badge">Motor OCI</span>
                <h3 class="tool-title">PDF para Word</h3>
                <p class="tool-desc">Converta documentos PDF em arquivos DOCX editáveis para fazer alterações no Office.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 9. Girar Páginas -->
            <div class="tool-card" data-tool="rotate" data-cat="organize" style="--card-accent: #ec4899; --card-glow: rgba(236, 72, 153, 0.3); --icon-bg: rgba(236, 72, 153, 0.15); --icon-color: #f472b6;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-rotate-right"></i></div>
                <h3 class="tool-title">Girar Páginas</h3>
                <p class="tool-desc">Ajuste e corrija a orientação de páginas em 90°, 180° ou 270° com visualização imediata.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 10. Excluir Páginas -->
            <div class="tool-card" data-tool="delete_pages" data-cat="organize" style="--card-accent: #ef4444; --card-glow: rgba(239, 68, 68, 0.3); --icon-bg: rgba(239, 68, 68, 0.15); --icon-color: #f87171;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-trash-can"></i></div>
                <h3 class="tool-title">Excluir Páginas</h3>
                <p class="tool-desc">Remova páginas em branco, capas ou folhas indesejadas clicando direto na miniatura.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 11. Marca d'Água -->
            <div class="tool-card" data-tool="watermark" data-cat="edit" style="--card-accent: #d946ef; --card-glow: rgba(217, 70, 239, 0.3); --icon-bg: rgba(217, 70, 239, 0.15); --icon-color: #e879f9;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-stamp"></i></div>
                <h3 class="tool-title">Marca d'Água</h3>
                <p class="tool-desc">Insira carimbos de texto (ex: CONFIDENCIAL, RASCUNHO) com rotação e transparência regulável.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

            <!-- 12. OCR & Extrair Texto -->
            <div class="tool-card" data-tool="ocr" data-cat="edit" style="--card-accent: #eab308; --card-glow: rgba(234, 179, 8, 0.3); --icon-bg: rgba(234, 179, 8, 0.15); --icon-color: #fde047;">
                <div class="tool-icon-wrap"><i class="fa-solid fa-font"></i></div>
                <span class="tool-badge">IA Tesseract</span>
                <h3 class="tool-title">OCR & Texto</h3>
                <p class="tool-desc">Extraia todo o texto pesquisável de PDFs digitalizados e scans de fotos em segundos.</p>
                <div class="tool-footer"><span>Usar Ferramenta</span> <i class="fa-solid fa-arrow-right"></i></div>
            </div>

        </section>
    </main>

    <!-- Workspace Modal -->
    <div class="workspace-modal" id="workspaceModal">
        <div class="workspace-header">
            <div class="workspace-title" id="wsHeaderTitle">
                <i class="fa-solid fa-object-group text-primary"></i>
                <span>Juntar PDF</span>
            </div>
            <button type="button" class="btn-close-ws" id="btnCloseWs" title="Fechar"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="workspace-body">
            <!-- Dropzone -->
            <div class="dropzone-box" id="dropzone">
                <i class="fa-solid fa-cloud-arrow-up dropzone-icon" id="dropzoneIcon"></i>
                <h3 style="font-size: 1.4rem; font-weight: 800; margin-bottom: 0.5rem;" id="dropzoneTitle">Selecione ou arraste seu arquivo PDF aqui</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;" id="dropzoneDesc">Tamanho máximo de 100 MB por documento</p>
                <button type="button" class="btn-select-file" id="btnBrowseFile"><i class="fa-solid fa-folder-open"></i> Escolher Arquivo</button>
                <input type="file" id="fileInput" style="display: none;" multiple>
            </div>

            <!-- Preview / Editor Area -->
            <div class="file-preview-area" id="filePreviewArea">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="font-size: 0.95rem; font-weight: 700; color: #fff;" id="previewFileInfo">Páginas do Documento:</div>
                    <button type="button" class="filter-btn" id="btnAddMoreFiles" style="display: none;"><i class="fa-solid fa-plus"></i> Adicionar mais PDFs</button>
                </div>

                <div class="pages-grid" id="pagesGrid"></div>

                <!-- Signature Specific Pad -->
                <div id="signSpecificControls" style="display: none;" class="tool-options-card">
                    <div class="options-title"><i class="fa-solid fa-pen-nib text-primary"></i> Desenhe sua Assinatura / Rubrica</div>
                    <canvas id="signCanvas" width="800" height="240"></canvas>
                    <div style="display: flex; gap: 0.5rem; margin-top: 0.75rem;">
                        <button type="button" class="filter-btn" id="btnClearSign"><i class="fa-solid fa-eraser"></i> Limpar</button>
                        <button type="button" class="filter-btn active" id="btnSignColorBlue"><span style="display:inline-block; width:10px; height:10px; background:#1d4ed8; border-radius:50%;"></span> Azul Caneta</button>
                        <button type="button" class="filter-btn" id="btnSignColorBlack"><span style="display:inline-block; width:10px; height:10px; background:#000; border-radius:50%;"></span> Preto</button>
                    </div>
                </div>

                <!-- Options Card -->
                <div class="tool-options-card" id="toolOptionsCard">
                    <div class="options-title" id="optionsTitle"><i class="fa-solid fa-sliders text-primary"></i> Configurações da Ação</div>
                    <div id="dynamicOptionsContent"></div>
                </div>

                <!-- Progress Bar -->
                <div class="progress-wrap" id="progressWrap">
                    <div class="progress-bar-bg"><div class="progress-bar-fill" id="progressBarFill"></div></div>
                    <div class="progress-text" id="progressText">Processando documento...</div>
                </div>

                <!-- Action Button -->
                <button type="button" class="btn-process" id="btnExecuteAction">
                    <i class="fa-solid fa-bolt"></i> <span id="executeBtnText">Processar Agora</span>
                </button>
            </div>

            <!-- Result Box -->
            <div class="result-box" id="resultBox">
                <i class="fa-solid fa-circle-check result-icon"></i>
                <h3 class="result-title">Operação Concluída com Sucesso!</h3>
                <p class="result-info" id="resultInfo">Seu novo arquivo está pronto e otimizado.</p>
                <div id="ocrResultBox" style="display: none; background: rgba(0,0,0,0.4); border-radius: 12px; padding: 1rem; text-align: left; margin-bottom: 1.5rem; max-height: 250px; overflow-y: auto;">
                    <textarea id="ocrExtractedText" style="width: 100%; height: 180px; background: transparent; border: none; color: #fff; font-family: monospace; font-size: 0.85rem; outline: none;"></textarea>
                    <button type="button" class="filter-btn active" id="btnCopyOcrText" style="margin-top: 0.5rem;"><i class="fa-solid fa-copy"></i> Copiar Texto</button>
                </div>
                <a href="#" class="btn-download" id="btnDownloadResult" download><i class="fa-solid fa-download"></i> Baixar Arquivo Pronto</a>
                <button type="button" class="filter-btn" id="btnResetTool" style="margin-top: 1.5rem; display: block; margin-left: auto; margin-right: auto;"><i class="fa-solid fa-rotate-left"></i> Fazer Outro Arquivo</button>
            </div>
        </div>
    </div>

    <!-- Footer Obrigatório (Padrão 4U.IA.BR) -->
    <footer class="footer-clean">
        <div class="container">
            <div class="footer-brand">
                <i class="fa-solid fa-file-pdf" style="color: #fb7185;"></i> <span>PDFácil — 4U.IA.BR</span>
            </div>
            <div class="footer-links">
                <a href="privacidade.php">Privacidade & LGPD</a>
                <span class="sep">•</span>
                <a href="termos.php">Termos de Uso</a>
                <span class="sep">•</span>
                <a href="suporte.php">Suporte & FAQ</a>
                <span class="sep">•</span>
                <a href="https://www.paypal.com/ncp/payment/L7YRCS984T33N" target="_blank" rel="noopener noreferrer" class="donate-link" title="Apoie o Projeto via PayPal"><i class="fa-solid fa-mug-saucer"></i> Apoie</a>
                <span class="sep">•</span>
                <a href="https://github.com/4u-Labs" target="_blank" rel="noopener noreferrer" title="4U.IA.BR no GitHub"><i class="fa-brands fa-github"></i> GitHub</a>
            </div>
            <div class="footer-copyright">
                &copy; <span id="year"><?php echo date('Y'); ?></span> 4U.IA.BR — Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <!-- Script Principal do PDFácil -->
    <script>
        const { PDFDocument, rgb, degrees } = window.PDFLib || {};

        // Estado da Aplicação
        let activeTool = 'merge';
        let loadedFiles = [];
        let loadedPages = [];
        let signInkColor = '#1d4ed8';
        let signDrawing = false;
        let isStandAlone = window.matchMedia('(display-mode: standalone)').matches || navigator.standalone === true;

        // PWA Install Handling
        let deferredInstallPrompt = null;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredInstallPrompt = e;
            const btn = document.getElementById('btn-pwa-install');
            if (btn && !isStandAlone) btn.style.display = 'inline-flex';
        });

        document.getElementById('btn-pwa-install')?.addEventListener('click', async () => {
            if (deferredInstallPrompt) {
                deferredInstallPrompt.prompt();
                const { outcome } = await deferredInstallPrompt.userChoice;
                deferredInstallPrompt = null;
                document.getElementById('btn-pwa-install').style.display = 'none';
            } else {
                alert('Para instalar no iOS/Safari: toque no botão Compartilhar ➔ "Adicionar à Tela de Início".');
            }
        });

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('sw.js').catch(() => {});
        }

        // Filtro e Busca de Ferramentas
        const toolSearch = document.getElementById('toolSearch');
        const toolsGrid = document.getElementById('toolsGrid');
        const filterBtns = document.querySelectorAll('.filter-btn[data-cat]');

        toolSearch.addEventListener('input', () => {
            const q = toolSearch.value.toLowerCase().trim();
            document.querySelectorAll('.tool-card').forEach(card => {
                const title = card.querySelector('.tool-title').textContent.toLowerCase();
                const desc = card.querySelector('.tool-desc').textContent.toLowerCase();
                const match = title.includes(q) || desc.includes(q);
                card.style.display = match ? 'flex' : 'none';
            });
        });

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const cat = btn.dataset.cat;
                document.querySelectorAll('.tool-card').forEach(card => {
                    if (cat === 'all' || card.dataset.cat === cat) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Configurações e Títulos de cada Ferramenta
        const toolConfigs = {
            merge: {
                title: 'Juntar PDF',
                icon: 'fa-object-group',
                accept: '.pdf',
                multiple: true,
                dropDesc: 'Selecione 2 ou mais arquivos PDF para unificar',
                btnText: 'Juntar PDFs Agora',
                optionsHtml: `<p style="font-size:0.85rem; color:var(--text-muted); margin:0;">Arraste as miniaturas acima para reordenar a sequência exata em que as páginas serão mescladas.</p>`
            },
            split: {
                title: 'Dividir PDF',
                icon: 'fa-scissors',
                accept: '.pdf',
                multiple: false,
                dropDesc: 'Selecione o arquivo PDF que deseja dividir',
                btnText: 'Dividir Documento',
                optionsHtml: `
                    <div class="control-group">
                        <label class="control-label">Intervalo de Páginas (ex: 1-3, 5, 8-10):</label>
                        <input type="text" id="splitRangeInput" class="control-input" placeholder="Deixe em branco para extrair todas as selecionadas">
                    </div>`
            },
            compress: {
                title: 'Comprimir PDF',
                icon: 'fa-file-zipper',
                accept: '.pdf',
                multiple: false,
                dropDesc: 'Selecione o arquivo PDF para otimizar',
                btnText: 'Comprimir PDF',
                optionsHtml: `
                    <div class="control-group">
                        <label class="control-label">Nível de Compressão:</label>
                        <select id="compressLevel" class="control-select">
                            <option value="recommended">Recomendada (Ótimo equilíbrio nitidez/tamanho)</option>
                            <option value="extreme">Extrema (Menor tamanho possível - 72 DPI)</option>
                            <option value="low">Leve (Máxima qualidade gráfica - 300 DPI)</option>
                        </select>
                    </div>`
            },
            sign: {
                title: 'Assinar PDF',
                icon: 'fa-signature',
                accept: '.pdf',
                multiple: false,
                dropDesc: 'Selecione o PDF para assinar digitalmente',
                btnText: 'Aplicar Assinatura no PDF',
                optionsHtml: `<p style="font-size:0.85rem; color:var(--text-muted); margin:0;">Desenhe sua assinatura no quadro acima. Ela será carimbada no rodapé da página selecionada.</p>`
            },
            img_to_pdf: {
                title: 'Imagens para PDF',
                icon: 'fa-images',
                accept: 'image/jpeg,image/png,image/webp',
                multiple: true,
                dropDesc: 'Selecione imagens JPG, PNG ou WebP',
                btnText: 'Criar PDF a partir das Imagens',
                optionsHtml: `
                    <div class="control-group">
                        <label class="control-label">Margem da Página:</label>
                        <select id="imgPdfMargin" class="control-select">
                            <option value="none">Sem Margem (Preenchimento Total)</option>
                            <option value="small">Margem Pequena (20px)</option>
                            <option value="large">Margem Grande (40px)</option>
                        </select>
                    </div>`
            },
            pdf_to_img: {
                title: 'PDF para Imagens',
                icon: 'fa-file-image',
                accept: '.pdf',
                multiple: false,
                dropDesc: 'Selecione o PDF para extrair imagens',
                btnText: 'Extrair Páginas em Imagens',
                optionsHtml: `
                    <div class="control-group">
                        <label class="control-label">Formato de Saída:</label>
                        <select id="imgOutputFormat" class="control-select">
                            <option value="png">PNG (Máxima Fidelidade)</option>
                            <option value="jpeg">JPG (Mais Leve)</option>
                        </select>
                    </div>`
            },
            to_pdf: {
                title: 'Word / Office para PDF',
                icon: 'fa-file-word',
                accept: '.docx,.doc,.xlsx,.xls,.pptx,.ppt,.odt,.txt,.rtf',
                multiple: false,
                dropDesc: 'Selecione arquivo Word, Excel ou PowerPoint',
                btnText: 'Converter para PDF',
                optionsHtml: `<p style="font-size:0.85rem; color:var(--text-muted); margin:0;">O arquivo será convertido com layout idêntico via motor de renderização do servidor.</p>`
            },
            to_word: {
                title: 'PDF para Word',
                icon: 'fa-file-lines',
                accept: '.pdf',
                multiple: false,
                dropDesc: 'Selecione o PDF para converter em DOCX',
                btnText: 'Converter para Word (.docx)',
                optionsHtml: `<p style="font-size:0.85rem; color:var(--text-muted); margin:0;">O documento será convertido em arquivo do Word editável preservando parágrafos e tabelas.</p>`
            },
            rotate: {
                title: 'Girar Páginas',
                icon: 'fa-rotate-right',
                accept: '.pdf',
                multiple: false,
                dropDesc: 'Selecione o PDF para girar páginas',
                btnText: 'Salvar PDF com Páginas Giradas',
                optionsHtml: `<p style="font-size:0.85rem; color:var(--text-muted); margin:0;">Use os botões de rotação nas miniaturas para orientar as páginas no sentido horário.</p>`
            },
            delete_pages: {
                title: 'Excluir Páginas',
                icon: 'fa-trash-can',
                accept: '.pdf',
                multiple: false,
                dropDesc: 'Selecione o PDF para excluir páginas',
                btnText: 'Salvar PDF sem as Páginas Excluídas',
                optionsHtml: `<p style="font-size:0.85rem; color:var(--text-muted); margin:0;">Clique no ícone de lixeira nas miniaturas para marcar as páginas que devem ser removidas.</p>`
            },
            watermark: {
                title: 'Marca d\'Água',
                icon: 'fa-stamp',
                accept: '.pdf',
                multiple: false,
                dropDesc: 'Selecione o PDF para carimbar',
                btnText: 'Inserir Marca d\'Água',
                optionsHtml: `
                    <div class="control-group">
                        <label class="control-label">Texto do Carimbo / Marca:</label>
                        <input type="text" id="watermarkText" class="control-input" value="CONFIDENCIAL">
                    </div>
                    <div class="control-group">
                        <label class="control-label">Opacidade:</label>
                        <select id="watermarkOpacity" class="control-select">
                            <option value="0.25">25% (Suave / Transparente)</option>
                            <option value="0.5">50% (Médio)</option>
                            <option value="0.8">80% (Forte)</option>
                        </select>
                    </div>`
            },
            ocr: {
                title: 'OCR & Extrair Texto',
                icon: 'fa-font',
                accept: '.pdf,image/*',
                multiple: false,
                dropDesc: 'Selecione o PDF ou imagem para ler o texto',
                btnText: 'Reconhecer Texto com IA',
                optionsHtml: `
                    <div class="control-group">
                        <label class="control-label">Idioma do Documento:</label>
                        <select id="ocrLang" class="control-select">
                            <option value="por+eng">Português + Inglês</option>
                            <option value="por">Apenas Português</option>
                            <option value="eng">Apenas Inglês</option>
                        </select>
                    </div>`
            }
        };

        // Abertura do Modal de Workspace
        document.querySelectorAll('.tool-card').forEach(card => {
            card.addEventListener('click', () => {
                openWorkspace(card.dataset.tool);
            });
        });

        const modal = document.getElementById('workspaceModal');
        const btnCloseWs = document.getElementById('btnCloseWs');
        const fileInput = document.getElementById('fileInput');
        const dropzone = document.getElementById('dropzone');
        const filePreviewArea = document.getElementById('filePreviewArea');
        const resultBox = document.getElementById('resultBox');
        const progressWrap = document.getElementById('progressWrap');
        const progressBarFill = document.getElementById('progressBarFill');
        const progressText = document.getElementById('progressText');
        const btnExecuteAction = document.getElementById('btnExecuteAction');
        const pagesGrid = document.getElementById('pagesGrid');

        function openWorkspace(tool) {
            activeTool = tool;
            resetWorkspace();

            const cfg = toolConfigs[tool];
            document.getElementById('wsHeaderTitle').innerHTML = `<i class="fa-solid ${cfg.icon} text-primary"></i> <span>${cfg.title}</span>`;
            document.getElementById('dropzoneTitle').textContent = `Selecione ou arraste seu arquivo para ${cfg.title}`;
            document.getElementById('dropzoneDesc').textContent = cfg.dropDesc;
            document.getElementById('executeBtnText').textContent = cfg.btnText;
            document.getElementById('dynamicOptionsContent').innerHTML = cfg.optionsHtml;

            fileInput.accept = cfg.accept;
            fileInput.multiple = cfg.multiple;

            if (tool === 'sign') {
                document.getElementById('signSpecificControls').style.display = 'block';
                initSignaturePad();
            } else {
                document.getElementById('signSpecificControls').style.display = 'none';
            }

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeWorkspace() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
            resetWorkspace();
        }

        btnCloseWs.addEventListener('click', closeWorkspace);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeWorkspace();
            }
        });

        function resetWorkspace() {
            loadedFiles = [];
            loadedPages = [];
            pagesGrid.innerHTML = '';
            filePreviewArea.style.display = 'none';
            resultBox.style.display = 'none';
            dropzone.style.display = 'block';
            progressWrap.style.display = 'none';
            btnExecuteAction.disabled = false;
            fileInput.value = '';
            document.getElementById('ocrResultBox').style.display = 'none';
        }

        document.getElementById('btnResetTool').addEventListener('click', resetWorkspace);

        // Upload e Drag & Drop
        document.getElementById('btnBrowseFile').addEventListener('click', (e) => {
            e.stopPropagation();
            fileInput.click();
        });

        dropzone.addEventListener('click', () => fileInput.click());

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });

        dropzone.addEventListener('dragleave', () => dropzone.classList.remove('dragover'));

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('dragover');
            if (e.dataTransfer.files.length) {
                handleSelectedFiles(e.dataTransfer.files);
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) {
                handleSelectedFiles(fileInput.files);
            }
        });

        document.getElementById('btnAddMoreFiles')?.addEventListener('click', () => fileInput.click());

        async function handleSelectedFiles(fileList) {
            const files = Array.from(fileList);
            if (!files.length) return;

            // Para ferramentas simples de servidor (Word, OCR, Compressão de servidor)
            if (['to_pdf', 'to_word', 'compress', 'ocr'].includes(activeTool)) {
                loadedFiles = [files[0]];
                dropzone.style.display = 'none';
                filePreviewArea.style.display = 'flex';
                pagesGrid.style.display = 'none';
                document.getElementById('previewFileInfo').innerHTML = `<i class="fa-solid fa-file"></i> Arquivo carregado: <strong>${files[0].name}</strong> (${formatBytes(files[0].size)})`;
                return;
            }

            // Para imagens para PDF
            if (activeTool === 'img_to_pdf') {
                loadedFiles = files.filter(f => f.type.startsWith('image/'));
                if (!loadedFiles.length) { alert('Selecione imagens válidas.'); return; }
                renderImageThumbnails(loadedFiles);
                return;
            }

            // Para ferramentas com leitura visual de PDF via PDF.js / PDF-Lib
            showProgress('Carregando e renderizando miniaturas...', 20);
            try {
                if (activeTool === 'merge') {
                    for (const f of files) {
                        if (f.name.toLowerCase().endsWith('.pdf')) {
                            loadedFiles.push(f);
                        }
                    }
                    await renderMergeThumbnails(loadedFiles);
                } else {
                    loadedFiles = [files[0]];
                    await renderSinglePdfPages(files[0]);
                }
            } catch (err) {
                alert('Erro ao processar PDF: ' + err.message);
                resetWorkspace();
            } finally {
                hideProgress();
            }
        }

        // Renderização de miniaturas de Imagens para PDF
        function renderImageThumbnails(images) {
            dropzone.style.display = 'none';
            filePreviewArea.style.display = 'flex';
            pagesGrid.style.display = 'grid';
            pagesGrid.innerHTML = '';
            document.getElementById('previewFileInfo').textContent = `${images.length} imagem(ns) carregada(s):`;

            images.forEach((imgFile, idx) => {
                const card = document.createElement('div');
                card.className = 'page-card';
                card.dataset.index = idx;
                const img = document.createElement('img');
                img.className = 'page-thumb-canvas';
                img.src = URL.createObjectURL(imgFile);
                card.innerHTML = `<span class="page-badge-num">#${idx + 1}</span>`;
                card.appendChild(img);
                pagesGrid.appendChild(card);
            });

            new Sortable(pagesGrid, { animation: 150 });
        }

        // Renderização para Juntar PDF
        async function renderMergeThumbnails(files) {
            dropzone.style.display = 'none';
            filePreviewArea.style.display = 'flex';
            pagesGrid.style.display = 'grid';
            pagesGrid.innerHTML = '';
            document.getElementById('btnAddMoreFiles').style.display = 'inline-block';
            document.getElementById('previewFileInfo').textContent = `${files.length} documento(s) na fila para unir:`;

            for (let fIdx = 0; fIdx < files.length; fIdx++) {
                const file = files[fIdx];
                const arrayBuffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                const page = await pdf.getPage(1);
                const viewport = page.getViewport({ scale: 0.25 });

                const card = document.createElement('div');
                card.className = 'page-card';
                card.dataset.fileIndex = fIdx;

                const canvas = document.createElement('canvas');
                canvas.className = 'page-thumb-canvas';
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                const ctx = canvas.getContext('2d');
                await page.render({ canvasContext: ctx, viewport: viewport }).promise;

                card.innerHTML = `
                    <span class="page-badge-num">${fIdx + 1}</span>
                    <div style="font-size:0.7rem; font-weight:700; max-width:110px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; margin-top:4px;">${file.name}</div>
                    <div style="font-size:0.65rem; color:var(--text-muted);">${pdf.numPages} pág(s)</div>
                `;
                card.insertBefore(canvas, card.children[1]);
                pagesGrid.appendChild(card);
            }

            new Sortable(pagesGrid, { animation: 150 });
        }

        // Renderização de páginas individuais de um PDF
        async function renderSinglePdfPages(file) {
            dropzone.style.display = 'none';
            filePreviewArea.style.display = 'flex';
            pagesGrid.style.display = 'grid';
            pagesGrid.innerHTML = '';
            document.getElementById('previewFileInfo').textContent = `Documento: ${file.name}`;

            const arrayBuffer = await file.arrayBuffer();
            const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
            loadedPages = [];

            for (let pNum = 1; pNum <= pdf.numPages; pNum++) {
                const page = await pdf.getPage(pNum);
                const viewport = page.getViewport({ scale: 0.25 });

                const card = document.createElement('div');
                card.className = 'page-card';
                card.dataset.pageNum = pNum;
                card.dataset.rotation = 0;

                const canvas = document.createElement('canvas');
                canvas.className = 'page-thumb-canvas';
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                const ctx = canvas.getContext('2d');
                await page.render({ canvasContext: ctx, viewport: viewport }).promise;

                card.innerHTML = `
                    <span class="page-badge-num">Pág ${pNum}</span>
                    <div class="page-actions">
                        <button type="button" class="btn-page-action btn-rotate" title="Girar 90°"><i class="fa-solid fa-rotate-right"></i></button>
                        <button type="button" class="btn-page-action btn-delete" title="Excluir Página"><i class="fa-solid fa-trash"></i></button>
                    </div>
                `;
                card.insertBefore(canvas, card.children[1]);

                // Ações individuais
                card.querySelector('.btn-rotate').addEventListener('click', (e) => {
                    e.stopPropagation();
                    let currentRot = parseInt(card.dataset.rotation || '0', 10);
                    currentRot = (currentRot + 90) % 360;
                    card.dataset.rotation = currentRot;
                    canvas.style.transform = `rotate(${currentRot}deg)`;
                });

                card.querySelector('.btn-delete').addEventListener('click', (e) => {
                    e.stopPropagation();
                    card.classList.toggle('deleted');
                });

                pagesGrid.appendChild(card);
                loadedPages.push({ pageNum: pNum, card });
            }

            new Sortable(pagesGrid, { animation: 150 });
        }

        // Assinatura Canvas Pad
        function initSignaturePad() {
            const canvas = document.getElementById('signCanvas');
            const ctx = canvas.getContext('2d');
            ctx.lineWidth = 3;
            ctx.lineCap = 'round';
            ctx.strokeStyle = signInkColor;

            function startDraw(e) {
                signDrawing = true;
                const rect = canvas.getBoundingClientRect();
                const x = (e.clientX || e.touches[0].clientX) - rect.left;
                const y = (e.clientY || e.touches[0].clientY) - rect.top;
                ctx.beginPath();
                ctx.moveTo(x, y);
            }

            function draw(e) {
                if (!signDrawing) return;
                const rect = canvas.getBoundingClientRect();
                const x = (e.clientX || e.touches[0].clientX) - rect.left;
                const y = (e.clientY || e.touches[0].clientY) - rect.top;
                ctx.lineTo(x, y);
                ctx.stroke();
            }

            function stopDraw() {
                signDrawing = false;
            }

            canvas.onmousedown = startDraw;
            canvas.onmousemove = draw;
            window.onmouseup = stopDraw;

            canvas.ontouchstart = startDraw;
            canvas.ontouchmove = draw;
            canvas.ontouchend = stopDraw;

            document.getElementById('btnClearSign').onclick = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            };

            document.getElementById('btnSignColorBlue').onclick = () => {
                signInkColor = '#1d4ed8';
                ctx.strokeStyle = signInkColor;
                document.getElementById('btnSignColorBlue').classList.add('active');
                document.getElementById('btnSignColorBlack').classList.remove('active');
            };

            document.getElementById('btnSignColorBlack').onclick = () => {
                signInkColor = '#0f172a';
                ctx.strokeStyle = signInkColor;
                document.getElementById('btnSignColorBlack').classList.add('active');
                document.getElementById('btnSignColorBlue').classList.remove('active');
            };
        }

        // EXECUÇÃO DAS AÇÕES
        btnExecuteAction.addEventListener('click', async () => {
            btnExecuteAction.disabled = true;
            showProgress('Processando seu arquivo com tecnologia de ponta...', 30);

            try {
                if (activeTool === 'merge') {
                    await executeMerge();
                } else if (activeTool === 'split') {
                    await executeSplit();
                } else if (activeTool === 'img_to_pdf') {
                    await executeImagesToPdf();
                } else if (activeTool === 'pdf_to_img') {
                    await executePdfToImages();
                } else if (activeTool === 'rotate' || activeTool === 'delete_pages') {
                    await executeOrganize();
                } else if (activeTool === 'watermark') {
                    await executeWatermark();
                } else if (activeTool === 'sign') {
                    await executeSign();
                } else if (['to_pdf', 'to_word', 'compress', 'ocr'].includes(activeTool)) {
                    await executeServerAction(activeTool);
                }
            } catch (err) {
                alert('Erro durante o processamento: ' + err.message);
                btnExecuteAction.disabled = false;
                hideProgress();
            }
        });

        // 1. JUNTAR PDF (Local)
        async function executeMerge() {
            showProgress('Mesclando páginas dos documentos...', 60);
            const mergedPdf = await PDFDocument.create();
            const cards = Array.from(pagesGrid.querySelectorAll('.page-card'));

            for (const c of cards) {
                const fIdx = parseInt(c.dataset.fileIndex, 10);
                const file = loadedFiles[fIdx];
                const arrayBuffer = await file.arrayBuffer();
                const srcPdf = await PDFDocument.load(arrayBuffer);
                const copiedPages = await mergedPdf.copyPages(srcPdf, srcPdf.getPageIndices());
                copiedPages.forEach(p => mergedPdf.addPage(p));
            }

            const pdfBytes = await mergedPdf.save();
            const blob = new Blob([pdfBytes], { type: 'application/pdf' });
            showSuccessDownload(blob, 'PDF_Unificado.pdf', `União de ${loadedFiles.length} documentos concluída.`);
        }

        // 2. DIVIDIR PDF (Local)
        async function executeSplit() {
            showProgress('Separando páginas solicitadas...', 60);
            const file = loadedFiles[0];
            const arrayBuffer = await file.arrayBuffer();
            const srcPdf = await PDFDocument.load(arrayBuffer);
            const totalPages = srcPdf.getPageCount();

            const rangeStr = document.getElementById('splitRangeInput')?.value.trim();
            let selectedIndices = [];

            if (rangeStr) {
                const parts = rangeStr.split(',');
                for (const part of parts) {
                    if (part.includes('-')) {
                        const [start, end] = part.split('-').map(n => parseInt(n.trim(), 10));
                        for (let i = start; i <= end; i++) {
                            if (i >= 1 && i <= totalPages) selectedIndices.push(i - 1);
                        }
                    } else {
                        const p = parseInt(part.trim(), 10);
                        if (p >= 1 && p <= totalPages) selectedIndices.push(p - 1);
                    }
                }
            } else {
                const cards = Array.from(pagesGrid.querySelectorAll('.page-card:not(.deleted)'));
                selectedIndices = cards.map(c => parseInt(c.dataset.pageNum, 10) - 1);
            }

            if (!selectedIndices.length) throw new Error('Nenhuma página válida selecionada para divisão.');

            const newPdf = await PDFDocument.create();
            const copiedPages = await newPdf.copyPages(srcPdf, selectedIndices);
            copiedPages.forEach(p => newPdf.addPage(p));

            const pdfBytes = await newPdf.save();
            const blob = new Blob([pdfBytes], { type: 'application/pdf' });
            showSuccessDownload(blob, 'PDF_Dividido.pdf', `${selectedIndices.length} página(s) extraída(s) com sucesso.`);
        }

        // 3. IMAGENS PARA PDF (Local)
        async function executeImagesToPdf() {
            showProgress('Compilando imagens em documento PDF...', 50);
            const newPdf = await PDFDocument.create();
            const marginOpt = document.getElementById('imgPdfMargin')?.value || 'none';
            const margin = marginOpt === 'small' ? 20 : (marginOpt === 'large' ? 40 : 0);

            const cards = Array.from(pagesGrid.querySelectorAll('.page-card'));
            for (const c of cards) {
                const idx = parseInt(c.dataset.index, 10);
                const file = loadedFiles[idx];
                const arrayBuffer = await file.arrayBuffer();

                let embeddedImg;
                if (file.type === 'image/png') {
                    embeddedImg = await newPdf.embedPng(arrayBuffer);
                } else {
                    embeddedImg = await newPdf.embedJpg(arrayBuffer);
                }

                const page = newPdf.addPage([embeddedImg.width + margin * 2, embeddedImg.height + margin * 2]);
                page.drawImage(embeddedImg, {
                    x: margin,
                    y: margin,
                    width: embeddedImg.width,
                    height: embeddedImg.height
                });
            }

            const pdfBytes = await newPdf.save();
            const blob = new Blob([pdfBytes], { type: 'application/pdf' });
            showSuccessDownload(blob, 'Imagens_Convertidas.pdf', `${cards.length} imagem(ns) transformadas em PDF.`);
        }

        // 4. PDF PARA IMAGENS (Local com PDF.js e JSZip)
        async function executePdfToImages() {
            showProgress('Renderizando páginas em alta resolução...', 40);
            const file = loadedFiles[0];
            const arrayBuffer = await file.arrayBuffer();
            const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
            const format = document.getElementById('imgOutputFormat')?.value || 'png';
            const mime = format === 'jpeg' ? 'image/jpeg' : 'image/png';

            const zip = new JSZip();
            for (let i = 1; i <= pdf.numPages; i++) {
                showProgress(`Convertendo página ${i} de ${pdf.numPages}...`, Math.round((i / pdf.numPages) * 80));
                const page = await pdf.getPage(i);
                const viewport = page.getViewport({ scale: 2.0 }); // Alta resolução 2x
                const canvas = document.createElement('canvas');
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                const ctx = canvas.getContext('2d');
                await page.render({ canvasContext: ctx, viewport }).promise;

                const dataUrl = canvas.toDataURL(mime, 0.95);
                const base64Data = dataUrl.split(',')[1];
                zip.file(`pagina_${i}.${format}`, base64Data, { base64: true });
            }

            showProgress('Gerando pacote compactado ZIP...', 90);
            const zipBlob = await zip.generateAsync({ type: 'blob' });
            showSuccessDownload(zipBlob, 'Paginas_Extraidas.zip', `${pdf.numPages} páginas convertidas em imagens ZIP.`);
        }

        // 5. GIRAR E EXCLUIR PÁGINAS (Organizar)
        async function executeOrganize() {
            showProgress('Aplicando rotações e reordenação...', 60);
            const file = loadedFiles[0];
            const arrayBuffer = await file.arrayBuffer();
            const srcPdf = await PDFDocument.load(arrayBuffer);
            const newPdf = await PDFDocument.create();

            const cards = Array.from(pagesGrid.querySelectorAll('.page-card:not(.deleted)'));
            if (!cards.length) throw new Error('Não é possível gerar um PDF sem nenhuma página.');

            for (const c of cards) {
                const pNum = parseInt(c.dataset.pageNum, 10);
                const rotAngle = parseInt(c.dataset.rotation || '0', 10);
                const [copiedPage] = await newPdf.copyPages(srcPdf, [pNum - 1]);
                if (rotAngle !== 0) {
                    const existingRot = copiedPage.getRotation().angle;
                    copiedPage.setRotation(degrees((existingRot + rotAngle) % 360));
                }
                newPdf.addPage(copiedPage);
            }

            const pdfBytes = await newPdf.save();
            const blob = new Blob([pdfBytes], { type: 'application/pdf' });
            showSuccessDownload(blob, 'PDF_Organizado.pdf', 'Documento reordenado com sucesso.');
        }

        // 6. MARCA D'ÁGUA (Local)
        async function executeWatermark() {
            showProgress('Carimbando marca d\'água em todas as páginas...', 60);
            const file = loadedFiles[0];
            const arrayBuffer = await file.arrayBuffer();
            const pdfDoc = await PDFDocument.load(arrayBuffer);
            const text = document.getElementById('watermarkText')?.value || 'CONFIDENCIAL';
            const opacity = parseFloat(document.getElementById('watermarkOpacity')?.value || '0.3');

            const pages = pdfDoc.getPages();
            for (const page of pages) {
                const { width, height } = page.getSize();
                page.drawText(text, {
                    x: width / 4,
                    y: height / 2,
                    size: 42,
                    color: rgb(0.88, 0.11, 0.28),
                    opacity: opacity,
                    rotate: degrees(45)
                });
            }

            const pdfBytes = await pdfDoc.save();
            const blob = new Blob([pdfBytes], { type: 'application/pdf' });
            showSuccessDownload(blob, 'PDF_Com_Marca.pdf', 'Marca d\'água inserida com sucesso.');
        }

        // 7. ASSINATURA (Local)
        async function executeSign() {
            showProgress('Carimbando assinatura no documento...', 60);
            const file = loadedFiles[0];
            const arrayBuffer = await file.arrayBuffer();
            const pdfDoc = await PDFDocument.load(arrayBuffer);

            const canvas = document.getElementById('signCanvas');
            const signDataUrl = canvas.toDataURL('image/png');
            const signPng = await pdfDoc.embedPng(signDataUrl);

            const pages = pdfDoc.getPages();
            const lastPage = pages[pages.length - 1]; // Aplica na última página (local comum de assinatura)
            const { width, height } = lastPage.getSize();

            const signWidth = 160;
            const signHeight = 50;
            lastPage.drawImage(signPng, {
                x: width - signWidth - 50,
                y: 80,
                width: signWidth,
                height: signHeight
            });

            const pdfBytes = await pdfDoc.save();
            const blob = new Blob([pdfBytes], { type: 'application/pdf' });
            showSuccessDownload(blob, 'PDF_Assinado.pdf', 'Documento assinado digitalmente.');
        }

        // 8. SERVIDOR (Word, Compressão Ghostscript, OCR)
        async function executeServerAction(actionName) {
            showProgress('Enviando para motor do servidor...', 35);
            const file = loadedFiles[0];
            const formData = new FormData();
            formData.append('file', file);
            formData.append('action', actionName);

            if (actionName === 'compress') {
                formData.append('level', document.getElementById('compressLevel')?.value || 'recommended');
            } else if (actionName === 'ocr') {
                formData.append('lang', document.getElementById('ocrLang')?.value || 'por+eng');
            }

            showProgress('Processando conversão em segundo plano...', 65);
            const res = await fetch('api.php', { method: 'POST', body: formData });
            const data = await res.json();

            if (!res.ok || data.error) {
                throw new Error(data.error || 'Falha no processamento do servidor.');
            }

            if (actionName === 'ocr') {
                document.getElementById('ocrResultBox').style.display = 'block';
                document.getElementById('ocrExtractedText').value = data.text;
                document.getElementById('btnDownloadResult').style.display = 'none';
                showSuccessMessage('Texto Reconhecido com Sucesso!', `${data.wordCount || 0} palavras identificadas pelo motor Tesseract.`);
                document.getElementById('btnCopyOcrText').onclick = () => {
                    navigator.clipboard.writeText(data.text);
                    alert('Texto copiado para a área de transferência!');
                };
            } else {
                const btnDownload = document.getElementById('btnDownloadResult');
                btnDownload.style.display = 'inline-flex';
                btnDownload.href = data.downloadUrl;
                btnDownload.download = data.filename;

                let infoMsg = `Arquivo gerado: ${data.filename}`;
                if (data.reductionPercent) {
                    infoMsg += ` • Redução de ${data.reductionPercent}% no tamanho!`;
                }
                showSuccessMessage('Arquivo Convertido com Sucesso!', infoMsg);
            }
        }

        // Helpers de Sucesso e Progresso
        function showProgress(text, pct) {
            progressWrap.style.display = 'block';
            progressBarFill.style.width = pct + '%';
            progressText.textContent = text;
        }

        function hideProgress() {
            progressWrap.style.display = 'none';
        }

        function showSuccessDownload(blob, filename, infoText) {
            hideProgress();
            filePreviewArea.style.display = 'none';
            resultBox.style.display = 'block';

            const url = URL.createObjectURL(blob);
            const btn = document.getElementById('btnDownloadResult');
            btn.style.display = 'inline-flex';
            btn.href = url;
            btn.download = filename;

            document.getElementById('resultInfo').textContent = infoText;
        }

        function showSuccessMessage(title, infoText) {
            hideProgress();
            filePreviewArea.style.display = 'none';
            resultBox.style.display = 'block';
            document.querySelector('.result-title').textContent = title;
            document.getElementById('resultInfo').textContent = infoText;
        }

        function formatBytes(bytes, decimals = 1) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }
    </script>
</body>

</html>
