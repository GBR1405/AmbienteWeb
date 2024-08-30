<?php
include './db.php';
include './menu.php';

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

// Obtener productos disponibles
$query_productos = "SELECT * FROM productos WHERE Cantidad > 1";
$result_productos = $conn->query($query_productos);

// Obtener inventario
$sql = "SELECT * FROM inventario WHERE ID_Restaurante = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_restaurante);
$stmt->execute();
$result_inventario = $stmt->get_result();



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
    <link rel="stylesheet" href="../css/InfoRestaurante.css">
    <link rel="stylesheet" href="../css/inventario.css"> <!-- Actualiza el path al CSS -->
    <link rel="stylesheet" href="../css/modal.css"> <!-- Estilos para el modal -->
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

    <h1>Gestión de Inventario</h1>
    
    <!-- Botón para abrir el modal -->
    <button id="agregar-producto-btn">Agregar Producto</button>

    <!-- Modal para agregar producto -->
    <div id="agregar-producto-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Agregar Producto</h2>
            <form id="agregar-producto-form">
                <label for="producto-select">Seleccionar Producto:</label>
                <select id="producto-select" name="id_producto" required>
                    <!-- Opciones se cargarán aquí con AJAX -->
                </select>
                <button type="submit">Agregar Producto</button>
            </form>
        </div>
    </div>

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

    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/inventario.js"></script> <!-- Asegúrate de enlazar tu archivo JS aquí -->
</body>
</html>

