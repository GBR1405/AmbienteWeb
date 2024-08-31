<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/inicio_sesion.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/Inicio.js"></script>
</head>
<body>
   <div class="wrapper">
        <form id="loginForm">
            <h2 style="text-align: center;">TicoGourmet<i class='bx bx-bowl-hot'></i></h2>
            
            <div class="input-box">
                <input type="text" placeholder="Username" id="username" name="username" require = "true">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Contraseña" id="password" name="password" require = "true">
                <i class='bx bxs-lock-alt'></i>
            </div>
           
            <button type="button" id="loginButton" class="btn">Inicia Sesión</button>
            <div class="register-link">
                <p><a href="./Registro_Usuario.php">Regístrate</a></p>
            </div>
            <hr>
            <div class="register-link">
                <p><a href="./index.php">Regresar a la Página Principal</a></p>
            </div>
        </form>
   </div> 
</body>
</html>
