<?php
session_start();

if (!isset($_SESSION['nome_cliente']) || empty($_SESSION['carrinho'])) {
    header("Location: cardapio.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: #f9f9f9;
        }
        h2 {
            color: #333;
        }
        form {
            max-width: 400px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
        }
        input, textarea {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
        }
        button {
            margin-top: 15px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 18px;
            cursor: pointer;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <h2>Finalizar Pedido</h2>
    <form method="POST" action="enviar_whatsapp.php">
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required>

        <label for="endereco">Endereço:</label>
        <textarea name="endereco" id="endereco" required></textarea>

        <label>Método de Pagamento:</label>
        <input type="radio" name="pagamento" value="Dinheiro" checked> Dinheiro<br>
        <input type="radio" name="pagamento" value="Cartão"> Cartão<br>
        <input type="radio" name="pagamento" value="Pix"> Pix<br>

        <button type="submit">Enviar Pedido via WhatsApp</button>
    </form>
</body>
</html>
