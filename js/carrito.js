document.addEventListener("DOMContentLoaded", function() {
    // Ejemplo para el carrito
    const cartItems = [
        { title: "Producto 1", price: 15, quantity: 1 },
        { title: "Producto 2", price: 25, quantity: 1 },
        { title: "Producto 3", price: 15, quantity: 1 },
        { title: "Producto 4", price: 25, quantity: 1 }
    ];

    const cartTableBody = document.getElementById("cart-items");
    const totalAmount = document.getElementById("total-amount");

    function renderCart() {
        cartTableBody.innerHTML = '';
        let total = 0;

        cartItems.forEach((item, index) => {
            const row = document.createElement("tr");

            // Celdas de datos
            row.innerHTML = `
                <td>${item.title}</td>
                <td>$${item.price} USD</td>
                <td><input type="number" value="${item.quantity}" min="1" class="quantity-input" data-index="${index}"></td>
                <td>$${item.price * item.quantity} USD</td>
                <td><button class="remove-button" data-index="${index}">Eliminar</button></td>
            `;
            cartTableBody.appendChild(row);

            total += item.price * item.quantity;
        });

        totalAmount.textContent = `$${total} USD`;
    }

    // Evento para actualizar cantidades
    cartTableBody.addEventListener("change", (e) => {
        if (e.target.classList.contains("quantity-input")) {
            const index = e.target.dataset.index;
            cartItems[index].quantity = parseInt(e.target.value);
            renderCart();
        }
    });

    // Evento para eliminar productos
    cartTableBody.addEventListener("click", (e) => {
        if (e.target.classList.contains("remove-button")) {
            const index = e.target.dataset.index;
            cartItems.splice(index, 1);
            renderCart();
        }
    });

    renderCart();

    // Eventos para botones
    document.getElementById("continue-shopping").addEventListener("click", () => {
        window.location.href = "menu.php";
    });

    document.getElementById("proceed-payment").addEventListener("click", () => {

        document.querySelector('.order-status').textContent = "Orden en Proceso...";
    });
});