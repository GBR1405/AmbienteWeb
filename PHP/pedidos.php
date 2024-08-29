<?php
session_start();

// Verifica si el usuario está autenticado y tiene un ID_Usuario
if (!isset($_SESSION['ID_Usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['ID_Usuario'];

include './db.php'; // Incluye el archivo de conexión

// Verifica la conexión a la base de datos
if ($conn->connect_error) {
    echo json_encode(['error' => 'Error en la conexión a la base de datos: ' . $conn->connect_error]);
    exit;
}

// Obtener el ID del restaurante asociado al usuario de la sesión
$query_restaurante = "SELECT ID_Restaurante FROM restaurante_tb WHERE ID_Usuario = $id_usuario LIMIT 1";
$result_restaurante = $conn->query($query_restaurante);

if ($result_restaurante && $result_restaurante->num_rows > 0) {
    $row_restaurante = $result_restaurante->fetch_assoc();
    $id_restaurante = $row_restaurante['ID_Restaurante'];
} else {
    echo json_encode(['error' => 'No se encontró un restaurante asociado al usuario.']);
    exit;
}

// Obtener los pedidos que están asociados al restaurante del usuario
$query_pedidos = "SELECT p.ID_Pedido, e.Estado as Estado
                  FROM pedido_tb p
                  JOIN estado_tb e ON p.ID_Estado = e.ID_Estado
                  WHERE EXISTS (
                      SELECT 1
                      FROM pedido_platillos_tb pp
                      JOIN platillo_tb pl ON pp.ID_Platillo = pl.ID_Platillo
                      WHERE pp.ID_Pedido = p.ID_Pedido AND pl.ID_Restaurante = $id_restaurante AND p.ID_ESTADO = 3
                  )";
$result_pedidos = $conn->query($query_pedidos);

if ($result_pedidos) {
    $pedidos = [];
    while ($row = $result_pedidos->fetch_assoc()) {
        $pedidos[] = $row;
    }
    echo json_encode(['success' => true, 'pedidos' => $pedidos]);
} else {
    echo json_encode(['error' => 'Error al obtener los pedidos: ' . $conn->error]);
}

$conn->close();
?>
