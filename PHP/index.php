<?php
include './Menu.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header class="main-header">
        <div class="main-container">
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
    </header>

    <section class="main-food-search">
        <div class="food-search-container">
            <h2><span class="orange-text">Bienvenido</span> al mundo de sabor donde podrás pedir y llevar donde sea aquel sabor que tanto te gusta</h2>
            <p>Somos una aplicación nacional, nuestra misión es ayudar a todos los que quieran digitalizarse</p>
            <button class="order-button">Ordenar acá</button>
        </div>
    </section>

    <section class="main-categories-section">
        <h2 class="categories-title">Las categorías que tenemos</h2>
        <div class="main-carousel-container">
            <div class="main-carousel">
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
            <button class="carousel-button left">&lt;</button>
            <button class="carousel-button right">&gt;</button>
        </div>
    </section>

    <section class="main-map">
        <div class="map-container">
            <h2>Encuéntranos</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.760823167334!2d-84.05738208494214!3d9.937365792896364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0cfc02e6341f3%3A0xe7a9d8f91e64a785!2sPlaza%20Real%20Alajuela!5e0!3m2!1sen!2scr!4v1672942877345!5m2!1sen!2scr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h2>Acerca de TicoGourmet</h2>
                <p>Somos una empresa dedicada a ofrecer los mejores sabores de Costa Rica a tu hogar.</p>
            </div>
            <div class="footer-section">
                <h2>Contáctanos</h2>
                <p>Correo: info@ticogourmet.com</p>
                <p>Teléfono: +506 8888 8888</p>
            </div>
            <div class="footer-section">
                <h2>Síguenos</h2>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Twitter</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 TicoGourmet. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
