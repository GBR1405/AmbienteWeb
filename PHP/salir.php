<?php
// Incluye el archivo de configuración para asegurar que la sesión esté iniciada
include 'config.php';

// Verifica si hay una sesión activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // Borra todas las variables de sesión
    $_SESSION = array();

    // Elimina la cookie de sesión si existe
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    // Destruye la sesión
    session_destroy();
}

// Redirige al usuario a la página de inicio o al inicio de sesión
header("Location: index.php");
exit();
?>
