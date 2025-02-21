<?php
// Conectar a la base de datos
include '../../config/conexion.php'; 

// Obtener los datos enviados desde el AJAX
$product_id = $_POST['id_producto']; // Cambiar 'product_id' a 'id_producto'
$provider_id = $_POST['id_proveedor']; // Cambiar 'provider_id' a 'id_proveedor'

// Inicializar la respuesta
$response = array();

try {
    // Actualizar el proveedor en la tabla de productos
    $sql = "UPDATE productos SET id_proveedor = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ii", $provider_id, $product_id);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Proveedor actualizado correctamente';
    } else {
        throw new Exception("Error al actualizar el proveedor: " . $stmt->error);
    }

    $stmt->close();
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
} finally {
    $conn->close();
}

// Establecer el tipo de contenido a JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
