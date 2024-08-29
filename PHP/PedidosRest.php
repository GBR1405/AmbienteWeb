<?php
session_start();

// Verifica si el usuario está autenticado y tiene un ID_Usuario
if (!isset($_SESSION['ID_Usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['ID_Usuario'];
include './Menu.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos del Restaurante</title>
    <link rel="stylesheet" href="../css/InfoRestaurante.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="../css/MenuRest.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/Pedido.js"></script> 
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

<div class="container my-5">
    <h1 class="mb-4">Pedidos Actuales</h1>
    </div>
</div>
<div class="container my-5">
    <div id="pedidos-container" class="row g-4">
    </div>
</div>

<div class="container my-8">
    <h1 class="mb-4">Historial de Pedidos</h1>
    </div>
</div>
<div class="container my-8">
    <div id="historial-pedidos-container" class="row g-4">
    </div>
</div>


<!-- Modal para cambiar el estado del pedido -->
<div id="estado-modal" class="modal fade" tabindex="-1" aria-labelledby="estadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estadoModalLabel">Cambiar estado del pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p id="pedido-info"></p>
                <div class="d-grid gap-2">
                    <button id="completado-btn" class="btn btn-success">Marcar como Completado</button>
                    <button id="cancelado-btn" class="btn btn-danger">Marcar como Cancelado</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
