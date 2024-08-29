<?php
include './db.php'; // Verifica que esta ruta sea correcta
 // Verifica que esta ruta sea correcta

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT u.Username, r.Direccion, e.Especializacion, p.Pais 
            FROM restaurante_tb r
            JOIN usuario_tb u ON r.ID_Usuario = u.ID_Usuario
            JOIN especializacion_restaurante e ON r.ID_Especializacion_Restaurante = e.ID_Especializacion_Restaurante
            JOIN pais_tb p ON r.ID_Pais = p.ID_Pais
            WHERE r.ID_Restaurante = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $restaurante = $result->fetch_assoc();

        $sql_platillos = "SELECT ID_Platillo, Nombre, Descripcion, Precio, Imagen 
                          FROM platillo_tb 
                          WHERE ID_Restaurante = ?";
        $stmt_platillos = $conn->prepare($sql_platillos);
        $stmt_platillos->bind_param('i', $id);
        $stmt_platillos->execute();
        $result_platillos = $stmt_platillos->get_result();

        $platillos = [];
        while ($row = $result_platillos->fetch_assoc()) {
            $platillos[] = $row;
        }

        $response = [
            'Username' => $restaurante['Username'],
            'Direccion' => $restaurante['Direccion'],
            'Especializacion' => $restaurante['Especializacion'],
            'Pais' => $restaurante['Pais'],
            'platillos' => $platillos
        ];

        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'No se encontró información para este restaurante.']);
    }

    $stmt->close();
    $stmt_platillos->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'ID de restaurante no válido.']);
}
?>