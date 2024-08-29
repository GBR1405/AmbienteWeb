<?php
include './menu.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Restaurante</title>
    <link rel="stylesheet" href="../css/InfoRestaurante.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/MenuRest.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/InfoRestUser.js"></script> <!-- Incluye tu archivo JS -->
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

    <section class="restaurant-details">
        <div class="banner">
            <img src="https://images.alphacoders.com/511/51161.jpg" alt="Banner del Restaurante">
        </div>
        <div class="info">
            <div class="icon">
                <img src="https://i.ibb.co/ScSzN9d/imagen.png" alt="Icono del Restaurante">
            </div>
            <div class="text">
                <h1 id="nombre_usuario"></h1>
                <p id="direccion"></p>
                <p id="especializacion"></p>
                <p id="pais"></p>
            </div>
        </div>
        <div class="menu-section">
            <h2 class="menu-title">Menú</h2>
            <div class="search-bar">
                <input type="text" placeholder="Buscar producto...">
                <button>Buscar</button>
            </div>
            <div class="product-list" id="product-list">
                <!-- Los productos serán cargados aquí con JavaScript -->
            </div>
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
    </footer>

    <script>
        $(document).ready(function() {
            // Obtener el ID del restaurante desde la URL
            const urlParams = new URLSearchParams(window.location.search);
            const restaurantId = urlParams.get('id');

            if (!restaurantId) {
                console.error('Error: ID del restaurante no proporcionado.');
                return;
            }

            // Llamada AJAX para obtener la información del restaurante
            $.ajax({
                url: '../PHP/InfoRestUserHTML.php',
                method: 'GET',
                data: {
                    id: restaurantId
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data); // Añadido para depuración
                    if (data.error) {
                        console.error('Error:', data.error);
                        return;
                    }
                    if (data.Username) {
                        $('#nombre_usuario').text(data.Username);
                        $('#direccion').text(data.Direccion);
                        $('#especializacion').text(data.Especializacion);
                        $('#pais').text(data.Pais);
                    } else {
                        console.error('Error: Datos del restaurante no disponibles.');
                    }

                    if (Array.isArray(data.platillos)) {
                        const productList = $('#product-list');
                        productList.empty();
                        data.platillos.forEach(function(platillo) {
                            const div = $('<div>', {
                                class: 'product-item'
                            });
                            div.html(`
                        <img src="${platillo.Imagen}" alt="${platillo.Nombre}" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.onerror=null; this.src='https://img.freepik.com/vector-gratis/dibujado-mano-dia-mundial-alimentacion_23-2148631852.jpg?size=338&ext=jpg&ga=GA1.1.2008272138.1724803200&semt=ais_hybrid';">
                        <div class="product-info">
                            <h3>${platillo.Nombre}</h3>
                            <p class="price">$${platillo.Precio.toFixed(2)}</p>
                            <p class="description">${platillo.Descripcion}</p>
                        </div>
                        <button class="edit-dish btn btn-warning" data-id="${platillo.ID_Platillo}">Añadir al carrito</button>
                    `);
                            productList.append(div);
                        });

                        // Maneja el clic en el botón "Añadir al carrito"
                        $('.edit-dish').click(function() {
                            const platilloId = $(this).data('id');
                            $.ajax({
                                url: '../PHP/AgregarCarrito.php',
                                method: 'POST',
                                data: {
                                    platillo_id: platilloId
                                },
                                dataType: 'json',
                                success: function(response) {
                                    try {
                                        if (response.success) {
                                            alert('Platillo añadido al carrito.');
                                        } else {
                                            alert('Error al añadir el platillo al carrito: ' + response.error);
                                        }
                                    } catch (e) {
                                        console.error('Error al analizar la respuesta JSON:', e);
                                        alert('Error inesperado.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error en la llamada AJAX:', error);
                                    alert('Error en la llamada AJAX.');
                                }
                            });
                        });
                    } else {
                        console.error('Error: No se pudieron cargar los platillos.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la llamada AJAX:', error);
                }
            });
        });
    </script>
</body>

</html>