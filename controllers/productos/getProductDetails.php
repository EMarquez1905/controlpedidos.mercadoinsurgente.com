<?php
// Incluir la conexión a la base de datos
include '../../config/conexion.php'; // Asegúrate de que este archivo tenga la conexión a la base de datos

// Obtener el ID del producto desde la solicitud GET
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($productId > 0) {
    // Preparar la consulta SQL
    $sql = "SELECT p.*, pr.nombre FROM productos p LEFT JOIN proveedores pr ON pr.id_proveedor = p.id_proveedor WHERE p.id_producto = ?";
    
    // Preparar la declaración
    if ($stmt = $conn->prepare($sql)) {
        // Vincular parámetros
        $stmt->bind_param("i", $productId);
        
        // Ejecutar la declaración
        $stmt->execute();
        
        // Obtener el resultado
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Obtener los datos del producto
            $producto = $result->fetch_assoc();
            
            // Verificar si id_proveedor es null
            if (is_null($producto['id_proveedor'])) {
                $producto['show_button'] = true; // Añadir un campo para mostrar el botón
            } else {
                $producto['show_button'] = false; // No mostrar el botón
            }
            
            // Devolver los datos en formato JSON
            echo json_encode($producto);
        } else {
            // Si no se encuentra el producto
            echo json_encode(['error' => 'Producto no encontrado']);
        }
        
        // Cerrar la declaración
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Error en la preparación de la consulta']);
    }
} else {
    echo json_encode(['error' => 'ID de producto no válido']);
}

// Cerrar la conexión
$conn->close();
?>
