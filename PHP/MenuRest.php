<?php include './Menu.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet</title>
    <link rel="stylesheet" href="../css/InfoRestaurante.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../css/MenuRest.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/menu.js"></script> <!-- Actualizado para usar el nuevo nombre del archivo JS -->
    <link rel="stylesheet" href="../css/MenuRest.css">
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

    <main>

        <div class="banner">
            <img src="https://static.vecteezy.com/system/resources/previews/021/428/962/non_2x/background-junk-food-related-seamless-pattern-and-background-editable-stroke-fast-food-line-art-of-hamburger-pizza-hot-dog-beverage-cheeseburger-restaurant-menu-background-free-vector.jpg" alt="Banner del Restaurante">
        </div>

        <section class="restaurants-section">
            <div class="container">
                <h1>Todos los Restaurantes</h1>
            </div>

            <div class="container">
                <div class="cards-container">
                    <!-- Las cartas se llenarán aquí mediante JavaScript -->
                </div>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <!-- Aquí va el contenido del pie de página -->
    </footer>
    
    <link rel="stylesheet" href="../css/MenuRest.css">
</body>

</html>