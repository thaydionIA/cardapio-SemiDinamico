<?php
// Verificar se a variável global $incluir_rodape está definida e se deve incluir o rodapé
$incluir_rodape = !isset($GLOBALS['incluir_rodape']) || $GLOBALS['incluir_rodape'];

if (basename($_SERVER['PHP_SELF']) == 'bebidas.php') {
    include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-SemiDinamico/header.php';
}
?>

<?php
require_once dirname(__DIR__) . '/db/conexao.php';
$base_url = '/cardapio-SemiDinamico/admin/uploads/produtos/';

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE categoria = 'bebidas' ORDER BY nome");
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bebidas</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Bebidas</h1>
    <div class="produtos-container">
        <?php foreach ($produtos as $produto): ?>
        <div class="produto-item">
            <div class="produto-imagem">
                <?php if ($produto['imagem']): ?>
                    <!-- Caminho absoluto para a imagem -->
                    <img src="<?php echo $base_url . htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                <?php endif; ?>
            </div>
            <div class="produto-info">
                <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
                <p class="preco">Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                <a href="cardapio.php?add=<?php echo $produto['id']; ?>" class="botao-adicionar">Adicionar 🛒</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Inclusão do rodapé se o arquivo estiver sendo acessado diretamente -->
    <?php if ($incluir_rodape): ?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-SemiDinamico/footer.php'; ?>
    <?php endif; ?>
</body>
</html>
