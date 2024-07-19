<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/agregar_product.css">
    <script src="./js/agregar_product.js" defer></script>


</head>
<div>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h1>TicoGourmet</h1>
            </div>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="#">MENU</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">NEWS</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">CONTACTS</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">PAGES</a></li>
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


    <main>
    <div class="form-container">
        <section class="product-form">
            <h2>Agregar Producto</h2>
            <form id="productForm">
                <label for="productName">Nombre del Producto:</label>
                <input type="text" id="productName" required>
                
                <label for="productPrice">Precio:</label>
                <input type="number" id="productPrice" required>
                
                <label for="productDescription">Descripción:</label>
                <textarea id="productDescription" required></textarea>
                
                <button type="submit">Agregar</button>
            </form>
        </section>

        <section class="product-list">
            <h2>Lista de Productos</h2>
            <ul id="productList"></ul>
        </section>
    </main>
</div>





    <br>
<br>

<footer class="footer-container">
    <div class="footer-content">
        <div class="footer-section about">
            <h2>Sobre notrosos</h2>
            <p>Somos una empresa comprometida con el bienestar de la cultura culinaria, enfocandonos en el Sabor Tico y la cultura en cada platillo.</p>
        </div>
        <div class="footer-section links">
            <h2>Encuentra</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Nosotros</a></li>
            </ul>
        </div>
        <div class="footer-section contact">
            <h2>Contact Us</h2>
            <p><i class="fas fa-phone-alt"></i> +506 67489300</p>
            <p><i class="fas fa-map-marker-alt"></i> San Jose, Costa Rica, Aranjuez</p>
            <p><i class="fas fa-envelope"></i> TicoGourmet@gmail.com</p>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2024 TicoGourmet | Deseñado por Grupo# Ambiente Web 
    </div>
</footer>

    
</body>
</html>
