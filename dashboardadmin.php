<?php
session_start();

if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['titulo']) && isset($_POST['autor']) && isset($_POST['preco']) && isset($_POST['editora']) && isset($_FILES['imagem'])) {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $preco = floatval($_POST['preco']);
        $editora = $_POST['editora'];
        $imagem = $_FILES['imagem']['name'];
        $target_dir = "livros/";
        $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);
        $imagePath = $target_file;
        $db = new SQLite3('premium_literature.db');
        $stmt = $db->prepare('INSERT INTO Livros (titulo, autor, preco, editora, caminho_imagem) VALUES (:titulo, :autor, :preco, :editora, :caminho_imagem)');
        $stmt->bindValue(':titulo', $titulo, SQLITE3_TEXT);
        $stmt->bindValue(':autor', $autor, SQLITE3_TEXT);
        $stmt->bindValue(':preco', $preco, SQLITE3_FLOAT);
        $stmt->bindValue(':editora', $editora, SQLITE3_TEXT);
        $stmt->bindValue(':caminho_imagem', $imagePath, SQLITE3_TEXT);
        $stmt->execute();
        header("Location: dashboardadmin.php?success=book_added");
        exit;
    } else {
        header("Location: dashboardadmin.php?error=missing_fields");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles/styleadmin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="form-container">
        <h1>Admin Dashboard</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required><br><br>
            
            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor"><br><br>
            
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01"><br><br>
            
            <label for="editora">Editora:</label>
            <input type="text" id="editora" name="editora"><br><br>
            
            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*"><br><br>
            
            <input type="submit" value="Adicionar Livro"> 
            <a href="logout.php">
                  <i class="bx bx-log-out" id="logout-icon"></i>
            </a>
            <input type = "submit" value = "Remover Livro" class = "remove-book-btn">
        </form>
    </div>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Acesso não autorizado.']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $db = new SQLite3('premium_literature.db');

    if ($action == 'add') {
        if (isset($_POST['titulo']) && isset($_POST['autor']) && isset($_POST['preco']) && isset($_POST['editora']) && isset($_FILES['imagem'])) {
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $preco = floatval($_POST['preco']);
            $editora = $_POST['editora'];
            $imagem = $_FILES['imagem']['name'];
            $target_dir = "livros/";
            $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                $imagePath = $target_file;
                $stmt = $db->prepare('INSERT INTO Livros (titulo, autor, preco, editora, caminho_imagem) VALUES (:titulo, :autor, :preco, :editora, :caminho_imagem)');
                $stmt->bindValue(':titulo', $titulo, SQLITE3_TEXT);
                $stmt->bindValue(':autor', $autor, SQLITE3_TEXT);
                $stmt->bindValue(':preco', $preco, SQLITE3_FLOAT);
                $stmt->bindValue(':editora', $editora, SQLITE3_TEXT);
                $stmt->bindValue(':caminho_imagem', $imagePath, SQLITE3_TEXT);
                if ($stmt->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro ao adicionar o livro no banco de dados.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao fazer upload da imagem.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Campos obrigatórios faltando.']);
        }
    } elseif ($action == 'remove') {
        if (isset($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
            $stmt = $db->prepare('DELETE FROM Livros WHERE titulo = :titulo');
            $stmt->bindValue(':titulo', $titulo, SQLITE3_TEXT);
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao remover o livro do banco de dados.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Título não fornecido.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Ação inválida.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requisição inválida.']);
}
?>