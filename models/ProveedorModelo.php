<?php

class ProductoModelo
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtenerTodosLosProveedores()
{
    $sql = "SELECT id_proveedor, nombre 
            FROM proveedores";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $proveedores = array();
    while ($row = $result->fetch_assoc()) {
        $proveedores[] = array(
            'id_proveedor' => $row['id_proveedor'],
            'nombre' => $row['nombre']
        );
    }

    $stmt->close();
    return $proveedores;
}

}
