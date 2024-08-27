document.addEventListener("DOMContentLoaded", function () {
    let currentIndex = 0;

    window.scrollCarousel = function (direction) {
        const carouselTrack = document.querySelector('.carousel-track');
        const cardWidth = document.querySelector('.card').offsetWidth;
        const visibleCards = 8; 
        const totalCards = document.querySelectorAll('.card').length;

        currentIndex += direction * visibleCards;

        if (currentIndex < 0) {
            currentIndex = 0;
        } else if (currentIndex > totalCards - visibleCards) {
            currentIndex = totalCards - visibleCards;
        }

        const offset = currentIndex * cardWidth;
        carouselTrack.style.transform = `translateX(-${offset}px)`;
    }
});
document.getElementById("loginButton").addEventListener("click", function() {
    window.location.href = "inicio_sesion.html";
});

