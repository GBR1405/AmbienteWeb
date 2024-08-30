<?php
// Conectar a la base de datos
include './db.php'; // Asegúrate de que la ruta sea correcta
include './Menu.php';

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

// Obtener el ID del proveedor asociado al usuario
$query_proveedor = "SELECT ID_Proveedor FROM proveedor_tb WHERE ID_Usuario = ?";
$stmt_proveedor = $conn->prepare($query_proveedor);
$stmt_proveedor->bind_param("i", $id_usuario);
$stmt_proveedor->execute();
$result_proveedor = $stmt_proveedor->get_result();
$row_proveedor = $result_proveedor->fetch_assoc();

if (!$row_proveedor) {
    die("No se encontró un proveedor asociado a este usuario.");
}

$id_proveedor = $row_proveedor['ID_Proveedor'];

// Agregar un producto
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $detalles = $_POST['detalles'];
    $precio = $_POST['precio'];
    $fecha_caducidad = $_POST['fecha_caducidad'];
    $cantidad = $_POST['cantidad'];

    $sql = "INSERT INTO productos (Nombre, Detalles, Precio, Fecha_Caducidad, Cantidad, ID_Proveedor) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsii", $nombre, $detalles, $precio, $fecha_caducidad, $cantidad, $id_proveedor);

    if ($stmt->execute()) {
    } else {
        echo "Error al agregar el producto: " . $stmt->error;
    }
    $stmt->close();
}

// Eliminar un producto
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM productos WHERE ID_Producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Editar un producto
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $detalles = $_POST['detalles'];
    $precio = $_POST['precio'];
    $fecha_caducidad = $_POST['fecha_caducidad'];
    $cantidad = $_POST['cantidad'];

    $sql = "UPDATE productos SET Nombre=?, Detalles=?, Precio=?, Fecha_Caducidad=?, Cantidad=? WHERE ID_Producto=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsii", $nombre, $detalles, $precio, $fecha_caducidad, $cantidad, $id);

    if ($stmt->execute()) {
        echo "Producto actualizado exitosamente.";
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }
    $stmt->close();
}

// Obtener productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

// Variable para almacenar los datos del producto a editar
$edit_product = null;

// Si se hace clic en "Editar", obtenemos los datos del producto y los prellenamos en el formulario
if (isset($_GET['editar'])) {
    $id_editar = $_GET['editar'];
    $sql_editar = "SELECT * FROM productos WHERE ID_Producto = ?";
    $stmt_editar = $conn->prepare($sql_editar);
    $stmt_editar->bind_param("i", $id_editar);
    $stmt_editar->execute();
    $result_editar = $stmt_editar->get_result();
    $edit_product = $result_editar->fetch_assoc();
    $stmt_editar->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="../css/InfoRestaurante.css">
    <link rel="stylesheet" href="../css/Productos.css">
    <script src="../js/jquery-3.5.1.min.js"></script> <!-- Ruta a verificar -->
    <script src="../js/inventario.js"></script> <!-- Ruta a verificar -->
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="logo">
                <h1><a href="./index.php" class="logo-link">TicoGourmet 🍔 . </a></h1>
            </div>
            <nav class="nav">
                <ul class="nav-list">
                    <?php
                    $menu = getMenu();
                    foreach ($menu as $item) {
                        echo '<li class="nav-item"><a href="' . $item["url"] . '">' . $item["name"] . '</a></li>';
                        echo '<li class="separator">|</li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <div class="BodySection">
    <h1>Gestión de Productos</h1>

    <!-- Formulario para agregar o editar un producto -->
    <form method="POST" action="productos.php">
        <input type="hidden" name="id" value="<?php echo $edit_product['ID_Producto'] ?? ''; ?>">
        <input type="text" name="nombre" placeholder="Nombre del Producto" required value="<?php echo $edit_product['Nombre'] ?? ''; ?>">
        <textarea name="detalles" placeholder="Detalles del Producto" required><?php echo $edit_product['Detalles'] ?? ''; ?></textarea>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required value="<?php echo $edit_product['Precio'] ?? ''; ?>">
        <input type="date" name="fecha_caducidad" placeholder="Fecha de Caducidad" required value="<?php echo $edit_product['Fecha_Caducidad'] ?? ''; ?>">
        <input type="number" name="cantidad" placeholder="Cantidad" required value="<?php echo $edit_product['Cantidad'] ?? ''; ?>">
        <button type="submit" name="<?php echo $edit_product ? 'editar' : 'agregar'; ?>">
            <?php echo $edit_product ? 'Actualizar Producto' : 'Agregar'; ?>
        </button>
    </form>

    <!-- Tabla para mostrar los productos -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Detalles</th>
            <th>Precio</th>
            <th>Fecha de Caducidad</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['ID_Producto']; ?></td>
                <td><?php echo $row['Nombre']; ?></td>
                <td><?php echo $row['Detalles']; ?></td>
                <td><?php echo $row['Precio']; ?></td>
                <td><?php echo $row['Fecha_Caducidad']; ?></td>
                <td><?php echo $row['Cantidad']; ?></td>
                <td>
                    <a href="productos.php?eliminar=<?php echo $row['ID_Producto']; ?>">Eliminar</a>
                    <a href="productos.php?editar=<?php echo $row['ID_Producto']; ?>">Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    </div>
</body>

</html>