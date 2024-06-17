<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="styles/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Premium Literature</title>
</head>

<body>
  <?php
  session_start();
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
        if (isset ($_SESSION['nome'])) {
          echo '<li><span class="username">' . $_SESSION['nome'] . '</span></li>';
          echo '    <a href="logout.php">
                      <i class="bx bx-log-out" id="logout-icon"></i>
                    </a>';
        } else {
          echo '<li><button class="login-btn"><a href="login.php">Login</a></button></li>';
        }
        ?>
      </ul>
    </div>
  </nav>
  <section class="section">
    <div class="section__container">
      <div class="content">
        <h1 class="title">
          <span>Premium Literature<br /></span>

        </h1>
        <p class="description">
          Sejam bem-vindos ao nosso website. Somos uma livraria especializada nos mais variados gostos dos leitores.
        </p>
        <div class="action__btns">
          <a href="livros.php"><button class="hire__me">Comprar Livros</button></a>
          <a href="about.php"><button class="portfolio">Sobre nós</button></a>
        </div>
      </div>
      <div class="image">
      </div>
    </div>
  </section>

  <?php
  if (isset ($_GET['error']) && $_GET['error'] === 'none') {
    echo '<script>
                // Exibir SweetAlert de sucesso
                Swal.fire({
                    icon: "success",
                    title: "Login efetuado com sucesso!",
                    showCancelButton: false,
                    confirmButtonText: "OK",
                }).then((result) => {
                    // Se o botão "OK" for clicado, esperar 1 segundo e redirecionar
                    if (result.isConfirmed) {
                        setTimeout(function () {
                            window.location.href = "index1.php";
                        }, 1000); // 1000 milissegundos = 1 segundo
                    }
                });
              </script>';
  }
  ?>
  <script src="main.js"></script>
</body>
</html>