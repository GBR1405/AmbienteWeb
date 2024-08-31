<?php
include './db.php';

// Obtener datos del formulario
$id_usuario = $_POST['ID_Usuario'];
$direccion = $_POST['Direccion'];
$id_especializacion = $_POST['ID_Especializacion_Restaurante'];
$id_pais = $_POST['ID_Pais'];
$id_estado = $_POST['ID_Estado'];

// Insertar nuevo restaurante
$sql = "
    INSERT INTO restaurante_tb (ID_Usuario, Direccion, ID_Especializacion_Restaurante, ID_Pais, ID_Estado)
    VALUES (?, ?, ?, ?, ?)
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isiii", $id_usuario, $direccion, $id_especializacion, $id_pais, $id_estado);

if ($stmt->execute()) {
    echo "Restaurante agregado exitosamente.";
} else {
    echo "Error al agregar restaurante: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
