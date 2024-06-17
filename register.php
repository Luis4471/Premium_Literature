<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="styles/stylelogin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <?php
            if (isset($_GET["erro"])) {
                $errorMessage = "";
                switch ($_GET["erro"]) {
                    case "pass":
                        $errorMessage = "Passwords não coincidem";
                        break;
                    case "telemovel":
                        $errorMessage = "Nº de telemóvel já inserido";
                        break;
                    case "email":
                        $errorMessage = "Email já inserido";
                        break;
                    default:
                        $errorMessage = "Unknown error";
                        break;
                }
                if (!empty($errorMessage)) {
                    echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: '$errorMessage',
                                    });
                                });
                            </script>";
                }
            }
            ?>
            <div class="title"><span>Register Form</span></div>
            <form id="registerForm" action="registo.php" method="post">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nome" id="nome" placeholder="Nome" required>
                </div>
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="apelido" id="apelido" placeholder="Apelido" required>
                </div>
                <div class="row">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="row">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="telefone" id="telefone" placeholder="Nº de telemóvel" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="rpassword" id="rpassword" placeholder="Repetir a Password" required>
                </div>
                <div class="row button">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>