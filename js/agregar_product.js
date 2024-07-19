document.getElementById('productForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const productName = document.getElementById('productName').value;
    const productPrice = document.getElementById('productPrice').value;
    const productDescription = document.getElementById('productDescription').value;
    
    addProduct(productName, productPrice, productDescription);
    document.getElementById('productForm').reset();
});

function addProduct(name, price, description) {
    const productList = document.getElementById('productList');
    const productItem = document.createElement('li');
    
    productItem.innerHTML = `
        <strong>${name}</strong><br>
        Precio: ₡${price}<br>
        Descripción: ${description}<br>
        
    `;
    
    productList.appendChild(productItem);
}



