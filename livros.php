<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Literature - Carrinho de compras</title>
    <link rel="stylesheet" href="styles/stylecompras.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
    <script src="main.js"></script>
</head>

<body>
    <header>
        <?php
        session_start();
        include('connect.php');
        ?>
        <?php
        echo '<script>';
        echo 'var userLoggedIn = ' . (isset($_SESSION['nome']) ? 'true' : 'false') . ';';
        echo '</script>';
        ?>
        <nav>
            <div class="nav__content">
                <div class="logo"><a href="#">Premium Literature</a></div>
                <label for="check" class="checkbox">
                    <i class="ri-menu-line"></i>
                </label>
                <input type="checkbox" name="check" id="check" />
                <ul>
                    <li><a href="index1.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="livros.php">Livros</a></li>
                    <?php
                    if (isset($_SESSION['nome'])) {
                        echo '<li><span class="username">' . $_SESSION['nome'] . '</span></li>';
                        echo '<div class="nav container">';
                        echo '    <a href="logout.php">
                        <i class="bx bx-log-out" id="logout-icon"></i>
                        </a>';
                        echo '    <i class="bx bx-shopping-bag" id="cart-icon"></i>';
                        echo '    <div class="cart">';
                        echo '        <h2 class="cart-title">Carrinho</h2>';
                        echo '        <div class="cart-content">';
                        echo '            <div class="cart-box">';
                        echo '            </div>';
                        echo '            <i class="bx bxs-trash-alt cart-remove"></i>';
                        echo '        </div>';
                        echo '        <div class="total">';
                        echo '            <div class="total-title">Total</div>';
                        echo '            <div class="total-price">0€</div>';
                        echo '        </div>';
                        echo '        <button type="button" class="btn-buy" id="btn-buy">Comprar</button>';
                        echo '        <i class="bx bx-x" id="close-cart"></i>';
                        echo '    </div>';
                        echo '</div>';
                    } else {
                        echo '<li><button class="login-btn"><a href="login.php">Login</a></button></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>
    <section class="shop container">
        <h2 class="section-title">Comprar Livros</h2>
        <div class="shop-content">
            <?php
            $sql = "SELECT titulo, preco, caminho_imagem FROM Livros";
            $result = $db->query($sql);
            if ($result) {
                while ($row = $result->fetchArray()) {
                    $titulo = $row["titulo"];
                    $preco = $row["preco"];
                    $caminho_imagem = $row["caminho_imagem"];
                    echo "<div class='product-box'>";
                    echo " <img src='$caminho_imagem' alt='' class='product-img' style='height: 350px'>";
                    echo "    <h2 class='product-title'>$titulo</h2>";
                    echo "    <span class='price'>$preco €</span>";
                    echo "    <i class='bx bx-shopping-bag add-cart' data-titulo='$titulo' data-preco='$preco' data-caminho-imagem='$caminho_imagem'></i>";
                    echo "</div>";
                }
            } else {
                echo "Erro na consulta: " . $db->lastErrorMsg();
            }
            ?>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buyButton = document.getElementById('btn-buy');
            if (buyButton) {
                buyButton.addEventListener('click', function() {
                    window.location.href = 'cartao.php';
                });
            }
        });
    </script>
</body>
</html>