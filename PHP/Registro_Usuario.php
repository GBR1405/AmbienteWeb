<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link rel="stylesheet" href="../css/Registro_Usuario.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/Registro.js"></script>
</head>

<body>
    <div class="wrapper">
        <form id="registrationForm" action="register.php" method="post">
            <h2 style="text-align: center;">Registro<i class='bx bx-bowl-hot'></i></h2>

            <div class="input-row">
                <div class="input-box">
                    <input type="text" placeholder="Username" id="username" name="username">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Contraseña" id="password" name="password">
                    <i class='bx bxs-lock-alt'></i>
                </div>
            </div>

            <div class="input-row">
                <div class="input-box">
                    <input type="text" placeholder="Nombre" id="nombre" name="nombre">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Apellido" id="apellido" name="apellido">
                    <i class='bx bxs-user'></i>
                </div>
            </div>

            <div class="input-box">
                <input type="text" placeholder="Email" id="email" name="email">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="text" placeholder="Teléfono" id="telefono" name="telefono">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <select id="genero" name="genero">
                    <!-- Options will be loaded here -->
                </select>
                <i class='bx bxs-user'></i>
            </div>

            <button type="button" id="registerButton" class="btn">Registrate</button>
            <div class="register-link">
                <p><a href="./inicio_sesion.php">¿Ya tienes cuenta? Inicia Sesión</a></p>
            </div>
            <hr>
            <div class="register-link">
                <p><a href="./index.php">Regresar a la Página Principal</a></p>
            </div>
        </form>
    </div>
</body>

</html>
