<?php
$GLOBALS['incluir_rodape'] = false; // Define que o rodapé não deve ser incluído
include 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - <?php echo $site_name; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Adiciona FontAwesome -->
    <style>
        body {
            color: <?php echo $text_color; ?>;
        }
        header {
            background-color: <?php echo $primary_color; ?>;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        .logo-container img {
            width: 50px;
            height: auto;
        }
        .site-title {
            font-size: 24px;
            color: #d4af37;
            margin-left: 10px;
        }
        nav {
            display: flex;
            align-items: center;
            margin-left: auto; /* Move o menu para o lado direito */
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 15px;
        }
        nav ul li {
            margin: 0;
        }
        nav ul li a {
            color: #d4af37; /* Cor dourada para o menu */
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        nav ul li a:hover {
            background-color: white;
            color: <?php echo $primary_color; ?>;
        }
        .hamburger-menu, .menu-responsive {
            display: none; /* Oculta no desktop */
        }
        footer {
            background-color: <?php echo $primary_color; ?>;
        }
        /* Layout do cabeçalho para mobile */
      /* Ajuste do Header para Mobile */
/* Ajuste do Header para Mobile */
@media (max-width: 768px) {
    header {
        flex-direction: row;
        justify-content: space-between;
        padding: 10px;
    }

    .logo-container {
        margin-right: auto; /* Garante que a logo fique à esquerda */
    }

    .site-title {
        font-size: 18px;
        position: absolute;
        top: 10px;
        right: 50px; /* Nome do site no canto superior direito */
    }

    .hamburger-menu {
        display: block; /* Exibe o ícone de hambúrguer no mobile */
        position: absolute;
        top: 20px; /* Baixa o ícone de hambúrguer um pouco */
        right: 25px; /* Move o ícone um pouco para a esquerda */
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
    }

    .menu-responsive.menu-open {
        display: flex; /* Mostra o menu responsivo quando aberto */
        flex-direction: column;
        align-items: center;
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
        width: 100%; /* O menu agora ocupa toda a largura */
    }

    .menu-responsive ul li {
        padding: 15px 0;
        text-align: center;
        border-bottom: 1px solid #d4af37; /* Linha de separação dourada */
        width: 100%; /* Linha ocupa toda a largura */
    }

    .menu-responsive ul li a {
        color: #d4af37;
        font-size: 18px;
        display: block; /* Cada link ocupa uma linha inteira */
        width: 100%; /* O link ocupa toda a largura */
    }
}

    </style>
</head>

<body>
    <header>
        <!-- Container do Logo -->
        <div class="logo-container">
            <img src="path/logo.jpg" alt="Logo do Site <?php echo $site_name; ?>">
        </div>

        <!-- Nome do Site -->
        <h1 class="site-title"><?php echo $site_name; ?></h1>

        <!-- Ícone de hambúrguer (somente mobile) -->
        <div class="hamburger-menu" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Menu tradicional para desktop -->
        <nav>
            <ul>
                <?php foreach ($sections as $id => $section): ?>
                    <li><a href="<?php echo $section['url']; ?>"><?php echo $section['title']; ?></a></li>
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
                <li><a href="<?php echo $section['url']; ?>"><?php echo $section['title']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Banner -->
    <div class="banner">
        <img src="<?php echo $banner_image_path; ?>" alt="Banner do site <?php echo $site_name; ?>">
    </div>

    <!-- Conteúdo Principal -->
    <main>
        <?php 
        foreach ($sections as $id => $section) {
            include $section['url'];
        } 
        ?>
    </main>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 <?php echo $site_name; ?>. Todos os direitos reservados.</p>
        <ul>
            <li><a href="admin/login.php">Painel Administrativo</a></li>
        </ul>
    </footer>

    <script>
        function toggleMenu() {
            const menu = document.querySelector('.menu-responsive');
            menu.classList.toggle('menu-open');
        }
    </script>
</body>
</html>
