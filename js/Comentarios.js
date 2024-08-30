// comentarios.js

document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');
    
    // Función para actualizar las estrellas basadas en el rating
    function updateStars(rating) {
        stars.forEach(star => {
            if (parseInt(star.getAttribute('data-value')) <= rating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
    }

    // Inicializar las estrellas según el valor de rating
    updateStars(parseInt(ratingInput.value));

    // Manejar el clic en las estrellas para seleccionar la calificación
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = parseInt(this.getAttribute('data-value'));
            ratingInput.value = value;
            updateStars(value);
        });

        // Añadir clase de hover a las estrellas
        star.addEventListener('mouseover', function() {
            const value = parseInt(this.getAttribute('data-value'));
            stars.forEach(star => {
                if (parseInt(star.getAttribute('data-value')) <= value) {
                    star.classList.add('hovered');
                } else {
                    star.classList.remove('hovered');
                }
            });
        });

        star.addEventListener('mouseout', function() {
            stars.forEach(star => {
                star.classList.remove('hovered');
            });
        });
    });

    // Manejar el envío del formulario
    document.getElementById('comentario-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('Comentarios.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Mensaje de éxito o error
            if (data.includes('exitosamente')) {
                // Actualizar la lista de comentarios
                actualizarComentarios();
            }
        });
    });

    function actualizarComentarios() {
        const idRestaurante = document.getElementById('id_restaurante').value;

        fetch('Comentarios.php?id_restaurante=' + idRestaurante)
        .then(response => response.text())
        .then(data => {
            document.getElementById('comentarios').innerHTML = data;
        });
    }
});
