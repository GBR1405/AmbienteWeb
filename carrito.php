<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet - Carrito de Compras</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/carrito.css">
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
                <li class="sub-nav-item"><a href="info.php">Info Platillo</a></li>
                <li class="separator">|</li>
                <li class="sub-nav-item"><a href="carrito.php">Método Pago</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <div class="cart-container">
            <h1>Carrito de Compras</h1>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <!-- Los productos se cargarán aquí dinámicamente -->
                </tbody>
            </table>
            <div class="cart-actions">
                <button id="continue-shopping">Continuar Comprando</button>
                <div class="total-container">
                    <span>Total: <span id="total-amount">$0 USD</span></span>
                </div>
                <button id="proceed-payment">Proceder al Pago</button>
            </div>
        </div>
    </main>

    <script src="./js/carrito.js"></script>
</body>
</html>