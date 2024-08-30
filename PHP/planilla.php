<?php
include './db.php';
include './Menu.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ID_Usuario'])) {
    http_response_code(403);
    echo json_encode(['error' => 'No se ha iniciado sesión o el usuario no está definido.']);
    exit;
}

$id_usuario = $_SESSION['ID_Usuario'];

if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión a la base de datos.']);
    exit;
}

// Obtener ID del restaurante
$query_restaurante = "SELECT ID_Restaurante FROM restaurante_tb WHERE ID_Usuario = ?";
$stmt_restaurante = $conn->prepare($query_restaurante);
$stmt_restaurante->bind_param("i", $id_usuario);
$stmt_restaurante->execute();
$result_restaurante = $stmt_restaurante->get_result();
$row_restaurante = $result_restaurante->fetch_assoc();

if (!$row_restaurante) {
    http_response_code(404);
    echo json_encode(['error' => 'No se encontró un restaurante asociado a este usuario.']);
    exit;
}

$id_restaurante = $row_restaurante['ID_Restaurante'];

// Obtener horarios
$horarios = [];
$horario_query = "SELECT ID_Horario, Horario FROM horario_tb WHERE ID_Estado = 1";
$horario_result = $conn->query($horario_query);
while ($row = $horario_result->fetch_assoc()) {
    $horarios[] = $row;
}

// Obtener roles
$roles = [];
$rol_query = "SELECT ID_Rol, Rol FROM rol_tb WHERE ID_Estado = 1 AND ID_ROL > 4";
$rol_result = $conn->query($rol_query);
while ($row = $rol_result->fetch_assoc()) {
    $roles[] = $row;
}

// Manejar envíos de formularios para agregar o editar trabajadores
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $salario = $_POST['salario'];
    $id_horario = $_POST['id_horario'];
    $telefono = $_POST['telefono'];
    $id_rol = $_POST['id_rol'];
    $id_estado = 1; 

    if ($id) {
        // Actualizar trabajador
        $sql = "UPDATE planilla SET Nombre=?, Apellido=?, Salario=?, ID_Horario=?, Telefono=?, ID_RolPlanilla=?, ID_Estado=? WHERE ID_Planilla=? AND ID_Restaurante=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdiisii", $nombre, $apellido, $salario, $id_horario, $telefono, $id_rol, $id_estado, $id, $id_restaurante);
    } else {
        // Insertar nuevo trabajador
        $sql = "INSERT INTO planilla (Nombre, Apellido, Salario, ID_Horario, Telefono, ID_RolPlanilla, ID_Estado, ID_Restaurante) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdiisii", $nombre, $apellido, $salario, $id_horario, $telefono, $id_rol, $id_estado, $id_restaurante);
    }

    if ($stmt->execute()) {
        echo "Registro guardado correctamente";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Manejar eliminación de trabajadores
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM planilla WHERE ID_Planilla=? AND ID_Restaurante=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $id_restaurante);

    if ($stmt->execute()) {
        echo "Registro eliminado correctamente";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit;
}

// Obtener detalles de un trabajador para editar
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM planilla WHERE ID_Planilla=? AND ID_Restaurante=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $id_restaurante);
    $stmt->execute();
    $result = $stmt->get_result();
    $worker = $result->fetch_assoc();
    echo json_encode($worker);
    $stmt->close();
    $conn->close();
    exit;
}

// Obtener todos los trabajadores para mostrar en la tabla
if (isset($_GET['list']) && $_GET['list'] == 'true') {
    $sql = "SELECT * FROM planilla WHERE ID_Restaurante=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_restaurante);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['ID_Planilla'] . '</td>';
        echo '<td>' . $row['Nombre'] . '</td>';
        echo '<td>' . $row['Apellido'] . '</td>';
        echo '<td>' . $row['Salario'] . '</td>';
        echo '<td>' . $row['ID_Horario'] . '</td>';
        echo '<td>' . $row['Telefono'] . '</td>';
        echo '<td>' . $row['ID_RolPlanilla'] . '</td>';
        echo '<td>' . $row['ID_Estado'] . '</td>';
        echo '<td>
                <button class="btn-edit" data-id="' . $row['ID_Planilla'] . '">Editar</button>
                <button class="btn-delete" data-id="' . $row['ID_Planilla'] . '">Eliminar</button>
              </td>';
        echo '</tr>';
    }

    $conn->close();
    exit;
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planilla de Trabajadores</title>
    <link rel="stylesheet" href="../css/planilla.css">
    <script src="../js/planilla.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

    <div class="main-container">
        <header class="main-header">
            <div class="main-content">
                <h1>Planilla de Trabajadores</h1>
                <button id="openAddModal" class="btn-add">Agregar Trabajador</button>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Salario</th>
                        <th>Horario</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos serán cargados por JavaScript -->
                </tbody>
            </table>
        </main>
    </div>
    
    <!-- Modal para agregar o editar trabajador -->
    <div id="workerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle">Agregar Trabajador</h2>
            <form id="workerForm">
                <input type="hidden" id="workerId" name="id">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>
                <div class="form-group">
                    <label for="salario">Salario:</label>
                    <input type="number" id="salario" name="salario" required>
                </div>
                <div class="form-group">
                    <label for="id_horario">Horario:</label>
                    <select id="id_horario" name="id_horario" required>
                         <?php foreach ($horarios as $horario): ?>
                             <option value="<?php echo $horario['ID_Horario']; ?>"><?php echo $horario['Horario']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" required>
                </div>
                <div class="form-group">
                    <label for="id_rol">Rol:</label>
                    <select id="id_rol" name="id_rol" required>
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?php echo $rol['ID_Rol']; ?>"><?php echo $rol['Rol']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn-save">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Modal para confirmar eliminación -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirmar Eliminación</h2>
            <p>¿Estás seguro de que deseas eliminar este trabajador?</p>
            <button id="confirmDelete" class="btn-confirm">Eliminar</button>
            <button id="cancelDelete" class="btn-cancel">Cancelar</button>
        </div>
    </div>
</body>
</html>
