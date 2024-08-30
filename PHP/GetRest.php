<?php
include './db.php';

// Consulta para obtener todos los restaurantes con joins para especialización, país y estado
$sql = "
    SELECT 
        r.ID_Restaurante,
        r.Direccion,
        e.Especializacion AS Especializacion,
        p.Pais AS Pais,
        es.Estado AS Estado
    FROM 
        restaurante_tb r
    JOIN 
        especializacion_restaurante e ON r.ID_Especializacion_Restaurante = e.ID_Especializacion_Restaurante
    JOIN 
        pais_tb p ON r.ID_Pais = p.ID_Pais
    JOIN 
        estado_tb es ON r.ID_Estado = es.ID_Estado
";

$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result) {
    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['ID_Restaurante']}</td>
                <td>{$row['Direccion']}</td>
                <td>{$row['Especializacion']}</td>
                <td>{$row['Pais']}</td>
                <td>{$row['Estado']}</td>
                <td><button class='btn btn-primary btn-sm edit-btn' data-id='{$row['ID_Restaurante']}'>Editar</button></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No hay restaurantes disponibles.</td></tr>";
    }
} else {
    // Manejar el error de la consulta
    echo "<tr><td colspan='6'>Error en la consulta: " . $conn->error . "</td></tr>";
}

$conn->close();
?>
