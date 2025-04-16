<?php
require_once __DIR__ . '/../../db/conexao.php';

session_start();

$venda_id = isset($_GET['venda_id']) ? intval($_GET['venda_id']) : 0;

if ($venda_id <= 0) {
    die("Pedido inválido.");
}

$stmt = $pdo->prepare("SELECT * FROM vendas WHERE id = ?");
$stmt->execute([$venda_id]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pedido) {
    die("Pedido não encontrado.");
}

$stmtItens = $pdo->prepare("
    SELECT iv.quantidade, iv.preco, p.nome 
    FROM itens_venda iv
    JOIN produtos p ON p.id = iv.produto_id
    WHERE iv.venda_id = ?
");
$stmtItens->execute([$venda_id]);
$itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);
