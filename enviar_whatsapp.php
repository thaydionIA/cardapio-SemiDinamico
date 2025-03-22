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

// Monta mensagem
$mensagem = "Pedido de {$_SESSION['nome_cliente']}:%0A%0A";
$total = 0;

foreach ($produtos as $item) {
    $mensagem .= "- {$item['nome']} - R$ " . number_format($item['preco'], 2, ',', '.') . "%0A";
    $total += $item['preco'];
}

$mensagem .= "%0ATotal: R$ " . number_format($total, 2, ',', '.');
$mensagem .= "%0A%0A📞 Contato: $telefone";
$mensagem .= "%0A📍 Endereço: $endereco";
$mensagem .= "%0A💳 Pagamento: $pagamento";

// Número do restaurante (com DDD, sem + ou traços)
$numero = '62992545720';

header("Location: https://wa.me/$numero?text=" . urlencode($mensagem));
exit;
