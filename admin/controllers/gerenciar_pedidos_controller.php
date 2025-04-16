<?php
session_start();
require_once __DIR__ . '/../../db/conexao.php';

if (!isset($_SESSION['usuario'])) {
    echo "Acesso negado.";
    exit;
}

$stmt = $pdo->query("SELECT COUNT(*) as total_pedidos FROM vendas");
$totalPedidos = $stmt->fetch(PDO::FETCH_ASSOC)['total_pedidos'];

$novosPedidos = isset($_SESSION['totalPedidos']) && $totalPedidos > $_SESSION['totalPedidos'];
$_SESSION['totalPedidos'] = $totalPedidos;

// Atualizações
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['venda_id'], $_POST['status_pagamento'])) {
        $stmt = $pdo->prepare("UPDATE vendas SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $_POST['status_pagamento'], ':id' => $_POST['venda_id']]);
        header("Location: ../gerenciar_pedidos.php");
        exit;
    }

}
if (isset($_POST['cancelar_venda_id'])) {
    $id = intval($_POST['cancelar_venda_id']);

    // Excluir os itens da venda primeiro (FK)
    $stmt = $pdo->prepare("DELETE FROM itens_venda WHERE venda_id = ?");
    $stmt->execute([$id]);

    // Excluir a venda em si
    $stmt = $pdo->prepare("DELETE FROM vendas WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: ../gerenciar_pedidos.php");
    exit;
}


$stmt = $pdo->query("SELECT * FROM vendas ORDER BY data_venda DESC");
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
