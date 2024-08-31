<?php
include './db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $telefono = intval(trim($_POST['telefono'])); 
    $genero = intval(trim($_POST['genero'])); 

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $username = $conn->real_escape_string($username);
    $hashed_password = $conn->real_escape_string($hashed_password);
    $nombre = $conn->real_escape_string($nombre);
    $apellido = $conn->real_escape_string($apellido);
    $email = $conn->real_escape_string($email);
    $telefono = $conn->real_escape_string($telefono);
    $genero = $conn->real_escape_string($genero);

    $puntos = 0;
    $id_rol = 2;
    $id_estado = 1;

    $puntos = $conn->real_escape_string($puntos);
    $id_rol = $conn->real_escape_string($id_rol);
    $id_estado = $conn->real_escape_string($id_estado);

    $sql = "INSERT INTO usuario_tb (Username, Nombre, Apellido, Contra, Email, Telefono, Puntos, ID_Genero, ID_Rol, ID_Estado)
            VALUES ('$username', '$nombre', '$apellido', '$hashed_password', '$email', $telefono, $puntos, $genero, $id_rol, $id_estado)";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado con éxito.";
        header("Location: inicio_sesion.php");
        exit();
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
    
    $conn->close();
}
?>
