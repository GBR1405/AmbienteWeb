<?php
include './Menu.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tablas - TicoGourmet</title>
    <link rel="stylesheet" href="../css/Pagusuario.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/TablasAdmin.js"></script>
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
                    <div id="table-container">
                        <!-- Aquí se insertará la tabla que necesitas editar -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <button class="btn btn-primary btn-block mb-3 btn-tabla" data-tabla="categoria_tb">Ver Categorías</button>
                    <button class="btn btn-secondary btn-block mb-3 btn-insertar" data-tabla="categoria_tb">Insertar Categoría</button>
                    <button class="btn btn-primary btn-block mb-3 btn-tabla" data-tabla="especializacion_proveedortb">Ver Especializaciones Proveedor</button>
                    <button class="btn btn-secondary btn-block mb-3 btn-insertar" data-tabla="especializacion_proveedortb">Insertar Especialización Proveedor</button>
                    <button class="btn btn-primary btn-block mb-3 btn-tabla" data-tabla="especializacion_restaurante">Ver Especializaciones Restaurante</button>
                    <button class="btn btn-secondary btn-block mb-3 btn-insertar" data-tabla="especializacion_restaurante">Insertar Especialización Restaurante</button>
                    <button class="btn btn-primary btn-block mb-3 btn-tabla" data-tabla="horario_tb">Ver Horarios</button>
                    <button class="btn btn-secondary btn-block mb-3 btn-insertar" data-tabla="horario_tb">Insertar Horario</button>
                    <button class="btn btn-primary btn-block mb-3 btn-tabla" data-tabla="genero_tb">Ver Géneros</button>
                    <button class="btn btn-secondary btn-block mb-3 btn-insertar" data-tabla="genero_tb">Insertar Género</button>
                    <button class="btn btn-primary btn-block mb-3 btn-tabla" data-tabla="pais_tb">Ver Países</button>
                    <button class="btn btn-secondary btn-block mb-3 btn-insertar" data-tabla="pais_tb">Insertar País</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para formulario -->
    <div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Formulario</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <!-- El formulario se carga aquí -->
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

