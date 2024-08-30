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
    <link rel="stylesheet" href="../css/comentarios.css">
    <script src="../js/comentarios.js"></script>

</head>

<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h1><a href="./index.php" class="logo-link">TicoGourmet 🍔</a></h1>
            </div>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="./MenuRest.php">MENU</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="contacto.php">CONTACTO</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="nosotros.php">NOSOTROS</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="reservas.php">RESERVAS</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="cart.php">CARRITO</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="historial.php">HISTORIAL</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="./salir.php">SALIR</a></li>
                    <li class="separator">|</li>
                </ul>
            </nav>
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
        <div class="comments-section">
        <h2>Deja tu comentario</h2>
            <form id="comment-form">
        <div id="star-rating">
            <span class="rating-star">&#9733;</span>
            <span class="rating-star">&#9733;</span>
            <span class="rating-star">&#9733;</span>
            <span class="rating-star">&#9733;</span>
            <span class="rating-star">&#9733;</span>
        </div>
        <textarea id="comment-text" placeholder="Escribe tu comentario aquí..."></textarea>
        <input type="hidden" id="rating" name="rating" value="0">
        <button type="submit">Enviar Comentario</button>
    </form>

        <div id="comment-list"></div>
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