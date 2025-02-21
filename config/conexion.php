<?php

$host = 'localhost'; // Cambia según tu configuración
$db_name = 'control_pedidos'; // Nombre de tu base de datos
$username = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña de la base de datos

$conn = new mysqli($host, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}