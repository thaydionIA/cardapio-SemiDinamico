<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../conexao.php';

// Impressora térmica
require_once __DIR__ . '/../escpos/src/Mike42/Escpos/PrintConnectors/WindowsPrintConnector.php';
require_once __DIR__ . '/../escpos/src/Mike42/Escpos/Printer.php';
require_once __DIR__ . '/../escpos/src/Mike42/Escpos/CapabilityProfile.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;

$venda_id = isset($_POST['venda_id']) ? intval($_POST['venda_id']) : 0;

if ($venda_id <= 0) {
    echo "Pedido não encontrado.";
    exit;
}

// Buscar dados da venda
$stmt = $pdo->prepare("SELECT * FROM vendas WHERE id = ?");
$stmt->execute([$venda_id]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pedido) {
    echo "Pedido não encontrado.";
    exit;
}

// Buscar itens da venda
$stmtItens = $pdo->prepare("
    SELECT iv.quantidade, iv.preco, p.nome 
    FROM itens_venda iv
    JOIN produtos p ON p.id = iv.produto_id
    WHERE iv.venda_id = ?
");
$stmtItens->execute([$venda_id]);
$itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);

try {
    $connector = new WindowsPrintConnector("Nome da Impressora"); // <- Trocar pelo nome real da impressora
    $profile = CapabilityProfile::load("default");
    $printer = new Printer($connector, $profile);

    // Cabeçalho do cupom
    $printer->setEmphasis(true);
    $printer->text("=== Cupom do Pedido ===\n");
    $printer->setEmphasis(false);

    $printer->text("Pedido ID: {$pedido['id']}\n");
    $printer->text("Cliente: {$pedido['cliente_nome']}\n");
    $printer->text("Contato: {$pedido['contato']}\n");
    $printer->text("Endereço: {$pedido['endereco']}\n");
    $printer->text("Pagamento: {$pedido['status']}\n");
    $printer->text("Data: {$pedido['data_venda']}\n");
    $printer->text("------------------------------\n");

    $printer->text("Itens:\n");
    foreach ($itens as $item) {
        $nome = $item['nome'];
        $qtd = $item['quantidade'];
        $preco = number_format($item['preco'], 2, ',', '.');
        $printer->text("{$qtd}x {$nome} - R$ {$preco}\n");
    }

    $total = number_format($pedido['total'], 2, ',', '.');
    $printer->text("------------------------------\n");
    $printer->text("Total: R$ {$total}\n");

    $printer->cut();
    $printer->close();

    echo "Cupom enviado para a impressora.";
} catch (Exception $e) {
    echo "Erro ao imprimir: " . $e->getMessage();
}
