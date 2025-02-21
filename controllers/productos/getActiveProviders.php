<?php
// Incluir la conexión a la base de datos
include '../../config/conexion.php';

// Preparar la consulta SQL para obtener proveedores activos
$sql = "SELECT id_proveedor, nombre, estatus FROM proveedores WHERE estatus = 'activo'";

if ($result = $conn->query($sql)) {
    $proveedores = [];
    while ($row = $result->fetch_assoc()) {
        $proveedores[] = $row;
    }
    echo json_encode($proveedores);
} else {
    echo json_encode(['error' => 'Error en la consulta']);
}

// Cerrar la conexión
$conn->close();
?>
