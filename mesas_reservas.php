<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/mesas_reservas.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h1>TicoGourmet</h1>
            </div>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="#">MENU</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="contacts.php">CONTACTO</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="mesas_reservas.php">RESERVAS</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">NOSOTROS</a></li>
                </ul>
            </nav>
            <div class="right-section">
                <div class="cart">
                    <a href="#"><img src="https://cdn.icon-icons.com/icons2/906/PNG/512/shopping-cart_icon-icons.com_69913.png" alt="Cart" class="cart-icon"></a>
                </div>
                <div class="login">
                    <button class="login-button">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </header>


    <div class="main-container">
        <div class="reservation-form-container">
            <h2 style="text-align: center; color: white;">Reservas</h2>
            <form id="reservationForm">
                <input type="text" placeholder="Nombre" required>
                <input type="text" placeholder="Apellido" required>
                <input type="tel" placeholder="Número de Teléfono" required>
                <input type="date" required>
                <select required>
                    <option value="" disabled selected>Selecciona una Mesa</option>
                    <option value="Mesa 1">Mesa 1</option>
                    <option value="Mesa 2">Mesa 2</option>
                    <option value="Mesa 3">Mesa 3</option>
                </select>
                <button type="submit">Reservar</button>
            </form>
            <br>
            
            <div class="reservation-list">
                <h3 style="text-align: center; color: white;">Tus Reservas</h3>
                <!-- Reservas hechas serán añadidas aquí -->
                <div class="reservation-list-item">
                    <span>Mesa 1 - 2024-08-30</span>
                    <span>
                        <button>Editar</button>
                        <button>Eliminar</button>
                    </span>
                </div>
            </div>
        </div>

        <div class="image-description-container">
            <img src="https://example.com/your-image.jpg" alt="Descripción de Imagen">
            <p>Esta es una breve descripción de la imagen que ilustra las experiencias gastronómicas que ofrecemos en TicoGourmet.</p>
        </div>
    </div>


</body>
</html>