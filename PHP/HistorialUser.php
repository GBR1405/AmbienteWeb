<?php
session_start();
include './db.php';
include './menu.php'; // Incluye el archivo de conexión

if (!isset($_SESSION['ID_Usuario'])) {
    echo "No estás autenticado.";
    exit;
}

$id_usuario = $_SESSION['ID_Usuario'];

// Obtener los pedidos del usuario
$query = "SELECT p.ID_Pedido, e.Estado AS Estado
          FROM pedido_tb p
          JOIN estado_tb e ON p.ID_Estado = e.ID_Estado
          WHERE p.ID_Usuario = $id_usuario";
$result = $conn->query($query);

if (!$result) {
    echo "Error en la consulta: " . $conn->error;
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pedidos</title>
    <link rel="stylesheet" href="../css/InfoRestaurante.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../css/MenuRest.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/historial.js"></script> 
    <link rel="stylesheet" href="../css/MenuRest.css">
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

    <div class="container mt-5">
        <h2>Historial de Pedidos</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['ID_Pedido']; ?></td>
                        <td><?php echo $row['Estado']; ?></td>
                        <td>
                            <button class="btn btn-info btn-sm ver-mas" data-id="<?php echo $row['ID_Pedido']; ?>">Ver más</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detallePedidoModal" tabindex="-1" aria-labelledby="detallePedidoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detallePedidoModalLabel">Detalles del Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre del Platillo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody id="detallePedidoBody">
                            <!-- Los datos del pedido se cargarán aquí mediante JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="path/to/historial.js"></script>
</body>

</html>