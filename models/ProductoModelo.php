<?php

class ProductoModelo
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function buscarProductos($search)
    {
        $search = $this->conn->real_escape_string($search);
        $sql = "SELECT * FROM productos WHERE producto LIKE '%$search%'";
        $result = $this->conn->query($sql);

        $productos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }

        return $productos;
    }

    public function obtenerProveedoresPorProducto($id_producto)
    {
        $sql = "SELECT p.id_proveedor, p.nombre 
                FROM proveedores p
                JOIN productos pp ON p.id_proveedor = pp.id_proveedor
                WHERE pp.id_producto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_producto);
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
