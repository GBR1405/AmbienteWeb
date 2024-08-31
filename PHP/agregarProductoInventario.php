<?php
// Conectar a la base de datos
include './db.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

// Agregar el producto al inventario
if (isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    // Insertar el producto en el inventario
    $sql = "INSERT INTO inventario (ID_Producto, Cantidad, Fecha_De_Entregado, ID_Restaurante) 
            VALUES (?, 1, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_producto, $id_restaurante);

    if ($stmt->execute()) {
        // Restar uno de la tabla productos
        $sql_restar = "UPDATE productos_tb SET cantidad = cantidad - 1 WHERE ID_Producto = ?";
        $stmt_restar = $conn->prepare($sql_restar);
        $stmt_restar->bind_param("i", $id_producto);
        $stmt_restar->execute();
        echo "Producto agregado exitosamente.";
    } else {
        echo "Error al agregar el producto: " . $stmt->error;
    }
    $stmt->close();
}
?>
