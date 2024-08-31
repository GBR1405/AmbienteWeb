<?php
include './Menu.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - TicoGourmet</title>
    <link rel="stylesheet" href="../css/Pagusuario.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/carrito.js"></script>
    <style>
        /* Estilo para la tabla del carrito */
        .carrito-table {
            background-color: #ffffff; /* Color de fondo blanco para la tabla */
            border-radius: 8px; /* Bordes redondeados */
            overflow: hidden; /* Para asegurar que los bordes redondeados se apliquen */
        }

        /* Contenedor para el total */
        .total-container {
            background-color: #f8f9fa; /* Color de fondo para el contenedor del total */
            border: 1px solid #dee2e6; /* Borde gris claro */
            border-radius: 8px; /* Bordes redondeados */
            padding: 15px;
            margin-left: 20px;
        }

        .btn-pedir {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header class="main-header">
        <div class="main-container">
            <div class="main-content">
                <div class="logo">
                    <h1><a href="./index.php" class="logo-link">TicoGourmet 🍔</a></h1>
                </div>
                <nav class="main-nav">
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
        </div>
    </header>

    <!-- Contenedor principal -->
    <div class="main-content-container">
        <div class="container mt-5 d-flex">
            <!-- Tabla de carrito -->
            <div class="table-responsive carrito-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="carrito-table-body">
                        <!-- Los productos del carrito se cargarán dinámicamente aquí -->
                    </tbody>
                </table>
            </div>

            <!-- Contenedor para el total -->
            <div class="total-container">
                <h4>Total:</h4>
                <p id="total-price">$0.00</p>
                <button id="confirmar-pedido-btn" class="btn btn-success">Pedir</button>
            </div>
        </div>
    </div>
</body>

</html>
