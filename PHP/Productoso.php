<?php
include './Menu.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios - TicoGourmet</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/Pagusuario.css">
    <link rel="stylesheet" href="../css/styles.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/usuarios.js"></script>
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

    <main>
        <section class="product-details">
            <div class="product-image">
                <img src="https://via.placeholder.com/500x400" alt="Producto">
            </div>
            <div class="product-info">
                <h1>Nombre del Producto</h1>
                <p class="description">Descripción del producto. Aquí puedes incluir todos los detalles relevantes sobre el producto, como ingredientes, características, etc.</p>
                <p class="price">$19.99</p>
                <div class="reviews">
                    <h2>Comentarios</h2>
                    <div class="review">
                        <p><strong>Cliente 1:</strong> Excelente producto, muy sabroso!</p>
                    </div>
                    <div class="review">
                        <p><strong>Cliente 2:</strong> Muy buena calidad, pero el precio es un poco alto.</p>
                    </div>
                    <div class="review">
                        <p><strong>Cliente 3:</strong> Me encantó, lo volveré a comprar.</p>
                    </div>
                </div>
                <button class="order-button">Agregar al Carrito</button>
            </div>
        </section>
    </main>

    <footer class="footer-container">
        <div class="footer-content">
            <div class="footer-section about">
                <h2>Sobre nosotros</h2>
                <p>Comprometidos con el bienestar culinario y la cultura Tica en cada platillo.</p>
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
                <h2>Contáctanos</h2>
                <p><i class="fas fa-phone-alt"></i> +506 67489300</p>
                <p><i class="fas fa-map-marker-alt"></i> San Jose, Costa Rica, Aranjuez</p>
                <p><i class="fas fa-envelope"></i> TicoGourmet@gmail.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2024 TicoGourmet | Diseñado por Grupo# Ambiente Web
        </div>
    </footer>
</body>
</html>
