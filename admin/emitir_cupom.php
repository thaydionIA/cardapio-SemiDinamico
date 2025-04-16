<?php require_once 'controllers/cupom_controller.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Impressão do Cupom</title>
    <link rel="stylesheet" href="assets/css/cupom.css">
    <style>@page { size: auto; margin: 0mm; }</style>
</head>
<body>
    <div class="print-btn">
        <button onclick="window.print()">Imprimir Cupom</button>
    </div>

    <h1>Cupom do Pedido #<?= $pedido['id'] ?></h1>

    <p><strong>Cliente:</strong> <?= htmlspecialchars($pedido['cliente_nome']) ?></p>
    <p><strong>Contato:</strong> <?= htmlspecialchars($pedido['contato']) ?></p>
    <p><strong>Endereço:</strong> <?= htmlspecialchars($pedido['endereco']) ?></p>
    <p><strong>Pagamento:</strong> <?= htmlspecialchars($pedido['status']) ?></p>
    <p><strong>Data:</strong> <?= $pedido['data_venda'] ?></p>

    <table>
        <thead>
            <tr>
                <th>Qtd</th>
                <th>Produto</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itens as $item): ?>
            <tr>
                <td><?= $item['quantidade'] ?></td>
                <td><?= htmlspecialchars($item['nome']) ?></td>
                <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p class="total">Total: R$ <?= number_format($pedido['total'], 2, ',', '.') ?></p>
</body>
</html>
