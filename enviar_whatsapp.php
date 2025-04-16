<?php
require_once __DIR__ . '/db/conexao.php';
session_start();

$venda_id = isset($_GET['venda_id']) ? intval($_GET['venda_id']) : 0;

if ($venda_id <= 0) {
    echo "Pedido inválido.";
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

// Buscar itens
$stmtItens = $pdo->prepare("
    SELECT iv.quantidade, iv.preco, p.nome 
    FROM itens_venda iv
    JOIN produtos p ON p.id = iv.produto_id
    WHERE iv.venda_id = ?
");
$stmtItens->execute([$venda_id]);
$itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);

// Montar mensagem
$mensagem = "Pedido de *{$pedido['cliente_nome']}*\n\n";
foreach ($itens as $item) {
    $mensagem .= "- {$item['quantidade']}x {$item['nome']} - R$ " . number_format($item['preco'], 2, ',', '.') . "\n";
}
$mensagem .= "\n*Total:* R$ " . number_format($pedido['total'], 2, ',', '.');
$mensagem .= "\n\n*Contato:* {$pedido['contato']}";
$mensagem .= "\n*Endereço:* {$pedido['endereco']}";
$mensagem .= "\n*Pagamento:* {$pedido['status']}";

// Encodar a mensagem
$mensagemCodificada = urlencode($mensagem);
$numeroWhatsApp = '556294035584'; // Substitua pelo número real
$link = "https://wa.me/$numeroWhatsApp?text=$mensagemCodificada";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedido Finalizado</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 40px;
            background: #f9f9f9;
            text-align: center;
        }
        .btn {
            background-color: #25D366;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h2>Pedido registrado com sucesso!</h2>
    <p>Clique no botão abaixo para enviar o pedido via WhatsApp:</p>
    <a class="btn" href="<?php echo $link; ?>" target="_blank">Enviar pelo WhatsApp</a>
</body>
</html>
