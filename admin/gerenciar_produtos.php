<?php 
// Incluir o header.php somente se o arquivo estiver sendo acessado diretamente
if (basename($_SERVER['PHP_SELF']) == 'gerenciar_produtos.php') {
    include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-dinamicoo/header-ad.php';
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
    <style>
        /* Adicionando estilos CSS diretamente no arquivo PHP */

        .admin-container {
            width: 80%;
            margin: 0 auto;
            background-color: #d4af37;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            border-radius: 8px;
            flex: 1;
        }

        h1 {
            color: #444;
            margin-bottom: 20px;
        }

        /* Contêiner para a tabela com rolagem horizontal */
        .table-container {
            overflow-x: auto; /* Permite rolagem horizontal */
            width: 100%;
            margin-bottom: 20px;
            -webkit-overflow-scrolling: touch; /* Suaviza a rolagem em iOS */
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            min-width: 800px; /* Largura mínima para forçar a rolagem */
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap; /* Impede quebra de linha */
        }

        table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        table img {
            max-width: 50px;
            border-radius: 4px;
        }

        /* Mensagem de rolagem para dispositivos móveis */
        .scroll-hint {
            display: none; /* Esconde por padrão */
        }

        /* Responsividade para dispositivos móveis */
        @media (max-width: 768px) {
            .admin-container {
                width: 95%;
                padding: 15px;
            }

            .table-container {
                overflow-x: auto; /* Ativa rolagem horizontal */
                -webkit-overflow-scrolling: touch; /* Suaviza a rolagem em iOS */
            }

            .scroll-hint {
                display: block; /* Mostra a mensagem de rolagem */
                text-align: center;
                margin-bottom: 10px;
                font-size: 0.9em;
                color: #888;
            }

            table th, table td {
                font-size: 0.9em;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Gerenciar Produtos</h1>
        
        <!-- Mensagem de rolagem visível em dispositivos móveis -->
        <div class="scroll-hint">Arraste para o lado para ver mais</div>

        <!-- Contêiner para a tabela com rolagem horizontal -->
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
                    <td><?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                    <td>
                        <?php if ($produto['imagem']): ?>
                            <img src="uploads/produtos/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                        <?php endif; ?>
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
</body>
</html>

<?php 
// Corrigir o caminho para o footer.php usando um caminho absoluto
include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-dinamicoo/footer-ad.php'; 
?>
