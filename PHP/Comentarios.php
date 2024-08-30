<?php
include './db.php';

session_start();

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['comentario'];
    $rating = $_POST['rating'];
    
    $query_insert = "INSERT INTO comentarios_tb (ID_Restaurante, Comentario, Rating, ID_Usuario) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($query_insert);
    $stmt_insert->bind_param("isii", $id_restaurante, $comentario, $rating, $id_usuario);
    
    if ($stmt_insert->execute()) {
        // Obtener el nombre del usuario
        $query_user = "SELECT Nombre FROM usuario_tb WHERE ID_Usuario = ?";
        $stmt_user = $conn->prepare($query_user);
        $stmt_user->bind_param("i", $id_usuario);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        $user = $result_user->fetch_assoc();
        
        if ($user) {
            $nombre_usuario = $user['Nombre'];
        } else {
            $nombre_usuario = 'Desconocido';
        }
        
        echo json_encode(['success' => 'Comentario guardado exitosamente.', 'nombre' => $nombre_usuario, 'comentario' => $comentario, 'rating' => $rating]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Error al guardar el comentario.']);
    }
    exit;
}

// Obtener comentarios
$query_comentarios = "SELECT Comentario, Rating, ID_Usuario FROM comentarios_tb WHERE ID_Restaurante = ?";
$stmt_comentarios = $conn->prepare($query_comentarios);
$stmt_comentarios->bind_param("i", $id_restaurante);
$stmt_comentarios->execute();
$result_comentarios = $stmt_comentarios->get_result();

$comentarios = [];
while ($row_comentarios = $result_comentarios->fetch_assoc()) {
    // Obtener nombre del usuario para cada comentario
    $query_user = "SELECT Nombre FROM usuario_tb WHERE ID_Usuario = ?";
    $stmt_user = $conn->prepare($query_user);
    $stmt_user->bind_param("i", $row_comentarios['ID_Usuario']);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $user = $result_user->fetch_assoc();
    
    $row_comentarios['Nombre'] = $user ? $user['Nombre'] : 'Desconocido';
    $comentarios[] = $row_comentarios;
}

echo json_encode($comentarios);
?>
