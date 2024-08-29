document.addEventListener('DOMContentLoaded', () => {
    fetch('../PHP/MenuRestGet.php')
        .then(response => response.text()) // Usar .text() para ver el contenido crudo
        .then(text => {
            console.log('Respuesta del servidor:', text); // Ver el contenido de la respuesta
            return JSON.parse(text); // Analizar el texto como JSON
        })
        .then(data => {
            const cardsContainer = document.querySelector('.cards-container');
            cardsContainer.innerHTML = ''; // Limpiar contenido previo

            data.forEach(restaurant => {
                const card = document.createElement('div');
                card.className = 'restaurant-card card mb-4';

                // Asignar el ID del restaurante al atributo data-id para su uso posterior
                card.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${restaurant.Nombre}</h5>
                        <p class="card-text"><strong>Especialidad:</strong> ${restaurant.ID_ESPECIALIDAD}</p>
                        <p class="card-text"><strong>País:</strong> ${restaurant.ID_PAIS}</p>
                        <a href="InfoRestUser.php?id=${restaurant.ID_Restaurante}" class="btn btn-danger">Ver Detalles</a>
                    </div>
                `;

                cardsContainer.appendChild(card);
            });
        })
        .catch(error => console.error('Error al cargar los datos:', error));
});
