<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicoGourmet</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/contacts.css">
    <link rel="stylesheet" href="./js/contacts.js">


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
                    <li class="nav-item"><a href="#">NEWS</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">CONTACTS</a></li>
                    <li class="separator">|</li>
                    <li class="nav-item"><a href="#">PAGES</a></li>
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

    <div class="banner">
        <h1> Contacts </h1>
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>→</span>
            <span>Contacts</span>
        </div>
    </div>


    <div class="form-container">
    <h2>TicoGourmet</h2>
    <p>Estamos disponibles 24 horas al día, 7 días a la semana por fax, correo electrónico o teléfono. También puede utilizar nuestro formulario de contacto rápido para hacer una pregunta sobre los servicios que ofrecemos de forma regular. Estaremos encantados de responder a sus preguntas.</p>
    <form id="contactForm">
        <div class="form-group">
            <label for="firstName">Nombre</label>
            <input type="text" id="firstName" name="firstName" placeholder="Tu nombre">
            <div class="error" id="firstNameError"></div>
        </div>
        <div class="form-group">
            <label for="lastName">Apellidos</label>
            <input type="text" id="lastName" name="lastName" placeholder="Tus apellidos">
            <div class="error" id="lastNameError"></div>
        </div>
        <div class="form-group">
            <label for="message">Mensaje</label>
            <textarea id="message" name="message" rows="5" placeholder="Escribe tu mensaje aquí"></textarea>
            <div class="error" id="messageError"></div>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Escribe tu email aquí">
            <div class="error" id="emailError"></div>
        </div>
        <div class="form-group">
            <input type="submit" id="enviar" name = "Enviar">
        </div>
    </form>
</div>


<br>
<br>
<br>

<footer class="footer-container">
    <div class="footer-content">
        <div class="footer-section about">
            <h2>Sobre notrosos</h2>
            <p>Somo una empresa comprometida con el bienestar de la cultura culinaria, enfocandonos en el Sabor Tico y la cultura en cada platillo.</p>
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
        &copy; 2024 TicoGourmet | Deseñado por Grupo# Ambiente Web 
    </div>
</footer>





    
</body>
</html>
