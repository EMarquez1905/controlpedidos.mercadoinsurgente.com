<?php
include('../../config/conexion.php');

if ($conn->connect_error) {
    die(json_encode(['error' => "Conexión fallida: " . $conn->connect_error]));
}

// Manejo de la búsqueda
$searchTerm = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : ''; // Escapa la entrada
$sql = "SELECT * FROM productos WHERE producto LIKE '%$searchTerm%'";
$result = $conn->query($sql);

if (!$result) {
    die(json_encode(['error' => "Error en la consulta: " . $conn->error]));
}

$productos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}
header('Content-Type: application/json');
echo json_encode($productos);
$conn->close();
?>
