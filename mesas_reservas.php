<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/mesas_reservas.css">
    <script src="./js/jquery-3.7.1.js"></script> 
   
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h1>TicoGourmet</h1>
            </div>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="#">MENU</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="contacts.php">CONTACTO</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="mesas_reservas.php">RESERVAS</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">NOSOTROS</a></li>
                </ul>
            </nav>
            <div class="right-section">
                <div class="cart">
                    <a href="#"><img src="https://cdn.icon-icons.com/icons2/906/PNG/512/shopping-cart_icon-icons.com_69913.png" alt="Cart" class="cart-icon"></a>
                </div>
                <div class="login">
                    <button class="login-button">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </header>




    <div >
            <img src="https://www.interhome.es/upload/travelguide/6665/conversions/francia-cocina-francesa-hero-teaser-responsive.jpg" alt="" width="100%">
            <h2 style="text-align: center;">TicoGourmet Reservas</h2>
            <p style="text-align: center ;">Todo en un mismo lugar, haz tu reserva ahora y cancela cuando quieras sin costo adicional</p>
            
            </div>
            <div class="cards-container">
    <div class="card">
        <h3>Mesa 1</h3>
        <p>Capacidad: 4 personas</p>
        <p>Estado: Disponible</p>
        <button>Reservar</button>
    </div>
    <div class="card">
        <h3>Mesa 2</h3>
        <p>Capacidad: 2 personas</p>
        <p>Estado: Ocupada</p>
        <button disabled>No Disponible</button>
    </div>
    <div class="card">
        <h3>Mesa 3</h3>
        <p>Capacidad: 6 personas</p>
        <p>Estado: Disponible</p>
        <button>Reservar</button>
    </div>
    <!-- Añade más cards para otras mesas según sea necesario -->
</div>

<?php
// Conexión a la base de datos
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ID_Usuario'])) {
    http_response_code(403);
    echo "No se ha iniciado sesión o el usuario no está definido.";
    exit;
}

$id_usuario = $_SESSION['ID_Usuario'];

if (!$conn) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consultar las reservas pendientes
$query = "SELECT reserva_tb.ID_Reserva, reserva_tb.Fecha, reserva_tb.Cantidad_Asientos, 
                 mesa_tb.Cantidad_Asientos AS Mesa 
          FROM reserva_tb 
          JOIN mesa_tb ON reserva_tb.ID_Mesa = mesa_tb.ID_Mesa 
          WHERE reserva_tb.ID_Usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reserva_id = $_POST['reserva_id'];
    $accion = $_POST['accion'];

    if ($accion == 'editar') {
        $fecha = $_POST['Fecha'];
        $cantidad_asientos = $_POST['Cantidad_Asientos'];

        $sql = "UPDATE reserva_tb 
                SET Fecha = ?, Cantidad_Asientos = ? 
                WHERE ID_Reserva = ? AND ID_Usuario = ?";
        $stmt_update = $conn->prepare($sql);
        $stmt_update->bind_param("ssii", $fecha, $cantidad_asientos, $reserva_id, $id_usuario);
    } elseif ($accion == 'eliminar') {
        $sql = "DELETE FROM reserva_tb WHERE ID_Reserva = ? AND ID_Usuario = ?";
        $stmt_update = $conn->prepare($sql);
        $stmt_update->bind_param("ii", $reserva_id, $id_usuario);
    }

    if ($stmt_update->execute()) {
        echo "Reserva actualizada con éxito.";
    } else {
        echo "Error al actualizar la reserva: " . $conn->error;
    }
    $stmt_update->close();
}

$stmt->close();
$conn->close();
?>


<div class="form-container button-form">
    <h2 style="text-align: center;">Reservas</h2>
    <form method="post" id="reservationForm" class="form-container">
        <input type="text" id="ID_Usuario" placeholder="Nombre" required>
        <input type="date" id="Fecha" required>
        <select required id="Cantidad_Asientos">
            <option value="" disabled selected>Cantidad de asientos</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="8">8</option>
            <option value="10">10</option>
        </select>
        <button type="submit" class="button-form">Reservar</button>
    </form>
    <br>

    <div class="reservation-list">
        <h3 style="text-align: center;">Tus Reservas</h3>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="reservation-list-item">
                <span><?php echo "Mesa " . $row['Mesa'] . " - " . $row['Fecha']; ?></span>
                <span>
                    <form method="post">
                        <input type="hidden" name="reserva_id" value="<?php echo $row['ID_Reserva']; ?>">
                        <input type="hidden" name="accion" value="editar">
                        <button type="submit">Editar</button>
                    </form>
                    <form method="post">
                        <input type="hidden" name="reserva_id" value="<?php echo $row['ID_Reserva']; ?>">
                        <input type="hidden" name="accion" value="eliminar">
                        <button type="submit">Eliminar</button>
                    </form>
                </span>
            </div>
        <?php endwhile; ?>
    </div>
</div>








        

        





















        
        
   








     <!--***************************************-->
     


</body>
</html>