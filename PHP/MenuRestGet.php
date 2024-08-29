<?php
header('Content-Type: application/json');

// Incluye la conexión a la base de datos
include './db.php';

$sql = "SELECT r.ID_Restaurante, u.Username AS Nombre, e.Especializacion AS ID_ESPECIALIDAD, p.Pais AS ID_PAIS 
        FROM restaurante_tb r
        JOIN usuario_tb u ON r.ID_Usuario = u.ID_Usuario
        JOIN especializacion_restaurante e ON r.ID_Especializacion_Restaurante = e.ID_Especializacion_Restaurante
        JOIN pais_tb p ON r.ID_Pais = p.ID_Pais
        WHERE r.ID_Estado = 1";

$result = $conn->query($sql);

if ($conn->error) {
    echo json_encode(['error' => $conn->error]);
    $conn->close();
    exit();
}

$restaurants = [];
while ($row = $result->fetch_assoc()) {
    $restaurants[] = $row;
}

echo json_encode($restaurants);

$conn->close(); // Cierra la conexión
?>
