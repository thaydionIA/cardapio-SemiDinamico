<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_cliente'])) {
    $_SESSION['nome_cliente'] = trim($_POST['nome_cliente']);
    header("Location: cardapio.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Entrar no Cardápio</title>
      <link rel="stylesheet" href="assets/css/style.css">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      background-color: #444;
      color: #d4af37;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      background-color: #f0d28b;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    input[type="text"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
      box-sizing: border-box;
    }

    button {
      background-color: #d4af37;
      color: #1c1c1c;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #e0b94f;
      color: #fff;
    }
  </style>
</head>
<body>
    <h2>Bem-vindo! Informe seu nome para continuar:</h2>
    <form method="POST">
        <input type="text" name="nome_cliente" required placeholder="Seu nome">
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
