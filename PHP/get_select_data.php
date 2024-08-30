<?php
include './db.php';

// Obtener géneros
$generos = [];
$sqlGenero = "SELECT ID_Genero, Nombre_Genero FROM genero_tb WHERE ID_Estado = 1";
$resultGenero = $conn->query($sqlGenero);
while ($row = $resultGenero->fetch_assoc()) {
    $generos[] = $row;
}

// Verificar que se están obteniendo datos
if (empty($generos)) {
    echo "Error: No se obtuvieron géneros";
    exit;
}

// Obtener roles
$roles = [];
$sqlRol = "SELECT ID_Rol, Rol FROM rol_tb WHERE ID_Rol > 0 AND ID_Rol < 5";
$resultRol = $conn->query($sqlRol);
while ($row = $resultRol->fetch_assoc()) {
    $roles[] = $row;
}

// Verificar que se están obteniendo datos
if (empty($roles)) {
    echo "Error: No se obtuvieron roles";
    exit;
}

// Obtener estados
$estados = [];
$sqlEstado = "SELECT ID_Estado, Estado FROM estado_tb where ID_ESTADO < 3";
$resultEstado = $conn->query($sqlEstado);
while ($row = $resultEstado->fetch_assoc()) {
    $estados[] = $row;
}

// Verificar que se están obteniendo datos
if (empty($estados)) {
    echo "Error: No se obtuvieron estados";
    exit;
}

// Devolver datos como JSON
echo json_encode([
    'generos' => $generos,
    'roles' => $roles,
    'estados' => $estados
]);

$conn->close();
?>
