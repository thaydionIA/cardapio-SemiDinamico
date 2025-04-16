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
    <form id="form-finalizar">
    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" id="telefone" required>

    <label for="endereco">Endereço:</label>
    <textarea name="endereco" id="endereco" required></textarea>

    <label>Método de Pagamento:</label>
    <input type="radio" name="pagamento" value="Dinheiro" checked> Dinheiro<br>
    <input type="radio" name="pagamento" value="Cartão" > Cartão<br>
    <input type="radio" name="pagamento" value="Pix"> Pix<br>

    <button type="submit">Enviar Pedido via WhatsApp</button>
</form>

<script>
document.getElementById('form-finalizar').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('controller/carrinho/processa_pedido.php', {
        method: 'POST',
        body: formData
    })
    .then(resp => resp.json())
    .then(data => {
        if (data.status === 'ok') {
            window.open(data.whatsapp_link, '_blank'); // Abre WhatsApp
            window.location.href = 'cardapio.php';     // Volta para o cardápio
        } else {
            alert('Erro ao finalizar pedido.');
        }
    });
});
</script>

</body>
</html>