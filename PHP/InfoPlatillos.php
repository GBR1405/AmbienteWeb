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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/InfoRestuante.js"></script>
    <script src="../js/Platillo.js"></script>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h1><a href="./index.php" class="logo-link">TicoGourmet 🍔 . </a></h1>
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
            <img src="https://images.alphacoders.com/511/51161.jpg" alt="Banner del Restaurante">
        </div>
        <div class="info">
            <div class="icon">
                <img src="https://i.ibb.co/ScSzN9d/imagen.png" alt="Icono del Restaurante">
            </div>
            <div class="text">
                <!-- El nombre del usuario se cargará aquí mediante JavaScript -->
                <h1 id="nombre_usuario"></h1>
                <div class="rating">
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
        </div>
        <div class="menu-section">
            <button id="add-dish-btn" class="btn btn-primary btn-block" style="background-color: orange; color: white; border: none; margin-top: 20px; margin-bottom: px;">Agregar Platillo</button>
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

    <!-- Modal para agregar platillo -->
    <!-- Modal para agregar platillo -->
    <div class="modal fade" id="addDishModal" tabindex="-1" role="dialog" aria-labelledby="addDishModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDishModalLabel">Agregar Nuevo Platillo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addDishForm">
                        <div class="form-group">
                            <label for="dishName">Nombre</label>
                            <input type="text" class="form-control" id="dishName" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="dishDescription">Descripción</label>
                            <textarea class="form-control" id="dishDescription" name="descripcion" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="dishCategory">Categoría</label>
                            <select class="form-control" id="dishCategory" name="categoria" required>
                                <!-- Las opciones se cargarán dinámicamente -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dishPrice">Precio</label>
                            <input type="number" class="form-control" id="dishPrice" name="precio" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="dishImage">URL de Imagen</label>
                            <input type="url" class="form-control" id="dishImage" name="imagen" required>
                        </div>
                        <input type="hidden" id="restaurantId" name="id_restaurante">
                        <button type="submit" class="btn btn-primary">Agregar Platillo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Platillo -->
    <!-- Modal para editar platillo -->
<div class="modal fade" id="editDishModal" tabindex="-1" aria-labelledby="editDishModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDishModalLabel">Editar Platillo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editDishForm">
          <input type="hidden" id="editDishId" name="id">
          <div class="mb-3">
            <label for="editDishName" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="editDishName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="editDishPrice" class="form-label">Precio</label>
            <input type="number" class="form-control" id="editDishPrice" name="price" step="0.01" required>
          </div>
          <div class="mb-3">
            <label for="editDishDescription" class="form-label">Descripción</label>
            <textarea class="form-control" id="editDishDescription" name="description" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="editDishCategory" class="form-label">Categoría</label>
            <select class="form-select" id="editDishCategory" name="category" required>
              <!-- Opciones de categoría se cargarán dinámicamente -->
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>




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
            // Cargar datos del usuario y los platillos
            $.ajax({
                url: '../PHP/get_user_data.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.Username) {
                        $('#nombre_usuario').text(data.Username);
                    } else {
                        console.error('Error: Nombre de usuario no disponible.');
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
    <button class="edit-dish btn btn-secondary" data-id="${platillo.ID_Platillo}">Editar</button>
`);

                            productList.append(div);
                        });
                    } else {
                        console.error('Error: Datos de platillos no válidos o vacíos.');
                    }

                    // Carga de categorías en el modal
                    $.ajax({
                        url: '../PHP/get_categories.php',
                        method: 'GET',
                        dataType: 'json',
                        success: function(categories) {
                            const categorySelect = $('#dishCategory');
                            categorySelect.empty();
                            if (Array.isArray(categories)) {
                                categories.forEach(function(categoria) {
                                    categorySelect.append(new Option(categoria.Categoria, categoria.ID_Categoria));
                                });
                            } else {
                                console.error('Error: Datos de categorías no válidos o vacíos.');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error al cargar las categorías:', textStatus, errorThrown);
                        }
                    });

                    if (data.ID_Restaurante) {
                        $('#restaurantId').val(data.ID_Restaurante);
                    } else {
                        console.error('Error: ID del restaurante no disponible.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error al cargar los datos:', textStatus, errorThrown);
                    console.error('Respuesta del servidor:', jqXHR.responseText);
                }
            });

            // Manejar clic en el botón para agregar platillo
            $('#add-dish-btn').click(function() {
                $('#addDishModal').modal('show');
            });

            $('#product-list').on('click', '.edit-dish', function() {
                const dishId = $(this).data('id');

                // Llamada AJAX para obtener los datos del platillo desde `platillo_tb`
                $.ajax({
                    url: '../PHP/get_dish.php', // Asegúrate de que este archivo PHP esté configurado para acceder a `platillo_tb`
                    method: 'GET',
                    data: {
                        id: dishId
                    },
                    dataType: 'json',
                    success: function(platillo) {
                        console.log('Datos del platillo:', platillo);

                        if (platillo && platillo.ID_Platillo) {
                            // Rellenar el modal con los datos del platillo
                            $('#editDishId').val(platillo.ID_Platillo); // Este campo está oculto
                            $('#editDishName').val(platillo.Nombre);
                            $('#editDishPrice').val(platillo.Precio);
                            $('#editDishDescription').val(platillo.Descripcion);

                            // Cargar la categoría en el select list
                            $('#editDishCategory').val(platillo.ID_Categoria);

                            // Mostrar el modal
                            $('#editDishModal').modal('show');
                        } else {
                            console.error('Error: Platillo no encontrado o datos incompletos.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error al obtener los datos del platillo:', textStatus, errorThrown);
                        console.error('Respuesta del servidor:', jqXHR.responseText);
                    }
                });
            });

            // Manejador para guardar cambios del platillo
            $('#editDishForm').submit(function(e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: '../PHP/update_dish.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log('Respuesta del servidor:', response);
                        alert('Platillo actualizado exitosamente');
                        $('#editDishModal').modal('hide');
                        location.reload(); // Recargar la página para mostrar los cambios
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error al actualizar el platillo:', textStatus, errorThrown);
                        alert('Error al actualizar el platillo. Por favor, intente nuevamente.');
                    }
                });
            });
        });
    </script>
</body>

</html>