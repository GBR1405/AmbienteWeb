<?php
include './db.php';

$query_categorias = "SELECT ID_Categoria, Categoria FROM categoria_tb";

$result_categorias = $conn->query($query_categorias);

if (!$result_categorias) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la consulta de categorías: ' . $conn->error]);
    exit;
}

$categorias = [];
while ($row_categoria = $result_categorias->fetch_assoc()) {
    $categorias[] = $row_categoria;
}

echo json_encode($categorias);

$conn->close();
?>
