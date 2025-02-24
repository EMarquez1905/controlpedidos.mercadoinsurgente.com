<?php

class PreciosModelo
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtener_precios()
    {
        $sql = "SELECT * FROM productos WHERE estatus = 'activo'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $precios = array();
        while ($row = $result->fetch_assoc()) {
            $precios[] = array(
                'id_producto' => $row['id_producto'],
                'producto' => $row['producto'],
                'estatus' => $row['estatus']
            );
        }
        return $precios;
    }


    public function buscar_precios($searchTerm)
    {
        $sql = "SELECT * FROM productos
                WHERE producto LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $searchTerm = '%' . $searchTerm . '%';
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $precios = array();
        while ($row = $result->fetch_assoc()) {
            $precios[] = array(
                'id_producto' => $row['id_producto'],
                'producto' => $row['producto'],
                'estatus' => $row['estatus']
            );
        }
        return $precios;
    }

    public function buscar_precios_proveedores($searchTerm)
    {
        $sql = "SELECT * FROM proveedores
                WHERE nombre LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $searchTerm = '%' . $searchTerm . '%';
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $precios = array();
        while ($row = $result->fetch_assoc()) {
            $precios[] = array(
                'id_proveedor' => $row['id_proveedor'],
                'nombre' => $row['nombre'],
                'estatus' => $row['estatus']
            );
        }
        return $precios;
    }

    public function obtener_precios_proveedores()
    {
        $sql = "SELECT * FROM proveedores WHERE estatus = 'activo'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $precios = array();
        while ($row = $result->fetch_assoc()) {
            $precios[] = array(
                'id_proveedor' => $row['id_proveedor'],
                'nombre' => $row['nombre'],
                'estatus' => $row['estatus']
            );
        }
        return $precios;
    }

    public function seleccionar_producto($id_producto)
    {
        $sql = "SELECT p.*, u.nombre AS usuario 
                FROM productos p 
                INNER JOIN usuarios u ON p.usuario_captura = u.id_usuario 
                WHERE p.id_producto = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row;
        } else {
            return null;
        }
    }

    public function obtener_precios_productos($producto)
    {
        $sql = "SELECT pp.*, pr.nombre as proveedor, u.nombre AS usuario, p.producto 
                FROM precios_producto pp
                INNER JOIN proveedores pr ON pr.id_proveedor = pp.id_proveedor
                INNER JOIN productos p ON pp.id_producto = p.id_producto
                INNER JOIN usuarios u ON u.id_usuario = pp.usuario_captura
                WHERE pp.id_producto = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $producto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $precios = array();
            while ($row = $result->fetch_assoc()) {
                $precios[] = array(
                    'proveedor' => $row['proveedor'],
                    'producto' => $row['producto'],
                    'precio_costo' => $row['precio_costo'],
                    'fecha_captura' => $row['fecha_captura'],
                    'usuario_captura' => $row['usuario'],
                    'estatus' => $row['estatus']
                );
            }
            return $precios;
        } else {
            return [];
        }
    }

    public function seleccionar_proveedor($proveedor)
    {
        $sql = "SELECT * FROM proveedores WHERE id_proveedor = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $proveedor);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row;
        } else {
            return null;
        }
    }

    public function insertarPrecio($productoId, $proveedorId, $precio, $fechaInicio, $fechaFinal, $usuarioId)
    {
        // Definir la consulta SQL para insertar un nuevo registro en la tabla "precios"
        $sql = "INSERT INTO precios_producto (id_producto, id_proveedor, precio_costo, fecha_inicio, fecha_fin, usuario_captura, estatus) VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Preparar la sentencia
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            // Retornar false si ocurre algún error al preparar la consulta
            return false;
        }

        // Vincular los parámetros. 
        // "iidss" indica: integer, integer, double (o float) y dos strings para las fechas.
        $estado = 'Activo';
        $stmt->bind_param("iidssss", $productoId, $proveedorId, $precio, $fechaInicio, $fechaFinal, $usuarioId, $estado);

        // Ejecutar la sentencia y retornar el resultado
        $resultado = $stmt->execute();

        // Opcional: puedes retornar el id insertado en caso de éxito
        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }
}
