<?php
include './db.php'; // Verifica que el archivo db.php esté en la ruta correcta

header('Content-Type: text/html; charset=utf-8'); // Asegúrate de que el tipo de contenido sea correcto

// Mensaje de depuración
echo 'Conectado a la base de datos'; 

$query = "SELECT ID_GENERO, Nombre_Genero FROM genero_tb";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Verifica que los datos se están recuperando correctamente
        echo '<option value="' . htmlspecialchars($row['ID_GENERO']) . '">' . htmlspecialchars($row['Nombre_Genero']) . '</option>';
    }
} else {
    echo '<option value="">Error al cargar géneros</option>';
}

mysqli_close($conn);
?>
