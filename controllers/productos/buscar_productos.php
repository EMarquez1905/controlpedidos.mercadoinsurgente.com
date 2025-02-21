<?php
require_once '../../config/database.php';
require_once '../../models/ProductoModelo.php';

$productoModelo = new ProductoModelo();

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $productos = $productoModelo->buscarProductos($search);

    foreach ($productos as $producto) {
        echo "<tr>
                <th scope='row'>{$producto['id_producto']}</th>
                <td>{$producto['producto']}</td>
                <td><button class='btn btn-primary select-product' data-id='{$producto['id_producto']}' data-nombre='{$producto['producto']}'>Seleccionar</button></td>
              </tr>";
    }

    if (empty($productos)) {
        echo "<tr><td colspan='3' class='text-center'>No se encontraron resultados.</td></tr>";
    }
}
