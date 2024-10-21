<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - <?php echo $site_name; ?></title>
    <link rel="stylesheet" href="/cardapio-dinamicoo/assets/css/style.css">
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
            flex-wrap: wrap; /* Permite quebra em telas menores */
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px; /* Espaço entre logo e título */
        }

        .logo-container img {
            width: 50px; /* Ajusta o tamanho da logo */
            height: auto; /* Mantém a proporção da imagem */
        }

        .logo-container h1 {
            margin: 0;
            font-size: 1.5em;
            color: #d4af37; /* Cor dourada para o nome do site */
            white-space: nowrap; /* Impede quebra de linha */
        }

        .return-button-container {
            margin-top: 10px;
        }

        .return-button {
            text-decoration: none;
            color: white;
            background-color: #f0d28b; /* Cor original do botão */
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        .return-button:hover {
            background-color: #e0b94f; /* Cor de hover */
        }

        /* Responsividade para telas menores */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .logo-container {
                margin-bottom: 10px;
                justify-content: center;
            }

            .logo-container h1 {
                font-size: 1.2em;
            }

            .return-button {
                width: 100%;
                text-align: center;
                margin-top: 10px;
            }
        }

        @media (max-width: 576px) {
            .logo-container img {
                width: 40px; /* Reduz o tamanho da logo em telas menores */
            }

            .logo-container h1 {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>

<header>
    <!-- Espaço para a logo e o nome do site -->
    <div class="logo-container">
        <img src="../path/logo.jpg" alt="Logo do Cliente" class="logo">
        <h1><?php echo $site_name; ?></h1>
    </div>

    <!-- Botão para retornar ao index principal -->
    <div class="return-button-container">
        <a href="/cardapio-dinamicoo/index.php" class="return-button">Retornar ao Início</a>
    </div>
</header>

<main>
