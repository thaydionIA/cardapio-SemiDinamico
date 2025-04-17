<?php 
// Incluir o header.php somente se o arquivo estiver sendo acessado diretamente
if (basename($_SERVER['PHP_SELF']) == 'gerenciar_produtos.php') {
    include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-SemiDinamico/header-ad.php';
}

// Iniciar a sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once '../db/conexao.php';

$stmt = $pdo->query("SELECT * FROM produtos ORDER BY categoria, nome");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>
    <link rel="stylesheet" href="assets/css/admin_style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Gerenciar Produtos</h1>

        <!-- Adicionando o aviso de rolagem para dispositivos móveis -->
        <div class="scroll-hint">Arraste para o lado para ver mais</div>

        <!-- Adicionando contêiner com rolagem horizontal para dispositivos menores -->
        <div class="table-container">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                    <td><?php echo htmlspecialchars($produto['descricao']); ?></td>
                    <td><?php echo htmlspecialchars($produto['preco']); ?></td>
                    <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                    <td>
                        <?php if ($produto['imagem']): ?>
                            <img src="uploads/produtos/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" style="width: 50px;">
                        <?php endif; ?>
                    </td>
                    <td>
                     <label class="switch">
                        <input type="checkbox" <?= $produto['disponivel'] ? 'checked' : '' ?>
                               onchange="atualizarDisponibilidade(<?= $produto['id']; ?>, this.checked)">
                        <span class="slider round"></span>
                     </label>
                    </td>
                    <td>
                        <a href="editar_produto.php?id=<?php echo $produto['id']; ?>">Editar</a> |
                        <a href="remover_produto.php?id=<?php echo $produto['id']; ?>" onclick="return confirm('Tem certeza que deseja remover este produto?')">Remover</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <p><a href="index.php">Voltar ao Painel</a></p>
    </div>

<script>
function atualizarDisponibilidade(id, status) {
    fetch('atualizar_disponibilidade.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id=${id}&status=${status ? 1 : 0}`
    }).then(response => response.text()).then(msg => {
        console.log('Resposta:', msg);
    });
}
</script>

</body>
</html>

<?php 
// Corrigir o caminho para o footer.php usando um caminho absoluto
include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-SemiDinamico/footer-ad.php'; 
?>
