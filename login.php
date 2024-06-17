<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('connect.php');
    $sql ="SELECT * from Utilizadores where email='$_POST[username]'";
    $ret = $db->query($sql);
    $rows = 0;
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        $id = $row['utilizador_ID'];
        $nome = $row['nome'];
        $apelido = $row['apelido'];
        $email = $row['email'];
        $pass = $row['pwd'];
        $tel = $row['telefone'];
        $isAdmin = $row['isAdmin'];
        $rows += 1;	  
    }
    if ($rows == 0) {
        echo 'O utilizador <b><u>' . $_POST["username"] . '</u></b> não existe';
        exit;
    }
    if ($_POST["password"] != $pass) {
        header("Location: login.php?erro=pass");
        exit;
    } else {
        if ($_POST['username'] == $email && $_POST['password'] == $pass) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION["sessao"] = array();
            $_SESSION["nome"] = $nome;
            $_SESSION["telm"] = $tel;
            $_SESSION["email"] = $email;
            $_SESSION["id"] = $id;
            $_SESSION["dataIn"] = date("d-m-Y h:i:sa");
            if ($isAdmin == 1) {
                $_SESSION['isAdmin'] = true;
            }
            if ($_SESSION['isAdmin']) {
                header("Location: dashboardadmin.php");
                exit;
            } else {
                header("Location: index1.php");
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles/stylelogin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
if (isset($_GET["erro"])) {
    $errorMessage = "";

    switch ($_GET["erro"]) {
        case "pass":
            $errorMessage = "Password errada";
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
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Login Form</span></div>
            <form action="" method="post">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Email" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="row button">
                    <input type="submit" value="Login">
                </div>
                <div class="signup-link">Não está registado? <a href="register.php">Registe-se agora</a></div>
            </form>
        </div>
    </div>
</body>
</html>