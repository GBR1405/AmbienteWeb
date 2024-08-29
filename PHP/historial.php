<?php

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener inventario
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Inventario</title>
    <link rel="stylesheet" href="styles.css"> <!-- Añade tu archivo CSS aquí -->
</head>
<body>
    <h1>Historial de Inventario</h1>

    <!-- Tabla para mostrar el inventario -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre del Producto</th>
            <th>Cantidad</th>
            <th>Fecha de Adquisición</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre_producto']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td><?php echo $row['fecha_adquisicion']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
