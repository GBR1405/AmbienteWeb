<?php
header('Content-Type: application/json');
include './db.php'; // Asegúrate de que la ruta sea correcta

// Obtener el ID del restaurante de la solicitud
$restaurantId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($restaurantId <= 0) {
    echo json_encode(array('error' => 'ID del restaurante inválido'));
    exit;
}

// Preparar y ejecutar la consulta
$sql = "SELECT ID_Mesa AS id, Num_Mesa AS numero, Estado AS estado FROM mesas_tb WHERE ID_Restaurante = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(array('error' => 'Error en la preparación de la consulta: ' . $conn->error));
    exit;
}

$stmt->bind_param("i", $restaurantId);
$stmt->execute();
$result = $stmt->get_result();

// Recoger los datos
$mesas = array();
while ($row = $result->fetch_assoc()) {
    $mesas[] = $row;
}

// Devolver los datos en formato JSON
echo json_encode(array('mesas' => $mesas));

$stmt->close();
$conn->close();
?>
