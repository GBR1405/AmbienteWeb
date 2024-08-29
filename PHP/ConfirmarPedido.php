<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['ID_Usuario'])) {
    echo json_encode(['error' => 'ID_Usuario no está disponible en la sesión.']);
    exit;
}

$id_usuario = $_SESSION['ID_Usuario'];
include './db.php'; // Incluye el archivo de conexión

// Verifica la conexión a la base de datos
if ($conn->connect_error) {
    echo json_encode(['error' => 'Error en la conexión a la base de datos: ' . $conn->connect_error]);
    exit;
}

// Obtener el ID del pedido actual del usuario
$query = "SELECT ID_Pedido FROM pedido_tb WHERE ID_Usuario = $id_usuario AND ID_Estado = 1 LIMIT 1";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(['error' => 'Error en la consulta: ' . $conn->error]);
    exit;
}

if ($result->num_rows === 0) {
    echo json_encode(['error' => 'No se encontró un pedido con estado 1 para el usuario.']);
    exit;
}

$pedido = $result->fetch_assoc();
$id_pedido = $pedido['ID_Pedido'];

// Obtener detalles del pedido y calcular el total
$query = "SELECT pp.ID_Platillo, p.Nombre, p.Precio, pp.Cantidad 
          FROM pedido_platillos_tb pp
          JOIN platillo_tb p ON pp.ID_Platillo = p.ID_Platillo
          WHERE pp.ID_Pedido = $id_pedido";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(['error' => 'Error en la consulta: ' . $conn->error]);
    exit;
}

$total = 0;
$id_platillo = null; // Variable para obtener el ID_Restaurante

while ($row = $result->fetch_assoc()) {
    $subtotal = $row['Precio'] * (int)$row['Cantidad'];
    $total += $subtotal;
    $id_platillo = $row['ID_Platillo']; // Obtener el ID del platillo para la consulta siguiente
}

// Obtener el ID_Restaurante del primer platillo
$query = "SELECT ID_Restaurante FROM platillo_tb WHERE ID_Platillo = $id_platillo LIMIT 1";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(['error' => 'Error en la consulta: ' . $conn->error]);
    exit;
}

$restaurante = $result->fetch_assoc();
$id_restaurante = $restaurante['ID_Restaurante'];

// Insertar la factura
$query = "INSERT INTO factura_tb (ID_Pedido, Total, Fecha, ID_Restaurante, ID_Estado) 
          VALUES ($id_pedido, $total, CURDATE(), $id_restaurante, 1)";
if ($conn->query($query) === TRUE) {
    // Actualizar el estado del pedido a 3 (en proceso)
    $query = "UPDATE pedido_tb SET ID_Estado = 3 WHERE ID_Pedido = $id_pedido";
    if ($conn->query($query) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error al actualizar el estado del pedido.']);
    }
} else {
    echo json_encode(['error' => 'Error al crear la factura.']);
}

$conn->close();
?>
