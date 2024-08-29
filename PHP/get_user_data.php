<?php
include './db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ID_Usuario'])) {
    http_response_code(403);
    echo json_encode(['error' => 'No se ha iniciado sesión o el usuario no está definido.']);
    exit;
}

$id_usuario = $_SESSION['ID_Usuario'];

if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión a la base de datos.']);
    exit;
}

// Obtener Username e ID_Restaurante
$query_usuario = "
    SELECT u.Username, r.ID_Restaurante
    FROM usuario_tb u
    JOIN restaurante_tb r ON u.ID_Usuario = r.ID_Usuario
    WHERE u.ID_Usuario = ?";

$stmt_usuario = $conn->prepare($query_usuario);

if (!$stmt_usuario) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al preparar la consulta: ' . $conn->error]);
    exit;
}

$stmt_usuario->bind_param("i", $id_usuario);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();
$row_usuario = $result_usuario->fetch_assoc();

if (!$row_usuario) {
    http_response_code(404);
    echo json_encode(['error' => 'No se encontró el usuario asociado con este ID.']);
    exit;
}

$nombre_usuario = $row_usuario['Username'];
$id_restaurante = $row_usuario['ID_Restaurante'];

// Obtener platillos del restaurante
$query_platillos = "
    SELECT p.ID_Platillo, p.Nombre, p.Descripcion, p.Precio 
    FROM platillo_tb p
    WHERE p.ID_Restaurante = ?";

$stmt_platillos = $conn->prepare($query_platillos);

if (!$stmt_platillos) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al preparar la consulta: ' . $conn->error]);
    exit;
}

$stmt_platillos->bind_param("i", $id_restaurante);
$stmt_platillos->execute();
$result_platillos = $stmt_platillos->get_result();

$platillos = [];
while ($row_platillo = $result_platillos->fetch_assoc()) {
    $platillos[] = $row_platillo;
}

$response = [
    'Username' => $nombre_usuario,
    'ID_Restaurante' => $id_restaurante,
    'platillos' => $platillos
];

echo json_encode($response);

$stmt_usuario->close();
$stmt_platillos->close();
$conn->close();
?>
