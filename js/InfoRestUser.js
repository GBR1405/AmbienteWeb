document.addEventListener('DOMContentLoaded', () => {
    fetch('../PHP/InfoRestUser.php?id=' + new URLSearchParams(window.location.search).get('id'))
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Analiza la respuesta como JSON
        })
        .then(data => {
            if (data.error) {
                console.error('Error en la respuesta del servidor:', data.error);
                return;
            }

            const cardsContainer = document.querySelector('.cards-container');
            cardsContainer.innerHTML = ''; // Limpiar contenido previo

            data.forEach(platillo => {
                const card = document.createElement('div');
                card.className = 'restaurant-card card mb-4';
                card.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${platillo.Nombre}</h5>
                        <p class="card-text">${platillo.Descripcion}</p>
                        <p class="card-text">Precio: $${platillo.Precio}</p>
                    </div>
                `;
                cardsContainer.appendChild(card);
            });
        })
        .catch(error => console.error('Error al cargar los datos:', error));
});
