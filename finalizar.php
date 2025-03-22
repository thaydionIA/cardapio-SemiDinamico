
<?php
session_start();
require_once __DIR__ . '/db/conexao.php';

$total = 0;

if (!empty($_SESSION['carrinho'])) {
    $ids = array_map('intval', $_SESSION['carrinho']);
    $idList = implode(',', $ids);

    $stmt = $pdo->prepare("SELECT preco FROM produtos WHERE id IN ($idList)");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($produtos as $item) {
        $total += $item['preco'];
    }
}


// Incluir o header.php somente se o arquivo estiver sendo acessado diretamente

if (basename($_SERVER['PHP_SELF']) == 'finalizar.php') {
    include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-SemiDinamico/header.php';
}

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
  html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    background-color: #444;
    color: #d4af37;
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
  }

  header {
    background-color: #1c1c1c;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    width: 100%;
    box-sizing: border-box;
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

  main {
    flex: 1;
    padding: 20px;
    width: 100%;
    box-sizing: border-box;
  }

  form {
    max-width: 500px;
    margin: 20px auto;
    background: #f0d28b;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    color: #1c1c1c;
  }

  form label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
  }

  form input[type="text"],
  form textarea {
    width: 100%;
    margin-top: 5px;
    padding: 10px;
    font-size: 16px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  form input[type="radio"] {
    margin-right: 8px;
    margin-top: 10px;
  }

  form button {
    margin-top: 25px;
    background-color: #d4af37;
    color: #1c1c1c;
    border: none;
    padding: 14px;
    width: 100%;
    font-size: 18px;
    cursor: pointer;
    border-radius: 8px;
  }

  form button:hover {
    background-color: #e0b94f;
    color: #fff;
  }

  footer {
    background-color: #1c1c1c;
    color: #d4af37;
    text-align: center;
    padding: 10px 0;
    width: 100%;
    box-sizing: border-box;
  }
  .section-title {
  font-size: 1.5em;
  margin-bottom: 10px;
  text-align: center;
}

</style>

</head>
<body>
<h2 class="section-title">Finalizar Pedido</h2>

    <form method="POST" action="enviar_whatsapp.php">
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required>

        <label for="endereco">Endereço:</label>
        <textarea name="endereco" id="endereco" required></textarea>

        <label>Método de Pagamento:</label>
        <input type="radio" name="pagamento" value="Dinheiro" checked> Dinheiro<br>
        <input type="radio" name="pagamento" value="Cartão"> Cartão<br>
        <input type="radio" name="pagamento" value="Pix"> Pix<br>

        <p style="margin-top: 20px; font-weight: bold;">
      Total do Pedido: R$ <?php echo number_format($total, 2, ',', '.'); ?>
    </p>


        <button type="submit">Enviar Pedido via WhatsApp</button>
    </form>
</body>
</html>
<?php 
if (basename($_SERVER['PHP_SELF']) == 'finalizar.php') {
    include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-SemiDinamico/footer.php';
}
?>
