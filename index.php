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
</head>
<body>
    <h2>Bem-vindo! Informe seu nome para continuar:</h2>
    <form method="POST">
        <input type="text" name="nome_cliente" required placeholder="Seu nome">
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
