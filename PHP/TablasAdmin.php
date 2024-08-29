<?php
include './db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        switch ($accion) {
            case 'cargar_tabla':
                cargarTabla($_POST['tabla']);
                break;
            case 'mostrar_formulario_insercion':
                mostrarFormularioInsercion($_POST['tabla']);
                break;
            case 'insertar_dato':
                insertarDato($_POST);
                break;
            case 'editar_fila':
                mostrarFormularioEdicion($_POST['tabla'], $_POST['id']);
                break;
            case 'actualizar_dato':
                actualizarDato($_POST);
                break;
        }
    }
}

function cargarTabla($tabla) {
    global $conn;

    $primaryKeys = [
        'categoria_tb' => 'ID_Categoria',
        'especializacion_proveedortb' => 'ID_Especializacion_Proveedor',
        'especializacion_restaurante' => 'ID_Especializacion_Restaurante',
        'horario_tb' => 'ID_Horario',
        'genero_tb' => 'ID_Genero',
        'pais_tb' => 'ID_Pais'
    ];

    $query = "SELECT * FROM $tabla";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo 'Error al consultar la base de datos: ' . mysqli_error($conn);
        return;
    }

    echo '<table class="table table-bordered">';
    echo '<thead><tr>';
    $field_info = mysqli_fetch_fields($result);
    $primaryKey = $primaryKeys[$tabla] ?? '';
    foreach ($field_info as $val) {
        // No mostrar la columna autoincremental ID
        if ($val->name != $primaryKey) {
            echo '<th>' . htmlspecialchars($val->name) . '</th>';
        }
    }
    echo '<th>Acciones</th></tr></thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        foreach ($row as $key => $value) {
            // No mostrar la columna autoincremental ID
            if ($key != $primaryKey) {
                echo '<td>' . htmlspecialchars($value) . '</td>';
            }
        }
        $id = $row[$primaryKey]; // Obtener el nombre de la columna de clave primaria
        echo '<td><button class="btn btn-primary btn-editar" data-id="' . htmlspecialchars($id) . '" data-tabla="' . htmlspecialchars($tabla) . '">Editar</button></td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
}

function mostrarFormularioInsercion($tabla) {
    global $conn;
    $query = "DESCRIBE " . $tabla;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo 'Error al consultar la base de datos: ' . mysqli_error($conn);
        return;
    }
    $columns = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo '<form class="formulario-insertar">';
    echo '<input type="hidden" name="accion" value="insertar_dato">';
    echo '<input type="hidden" name="tabla" value="' . htmlspecialchars($tabla) . '">';
    foreach ($columns as $column) {
        if ($column['Field'] != 'ID_Categoria' && $column['Field'] != 'ID_Especializacion_Proveedor' && $column['Field'] != 'ID_Especializacion_Restaurante' && $column['Field'] != 'ID_Horario' && $column['Field'] != 'ID_Genero' && $column['Field'] != 'ID_Pais') {
            echo '<div class="form-group">';
            echo '<label for="' . htmlspecialchars($column['Field']) . '">' . htmlspecialchars($column['Field']) . '</label>';
            if ($column['Field'] == 'ID_ESTADO') {
                echo '<select class="form-control" id="' . htmlspecialchars($column['Field']) . '" name="' . htmlspecialchars($column['Field']) . '">';
                // Añadir opciones dinámicamente si es necesario
                echo '<option value="1">Activo</option>';
                echo '<option value="2">Inactivo</option>';
                echo '</select>';
            } else {
                echo '<input type="text" class="form-control" id="' . htmlspecialchars($column['Field']) . '" name="' . htmlspecialchars($column['Field']) . '">';
            }
            echo '</div>';
        }
    }
    echo '<button type="submit" class="btn btn-primary">Guardar</button>';
    echo '</form>';
}

