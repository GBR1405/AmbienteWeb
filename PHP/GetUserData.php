<?php
include './db.php'; // Incluye la conexión a la base de datos

// Verifica si se envió el ID del usuario
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']); // Asegúrate de que el ID sea un número entero

    // Crear la consulta SQL para obtener la información del usuario
    $sql = "SELECT * FROM usuario_tb WHERE ID_Usuario = $userId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo "Usuario no encontrado";
    }

    // Cerrar la conexión
    $conn->close();

} else {
    echo "ID de usuario no proporcionado";
}
?>
