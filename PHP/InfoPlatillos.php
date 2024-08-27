<?php
include './Menu.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet</title>
    <link rel="stylesheet" href="../css/InfoRestaurante.css">
    
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h1><a href="./index.php" class="logo-link">TicoGourmet 🍔</a></h1>
            </div>
            <nav class="nav">
                <ul class="nav-list">
                    <?php
                    $menu = getMenu();
                    foreach ($menu as $item) {
                        echo '<li class="nav-item"><a href="' . $item["url"] . '">' . $item["name"] . '</a></li>';
                        echo '<li class="separator">|</li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <section class="restaurant-details">
        <div class="banner">
            <img src="https://tb-static.uber.com/prod/image-proc/processed_images/3c4a80de3341abac77572cf57cd96735/fb86662148be855d931b37d6c1e5fcbe.jpeg" alt="Banner del Restaurante">
        </div>
        <div class="info">
            <div class="icon">
                <img src="https://cdn-icons-png.flaticon.com/512/1046/1046791.png" alt="Icono del Restaurante">
            </div>
            <div class="text">
                <h1>Tico Asia</h1>
                <p class="location">WWPJ+WQ2, San José, Aranjuez, 10101, por el calderon guardia, torre este, a la par de la fotocopiadora</p>
                <div class="rating">
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
        </div>
        <div class="menu-section">
            <h2 class="menu-title">Menu</h2>
            <div class="search-bar">
                <input type="text" placeholder="Buscar producto...">
                <button>Buscar</button>
            </div>
            <div class="product-list">
                <div class="product-item">
                    <img src="https://www.laespanolaaceites.com/wp-content/uploads/2019/06/fajitas-de-pollo.jpg" alt="Producto">
                    <div class="product-info">
                        <h3>Fajitas de pollo</h3>
                        <p class="price">$23.00</p>
                        <p class="description">Fajitas en sarte con vegetales, papas o arroz y fresco a elegir</p>
                    </div>
                    <button class="add-to-cart">Agregar al carrito</button>
                </div>
                <div class="product-item">
                    <img src="https://via.placeholder.com/100x100" alt="Producto">
                    <div class="product-info">
                        <h3>Nombre del Producto</h3>
                        <p class="price">$10.00</p>
                        <p class="description">Descripción del producto</p>
                    </div>
                    <button class="add-to-cart">Agregar al carrito</button>
                </div>
                <div class="product-item">
                    <img src="https://via.placeholder.com/100x100" alt="Producto">
                    <div class="product-info">
                        <h3>Nombre del Producto</h3>
                        <p class="price">$10.00</p>
                        <p class="description">Descripción del producto</p>
                    </div>
                    <button class="add-to-cart">Agregar al carrito</button>
                </div>
                <div class="product-item">
                    <img src="https://via.placeholder.com/100x100" alt="Producto">
                    <div class="product-info">
                        <h3>Nombre del Producto</h3>
                        <p class="price">$10.00</p>
                        <p class="description">Descripción del producto</p>
                    </div>
                    <button class="add-to-cart">Agregar al carrito</button>
                </div>
                <div class="product-item">
                    <img src="https://via.placeholder.com/100x100" alt="Producto">
                    <div class="product-info">
                        <h3>Nombre del Producto</h3>
                        <p class="price">$10.00</p>
                        <p class="description">Descripción del producto</p>
                    </div>
                    <button class="add-to-cart">Agregar al carrito</button>
                </div>
                <!-- Añade más productos según sea necesario -->
            </div>
        </div>
    </section>
    

    <footer class="footer-container">
        <div class="footer-content">
            <div class="footer-section about">
                <h2>Sobre notrosos</h2>
                <p>Somo una empresa comprometida con el bienestar de la cultura culinaria, enfocandonos en el Sabor Tico y la cultura en cada platillo.</p>
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


    <script src="./js/index.js"></script>
</body>
</html>
