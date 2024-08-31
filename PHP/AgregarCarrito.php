<?php
session_start(); // Asegúrate de que esta línea esté al principio del script

header('Content-Type: application/json');

// Verifica si la sesión está activa y si la variable de sesión está disponible
if (!isset($_SESSION['ID_Usuario'])) {
    echo json_encode(['error' => 'ID_Usuario no está disponible en la sesión.']);
    exit;
}

$id_usuario = $_SESSION['ID_Usuario'];
$platillo_id = isset($_POST['platillo_id']) ? intval($_POST['platillo_id']) : null;

// Verifica que el ID del platillo haya sido enviado
if (!$platillo_id) {
    echo json_encode(['error' => 'ID del platillo no proporcionado.']);
    exit;
}

include './db.php'; // Incluye el archivo de conexión

// Verifica la conexión
if ($conn->connect_error) {
    echo json_encode(['error' => 'Error de conexión: ' . $conn->connect_error]);
    exit;
}

// Busca si hay un pedido abierto para el usuario
$stmt = $conn->prepare("SELECT ID_Pedido FROM pedido_tb WHERE ID_Usuario = ? AND ID_ESTADO = 1 LIMIT 1");
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    // No hay pedido abierto, crea uno nuevo
    $stmt = $conn->prepare("INSERT INTO pedido_tb (ID_Usuario, ID_ESTADO) VALUES (?, 1)");
    $stmt->bind_param('i', $id_usuario);
    $stmt->execute();
    $pedido_id = $conn->insert_id;
} else {
    // Ya hay un pedido abierto
    $stmt->bind_result($pedido_id);
    $stmt->fetch();
}
$stmt->close();

// Obtén el ID del restaurante del primer platillo del pedido actual
$stmt = $conn->prepare("SELECT ID_Restaurante FROM platillo_tb 
    JOIN pedido_platillos_tb ON platillo_tb.ID_Platillo = pedido_platillos_tb.ID_Platillo
    WHERE pedido_platillos_tb.ID_Pedido = ? LIMIT 1");
$stmt->bind_param('i', $pedido_id);
$stmt->execute();
$stmt->bind_result($primer_restaurante);
$stmt->fetch();
$stmt->close();

if ($primer_restaurante !== null) {
    // Verifica si el platillo a agregar es del mismo restaurante que el primer platillo
    $stmt = $conn->prepare("SELECT ID_Restaurante FROM platillo_tb WHERE ID_Platillo = ? LIMIT 1");
    $stmt->bind_param('i', $platillo_id);
    $stmt->execute();
    $stmt->bind_result($platillo_restaurante);
    $stmt->fetch();
    $stmt->close();

    if ($platillo_restaurante != $primer_restaurante) {
        echo json_encode(['error' => 'El platillo no pertenece al mismo restaurante que el primer platillo.']);
        exit;
    }
}

// Verifica si el platillo ya está en el pedido
$stmt = $conn->prepare("SELECT Cantidad FROM pedido_platillos_tb WHERE ID_Pedido = ? AND ID_Platillo = ?");
$stmt->bind_param('ii', $pedido_id, $platillo_id);
$stmt->execute();
$stmt->bind_result($cantidad);
$stmt->fetch();
$stmt->close();

if ($cantidad !== null) {
    // Actualiza la cantidad del platillo en el pedido
    $nueva_cantidad = $cantidad + 1; // Incrementa la cantidad
    $stmt = $conn->prepare("UPDATE pedido_platillos_tb SET Cantidad = ? WHERE ID_Pedido = ? AND ID_Platillo = ?");
    $stmt->bind_param('iii', $nueva_cantidad, $pedido_id, $platillo_id);
    $stmt->execute();
    $stmt->close();
} else {
    // Agrega el platillo al pedido
    $stmt = $conn->prepare("INSERT INTO pedido_platillos_tb (ID_Pedido, ID_Platillo, Cantidad) VALUES (?, ?, 1)");
    $stmt->bind_param('ii', $pedido_id, $platillo_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

echo json_encode(['success' => 'Platillo agregado correctamente.']);
?>
