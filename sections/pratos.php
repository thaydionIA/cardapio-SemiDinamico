<?php
$incluir_rodape = !isset($GLOBALS['incluir_rodape']) || $GLOBALS['incluir_rodape'];

if (basename($_SERVER['PHP_SELF']) == 'prato_do_dia.php') {
    include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-SemiDinamico/header.php';
}

require_once dirname(__DIR__) . '/db/conexao.php';
$base_url = '/cardapio-SemiDinamico/admin/uploads/produtos/';

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE categoria = 'pratos' AND disponivel = 1 ORDER BY nome");
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Garantir que a sessão esteja ativa para acesso ao carrinho
if (!isset($_SESSION)) session_start();
$carrinho = $_SESSION['carrinho'] ?? [];
?>

<h1>Prato do Dia</h1>
<div class="produtos-container">
    <?php foreach ($produtos as $produto): ?>
    <div class="produto-item">
        <div class="produto-imagem">
            <?php if ($produto['imagem']): ?>
                <img src="<?php echo $base_url . htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
            <?php endif; ?>
        </div>
        <div class="produto-info">
            <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
            <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
            <p class="preco">Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>

            <?php $jaAdicionado = isset($carrinho[$produto['id']]); ?>
            <a href="cardapio.php?<?php echo $jaAdicionado ? 'remove' : 'add'; ?>=<?php echo $produto['id']; ?>"
               class="botao-adicionar"
               style="background-color: <?php echo $jaAdicionado ? '#dc3545' : '#ffc107'; ?>; color: <?php echo $jaAdicionado ? '#fff' : '#000'; ?>;">
               <?php echo $jaAdicionado ? '❌ Excluir Pedido' : 'Adicionar 🛒'; ?>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php if ($incluir_rodape): ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-SemiDinamico/footer.php'; ?>
<?php endif; ?>
