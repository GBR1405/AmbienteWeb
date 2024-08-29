<?php
session_start();
include './db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['ID_Usuario'])) {
    error_log("Usuario no autenticado");
    echo json_encode(['success' => false, 'error' => 'Usuario no autenticado']);
    exit;
}

$id_pedido = $_POST['id_pedido'] ?? null;
$estado = $_POST['estado'] ?? null;

// Verificar si se recibieron los datos necesarios
if ($id_pedido === null || $estado === null) {
    error_log("Falta ID_Pedido o estado en la solicitud");
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit;
}

// Verificar si el estado es válido
if ($estado != 4 && $estado != 6) {
    error_log("Estado inválido recibido: $estado");
    echo json_encode(['success' => false, 'error' => 'Estado inválido']);
    exit;
}

// Preparar y ejecutar la consulta de actualización
$query = "UPDATE pedido_tb SET ID_Estado = $estado WHERE ID_Pedido = $id_pedido";
error_log("Ejecutando consulta: $query");

if ($conn->query($query) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    error_log("Error en la actualización de la base de datos: " . $conn->error);
    echo json_encode(['success' => false, 'error' => 'Error al actualizar el estado del pedido']);
}

// Cerrar la conexión
$conn->close();
?>
