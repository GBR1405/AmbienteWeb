<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/inicio_sesion.css">
    <link rel="stylesheet" href="./css/inicio_sesion.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
   <div class="wrapper">
    <form action="">
        <h2 style="text-align: center;">TicoGourmet<i class='bx bx-bowl-hot'></i></h2>
        
        <div class="input-box">
            <input type="text" placeholder="Username" id="username">
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Contraseña" id="password">
            <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="remember-forget">
            <label>
                <input type="checkbox">
                Recuérdame</label>
                <a href="#">Olvidé mi contraseña</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="register-link">
            <p><a href="#">Regístrate</a></p>
        </div>
    </form>

   </div> 

</body>
</html>