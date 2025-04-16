<?php
session_start();
header('Content-Type: application/json');

$total = 0;

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $item) {
        if (isset($item['preco']) && isset($item['quantidade'])) {
            $total += $item['preco'] * $item['quantidade'];
        }
    }
}

echo json_encode(['total' => number_format($total, 2, ',', '.')]);
exit;
