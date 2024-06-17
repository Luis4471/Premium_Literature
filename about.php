<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/styleabout.css" />
    <title>Premium Literature About Us</title>
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
        if (isset($_SESSION['nome'])) {
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
  <section id="aboutUs">
        <img src="eu.jpg" alt="computer user">
        <div class="content">
            <h2>Luís Inácio</h2>
            <h4>Criador e desenvolvedor do web-site</h4>
            <p class="description">                                                                             
                O meu nome é Luís Inácio, tenho 18 anos, e sou estudante na Escola Secundária Domingos Sequeira.
                Frequento um curso profissional de Gestão e Programação de Sistemas Informáticos e estou no último
                ano do mesmo. Tive a ideia de desenvolver este site no ano de 2023 já a pensar na PAP. A literatura
                é uma vertente da arte que sempre esteve presente na minha vida e ter um negócio nessa área constitui
                um pequeno sonho para mim. Acho que damos demasiada importância aos ecrâs, mas não há nada melhor que
                um livro para estimular o nosso cérebro e adquirir conhecimentos.
            </p>
            <a href="livros.php">
              <button class="btn">Comprar Livros</button>
            </a>
        </div>
    </section>
  </body>
</html>