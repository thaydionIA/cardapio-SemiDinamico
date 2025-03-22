<?php
require_once __DIR__ . '/../../db/conexao.php';
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo json_encode(['total' => '0,00']);
    exit;
}

$ids = array_filter(array_map('intval', $_SESSION['carrinho']));
if (empty($ids)) {
    echo json_encode(['total' => '0,00']);
    exit;
}

$idList = implode(',', $ids);

try {
    $stmt = $pdo->prepare("SELECT SUM(preco) AS total FROM produtos WHERE id IN ($idList)");
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $data['total'] ?? 0;

    echo json_encode(['total' => number_format($total, 2, ',', '.')]);
} catch (PDOException $e) {
    echo json_encode(['total' => '0,00', 'erro' => $e->getMessage()]);
}
