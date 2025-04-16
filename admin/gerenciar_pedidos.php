<?php require_once 'controllers/gerenciar_pedidos_controller.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Gerenciar Pedidos</title>
    <link rel="stylesheet" href="assets/css/gerenciar_pedidos.css">
    <meta http-equiv="refresh" content="5">
</head>

<body>
    <div class="admin-container">
        <h1>Gerenciar Pedidos</h1>

        <?php if ($novosPedidos): ?>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    setTimeout(() => {
                        const audio = new Audio('assets/sounds/isolados.mp3');
                        audio.play().catch(e => console.error("Erro ao reproduzir o som:", e));
                    }, 1000);
                });
            </script>
        <?php endif; ?>

        <div class="scroll-hint">Arraste para o lado para ver mais</div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Tipo Pagamento</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $pedido['id'] ?></td>
                            <td><?= htmlspecialchars($pedido['cliente_nome']) ?></td>
                            <td>R$ <?= number_format($pedido['total'], 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($pedido['status']) ?></td>
                            <td><?= $pedido['data_venda'] ?></td>
                            <td>
                                <form method="GET" action="emitir_cupom.php" target="_blank">
                                    <input type="hidden" name="venda_id" value="<?= $pedido['id'] ?>">
                                    <button type="submit">Emitir Cupom</button>
                                </form>

                                <form method="POST" action="controllers/gerenciar_pedidos_controller.php">
                                    <input type="hidden" name="cancelar_venda_id" value="<?= $pedido['id'] ?>">
                                    <button class="cancel-button" onclick="return confirm('Deseja cancelar?')">Cancelar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <p><a href="index.php">Voltar ao Painel</a></p>
    </div>
    <script>
        let ultimoTotal = <?= $totalPedidos ?>;

        setInterval(() => {
            fetch('controllers/verifica_novos_pedidos.php')
                .then(res => res.json())
                .then(data => {
                    if (data.total > ultimoTotal) {
                        ultimoTotal = data.total;

                        // Tocar som
                        const audio = new Audio('assets/sounds/isolados.mp3');
                        audio.play().catch(() => {});

                        // Recarregar a página
                        location.reload();
                    }
                });
        }, 5000); // verifica a cada 5 segundos
    </script>

</body>

</html>