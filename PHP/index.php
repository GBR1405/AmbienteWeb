<?php
include './Menu.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet</title>
    <link rel="stylesheet" href="../css/Header.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/usuarios.js"></script>
</head>
<body>
<header class="main-header">
        <div class="main-container">
            <div class="main-content">
                <div class="logo">
                    <h1><a href="./index.php" class="logo-link">TicoGourmet 🍔</a></h1>
                </div>
                <nav class="main-nav">
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
        </div>
    </header>

    <section class="food-search">
        <div class="food-search-container">
            <h2><span class="orange-text">Bienvenido</span> al mundo de sabor donde podrás pedir y llevar donde sea aquel sabor que tanto te gusta</h2>
            <p>Somos una aplicación nacional, nuestra misión es ayudar a todos los que quieran digitalizarse</p>
            <button class="order-button">Ordenar acá</button>
        </div>
    </section>

    <section class="categories-section">
        <h2 class="categories-title">Las categorías que tenemos</h2>
        <div class="categories-carousel-container">
            <div class="categories-carousel">
                <div class="carousel-track">
                    <div class="card">
                        <img src="https://static.vecteezy.com/system/resources/thumbnails/025/076/438/small/pizza-isolated-illustration-ai-generative-png.png" alt="Pizza">
                        <p>Pizza</p>
                    </div>
                    <div class="card">
                        <img src="https://images.vexels.com/media/users/3/137056/isolated/preview/1229f311106f8e5fe7bf368c8a42ca4f-insignia-de-etiqueta-de-ecologia-vegana.png" alt="Natural">
                        <p>Vegano</p>
                    </div>
                    <div class="card">
                        <img src="https://static.vecteezy.com/system/resources/thumbnails/021/665/613/small_2x/beef-burger-isolated-png.png" alt="Hamburguesa">
                        <p>Hamburguesa</p>
                    </div>
                    <div class="card">
                        <img src="https://images.vexels.com/media/users/3/136309/isolated/preview/c6539229ad5c57c313d95711a1e676db-logo-hamburguesa-comida-rapida.png?w=360" alt="Comida Rápida">
                        <p>Comida Rápida</p>
                    </div>
                    <div class="card">
                        <img src="https://www.zomerafoods.com/wp-content/uploads/2022/09/Group-27.png" alt="Comida Típica">
                        <p>Comida Típica</p>
                    </div>
                    <div class="card">
                        <img src="https://cdn-icons-png.flaticon.com/512/1689/1689219.png" alt="Bebidas">
                        <p>Bebidas</p>
                    </div>
                    <div class="card">
                        <img src="https://images.vexels.com/media/users/3/293611/isolated/preview/05031444d08fa7d4501fa5c763c256c2-tres-piezas-de-pollo-frito-brillante.png" alt="Pollo">
                        <p>Pollo</p>
                    </div>
                    <div class="card">
                        <img src="https://cdn-icons-png.flaticon.com/512/7649/7649300.png" alt="Ensaladas">
                        <p>Ensaladas</p>
                    </div>
                    <div class="card">
                        <img src="https://www.pngall.com/wp-content/uploads/2018/04/Soup-Free-Download-PNG.png" alt="Sopas">
                        <p>Sopas</p>
                    </div>
                    <div class="card">
                        <img src="https://cdn3d.iconscout.com/3d/premium/thumb/tamago-sushi-6339305-5221208.png?f=webp" alt="Asiatico">
                        <p>Asiático</p>
                    </div>
                    <div class="card">
                        <img src="https://images.vexels.com/content/199351/preview/falafel-salad-arabic-food-illustration-9927d1.png" alt="Bowls">
                        <p>Bowls</p>
                    </div>
                </div>
            </div>
            <button class="carousel-button left" onclick="scrollCarousel(-1)">❮</button>
            <button class="carousel-button right" onclick="scrollCarousel(1)">❯</button>
        </div>
    </section>

    <section class="map">
        <div class="map-container">
            <h2>Ubicación</h2>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.0238858771854!2d-84.10136372430294!3d9.931968574200308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0e3530716003f%3A0xad3da4eeb0d286bb!2sTORRE%20UNIVERSAL%20%7C%20Sabana!5e0!3m2!1ses-419!2scr!4v1721373239689!5m2!1ses-419!2scr" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </section>
    
    <footer class="footer-container">
        <div class="footer-content">
            <div class="footer-section about">
                <h2>Sobre nosotros</h2>
                <p>Somos una empresa comprometida con el bienestar de la cultura culinaria, enfocándonos en el Sabor Tico y la cultura en cada platillo.</p>
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
            &copy; 2024 TicoGourmet | Diseñado por Grupo# Ambiente Web 
        </div>
    </footer>


    <script src="../js/index.js"></script>
    <link rel="stylesheet" href="../css/Header.css">
</body>
</html>
