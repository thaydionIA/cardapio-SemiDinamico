<?php 
// Incluir o header.php somente se o arquivo estiver sendo acessado diretamente
if (basename($_SERVER['PHP_SELF']) == 'adicionar_produto.php') {
    include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-SemiDinamico/header-ad.php';
}
?>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once '../db/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria']; // só aceita 'pratos' ou 'bebidas'
    $disponivel = $_POST['disponivel'] ?? 0;

    // Upload da imagem
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagem = uniqid() . '.' . $extensao;
        move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/produtos/' . $imagem);
    }

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, preco, categoria, imagem, disponivel) VALUES (:nome, :descricao, :preco, :categoria, :imagem, :disponivel)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->bindParam(':disponivel', $disponivel);
    $stmt->execute();

    header("Location: gerenciar_produtos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="assets/css/admin_style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Adicionar Produto</h1>
        <form action="adicionar_produto.php" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco" required>

            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required>
                <option value="pratos">Pratos do Dia</option>
                <option value="bebidas">Bebidas</option>
            </select>

            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*">

            <!-- Garantir que valor 0 seja enviado quando não marcado -->
            <input type="hidden" name="disponivel" value="0">
            <label for="disponivel">
                <input type="checkbox" id="disponivel" name="disponivel" value="1">
                Disponível no cardápio
            </label>


            <button type="submit">Adicionar Produto</button>
        </form>
        <p><a href="index.php">Voltar ao Painel</a></p>
    </div>
</body>
</html>

<?php 
// Corrigir o caminho para o footer.php usando um caminho absoluto
include $_SERVER['DOCUMENT_ROOT'] . '/cardapio-SemiDinamico/footer-ad.php'; 
?>
