<?php
require_once __DIR__ . '/../../db/conexao.php';
session_start();


header('Content-Type: application/json');

if (!isset($_SESSION['nome_cliente']) || empty($_SESSION['carrinho'])) {
    echo json_encode(['status' => 'erro']);
    exit;
}

$nome = $_SESSION['nome_cliente'];
$contato = $_POST['telefone'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$pagamento = $_POST['pagamento'] ?? 'Dinheiro';
$carrinho = $_SESSION['carrinho'];

$total = 0;
foreach ($carrinho as $item) {
    $total += $item['preco'] * $item['quantidade'];
}

// 1. Salvar venda
$stmt = $pdo->prepare("INSERT INTO vendas (cliente_nome, contato, endereco, total, status) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$nome, $contato, $endereco, $total, "Pago ($pagamento)"]);
$venda_id = $pdo->lastInsertId();

// 2. Salvar itens
$stmtItem = $pdo->prepare("INSERT INTO itens_venda (venda_id, produto_id, quantidade, preco) VALUES (?, ?, ?, ?)");
foreach ($carrinho as $item) {
    $stmtItem->execute([$venda_id, $item['id'], $item['quantidade'], $item['preco']]);
}

// 3. Montar link WhatsApp
$mensagem = "Pedido de *$nome*\n\n";
foreach ($carrinho as $item) {
    $mensagem .= "- {$item['quantidade']}x {$item['nome']} - R$ " . number_format($item['preco'], 2, ',', '.') . "\n";
}
$mensagem .= "\n*Total:* R$ " . number_format($total, 2, ',', '.');
$mensagem .= "\n\n*Contato:* $contato\n*Endereço:* $endereco\n*Pagamento:* Pago ($pagamento)";

$mensagemCodificada = urlencode($mensagem);
$numeroWhatsApp = '556294035584'; // Substitua pelo número do restaurante
$link = "https://wa.me/$numeroWhatsApp?text=$mensagemCodificada";

// 4. Limpar carrinho
unset($_SESSION['carrinho']);

// 5. Responder JSON com link
echo json_encode(['status' => 'ok', 'whatsapp_link' => $link]);
exit;

