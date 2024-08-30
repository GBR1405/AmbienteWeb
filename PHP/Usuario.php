<?php
include './Menu.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios - TicoGourmet</title>
    <link rel="stylesheet" href="../css/Pagusuario.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="../js/usuarioJS.js"></script>
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
        <div class="container mt-5">
            <h2 class="user-table-title">Usuarios</h2>
            <button id="add-user-btn" class="btn btn-warning mb-3">Agregar Usuario</button>
            <hr class="user-table-divider">
            <div class="table-responsive mt-3">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        <!-- Los usuarios se cargarán dinámicamente aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para agregar usuario -->
    <div id="add-user-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Añadir Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-user-form">
                        <div class="form-group">
                            <label for="id_usuario">ID Usuario:</label>
                            <input type="text" class="form-control" id="id_usuario" name="id_usuario" disabled>
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="genero">Género</label>
                            <select id="genero" class="form-control" name="genero">
                                <!-- Opciones se cargarán aquí -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select id="rol" class="form-control" name="rol">
                                <!-- Opciones se cargarán aquí -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" class="form-control" name="estado">
                                <!-- Opciones se cargarán aquí -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-user-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-user-form">
                        <input type="hidden" id="edit-user-id" name="id_usuario">
                        <div class="form-group">
                            <label for="edit-username">Username:</label>
                            <input type="text" class="form-control" id="edit-username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-nombre">Nombre:</label>
                            <input type="text" class="form-control" id="edit-nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-apellido">Apellido:</label>
                            <input type="text" class="form-control" id="edit-apellido" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email:</label>
                            <input type="email" class="form-control" id="edit-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="edit-telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-genero">Género</label>
                            <select id="edit-genero" class="form-control" name="genero">
                                <!-- Opciones se cargarán aquí -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-rol">Rol</label>
                            <select id="edit-rol" class="form-control" name="rol">
                                <!-- Opciones se cargarán aquí -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-estado">Estado</label>
                            <select id="edit-estado" class="form-control" name="estado">
                                <!-- Opciones se cargarán aquí -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</body>

</html>