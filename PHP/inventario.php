<?php

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Agregar un producto al inventario
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre_producto'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha_adquisicion'];

    $sql = "INSERT INTO inventario (nombre_producto, cantidad, fecha_adquisicion) VALUES ('$nombre', '$cantidad', '$fecha')";
    $conn->query($sql);
}

// Eliminar un producto del inventario
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM inventario WHERE id = $id";
    $conn->query($sql);
}

// Editar un producto del inventario
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre_producto'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha_adquisicion'];

    $sql = "UPDATE inventario SET nombre_producto='$nombre', cantidad='$cantidad', fecha_adquisicion='$fecha' WHERE id=$id";
    $conn->query($sql);
}

// Obtener inventario
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Inventario</title>
    <link rel="stylesheet" href="styles.css"> <!-- Añade tu archivo CSS aquí -->
</head>
<body>
    <h1>Gestión de Inventario</h1>
    
    <!-- Formulario para agregar un nuevo producto al inventario -->
    <form method="POST" action="inventario.php">
        <input type="text" name="nombre_producto" placeholder="Nombre del Producto" required>
        <input type="number" name="cantidad" placeholder="Cantidad" required>
        <input type="date" name="fecha_adquisicion" placeholder="Fecha de Adquisición" required>
        <button type="submit" name="agregar">Agregar al Inventario</button>
    </form>

    <!-- Tabla para mostrar el inventario -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre del Producto</th>
            <th>Cantidad</th>
            <th>Fecha de Adquisición</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre_producto']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td><?php echo $row['fecha_adquisicion']; ?></td>
            <td>
                <a href="inventario.php?eliminar=<?php echo $row['id']; ?>">Eliminar</a>
                <a href="inventario.php?editar=<?php echo $row['id']; ?>">Editar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
