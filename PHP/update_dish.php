<?php
// update_dish.php

include './db.php'; // Incluye tu conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['name'];
    $precio = $_POST['price'];
    $descripcion = $_POST['description'];
    $imagen = $_POST['imagen']; // Asegúrate de que este campo esté presente en tu formulario
    $idCategoria = $_POST['category'];

    // Prepara la consulta SQL para actualizar `platillo_tb`
    $sql = "UPDATE platillo_tb SET 
                Nombre = ?,
                Precio = ?,
                Descripcion = ?,
                Imagen = ?,
                ID_Categoria = ?
            WHERE ID_Platillo = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parámetros
        $stmt->bind_param('sdsdii', $nombre, $precio, $descripcion, $imagen, $idCategoria, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo 'Platillo actualizado exitosamente.';
        } else {
            echo 'Error al actualizar el platillo.';
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo 'Error al preparar la consulta.';
    }

    // Cerrar la conexión
    $conn->close();
}
?>
