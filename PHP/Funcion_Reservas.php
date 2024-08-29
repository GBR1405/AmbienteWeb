<?php
// Función_Reservas.php

require_once 'db_connection.php';

function insertarProducto($nombre, $precio, $categoria) {
    global $db;
    $sql = "INSERT INTO productos (nombre, precio, categoria) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sds", $nombre, $precio, $categoria);
    return $stmt->execute();
}
?>
