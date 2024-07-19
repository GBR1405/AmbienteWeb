document.addEventListener("DOMContentLoaded", function() {
    const restaurants = [
        {
            title: "Pizza Hut",
            imageUrl: "https://1000logos.net/wp-content/uploads/2017/05/Pizza-Hut-Logo-1999.jpg"
        },
        {
            title: "McDonald's",
            imageUrl: "https://static.vecteezy.com/system/resources/previews/020/190/455/original/mcdonalds-logo-mcdonald-icon-free-free-vector.jpg"
        },
        {
            title: "Taco Bell",
            imageUrl: "https://brandemia.org/sites/default/files/inline/images/taco_bell_logo.jpg"
        },
        {
            title: "Subway",
            imageUrl: "https://d3faj0w6aqatyx.cloudfront.net/uploads/2016/08/09165704/new-subway%C2%AE-retaurants-logo-5-HR.jpg"
        },
        {
            title: "KFC",
            imageUrl: "https://media-cdn.tripadvisor.com/media/photo-s/26/c8/30/69/kfc-logo.jpg"
        },
        {
            title: "Burger King",
            imageUrl: "https://cdn.prod.website-files.com/5ee732bebd9839b494ff27cd/5ef0a3d4299cb9f4f7ea67c4_Burger-King-Logo.png"
        },
        {
            title: "TicoAsia",
            imageUrl: "https://tb-static.uber.com/prod/image-proc/processed_images/3c4a80de3341abac77572cf57cd96735/fb86662148be855d931b37d6c1e5fcbe.jpeg"
        },
        {
            title: "Spoon",
            imageUrl: "https://tofuu.getjusto.com/orioneat-local/resized2/MDxyYFd4ptQpzZ2sw-200-x.webp"
        }
    ];

    const menuContainer = document.getElementById("menu-container");

    restaurants.forEach(restaurant => {
        const restaurantBox = document.createElement("div");
        restaurantBox.className = "restaurant-box";

        const restaurantImage = document.createElement("img");
        restaurantImage.src = restaurant.imageUrl;
        restaurantImage.alt = restaurant.title;
        restaurantImage.className = "restaurant-image";

        const restaurantTitle = document.createElement("h2");
        restaurantTitle.textContent = restaurant.title;

        const restaurantButton = document.createElement("button");
        restaurantButton.textContent = "Seleccionar";

        restaurantBox.appendChild(restaurantImage);
        restaurantBox.appendChild(restaurantTitle);
        restaurantBox.appendChild(restaurantButton);

        menuContainer.appendChild(restaurantBox);
    });
});