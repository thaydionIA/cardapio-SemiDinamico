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
            flex-wrap: wrap;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-container img {
            width: 50px;
            height: auto;
        }

        .logo-container h1 {
            margin: 0;
            font-size: 1.5em;
            color: #d4af37;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .return-button-container {
            width: 100%;
            display: flex;
            justify-content: center; /* Centraliza o botão */
            margin-top: 10px;
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

        /* Responsividade para dispositivos menores */
        @media (max-width: 768px) {
            header {
                flex-direction: row;
                justify-content: flex-start;
                align-items: center;
            }

            .logo-container {
                flex-direction: row;
                align-items: center;
                justify-content: flex-start;
            }

            .logo-container img {
                width: 40px;
            }

            .logo-container h1 {
                font-size: 1.2em;
                margin-left: 10px;
                margin-right: 80px;
            }
        }

        @media (max-width: 576px) {
            .logo-container {
                flex-direction: row;
                justify-content: flex-start;
            }

            .logo-container img {
                width: 35px;
            }

            .logo-container h1 {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>

<header>
    <!-- Logo e nome do site -->
    <div class="logo-container">
        <img src="../path/logo.jpg" alt="Logo do Cliente" class="logo">
        <h1><?php echo $site_name; ?></h1>
    </div>

   <!-- Verifica se a página atual não é login.php ou index.php -->
   <?php
    $current_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if ($current_page !== 'login.php' && $current_page !== 'index.php') {
    ?>
        <!-- Botão para retornar ao index principal -->
        <div class="return-button-container">
            <a href="/cardapio-SemiDinamico/admin/index.php" class="return-button">Retornar ao Início</a>
        </div>
    <?php } ?>
</header>

<main>
