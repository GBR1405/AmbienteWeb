<?php
include './Menu.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tablas - TicoGourmet</title>
    <link rel="stylesheet" href="../css/Pagusuario.css"> <!-- Asegúrate de enlazar correctamente el CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/editar_tablas.js"></script>
</head>

<body>
    <!-- Header -->
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

    <!-- Contenido principal -->
    <div class="main-content-container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <h2>Tablas a editar</h2>
                <hr class="user-table-divider">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <!-- Aquí se insertará la tabla que necesitas editar -->
                        <thead>
                            <tr>
                                <th>Columna 1</th>
                                <th>Columna 2</th>
                                <th>Columna 3</th>
                                <!-- Agrega más columnas según sea necesario -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas de la tabla -->
                            <tr>
                                <td>Dato 1</td>
                                <td>Dato 2</td>
                                <td>Dato 3</td>
                            </tr>
                            <!-- Agrega más filas según sea necesario -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <button class="btn btn-primary btn-block mb-3">Botón 1</button>
                    <button class="btn btn-primary btn-block mb-3">Botón 2</button>
                    <button class="btn btn-primary btn-block mb-3">Botón 3</button>
                    <button class="btn btn-primary btn-block mb-3">Botón 4</button>
                    <button class="btn btn-primary btn-block mb-3">Botón 5</button>
                    <button class="btn btn-primary btn-block">Botón 6</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>