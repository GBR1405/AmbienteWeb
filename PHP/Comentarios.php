<?php
include './Menu.php';

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ticogourmet";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del restaurante desde la URL o establecer un valor predeterminado
$idRestaurante = isset($_GET['id_restaurante']) ? (int)$_GET['id_restaurante'] : 1;

// Obtener el ID del usuario desde la sesión (esto es un ejemplo, necesitarás ajustar según tu sistema de autenticación)
$idUsuario = isset($_SESSION['id_usuario']) ? (int)$_SESSION['id_usuario'] : 1;

// Función para mostrar comentarios
function mostrarComentarios($conn, $idRestaurante) {
    $sql = "SELECT c.Comentario, c.Rating, u.Nombre 
            FROM comentarios_tb c
            JOIN usuario_tb u ON c.ID_Usuario = u.ID_Usuario
            WHERE c.ID_Restaurante = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idRestaurante);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        echo "<div class='comentario'>";
        echo "<p><strong>" . htmlspecialchars($row['Nombre']) . "</strong>:</p>";
        echo "<p>" . htmlspecialchars($row['Comentario']) . "</p>";
        echo "<p class='rating'>Rating: " . str_repeat('&#9733;', (int)$row['Rating']) . "</p>";
        echo "</div>";
    }
}

// Agregar comentario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comentario = $_POST['comentario'];
    $rating = $_POST['rating'];
    $idRestaurante = $_POST['id_restaurante'];
    $idUsuario = $_POST['id_usuario'];

    $sql = "INSERT INTO comentarios_tb (ID_Restaurante, Comentario, Rating, ID_Usuario) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isii", $idRestaurante, $comentario, $rating, $idUsuario);
    
    if ($stmt->execute()) {
        echo "<p class='success-message'>Comentario agregado exitosamente</p>";
    } else {
        echo "<p class='error-message'>Error al agregar comentario: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comentarios del Restaurante</title>
    <link rel="stylesheet" href="../css/Comentarios.css">
</head>
<body>
    <div class="container">
        <h1>Comentarios del Restaurante</h1>

        <!-- Formulario para agregar comentario -->
        <form id="comentario-form">
            <textarea name="comentario" id="comentario" placeholder="Escribe tu comentario..." required></textarea>
            <div class="rating-container">
                <span class="star" data-value="1">&#9733;</span>
                <span class="star" data-value="2">&#9733;</span>
                <span class="star" data-value="3">&#9733;</span>
                <span class="star" data-value="4">&#9733;</span>
                <span class="star" data-value="5">&#9733;</span>
            </div>
            <input type="hidden" name="rating" id="rating" value="0" required>
            <input type="hidden" name="id_restaurante" id="id_restaurante" value="<?php echo htmlspecialchars($idRestaurante); ?>">
            <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo htmlspecialchars($idUsuario); ?>">
            <button type="submit">Agregar Comentario</button>
        </form>

        <!-- Div para mostrar comentarios -->
        <div id="comentarios">
            <?php mostrarComentarios($conn, $idRestaurante); ?>
        </div>
    </div>

    <script src="./js/comentarios.js"></script>
</body>
</html>

<?php
$conn->close();
?>
