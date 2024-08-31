<?php
header('Content-Type: application/json');
include './db.php'; // Asegúrate de que la ruta sea correcta

// Obtener datos del formulario
$mesaId = isset($_POST['mesa_id']) ? intval($_POST['mesa_id']) : 0;
$clienteNombre = isset($_POST['cliente_nombre']) ? $_POST['cliente_nombre'] : '';
$clienteTelefono = isset($_POST['cliente_telefono']) ? $_POST['cliente_telefono'] : '';
$fechaReserva = isset($_POST['fecha_reserva']) ? $_POST['fecha_reserva'] : '';

if ($mesaId <= 0 || empty($clienteNombre) || empty($clienteTelefono) || empty($fechaReserva)) {
    echo json_encode(array('success' => false, 'error' => 'Datos de reserva inválidos'));
    exit;
}

// Preparar y ejecutar la consulta
$sql = "INSERT INTO reservas_tb (ID_Mesa, Cliente_Nombre, Cliente_Telefono, Fecha_Reserva) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(array('success' => false, 'error' => 'Error en la preparación de la consulta: ' . $conn->error));
    exit;
}

$stmt->bind_param("isss", $mesaId, $clienteNombre, $clienteTelefono, $fechaReserva);
$result = $stmt->execute();

if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'error' => 'Error en la ejecución de la consulta: ' . $stmt->error));
}

$stmt->close();
$conn->close();
?>
