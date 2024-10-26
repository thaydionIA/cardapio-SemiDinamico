<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - <?php echo $site_name; ?></title>
    <link rel="stylesheet" href="/cardapio-SemiDinamico/assets/css/style.css">
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
            flex-wrap: wrap; /* Permite que os elementos se ajustem em telas menores */
        }

        .logo-container {
            display: flex;
            align-items: center;
            max-width: 100px; /* Ajuste a largura máxima desejada */
            height: auto;
            overflow: hidden; /* Impede que o conteúdo exceda o container */
        }

        .logo-container img {
            width: 100%;
            height: auto; /* Mantém a proporção da imagem */
        }

        .return-button-container {
            margin: 10px 0;
        }

        .return-button {
            text-decoration: none;
            color: white; /* Texto branco */
            background-color: #f0d28b;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        .return-button:hover {
            background-color: #e0b94f; /* Cor de hover */
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 15px;
            flex-wrap: wrap; /* Permite a quebra de linha em telas menores */
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
            background-color: #d4af37; /* Cor de hover */
        }

        /* Responsividade para telas menores */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: center;
            }

            .logo-container {
                margin-bottom: 10px;
            }

            .return-button-container {
                margin-bottom: 10px;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            nav ul li {
                margin: 5px 0;
            }

            .return-button {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .logo-container {
                max-width: 80px; /* Reduz o tamanho da logo em telas menores */
            }

            .site-title {
                font-size: 1em;
                text-align: center;
                margin: 0;
            }
        }
    </style>
</head>
<body>

<header>
    <!-- Espaço para a logo do cliente -->
    <div class="logo-container">
        <img src="../path/logo.jpg" alt="Logo do Cliente" class="logo">
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

<main>
