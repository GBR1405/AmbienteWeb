document.addEventListener("DOMContentLoaded", function() {
    // Seleccionar los elementos necesarios
    const continueButton = document.querySelector(".btn.continue");
    const backButton = document.querySelector(".btn.back");
    const dishImage = document.querySelector(".dish-image");

    // Agregar eventos a los botones
    backButton.addEventListener("click", function() {
        window.location.href = 'menu.php';
    });
    
    continueButton.addEventListener("click", function() {
        window.location.href = 'carrito.php';
    });

    // Información de los platillos
    const dishes = [
        {
            name: "Crown Pizza",
            description: "¡El rey de las pizzas! Disfruta de nuestras pizzas artesanales con ingredientes frescos y sabores irresistibles. Cada bocado es una experiencia única que te hará volver por más. ¡Ven a probar la pizza que todos están hablando!",
            imageUrl: "https://cdn.prod.website-files.com/60bced77e8d8f042ff0d5210/60ca562014aded8acd53a33b_crown-pizza-min.png",
            price: "$20 USD"
        },
        {
            name: "Mushroom White Sauce Pizza",
            description: "La Mushroom White Sauce Pizza combina ingredientes frescos con nuestra cremosa salsa blanca y champiñones salteados sobre una masa artesanal perfectamente horneada.",
            imageUrl: "https://ouncesicecream.com/wp-content/uploads/2024/03/shop-9.png",
            price: "$22 USD"
        }
    ];

    let currentIndex = 0;

    function updateDishInfo(index) {
        const currentDish = dishes[index];
        document.querySelector(".description-box h2").textContent = currentDish.name;
        document.querySelector(".description-box p").textContent = currentDish.description;
        document.querySelector(".description-box p strong").nextSibling.textContent = currentDish.price;
        document.querySelector(".dish-image").src = currentDish.imageUrl;
    }

    // Cambiar la información del platillo al hacer clic en la imagen
    dishImage.addEventListener("click", function() {
        currentIndex = (currentIndex + 1) % dishes.length;
        updateDishInfo(currentIndex);
    });

    // Inicializar con la primera pizza
    updateDishInfo(currentIndex);
});
