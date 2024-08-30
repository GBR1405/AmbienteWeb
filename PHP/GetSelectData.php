<?php
include './db.php';

// Obtener usuarios que tengan rol de restaurante y no estén asociados a un restaurante
$usuarios = [];
$sqlUsuarios = "
    SELECT u.ID_Usuario, u.Username
    FROM usuario_tb u
    LEFT JOIN restaurante_tb r ON u.ID_Usuario = r.ID_Usuario
    WHERE u.ID_Rol = 4 AND r.ID_Usuario IS NULL
";
$resultUsuarios = $conn->query($sqlUsuarios);
while ($row = $resultUsuarios->fetch_assoc()) {
    $usuarios[] = $row;
}

// Obtener especializaciones
$especializaciones = [];
$sqlEspecializacion = "SELECT ID_Especializacion_Restaurante, Especializacion FROM especializacion_restaurante";
$resultEspecializacion = $conn->query($sqlEspecializacion);
while ($row = $resultEspecializacion->fetch_assoc()) {
    $especializaciones[] = $row;
}

// Obtener países
$paises = [];
$sqlPaises = "SELECT ID_Pais, Pais FROM pais_tb";
$resultPaises = $conn->query($sqlPaises);
while ($row = $resultPaises->fetch_assoc()) {
    $paises[] = $row;
}

// Obtener estados
$estados = [];
$sqlEstados = "SELECT ID_Estado, Estado FROM estado_tb";
$resultEstados = $conn->query($sqlEstados);
while ($row = $resultEstados->fetch_assoc()) {
    $estados[] = $row;
}

// Devolver datos como JSON
echo json_encode([
    'users' => $usuarios,
    'especializaciones' => $especializaciones,
    'paises' => $paises,
    'estados' => $estados
]);

$conn->close();
?>
