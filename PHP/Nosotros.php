<?php
include './Menu.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - Tico Gourmet</title>
    <link rel="stylesheet" href="../css/nosotros.css">
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

<main>

    <section class="about-us">
    <div class="container">
        <h2 class="section-title">¿Quiénes Somos?</h2>
        <div class="image-container">
                <img src="https://img.freepik.com/foto-gratis/camarero-feliz-sirviendo-comida-grupo-amigos-alegres-pub_637285-12525.jpg" alt="Imagen representativa de Tico Gourmet">
            </div>
        <p class="intro">
            Bienvenidos a Tico Gourmet, el corazón de la gastronomía costarricense en la web. Somos más que una simple plataforma de restaurantes; 
            somos un movimiento que celebra la diversidad y la riqueza culinaria de nuestra tierra. 
        </p>
        <div class="content-sections">
            <div class="section">
                <h3 class="section-subtitle">Nuestra Misión</h3>
                <p class="section-text">
                    En Tico Gourmet, creemos que cada plato cuenta una historia. Nuestra misión es conectar a los amantes de la buena comida 
                    con los sabores más auténticos de Costa Rica, ofreciendo una experiencia culinaria que combina tradición y modernidad.
                </p>
            </div>
            <div class="section">
                <h3 class="section-subtitle">Nuestra Visión</h3>
                <p class="section-text">
                    Queremos ser el puente que une a los comensales con los restaurantes que ponen el alma en cada receta. A medida que crecemos, 
                    aspiramos a convertirnos en la referencia principal para aquellos que buscan lo mejor de la gastronomía costarricense.
                </p>
            </div>
            <div class="section">
                <h3 class="section-subtitle">Nuestro Compromiso</h3>
                <p class="section-text">
                    Estamos comprometidos con la calidad, la autenticidad y la satisfacción de nuestros usuarios. Cada restaurante en Tico Gourmet 
                    ha sido seleccionado cuidadosamente para garantizar que cada visita sea una celebración de la cultura y el sabor costarricense.
                </p>
            </div>
        </div>
        <p class="closing">
            Disfruta de la variedad que encontrarás dentro de cada negocio. Buen provecho!
        </p>
    </div>
</section>

<footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h2>Sobre nosotros</h2>
                <p>Somos una empresa comprometida con el bienestar de la cultura culinaria, enfocándonos en el Sabor Tico y la cultura en cada platillo.</p>
            </div>
            <div class="footer-section links">
                <h2>Encuéntranos</h2>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Nosotros</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h2>Contáctanos</h2>
                <p><i class="fas fa-phone-alt"></i> +506 67489300</p>
                <p><i class="fas fa-map-marker-alt"></i> San José, Costa Rica, Aranjuez</p>
                <p><i class="fas fa-envelope"></i> TicoGourmet@gmail.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2024 TicoGourmet | Diseñado por Grupo# Ambiente Web 
        </div>
    </footer>

<script src="../js/index.js"></script>
</body>
</html>
