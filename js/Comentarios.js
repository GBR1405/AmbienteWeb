$(document).ready(function() {
    const ratingStars = $('.rating-star');
    const commentForm = $('#comment-form');
    const commentList = $('#comment-list');
    let currentRating = 0;

    // Manejo de las estrellas de calificación
    ratingStars.on('mouseover', function() {
        const index = $(this).index();
        ratingStars.each(function(i) {
            $(this).toggleClass('filled', i <= index);
        });
    });

    ratingStars.on('mouseout', function() {
        ratingStars.each(function(i) {
            $(this).toggleClass('filled', i < currentRating);
        });
    });

    ratingStars.on('click', function() {
        currentRating = $(this).index() + 1;
        ratingStars.each(function(i) {
            $(this).toggleClass('filled', i < currentRating);
        });
    });

    // Enviar el comentario
    commentForm.on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(commentForm[0]);
        formData.append('rating', currentRating);

        $.ajax({
            url: '../PHP/comentarios.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                const data = JSON.parse(response);
                if (data.success) {
                    loadComments();
                    commentForm[0].reset();
                    currentRating = 0;
                    ratingStars.removeClass('filled');
                } else {
                    alert(data.error);
                }
            }
        });
    });

    // Cargar los comentarios
    function loadComments() {
        $.ajax({
            url: '../PHP/comentarios.php',
            method: 'GET',
            success: function(response) {
                const comments = JSON.parse(response);
                commentList.empty();
                comments.forEach(function(comment) {
                    const ratingStars = '★'.repeat(comment.Rating) + '☆'.repeat(5 - comment.Rating);
                    commentList.append(`
                        <div class="comment-item">
                            <div class="rating">${ratingStars}</div>
                            <p><strong>${comment.Nombre}</strong>: ${comment.Comentario}</p>
                        </div>
                    `);
                });
            }
        });
    }

    loadComments();
});
