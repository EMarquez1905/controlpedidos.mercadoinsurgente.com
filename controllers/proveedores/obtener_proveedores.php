<?php
require_once '../../config/database.php';
require_once '../../models/ProductoModelo.php';

$productoModelo = new ProductoModelo();

$proveedores = $productoModelo->obtenerTodosLosProveedores();

header('Content-Type: application/json');
echo json_encode($proveedores);
