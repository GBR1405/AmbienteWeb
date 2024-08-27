<?php
include './db.php'; 

// Obtén los datos del formulario
$usuario = trim($_POST["username"]);
$clave = trim($_POST["password"]);

// Prepara la consulta SQL
$sql = "SELECT * FROM usuario_tb WHERE Username = ?";

// Usa una consulta preparada para evitar SQL Injection
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifica la contraseña
        if (password_verify($clave, $row["Contra"])) {
            session_start();
            // Guarda la información en la sesión
            $_SESSION["usuario"] = $usuario;
            $_SESSION["ID_Usuario"] = $row["ID_Usuario"];
            $_SESSION["Rol"] = $row["ID_Rol"]; // Usa el valor correcto para Rol

            // Redirige a la página principal
            echo "success";
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "No existe el usuario";
    }

    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}

$conn->close();
?>
