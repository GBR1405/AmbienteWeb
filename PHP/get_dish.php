<?php
// get_dish.php
include './db.php'; // Asegúrate de que este archivo incluye la conexión correcta a tu base de datos

if (isset($_GET['id'])) {
    $dishId = $_GET['id'];
    
    $query = "SELECT * FROM platillo_tb WHERE ID_Platillo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $dishId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $platillo = $result->fetch_assoc();
        echo json_encode($platillo);
    } else {
        echo json_encode([]);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode([]);
}
?>
