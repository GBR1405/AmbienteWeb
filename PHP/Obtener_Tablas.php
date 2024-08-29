<?php
// Obtener_Tablas.php

header('Content-Type: application/json');
require_once 'db_connection.php'; // Asegúrate de tener una conexión a la base de datos

function obtenerProductos() {
    $sql = "SELECT * FROM productos";
    $result = $db->query($sql);
    $productos = array();

    while($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }

    echo json_encode($productos);
}

if (isset($_GET['accion']) && $_GET['accion'] == 'obtener_productos') {
    obtenerProductos();
}
?>
