<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet</title>
    <title>TicoGourmet</title>
    <link rel="stylesheet" href="../css/IndexStyleTest.css">
    <link rel="stylesheet" href="../css/Header.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/mesas_reservas.css">
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/mesas_reservas.js"></script>

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





    <div>
        <br>
        <br>

        <img src="https://www.interhome.es/upload/travelguide/6665/conversions/francia-cocina-francesa-hero-teaser-responsive.jpg" alt="" width="100%">
        <br>
        <br>

        <h2 style="text-align: center;">TicoGourmet Reservas</h2>
        <br>
        <br>

        <p style="text-align: center ;">Todo en un mismo lugar, haz tu reserva ahora y cancela cuando quieras sin costo adicional</p>

    </div>
    <br>
    <br>






    <?php
    include './db.php';

    // Procesar acciones CRUD
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['update_status'])) {
            // Actualizar estado de mesa
            $id_mesa = intval($_POST['ID_Mesa']);
            $estado_actual = intval($_POST['Estado']);
            $nuevo_estado = $estado_actual ? 0 : 1;
            $sql = "UPDATE mesas_tb SET Estado = $nuevo_estado WHERE ID_Mesa = $id_mesa";
            $conn->query($sql);
        } elseif (isset($_POST['add'])) {
            // Agregar mesa
            $num_mesa = intval($_POST['Num_mesa']);
            $estado = intval($_POST['Estado']);
            $sql = "INSERT INTO mesas_tb (Num_mesa, Estado) VALUES ($num_mesa, $estado)";
            $conn->query($sql);
        } elseif (isset($_POST['edit'])) {
            // Editar mesa
            $id_mesa = intval($_POST['ID_Mesa']);
            $num_mesa = intval($_POST['Num_mesa']);
            $estado = intval($_POST['Estado']);
            $sql = "UPDATE mesas_tb SET Num_mesa = $num_mesa, Estado = $estado WHERE ID_Mesa = $id_mesa";
            $conn->query($sql);
        } elseif (isset($_POST['delete'])) {
            // Eliminar mesa
            $id_mesa = intval($_POST['ID_Mesa']);
            $sql = "DELETE FROM mesas_tb WHERE ID_Mesa = $id_mesa";
            $conn->query($sql);
        }
    }

    // Obtener mesas
    $sql = "SELECT * FROM mesas_tb";
    $result = $conn->query($sql);

    $conn->close();
    ?>

    <?php
    include './db.php';

    // Manejar la inserción de una nueva mesa
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add'])) {
            $num_mesa = $_POST['Num_mesa'];
            $estado = $_POST['Estado'];

            // Consulta para insertar una nueva mesa en la base de datos
            $sql = "INSERT INTO mesas_tb (Num_mesa, Estado, ID_Restaurante) VALUES ('$num_mesa', '$estado', '1')";

            if ($conn->query($sql) === TRUE) {
                echo "Nueva mesa agregada con éxito.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Redirigir para evitar reenvío de formulario
            header("Location: mesas_reservas.php");
            exit;
        }
    }

    // Consultar todas las mesas de la base de datos
    $query = "SELECT * FROM mesas_tb";
    $result = $conn->query($query);
    ?>



    <div>
        <h2 style="text-align: center;">Gestión de Mesas</h2>
        <button class="add-btn" onclick="openAddModal()" style="text-align: center; ">Agregar Nueva Mesa</button>
    </div>
    <div class="cards-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <h3>Mesa <?php echo $row['Num_Mesa']; ?></h3>
                <p>Estado: <?php echo $row['Estado'] ? 'Ocupada' : 'Disponible'; ?></p>
                <form method="post" action="">
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

    <!-- Modal para agregar/editar mesas -->
    <div class="modal" id="modal">
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

    <div class="modal" id="add-modal">
        <h3>Agregar Mesa</h3>
        <form method="post" action="">
            <label for="add-num-mesa">Número de Mesa:</label>
            <input type="number" name="Num_mesa" id="add-num-mesa" required>
            <label for="add-estado">Estado:</label>
            <select name="Estado" id="add-estado" required>
                <option value="0">Disponible</option>
                <option value="1">Ocupada</option>
            </select>
            <button type="submit" name="add">Agregar</button>
            <button type="button" class="close-btn" onclick="closeAddModal()">Cerrar</button>
        </form>
    </div>







    <br>
    <br>




    <div>
        <img src="https://www.abasturhub.com/img/blog/interiorismo-restaurantero---interiorismo-restaurantero.jpg" alt="" width="100%">
        <br>
        <br>

        <h2 style="text-align: center;">TicoGourmet Reservas</h2>


    </div>
    <br>
    <br>









    <div class="form-container button-form">
        <h2 style="text-align: center;">Reservas</h2>
        <form method="post" action="mesas_reservas.php" id="reservationForm" class="form-container">
            <input type="text" name="Username" placeholder="Nombre de usuario" required>
            <input type="date" name="Fecha" required>
            <select name="Cantidad_Asientos" required>
                <option value="" disabled selected>Cantidad de asientos</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="8">8</option>
                <option value="10">10</option>
            </select>
            <select name="ID_Mesa" required>
                <option value="" disabled selected>Selecciona una mesa</option>
                <!-- Las opciones para las mesas deben cargarse dinámicamente desde la base de datos -->
                <option value="1">Mesa 1</option>
                <option value="38">Mesa 2</option>
                <option value="40">Mesa 3</option>
                <!-- Agrega las demás mesas según los datos de la tabla "mesas_tb" -->
            </select>
            <button type="submit" class="button-form">Reservar</button>
        </form>
    </div>

    <?php
    include './db.php';

    // Verificar la conexión a la base de datos
    if (!$conn) {
        http_response_code(500);
        echo json_encode(['error' => 'Error de conexión a la base de datos.']);
        exit;
    }

    // Procesar el formulario al enviarse
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validar si los datos necesarios están presentes
        if (
            isset($_POST['Username']) && isset($_POST['ID_Mesa']) &&
            !empty($_POST['Username']) && !empty($_POST['ID_Mesa'])
        ) {

            // Obtener los datos del formulario
            $username = $_POST['Username']; // Nombre de usuario ingresado
            $fecha = $_POST['Fecha']; // Fecha seleccionada
            $cantidad_asientos = $_POST['Cantidad_Asientos']; // Cantidad de asientos
            $id_mesa = $_POST['ID_Mesa']; // ID de la mesa seleccionada

            // Obtener el ID de Usuario basado en el nombre de usuario
            $user_check_sql = "SELECT ID_Usuario FROM usuario_tb WHERE Username = '$username'";
            $user_check_result = $conn->query($user_check_sql);

            if ($user_check_result->num_rows === 0) {
                echo "Error: El nombre de usuario no existe.";
                $conn->close();
                exit;
            }

            $user_row = $user_check_result->fetch_assoc();
            $id_usuario = $user_row['ID_Usuario'];

            // Verificar que el ID de Mesa existe
            $mesa_check_sql = "SELECT ID_Mesa FROM mesas_tb WHERE ID_Mesa = '$id_mesa'";
            $mesa_check_result = $conn->query($mesa_check_sql);
            if ($mesa_check_result->num_rows === 0) {
                echo "Error: El ID de Mesa no existe.";
                $conn->close();
                exit;
            }

            // Insertar la reserva en la base de datos
            $sql = "INSERT INTO reserva_tb (ID_Usuario, Fecha, Cantidad_Asientos, ID_Mesa) 
                VALUES ('$id_usuario', '$fecha', '$cantidad_asientos', '$id_mesa')";

            if ($conn->query($sql) === TRUE) {
                echo "Reserva realizada con éxito.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Faltan datos en el formulario.";
        }
    }

    $conn->close();
    ?>










































    <!--***************************************-->

    <script src="../js/index.js"></script>

</body>

</html>