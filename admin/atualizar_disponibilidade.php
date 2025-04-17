<?php
require_once '../db/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? 0;

    if ($id !== null && is_numeric($id)) {
        $stmt = $pdo->prepare("UPDATE produtos SET disponivel = :status WHERE id = :id");
        $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
        echo "ok";
    } else {
        echo "erro: id inválido";
    }
} else {
    echo "erro: método não permitido";
}