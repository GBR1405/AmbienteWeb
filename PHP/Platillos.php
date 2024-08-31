<?php
include './db.php';

header('Content-Type: application/json');

session_start();
$id_usuario = $_SESSION['ID_USUARIO'];

// Obtén el ID_RESTAURANTE asociado con el ID_USUARIO
$query = "SELECT ID_Restaurante FROM restaurante_tb WHERE ID_Usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$id_restaurante = $row['ID_Restaurante'];

// Obtén todos los platillos del restaurante
$query_platillos = "SELECT ID_Platillo, Nombre, Descripcion, Precio FROM platillo_tb WHERE ID_Restaurante = ?";
$stmt_platillos = $conn->prepare($query_platillos);
$stmt_platillos->bind_param("i", $id_restaurante);
$stmt_platillos->execute();
$result_platillos = $stmt_platillos->get_result();

$platillos = [];
while ($row_platillo = $result_platillos->fetch_assoc()) {
    $platillos[] = $row_platillo;
}

echo json_encode($platillos);
?>
