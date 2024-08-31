<?php
include './db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT ID_Restaurante, Nombre, Ubicación FROM restaurante_tb WHERE ID_Restaurante = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $restaurant = $result->fetch_assoc();

    if ($restaurant) {
        echo json_encode($restaurant);
    } else {
        echo json_encode(['error' => 'No se encontró el restaurante']);
    }
    $stmt->close();
} else {
    echo json_encode(['error' => 'ID no proporcionado']);
}

$conn->close();
?>
