<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['ID_Usuario'])) {
    echo json_encode(['error' => 'ID_Usuario no está disponible en la sesión.']);
    exit;
}

$id_usuario = $_SESSION['ID_Usuario'];
$id_pedido = isset($_POST['id_pedido']) ? intval($_POST['id_pedido']) : 0;

if ($id_pedido <= 0) {
    echo json_encode(['error' => 'ID de pedido no válido.']);
    exit;
}

include './db.php'; // Incluye el archivo de conexión

// Verifica la conexión a la base de datos
if ($conn->connect_error) {
    echo json_encode(['error' => 'Error en la conexión a la base de datos: ' . $conn->connect_error]);
    exit;
}

// Obtener detalles del pedido
$query = "SELECT pp.ID_Platillo, pt.Nombre, pp.Cantidad
          FROM pedido_platillos_tb pp
          JOIN platillo_tb pt ON pp.ID_Platillo = pt.ID_Platillo
          WHERE pp.ID_Pedido = $id_pedido";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(['error' => 'Error en la consulta: ' . $conn->error]);
    exit;
}

$detalles = [];
while ($row = $result->fetch_assoc()) {
    $detalles[] = $row;
}

echo json_encode(['success' => true, 'detalles' => $detalles]);
$conn->close();
?>
