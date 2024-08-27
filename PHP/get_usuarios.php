<?php
include 'db.php';

$sql = "SELECT ID_Usuario, Username, Nombre, Apellido, Email, Telefono FROM usuario_tb WHERE ID_Estado = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['ID_Usuario']}</td>
                <td>{$row['Username']}</td>
                <td>{$row['Nombre']}</td>
                <td>{$row['Apellido']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['Telefono']}</td>
                <td><button class='btn btn-primary btn-sm'>Editar</button></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No se encontraron usuarios activos.</td></tr>";
}

$conn->close();
?>
