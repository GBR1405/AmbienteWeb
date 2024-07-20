<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info del Platillo</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/info.css">
    <script src="./js/info.js" defer></script>
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
                    <li class="nav-item"><a href="menu.php">MENÚ</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">CONTACTO</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">RESERVAS</a></li>
                </ul>
            </nav>
            <div class="right-section">
                <div class="cart">
                    <a href="carrito.php"><img src="https://cdn.icon-icons.com/icons2/906/PNG/512/shopping-cart_icon-icons.com_69913.png" alt="Carrito" class="cart-icon"></a>
                </div>
                <div class="login">
                    <button class="login-button">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Segundo Header con navegación específica -->
    <header class="sub-header">
        <nav class="sub-nav">
            <ul class="sub-nav-list">
                <li class="sub-nav-item"><a href="menu.php">Menú</a></li>
                <li class="separator">|</li>
                <li class="sub-nav-item"><a href="info.php" class="active">Info Platillo</a></li>
                <li class="separator">|</li>
                <li class="sub-nav-item"><a href="carrito.php">Método Pago</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <div class="info-container">
            <div class="info-box">
                <img src="https://emarsys.com/app/uploads/2022/05/PizzaHut-header-2280x900px.jpg" alt="Imagen del Platillo" class="dish-image">
            </div>
            <div class="info-box description-box">
                <h2>Nombre del Platillo</h2>
                <p>Descripción del platillo</p>
                <p><strong>Precio:</strong> $20 USD</p>
            </div>
        </div>
        <div class="info-buttons">
            <button class="btn back">Regresar</button>
            <button class="btn continue">Continuar</button>
        </div>
    </main>
</body>
</html>
