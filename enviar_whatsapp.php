<?php
session_start();
require_once __DIR__ . '/db/conexao.php';

if (!isset($_SESSION['carrinho'], $_SESSION['nome_cliente'])) {
    header("Location: index.php");
    exit;
}

// Dados do formulário
$telefone = htmlspecialchars($_POST['telefone']);
$endereco = htmlspecialchars($_POST['endereco']);
$pagamento = htmlspecialchars($_POST['pagamento']);

// Busca produtos
$ids = array_filter(array_map('intval', $_SESSION['carrinho']));
$idList = implode(',', $ids);

$stmt = $pdo->prepare("SELECT nome, preco FROM produtos WHERE id IN ($idList)");
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Monta mensagem formatada
$mensagem = "*🛒 Pedido Realizado*\n\n";
$mensagem .= "*Cliente:* {$_SESSION['nome_cliente']}\n";
$mensagem .= "*Telefone:* $telefone\n";
$mensagem .= "*Endereço:* $endereco\n";
$mensagem .= "*Forma de Pagamento:* $pagamento\n\n";

$mensagem .= "*Itens do Pedido:*\n";
$total = 0;
foreach ($produtos as $item) {
    $nome = $item['nome'];
    $preco = number_format($item['preco'], 2, ',', '.');
    $mensagem .= "• $nome — R$ $preco\n";
    $total += $item['preco'];
}

$mensagem .= "\n*Total:* R$ " . number_format($total, 2, ',', '.');

// Número do restaurante (com DDD, sem + ou traços)
$numero = '62992545720';

// Redireciona para WhatsApp com mensagem formatada
header("Location: https://wa.me/$numero?text=" . urlencode($mensagem));
exit;
