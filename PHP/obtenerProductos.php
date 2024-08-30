<?php
// Conectar a la base de datos
include './db.php'; // Asegúrate de que la ruta sea correcta

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del restaurante asociado al usuario (esto se puede modificar si es necesario)
session_start();

if (!isset($_SESSION['ID_Usuario'])) {
    die("No se ha iniciado sesión o el usuario no está definido.");
}

$id_usuario = $_SESSION['ID_Usuario'];

// Obtener el ID del restaurante asociado al usuario
$query_restaurante = "SELECT ID_Restaurante FROM restaurante_tb WHERE ID_Usuario = ?";
$stmt_restaurante = $conn->prepare($query_restaurante);
$stmt_restaurante->bind_param("i", $id_usuario);
$stmt_restaurante->execute();
$result_restaurante = $stmt_restaurante->get_result();
$row_restaurante = $result_restaurante->fetch_assoc();

if (!$row_restaurante) {
    die("No se encontró un restaurante asociado a este usuario.");
}

$id_restaurante = $row_restaurante['ID_Restaurante'];

// Obtener los productos con cantidad mayor a 1
$sql = "SELECT ID_Producto, Nombre FROM productos WHERE Cantidad > 1";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Crear un array para almacenar los productos
    $productos = array();
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }

    // Enviar el resultado en formato JSON
    header('Content-Type: application/json');
    echo json_encode(array('productos' => $productos));
} else {
    // Enviar una respuesta vacía si no hay productos
    header('Content-Type: application/json');
    echo json_encode(array('productos' => array()));
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
