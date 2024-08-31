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

// Obtener ID del restaurante
$query_restaurante = "SELECT ID_Restaurante FROM restaurante_tb WHERE ID_Usuario = ?";
$stmt_restaurante = $conn->prepare($query_restaurante);
$stmt_restaurante->bind_param("i", $id_usuario);
$stmt_restaurante->execute();
$result_restaurante = $stmt_restaurante->get_result();
$row_restaurante = $result_restaurante->fetch_assoc();

if (!$row_restaurante) {
    http_response_code(404);
    echo json_encode(['error' => 'No se encontró un restaurante asociado a este usuario.']);
    exit;
}

$id_restaurante = $row_restaurante['ID_Restaurante'];

// Recoger datos del formulario
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$id_categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
$precio = isset($_POST['precio']) ? $_POST['precio'] : null;
$imagen_url = isset($_POST['imagen']) ? $_POST['imagen'] : null;

// Preparar la consulta SQL
$query_insert = "
    INSERT INTO platillo_tb (ID_Restaurante, ID_Categoria, Nombre, Descripcion, Precio, Imagen) 
    VALUES (?, ?, ?, ?, ?, ?)";

$stmt_insert = $conn->prepare($query_insert);
$stmt_insert->bind_param("iissss", $id_restaurante, $id_categoria, $nombre, $descripcion, $precio, $imagen_url);

if ($stmt_insert->execute()) {
    echo json_encode(['success' => 'Platillo agregado exitosamente.']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error al insertar el platillo: ' . $stmt_insert->error]);
}

$stmt_insert->close();
$conn->close();
?>
