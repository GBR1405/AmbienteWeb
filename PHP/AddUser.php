<?php
include './db.php'; // Incluye la conexión a la base de datos

// Verifica si se enviaron todos los datos necesarios
if (isset($_POST['username'], $_POST['nombre'], $_POST['apellido'], $_POST['password'], $_POST['email'], $_POST['telefono'], $_POST['genero'], $_POST['rol'], $_POST['estado'])) {
    
    // Obtener los valores enviados desde el formulario
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashear la contraseña para mayor seguridad
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $genero = $_POST['genero'];
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];

    // Crear la consulta SQL para insertar el nuevo usuario
    // Nota: No incluimos `ID_Usuario` ya que es autoincremental
    $sql = "INSERT INTO usuario_tb (Username, Nombre, Apellido, Contra, Email, Telefono, ID_Genero, ID_Rol, ID_Estado, Puntos) 
            VALUES ('$username', '$nombre', '$apellido', '$password', '$email', $telefono, $genero, $rol, $estado, 0)";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Usuario agregado exitosamente";
    } else {
        echo "Error al agregar el usuario: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();

} else {
    echo "Faltan datos para agregar el usuario.";
}
?>
