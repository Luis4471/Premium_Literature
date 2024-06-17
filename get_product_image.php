<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['productId'])) {
        $productId = $data['productId'];
        $stmt = $db->prepare('SELECT caminho_imagem FROM Livros WHERE id = :productId');
        $stmt->bindValue(':productId', $productId, SQLITE3_INTEGER);
        $result = $stmt->execute();
        if ($result) {
            $row = $result->fetchArray(SQLITE3_ASSOC);
            if ($row) {
                $imagePath = $row['caminho_imagem'];
                echo json_encode(['success' => true, 'imagePath' => $imagePath]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>