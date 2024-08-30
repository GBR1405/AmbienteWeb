<?php
// Conectar a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ticogourmet";
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener inventario
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Inventario</title>
    <link rel="stylesheet" href="../css/historial.css"> <!-- Añade tu archivo CSS aquí -->
</head>
<body>
    <div class="history-container">
        <h2>Historial de Inventario</h2>

        <!-- Tabla para mostrar el inventario -->
        <table class="history-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha de Adquisición</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_producto']); ?></td>
                    <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_adquisicion']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 

<?php
// Cerrar conexiones
$conn->close();
?>
