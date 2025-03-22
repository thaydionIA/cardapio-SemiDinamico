<?php
$GLOBALS['incluir_rodape'] = false;
include 'config.php';

session_start();

if (!isset($_SESSION['nome_cliente'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_GET['add'])) {
    $idProduto = intval($_GET['add']);
    $_SESSION['carrinho'][] = $idProduto;
    header("Location: cardapio.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cardápio - <?php echo $site_name; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { color: <?php echo $text_color; ?>; }
        header {
            background-color: <?php echo $primary_color; ?>;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }
        .logo-container img { width: 50px; }
        .site-title { font-size: 24px; color: #d4af37; margin-left: 10px; }
        nav ul { display: flex; gap: 15px; list-style: none; padding: 0; }
        nav ul li a {
            color: #d4af37; text-decoration: none; padding: 5px 10px;
            border-radius: 5px; transition: background 0.3s;
        }
        nav ul li a:hover {
            background-color: white; color: <?php echo $primary_color; ?>;
        }
        footer { background-color: <?php echo $primary_color; ?>; }
        .botao-carrinho {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 15px 25px;
            font-size: 16px;
            border-radius: 30px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 999;
        }
        .mensagem-boas-vindas {
            text-align: center;
            padding: 20px;
            font-size: 22px;
            color: #d4af37;
        }
        .botao-adicionar {
            background: #ffc107;
            color: #000;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>

<body>
<header>
    <div class="logo-container">
        <img src="path/logo.jpg" alt="Logo do Site <?php echo $site_name; ?>">
    </div>
    <h1 class="site-title"><?php echo $site_name; ?></h1>
    <nav>
        <ul>
            <?php foreach ($sections as $id => $section): ?>
                <li><a href="#<?php echo $id; ?>"><?php echo $section['title']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

<main>
    <div class="mensagem-boas-vindas">
        Olá, <?php echo htmlspecialchars($_SESSION['nome_cliente']); ?>! Seja bem-vindo ao nosso cardápio.
    </div>

    <!-- Banner -->
    <div class="banner">
        <img src="<?php echo $banner_image_path; ?>" alt="Banner do site <?php echo $site_name; ?>">
    </div>

    <?php
    foreach ($sections as $id => $section) {
        include $section['url'];
    }
    ?>
</main>




<div id="cart-popup" class="cart-popup" style="display: none;">
  <div class="cart-content">
    <p id="cart-total">🛒 Finalizar pedido — R$ 0,00</p>
    <button onclick="window.location.href='finalizar.php'" class="btn-finalizar">Finalizar pedido</button>


    <button onclick="fecharPopup()" class="btn-voltar">Voltar às compras</button>
  </div>
</div>


<footer>
    <p>&copy; 2024 <?php echo $site_name; ?>. Todos os direitos reservados.</p>
    <ul>
        <li><a href="admin/login.php">Painel Administrativo</a></li>
    </ul>
</footer>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const total = document.getElementById('total-carrinho');
    if (total) {
        fetch('controller/carrinho/total.php')
            .then(response => response.json())
            .then(data => {
                total.innerText = 'R$ ' + data.total;
            });
    }
});
</script>


<script>
  let totalCarrinho = 0;

  function adicionarAoCarrinho(preco) {
    totalCarrinho += parseFloat(preco);
    document.getElementById('cart-total').innerText =
      `🛒 Finalizar pedido — R$ ${totalCarrinho.toFixed(2)}`;
    document.getElementById('cart-popup').style.display = 'flex';
  }

  function fecharPopup() {
    document.getElementById('cart-popup').style.display = 'none';
  }

  function finalizarPedido() {
    alert('Redirecionando para finalizar pedido...');
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('cart-popup').style.display = 'none'; // força ocultar ao carregar
    document.getElementById('cart-popup').addEventListener('click', function(e) {
      if (e.target.id === 'cart-popup') {
        fecharPopup();
      }
    });
  });
  function abrirFormulario() {
    document.getElementById('cart-popup').style.display = 'none';
    document.getElementById('formulario-pedido').style.display = 'flex';
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById('cart-popup');

    popup.addEventListener('click', function(e) {
      if (e.target === popup) {
        fecharPopup();
      }
    });
  });
</script>


<script>
  function enviarPedidoWhatsapp(e) {
    e.preventDefault();

    const nome = document.getElementById('nome').value;
    const telefone = document.getElementById('telefone').value;
    const endereco = document.getElementById('endereco').value;
    const pagamento = document.querySelector('input[name="pagamento"]:checked')?.value || '';

    const itens = `Itens do pedido:\n🛒 Total: R$ ${totalCarrinho.toFixed(2)}`;

    const mensagem = `Olá! Gostaria de fazer um pedido:\n\n${itens}\n\n👤 Nome: ${nome}\n📞 Telefone: ${telefone}\n🏠 Endereço: ${endereco}\n💳 Pagamento: ${pagamento}`;

    const numeroWhatsApp = '62992545720'; // Substitua aqui
    const url = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensagem)}`;
    window.open(url, '_blank');
  }
</script>

</body>
</html>
