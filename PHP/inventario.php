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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ID_Usuario'])) {
    die("No se ha iniciado sesión o el usuario no está definido.");
}

$id_usuario = $_SESSION['ID_Usuario'];

// Obtener el ID del restaurante asociado al usuario
$query_restaurante = "SELECT ID_Restaurante FROM restaurante_tb WHERE ID_Usuario = ?";
$stmt_restaurante = $conn->prepare($query_restaurante);
$stmt_restaurante->bind_param("i", $id_usuario);
$stmt_restaurante->execute();
$result_restaurante = $stmt_restaurante->get_result();
$row_restaurante = $result_restaurante->fetch_assoc();

if (!$row_restaurante) {
    die("No se encontró un restaurante asociado a este usuario.");
}

$id_restaurante = $row_restaurante['ID_Restaurante'];
var_dump($id_restaurante);  // Verifica que el ID del restaurante se ha obtenido correctamente

// Agregar un producto al inventario
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre_producto'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha_adquisicion'];

    $sql = "INSERT INTO inventario (ID_Producto, Cantidad, Fecha_De_Entregado, ID_Restaurante) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $nombre, $cantidad, $fecha, $id_restaurante);

    if ($stmt->execute()) {
        echo "Producto agregado exitosamente.";
    } else {
        echo "Error al agregar el producto: " . $stmt->error;
    }
    $stmt->close();
}

// Eliminar un producto del inventario
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM inventario WHERE ID_Inventario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Editar un producto del inventario
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre_producto'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha_adquisicion'];

    $sql = "UPDATE inventario SET ID_Producto=?, Cantidad=?, Fecha_De_Entregado=? WHERE ID_Inventario=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $nombre, $cantidad, $fecha, $id);

    if ($stmt->execute()) {
        echo "Producto actualizado exitosamente.";
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }
    $stmt->close();
}

// Obtener inventario
$sql = "SELECT * FROM inventario WHERE ID_Restaurante = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_restaurante);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Inventario</title>
    <link rel="stylesheet" href="../css/inventario.css"> <!-- Actualiza el path al CSS -->
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
            <td><?php echo $row['ID_Inventario']; ?></td>
            <td><?php echo $row['ID_Producto']; ?></td>
            <td><?php echo $row['Cantidad']; ?></td>
            <td><?php echo $row['Fecha_De_Entregado']; ?></td>
            <td>
                <a href="inventario.php?eliminar=<?php echo $row['ID_Inventario']; ?>">Eliminar</a>
                <a href="inventario.php?editar=<?php echo $row['ID_Inventario']; ?>">Editar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
