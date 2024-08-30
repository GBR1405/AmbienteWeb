<?php
include './db.php'; // Incluye la conexión a la base de datos

// Verifica si se enviaron todos los datos necesarios
if (isset($_POST['id_usuario'], $_POST['username'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['telefono'], $_POST['genero'], $_POST['rol'], $_POST['estado'])) {
    
    // Obtener los valores enviados desde el formulario
    $userId = intval($_POST['id_usuario']);
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $genero = intval($_POST['genero']);
    $rol = intval($_POST['rol']);
    $estado = intval($_POST['estado']);

    // Crear la consulta SQL para actualizar el usuario
    $sql = "UPDATE usuario_tb 
            SET Username = '$username', Nombre = '$nombre', Apellido = '$apellido', Email = '$email', Telefono = $telefono, ID_Genero = $genero, ID_Rol = $rol, ID_Estado = $estado 
            WHERE ID_Usuario = $userId";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado exitosamente";
    } else {
        echo "Error al actualizar el usuario: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();

} else {
    echo "Faltan datos para actualizar el usuario.";
}
?>
