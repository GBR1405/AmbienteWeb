<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet - Menu</title>
    <link rel="stylesheet" href="./css/menu.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h1>TicoGourmet</h1>
            </div>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="index.php">INICIO</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="menu.php">MENU</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">CONTACTO</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">RESERVAS</a></li>
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
    <main class="main-content">
        <div class="menu-container" id="menu-container">
            <!-- Las cajas de los restaurantes se cargarán aquí mediante JavaScript -->
        </div>
    </main>
    <script src="./js/menu.js"></script>
</body>
</html>
