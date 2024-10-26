<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - <?php echo $site_name; ?></title>
    <link rel="stylesheet" href="/cardapio-SemiDinamico/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Adiciona FontAwesome -->
    <style>
        body {
            color: <?php echo $text_color; ?>;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: <?php echo $primary_color; ?>;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            position: relative;
        }

        .logo-container {
            display: flex;
            align-items: center;
            max-width: 100px;
            height: auto;
            overflow: hidden;
        }

        .logo-container img {
            width: 100%;
            height: auto;
        }

        .site-title {
            font-size: 18px;
            color: #d4af37;
            margin-left: 10px;
            white-space: normal; /* Permite quebra de linha */
            overflow-wrap: break-word; /* Permite quebra de palavras */
            line-height: 1.2; /* Ajusta a altura da linha */
        }

        .return-button-container {
            margin: 10px 0;
        }

        .return-button {
            text-decoration: none;
            color: white;
            background-color: #f0d28b;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        .return-button:hover {
            background-color: #e0b94f;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        nav ul li {
            display: inline-block;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #d4af37;
        }

        .hamburger-menu {
            display: none; /* Escondido no desktop */
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            color: #d4af37;
            cursor: pointer;
            z-index: 2000;
        }

        .menu-responsive {
            display: none;
            background-color: <?php echo $primary_color; ?>;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 1000;
            overflow-y: auto;
            padding-top: 60px;
            flex-direction: column;
            align-items: center;
        }

        .menu-responsive.menu-open {
            display: flex; /* Mostra o menu responsivo quando aberto */
        }

        .menu-responsive ul {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .menu-responsive ul li {
            padding: 15px 0;
            text-align: center;
            border-bottom: 1px solid #d4af37;
            width: 100%;
        }

        .menu-responsive ul li a {
            color: #d4af37;
            font-size: 18px;
            display: block;
            width: 100%;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            color: #d4af37;
            cursor: pointer;
            background: none;
            border: none;
        }

        @media (max-width: 768px) {
    header {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        position: relative;
    }

    .logo-container {
        margin-right: auto; /* Garante que a logo fique totalmente à esquerda */
    }

    .site-title {
        font-size: 18px;
        position: absolute;
        top: 10px;
        right: 100px; /* Nome do site no canto superior direito */
        white-space: normal; /* Permite quebra de linha */
        overflow-wrap: break-word; /* Permite quebra de palavras longas */
        max-width: 50%; /* Limita a largura do título para facilitar a quebra */
        text-align: right; /* Alinha o texto à direita */
    }

    .hamburger-menu {
        display: block; /* Exibe o ícone de hambúrguer no mobile */
        position: absolute;
        top: 20px; /* Ajuste para o ícone de hambúrguer */
        right: 25px; /* Ajuste para o ícone de hambúrguer */
        font-size: 24px;
        color: #d4af37;
        cursor: pointer;
    }

    nav {
        display: none; /* Esconde o menu tradicional em mobile */
    }

    .menu-responsive {
        display: none;
        background-color: <?php echo $primary_color; ?>;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 1000;
        overflow-y: auto;
        padding-top: 60px;
        flex-direction: column;
        align-items: center;
    }

    .menu-responsive.menu-open {
        display: flex; /* Mostra o menu responsivo quando aberto */
    }

    .menu-responsive .close-btn {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 24px;
        color: #d4af37;
        cursor: pointer;
        background: none;
        border: none;
    }

    .menu-responsive ul {
        list-style: none;
        padding: 0;
        margin: 0;
        width: 100%;
    }

    .menu-responsive ul li {
        padding: 15px 0;
        text-align: center;
        border-bottom: 1px solid #d4af37;
        width: 100%;
    }

    .menu-responsive ul li a {
        color: #d4af37;
        font-size: 18px;
        display: block;
        width: 100%;
    }
}

    </style>
</head>
<body>

<header>
    <!-- Container do Logo -->
    <div class="logo-container">
        <img src="../path/logo.jpg" alt="Logo do Cliente" class="logo">
    </div>

    <!-- Nome do Site -->
    <h1 class="site-title"><?php echo $site_name; ?></h1>

    <!-- Ícone de hambúrguer (somente mobile) -->
    <div class="hamburger-menu" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Botão para retornar ao index principal -->
    <div class="return-button-container">
        <a href="/cardapio-SemiDinamico/index.php" class="return-button">Retornar ao Início</a>
    </div>

    <!-- Navegação principal -->
    <nav>
        <ul>
            <?php foreach ($sections as $id => $section): ?>
                <li><a href="/cardapio-SemiDinamico/<?php echo $section['url']; ?>"><?php echo $section['title']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

<!-- Menu responsivo -->
<div class="menu-responsive">
    <!-- Botão de fechar -->
    <button class="close-btn" onclick="toggleMenu()">&times;</button>
    <ul>
        <?php foreach ($sections as $id => $section): ?>
            <li><a href="/cardapio-SemiDinamico/<?php echo $section['url']; ?>"><?php echo $section['title']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>

<main>

<script>
    function toggleMenu() {
        const menu = document.querySelector('.menu-responsive');
        menu.classList.toggle('menu-open');
    }
</script>
