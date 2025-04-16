<?php
require_once __DIR__ . '/../../db/conexao.php';
header('Content-Type: application/json');

$stmt = $pdo->query("SELECT COUNT(*) AS total FROM vendas");
$total = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

echo json_encode(['total' => $total]);
