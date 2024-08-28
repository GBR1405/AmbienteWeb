<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/iniciosesion_registro.css">
    <script src="./js/iniciosesion_registro.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>InicioSesion_Registro</title>
</head>
<body>

<div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Crear Cuenta</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i 
                    class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i 
                    class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i 
                    class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i 
                    class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>o usa tu username para registrarte</span>
                <input type="text" placeholder="Nombre completo">
                <input type="username" placeholder="Username">
                <input type="password" placeholder="Contraseña">
                <button>Registrarme</button>
            </form>
        </div>



        <div class="form-container sign-in">
            <form>
                <h1>Inicia Sesión</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i 
                    class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i 
                    class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i 
                    class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i 
                    class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>o usa tu username y contraseña</span>
                <input type="username" placeholder="Username">
                <input type="password" placeholder="Contraseña">
                <a href="#">Olvidé mi contraseña</a>
                <button>Iniciar Sesión</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                <h1>¡Bienvenido(a) a TicoGourmet!</h1>
                    <p>Ingresa tu información personal para 
                        utilizar todo de la página de TicoGourmet</p>
                    
                        <button class="hidden" id="login">Iniciar Sesión</button>
                </div>


                <div class="toggle-panel toggle-right">
                <h1>¡Hola de nuevo!</h1>
                    <p>Ingresa tus datos ya registrados para entrar a TicoGourmet
                         </p>
                        <button class="hidden" id="register">Registrarme</button>
                </div>
            </div>
        </div>

    </div>


    <script src="./js/iniciosesion_registro.js"> </script>    
</body>
</html>