function insertarDato($data) {
    global $conn;
    $tabla = $data['tabla'];
    unset($data['accion']);
    unset($data['tabla']);
    $columns = array_keys($data);
    $values = array_values($data);
    // Filtrar ID si está presente
    $columns = array_filter($columns, function($col) {
        return !in_array($col, ['ID_Categoria', 'ID_Especializacion_Proveedor', 'ID_Especializacion_Restaurante', 'ID_Horario', 'ID_Genero', 'ID_Pais']);
    });
    $values = array_intersect_key($values, array_flip(array_keys($columns)));
    $placeholders = array_fill(0, count($columns), '?');
    $query = "INSERT INTO " . $tabla . " (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        echo 'Error al preparar la consulta: ' . mysqli_error($conn);
        return;
    }
    
    // Preparar el tipo de datos para los parámetros
    $types = str_repeat('s', count($values));
    mysqli_stmt_bind_param($stmt, $types, ...$values);
    mysqli_stmt_execute($stmt);
    echo 'Dato insertado correctamente';
}

function mostrarFormularioEdicion($tabla, $id) {
    global $conn;

    // Definir clave primaria para cada tabla
    $primaryKeys = [
        'categoria_tb' => 'ID_Categoria',
        'especializacion_proveedortb' => 'ID_Especializacion_Proveedor',
        'especializacion_restaurante' => 'ID_Especializacion_Restaurante',
        'horario_tb' => 'ID_Horario',
        'genero_tb' => 'ID_Genero',
        'pais_tb' => 'ID_Pais'
    ];

    $primaryKey = $primaryKeys[$tabla] ?? 'ID'; // Usar 'ID' como valor por defecto

    $query = "SELECT * FROM $tabla WHERE $primaryKey = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        echo 'Error al preparar la consulta: ' . mysqli_error($conn);
        return;
    }
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $query = "DESCRIBE $tabla";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo 'Error al consultar la base de datos: ' . mysqli_error($conn);
        return;
    }
    $columns = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo '<form class="formulario-editar">';
    echo '<input type="hidden" name="accion" value="actualizar_dato">';
    echo '<input type="hidden" name="tabla" value="' . htmlspecialchars($tabla) . '">';
    echo '<input type="hidden" name="' . htmlspecialchars($primaryKey) . '" value="' . htmlspecialchars($id) . '">';
    foreach ($columns as $column) {
        if ($column['Field'] != $primaryKey) {
            echo '<div class="form-group">';
            echo '<label for="' . htmlspecialchars($column['Field']) . '">' . htmlspecialchars($column['Field']) . '</label>';
            if ($column['Field'] == 'ID_ESTADO') {
                echo '<select class="form-control" id="' . htmlspecialchars($column['Field']) . '" name="' . htmlspecialchars($column['Field']) . '">';
                echo '<option value="1"' . ($row[$column['Field']] == '1' ? ' selected' : '') . '>Activo</option>';
                echo '<option value="2"' . ($row[$column['Field']] == '2' ? ' selected' : '') . '>Inactivo</option>';
                echo '</select>';
            } else {
                echo '<input type="text" class="form-control" id="' . htmlspecialchars($column['Field']) . '" name="' . htmlspecialchars($column['Field']) . '" value="' . htmlspecialchars($row[$column['Field']]) . '">';
            }
            echo '</div>';
        }
    }
    echo '<button type="submit" class="btn btn-primary">Guardar cambios</button>';
    echo '</form>';
}

function actualizarDato($data) {
    global $conn;

    $tabla = $data['tabla'];
    $primaryKeys = [
        'categoria_tb' => 'ID_Categoria',
        'especializacion_proveedortb' => 'ID_Especializacion_Proveedor',
        'especializacion_restaurante' => 'ID_Especializacion_Restaurante',
        'horario_tb' => 'ID_Horario',
        'genero_tb' => 'ID_Genero',
        'pais_tb' => 'ID_Pais'
    ];

    $primaryKey = $primaryKeys[$tabla] ?? 'ID';
    $id = $data[$primaryKey];
    unset($data['accion']);
    unset($data['tabla']);
    unset($data[$primaryKey]);

    $columns = array_keys($data);
    $values = array_values($data);

    $setClause = [];
    foreach ($columns as $col) {
        $setClause[] = "$col = ?";
    }
    
    $query = "UPDATE $tabla SET " . implode(', ', $setClause) . " WHERE $primaryKey = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        echo 'Error al preparar la consulta: ' . mysqli_error($conn);
        return;
    }

    $types = str_repeat('s', count($values)) . 'i';
    mysqli_stmt_bind_param($stmt, $types, ...array_merge($values, [$id]));
    mysqli_stmt_execute($stmt);
    echo 'Dato actualizado correctamente';
}
?>
