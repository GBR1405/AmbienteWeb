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
            <button class="btn btn-primary" onclick="openReserveModal()">Reservar Mesa</button>
            <h2 class="menu-title">Menú</h2>
            <div class="search-bar">
                <input type="text" placeholder="Buscar producto...">
                <button>Buscar</button>

            </div>

            <div class="product-list" id="product-list">
                <!-- Los productos serán cargados aquí con JavaScript -->
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

    <div id="reserve-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reservar Mesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reserve-form">
                        <div class="form-group">
                            <label for="mesa-select">Selecciona una mesa:</label>
                            <select id="mesa-select" class="form-control">
                                <!-- Las mesas serán cargadas aquí con JavaScript -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="seats-select">Número de asientos:</label>
                            <select id="seats-select" class="form-control">
                                <!-- Opciones de 2 a 8 asientos -->
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reserve-date">Fecha:</label>
                            <input type="date" id="reserve-date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const restaurantId = urlParams.get('id');
        $(document).ready(function() {
            // Obtener el ID del restaurante desde la URL


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

        const commentForm = $('#comment-form');
        const commentText = $('#comment-text');
        const ratingStars = $('#star-rating .rating-star');
        let currentRating = 0;

        ratingStars.on('click', function() {
            const index = $(this).index() + 1;
            currentRating = index;
            ratingStars.removeClass('filled');
            ratingStars.slice(0, index).addClass('filled');
            $('#rating').val(currentRating);
        });

        // Función para manejar el envío del formulario
        commentForm.on('submit', function(e) {
            e.preventDefault();

            if (currentRating === 0 || commentText.val().trim() === '') {
                alert('Por favor, completa todos los campos.');
                return;
            }

            const formData = new FormData(commentForm[0]);
            formData.append('rating', currentRating);
            formData.append('id_restaurante', restaurantId);
            formData.append('comentario', commentText.val());

            $.ajax({
                url: '../PHP/comentarios.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        loadComments(); // Cargar los comentarios después de un nuevo comentario
                        commentForm[0].reset();
                        currentRating = 0;
                        ratingStars.removeClass('filled');
                    } else {
                        alert(data.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Función para cargar los comentarios
        function loadComments() {
            $.ajax({
                url: '../PHP/comentarios.php',
                method: 'GET',
                data: {
                    id_restaurante: restaurantId
                },
                success: function(response) {
                    const comments = JSON.parse(response);
                    $('#comment-list').empty();
                    comments.forEach(comment => {
                        $('#comment-list').append(`
                        <div class="comment-item">
                            <strong>${comment.Nombre}</strong>
                            <p>${comment.Comentario}</p>
                            <span>Rating: ${comment.Rating}</span>
                        </div>
                    `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error);
                    console.log(xhr.responseText);
                }
            });
        }

        loadComments();

        // Función para abrir el modal de reserva
        function openReserveModal() {
        $('#reserve-modal').modal('show');

        $.ajax({
            url: '../PHP/obtenerMesas.php',
            method: 'GET',
            dataType: 'json',
            data: { id: restaurantId }, // Enviar el ID del restaurante
            success: function(data) {
                if (data.error) {
                    console.error('Error del servidor:', data.error);
                    return;
                }

                if (Array.isArray(data.mesas)) {
                    const mesaSelect = $('#mesa-select');
                    mesaSelect.empty();
                    data.mesas.forEach(function(mesa) {
                        const option = $('<option>', {
                            value: mesa.id,
                            text: `Mesa ${mesa.numero} - Estado ${mesa.estado}`
                        });
                        mesaSelect.append(option);
                    });
                } else {
                    console.error('Error: Datos de mesas no disponibles.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX para obtener mesas:', textStatus, errorThrown);
            }
        });
    }

    $('#open-reserve-modal-btn').click(openReserveModal);
    </script>
</body>

</html>