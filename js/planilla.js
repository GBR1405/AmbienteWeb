$(document).ready(function() {
    // Cargar trabajadores
    loadWorkers();

    // Abrir modal para agregar trabajador
    $('#openAddModal').on('click', function() {
        $('#workerId').val('');
        $('#workerForm')[0].reset();
        $('#modalTitle').text('Agregar Trabajador');
        $('#workerModal').show();
    });

    // Cerrar modal
    $('.close').on('click', function() {
        $('#workerModal').hide();
    });

    // Manejar envío de formulario
    $('#workerForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#workerId').val();
        var url = './planilla.php';
        var data = $(this).serialize();

        if (id) {
            // Actualizar trabajador
            $.post(url, data, function(response) {
                alert(response);
                $('#workerModal').hide();
                loadWorkers();
            });
        } else {
            // Agregar nuevo trabajador
            $.post(url, data, function(response) {
                alert(response);
                $('#workerModal').hide();
                loadWorkers();
            });
        }
    });

    // Editar trabajador
    $(document).on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        $.get('./planilla.php?edit=' + id, function(data) {
            var worker = JSON.parse(data);
            $('#workerId').val(worker.ID_Planilla);
            $('#nombre').val(worker.Nombre);
            $('#apellido').val(worker.Apellido);
            $('#salario').val(worker.Salario);
            $('#telefono').val(worker.Telefono);
            $('#id_horario').val(worker.ID_Horario);
            $('#id_rol').val(worker.ID_RolPlanilla);
            $('#modalTitle').text('Editar Trabajador');
            $('#workerModal').show();
        });
    });

    // Eliminar trabajador
    $(document).on('click', '.btn-delete', function() {
        if (confirm('¿Estás seguro de que deseas eliminar este trabajador?')) {
            var id = $(this).data('id');
            $.get('./planilla.php?delete=' + id, function(response) {
                alert(response);
                loadWorkers();
            });
        }
    });

    // Función para cargar trabajadores en la tabla
    function loadWorkers() {
        $.get('./planilla.php?list=true', function(data) {
            $('tbody').html(data);
        });
    }
});
