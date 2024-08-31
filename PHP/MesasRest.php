<?php
include './db.php';
include './menu.php';

// Verificación de sesión y usuario
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

// Manejar inserción de nuevas mesas
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $num_mesa = $_POST['Num_mesa'];
        $estado = $_POST['Estado'];

        $sql = "INSERT INTO mesas_tb (Num_mesa, Estado, ID_Restaurante) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $num_mesa, $estado, $id_restaurante);

        if ($stmt->execute()) {
            echo "Nueva mesa agregada con éxito.";
        } else {
            echo "Error: " . $stmt->error;
        }
        header("Location: mesasRest.php");
        exit;
    } elseif (isset($_POST['update_status'])) {
        $id_mesa = $_POST['ID_Mesa'];
        $estado = $_POST['Estado'] ? 0 : 1; // Cambiar el estado de ocupado a disponible y viceversa

        $sql = "UPDATE mesas_tb SET Estado = ? WHERE ID_Mesa = ? AND ID_Restaurante = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $estado, $id_mesa, $id_restaurante);

        if ($stmt->execute()) {
            echo "Estado actualizado con éxito.";
        } else {
            echo "Error: " . $stmt->error;
        }
        header("Location: mesasRest.php");
        exit;
    } elseif (isset($_POST['delete'])) {
        $id_mesa = $_POST['ID_Mesa'];

        $sql = "DELETE FROM mesas_tb WHERE ID_Mesa = ? AND ID_Restaurante = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_mesa, $id_restaurante);

        if ($stmt->execute()) {
            echo "Mesa eliminada con éxito.";
        } else {
            echo "Error: " . $stmt->error;
        }
        header("Location: mesasRest.php");
        exit;
    }
}

// Consultar todas las mesas de la base de datos para el restaurante seleccionado
$sql = "SELECT * FROM mesas_tb WHERE ID_Restaurante = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_restaurante);
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Mesas</title>
    <link rel="stylesheet" href="../css/Header.css">
    <link rel="stylesheet" href="../css/mesas_reservas.css">
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/mesas_reservas.js"></script>
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

    <div>
        <h2 style="text-align: center;">Gestión de Mesas</h2>
        <button class="add-btn" onclick="openAddModal()">Agregar Nueva Mesa</button>
    </div>

    <div class="cards-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <h3>Mesa <?php echo $row['Num_Mesa']; ?></h3>
                <p>Estado: <?php echo $row['Estado'] ? 'Ocupada' : 'Disponible'; ?></p>
                <form method="post" action="" style="display:inline;">
                    <input type="hidden" name="ID_Mesa" value="<?php echo $row['ID_Mesa']; ?>">
                    <input type="hidden" name="Estado" value="<?php echo $row['Estado']; ?>">
                    <button type="submit" name="update_status">
                        <?php echo $row['Estado'] ? 'Marcar Disponible' : 'Marcar Ocupada'; ?>
                    </button>
                </form>
                <button onclick="openModal('<?php echo $row['ID_Mesa']; ?>', '<?php echo $row['Num_Mesa']; ?>', '<?php echo $row['Estado']; ?>')">Editar</button>
                <form method="post" action="" style="display:inline;">
                    <input type="hidden" name="ID_Mesa" value="<?php echo $row['ID_Mesa']; ?>">
                    <button type="submit" name="delete">Eliminar</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Modal para agregar mesa -->
    <div class="modal" id="add-modal">
        <h3 id="modal-title">Agregar Mesa</h3>
        <form method="post" action="">
            <input type="hidden" name="ID_Mesa" id="modal-id-mesa">
            <label for="modal-num-mesa">Número de Mesa:</label>
            <input type="number" name="Num_mesa" id="modal-num-mesa" required>
            <label for="modal-estado">Estado:</label>
            <select name="Estado" id="modal-estado" required>
                <option value="0">Disponible</option>
                <option value="1">Ocupada</option>
            </select>
            <button type="submit" name="add" id="modal-add-btn">Agregar</button>
            <button type="submit" name="edit" id="modal-edit-btn" style="display: none;">Actualizar</button>
            <button type="button" class="close-btn" onclick="closeModal()">Cerrar</button>
        </form>
    </div>

    <!-- Modal para editar mesa -->
    <div class="modal" id="edit-modal">
        <!-- Similar estructura como el modal de agregar mesa -->
    </div>
</body>

</html>
