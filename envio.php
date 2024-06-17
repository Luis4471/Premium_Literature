<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="styles/stylelogin.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Dados de envio</span></div>
            <form>
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="Morada" placeholder="Morada" required>
                </div>
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="cidade" placeholder="Cidade" required>
                </div>
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="cp" placeholder="Código Postal" required>
                </div>
                <div class="row button">
                    <input type="button" value="Encomendar" onclick="processarEncomenda()">
                </div>
            </form>
        </div>
    </div>
</body>
</html>