<?php
include './Menu.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurantes</title>
    <link rel="stylesheet" href="../css/Pagusuario.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="path/to/your/custom.css">
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

    <div class="container mt-4">
        <h1>Restaurantes</h1>
        <button id="add-restaurant-btn" class="btn btn-primary mb-3">Agregar Restaurante</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="restaurant-table-body">
                <!-- Las filas se cargarán aquí mediante JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar restaurante -->
    <div class="modal fade" id="add-restaurant-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Restaurante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-restaurant-form">
                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <select id="user" name="ID_Usuario" class="form-control">
                                <!-- Los datos se llenarán mediante AJAX -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="especializacion">Especialización</label>
                            <select id="especializacion" name="ID_Especializacion_Restaurante" class="form-control">
                                <!-- Los datos se llenarán mediante AJAX -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pais">País</label>
                            <select id="pais" name="ID_Pais" class="form-control">
                                <!-- Los datos se llenarán mediante AJAX -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" name="ID_Estado" class="form-control">
                                <!-- Los datos se llenarán mediante AJAX -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="Direccion" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Incluir tu JavaScript -->
    <script src="../js/RestauranteAdmin.js"></script>
</body>
</html>
