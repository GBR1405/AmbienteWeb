function openModal(id = '', numMesa = '', estado = '') {
    document.getElementById('modal').classList.add('active');
    document.getElementById('modal-id-mesa').value = id;
    document.getElementById('modal-num-mesa').value = numMesa;
    document.getElementById('modal-estado').value = estado;
    if (id) {
        document.getElementById('modal-title').innerText = 'Editar Mesa';
        document.getElementById('modal-add-btn').style.display = 'none';
        document.getElementById('modal-edit-btn').style.display = 'inline-block';
    } else {
        document.getElementById('modal-title').innerText = 'Agregar Mesa';
        document.getElementById('modal-add-btn').style.display = 'inline-block';
        document.getElementById('modal-edit-btn').style.display = 'none';
    }
}

function closeModal() {
    document.getElementById('modal').classList.remove('active');
}

function openAddModal() {
    const addModal = document.getElementById('add-modal');
    if (addModal) {
        addModal.classList.add('active');
    } else {
        console.error('Elemento con ID "add-modal" no encontrado');
    }
}

function closeAddModal() {
    const addModal = document.getElementById('add-modal');
    if (addModal) {
        addModal.classList.remove('active');
    } else {
        console.error('Elemento con ID "add-modal" no encontrado');
    }
}

function openEditModal(id, numMesa, estado) {
    const editModal = document.getElementById('edit-modal');
    if (editModal) {
        editModal.classList.add('active');
        document.getElementById('edit-id-mesa').value = id;
        document.getElementById('edit-num-mesa').value = numMesa;
        document.getElementById('edit-estado').value = estado;
    } else {
        console.error('Elemento con ID "edit-modal" no encontrado');
    }
}

function closeEditModal() {
    const editModal = document.getElementById('edit-modal');
    if (editModal) {
        editModal.classList.remove('active');
    } else {
        console.error('Elemento con ID "edit-modal" no encontrado');
    }
}
