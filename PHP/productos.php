<?php
// Conectar a la base de datos
$host = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "ticogourmet";
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Agregar un producto
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $sql = "INSERT INTO productos (nombre, precio, cantidad) VALUES ('$nombre', '$precio', '$cantidad')";
    $conn->query($sql);
}

// Eliminar un producto
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM productos WHERE id = $id";
    $conn->query($sql);
}

// Editar un producto
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', cantidad='$cantidad' WHERE id=$id";
    $conn->query($sql);
}

// Obtener productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Gestión de Productos</h1>
    
    <!-- Formulario para agregar un nuevo producto -->
    <form method="POST" action="productos.php">
        <input type="text" name="nombre" placeholder="Nombre del Producto" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required>
        <input type="number" name="cantidad" placeholder="Cantidad" required> 
        <button type="submit" name="agregar">Agregar Producto</button>
    </form>

    <!-- Tabla para mostrar los productos -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th> 
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['precio']; ?></td>
            <td><?php echo $row['cantidad']; ?></td> 
            <td>
                <a href="productos.php?eliminar=<?php echo $row['id']; ?>">Eliminar</a>
                <a href="productos.php?editar=<?php echo $row['id']; ?>">Editar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
