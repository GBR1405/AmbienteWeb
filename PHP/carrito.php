<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['ID_Usuario'])) {
    echo json_encode(['error' => 'ID_Usuario no está disponible en la sesión.']);
    exit;
}

$id_usuario = $_SESSION['ID_Usuario'];

include './db.php'; // Incluye el archivo de conexión

if ($conn->connect_error) {
    echo json_encode(['error' => 'Error de conexión: ' . $conn->connect_error]);
    exit;
}

// Busca el pedido abierto del usuario
$stmt = $conn->prepare("SELECT ID_Pedido FROM pedido_tb WHERE ID_Usuario = ? AND ID_ESTADO = 1 LIMIT 1");
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo json_encode(['error' => 'No hay pedido abierto para el usuario.']);
    exit;
}

$stmt->bind_result($pedido_id);
$stmt->fetch();
$stmt->close();

// Obtiene los platillos en el pedido
$stmt = $conn->prepare("
    SELECT p.Nombre, p.Precio, pp.Cantidad
    FROM pedido_platillos_tb pp
    JOIN platillo_tb p ON pp.ID_Platillo = p.ID_Platillo
    WHERE pp.ID_Pedido = ?");
$stmt->bind_param('i', $pedido_id);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $itemTotal = $row['Precio'] * $row['Cantidad'];
    $total += $itemTotal;
    $items[] = [
        'nombre' => $row['Nombre'],
        'precio' => $row['Precio'],
        'cantidad' => $row['Cantidad'],
        'total' => $itemTotal
    ];
}

$stmt->close();
$conn->close();

echo json_encode(['items' => $items, 'total' => $total]);
?>
