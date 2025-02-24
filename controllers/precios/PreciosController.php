<?php
require("../../config/database.php");
require("../../models/PreciosModelo.php");

$preciosModelo = new PreciosModelo();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Manejo de búsqueda de productos
if (isset($_GET['search']) && isset($_GET['busqueda']) && $_GET['busqueda'] == 'productos') {
    $searchTerm = $_GET['search'];
    $precios = $preciosModelo->buscar_precios($searchTerm);

    foreach ($precios as $precio) {
        echo "<tr>";
        echo "<td class='text-center'>" . $precio['id_producto'] . "</td>";
        echo "<td>" . $precio['producto'] . "</td>";
        echo "<td>" . $precio['estatus'] . "</td>";
        echo "<td class='text-center'>";
        echo '<label class="custom-control custom-checkbox">';
        echo '<input type="checkbox" class="custom-control-input check-producto" data-id-producto="' . $precio['id_producto'] . '">';
        echo '<span class="custom-control-indicator"></span>';
        echo '</label>';
        echo "</td>";
        echo "</tr>";
    }
} else if (isset($_GET['listado']) && $_GET['listado'] == 'productos') {
    $productos = $preciosModelo->obtener_precios();

    foreach ($productos as $precio) {
        echo "<tr>";
        echo "<td class='text-center'>" . $precio['id_producto'] . "</td>";
        echo "<td>" . $precio['producto'] . "</td>";
        echo "<td>" . $precio['estatus'] . "</td>";
        echo "<td class='text-center'>";
        echo '<label class="custom-control custom-checkbox">';
        echo '<input type="checkbox" class="custom-control-input check-producto" data-id-producto="' . $precio['id_producto'] . '">';
        echo '<span class="custom-control-indicator"></span>';
        echo '</label>';
        echo "</td>";
        echo "</tr>";
    }
}

// Manejo de búsqueda de proveedores
if (isset($_GET['search_proveedores']) && isset($_GET['busqueda']) && $_GET['busqueda'] == 'proveedores') {
    $search_proveedores = $_GET['search_proveedores'];
    $precios = $preciosModelo->buscar_precios_proveedores($search_proveedores);

    foreach ($precios as $precio) {
        echo "<tr>";
        echo "<td class='text-center'>" . $precio['id_proveedor'] . "</td>";
        echo "<td>" . $precio['nombre'] . "</td>";
        echo "<td>" . $precio['estatus'] . "</td>";
        echo "<td class='text-center'>";
        echo '<label class="custom-control custom-checkbox">';
        echo '<input type="checkbox" class="custom-control-input check-proveedores" data-id-proveedor="' . $precio['id_proveedor'] . '">';
        echo '<span class="custom-control-indicator"></span>';
        echo '</label>';
        echo "</td>";
        echo "</tr>";
    }
} else if (isset($_GET['listado']) && $_GET['listado'] == 'proveedores') {
    $proveedores = $preciosModelo->obtener_precios_proveedores();

    foreach ($proveedores as $precio) { // Cambiado de $productos a $proveedores
        echo "<tr>";
        echo "<td class='text-center'>" . $precio['id_proveedor'] . "</td>";
        echo "<td>" . $precio['nombre'] . "</td>";
        echo "<td>" . $precio['estatus'] . "</td>";
        echo "<td class='text-center'>";
        echo '<label class="custom-control custom-checkbox">';
        echo '<input type="checkbox" class="custom-control-input check-proveedores" data-id-proveedor="' . $precio['id_proveedor'] . '">';
        echo '<span class="custom-control-indicator"></span>';
        echo '</label>';
        echo "</td>";
        echo "</tr>";
    }
}


if (isset($_REQUEST['id_producto'])) {
    $id_producto = $_REQUEST['id_producto'];

    // Ejecutar el método para obtener el producto junto con el nombre del usuario
    $producto = $preciosModelo->seleccionar_producto($id_producto);

    // Si $producto es un arreglo o un objeto
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($producto);
}

if (isset($_GET['id_producto']) && isset($_GET['listado']) && $_GET['listado'] == 'precios_productos') {
    $producto = $_GET['id_producto'];
    if (empty($producto)) {
        echo "No se recibió id_producto";
        exit;
    }
    $preciosProducto = $preciosModelo->obtener_precios_productos($producto);

    if ($preciosProducto) {
        foreach ($preciosProducto as $precio) {
            echo "<tr>";
            echo "<td>" . $precio['proveedor'] . "</td>";
            echo "<td>" . $precio['producto'] . "</td>";
            echo "<td class='text-right'>$ " . $precio['precio_costo'] . " MXN</td>";
            echo "<td>" . $precio['fecha_captura'] . "</td>";
            echo "<td>" . $precio['usuario_captura'] . "</td>";
            echo "<td>" . $precio['estatus'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "<td colspan='6' class='text-center'>No hay registros</td>";
        echo "</tr>";
    }
}

if (isset($_REQUEST['id_proveedor'])) {
    $id_proveedor = $_REQUEST['id_proveedor'];

    $proveedor = $preciosModelo->seleccionar_proveedor($id_proveedor);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($proveedor);
}


// Comprobar que se han recibido todos los datos necesarios
if (isset($_POST['productoId']) && isset($_POST['proveedorId']) && isset($_POST['precio']) && isset($_POST['fechaInicio']) && isset($_POST['fechaFinal']) && isset($_POST['usuarioId'])) {
    // Recoger los datos del POST
    $productoId = $_POST['productoId'];
    $proveedorId = $_POST['proveedorId'];
    $precio      = $_POST['precio'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal  = $_POST['fechaFinal'];
    $usuario = $_POST['usuarioId'];

    // Aquí podrías agregar validaciones adicionales (p.ej. que los datos no estén vacíos, sean del tipo adecuado, etc.)

    // Intentar insertar el registro en la base de datos
    $resultado = $preciosModelo->insertarPrecio($productoId, $proveedorId, $precio, $fechaInicio, $fechaFinal, $usuario);

    // Indicar que la respuesta será en formato JSON
    header('Content-Type: application/json');
    if ($resultado) {
        echo json_encode([
            'success' => true,
            'message' => 'Registro insertado con éxito'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al insertar el registro'
        ]);
    }
}
