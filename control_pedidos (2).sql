-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2025 a las 05:51:32
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control_pedidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `nombre_contacto` varchar(100) DEFAULT NULL,
  `telefono_contacto` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `razon_fiscal` varchar(100) DEFAULT NULL,
  `fecha_captura` datetime NOT NULL,
  `usuario_captura` int(11) NOT NULL,
  `estatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `rfc`, `direccion`, `telefono`, `nombre_contacto`, `telefono_contacto`, `email`, `razon_fiscal`, `fecha_captura`, `usuario_captura`, `estatus`) VALUES
(1, 'Juan Pérez', 'PEJ800101XXX', 'Av. Insurgentes Sur 1234, CDMX', '5551234567', 'María López', '5557654321', 'juan.perez@email.com', 'Juan Pérez S.A. de C.V.', '2025-02-19 14:58:49', 1, 'Activo'),
(2, 'Ana García', 'GAA900202YYY', 'Calle Reforma 567, Guadalajara', '3339876543', 'Carlos Gómez', '3331239876', 'ana.garcia@email.com', 'Ana García y Asociados', '2025-02-19 14:58:49', 2, 'Activo'),
(3, 'Luis Torres', 'TOR850303ZZZ', 'Blvd. Constitución 789, Monterrey', '8186543210', 'Sofía Martínez', '8182109876', 'luis.torres@email.com', 'Torres y Compañía S.A.', '2025-02-19 14:58:49', 1, 'Activo'),
(4, 'Marta Hernández', 'HEM950404AAA', 'Av. Central 456, Puebla', '2223456789', 'Raúl Sánchez', '2229876543', 'marta.hernandez@email.com', 'Hernández Consultores', '2025-02-19 14:58:49', 2, 'Activo'),
(5, 'Pedro Ramírez', 'RAP870505BBB', 'Calle Juárez 321, Mérida', '9991234567', 'Laura Fernández', '9998765432', 'pedro.ramirez@email.com', 'Ramírez y Asociados', '2025-02-19 14:58:49', 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_requisicion` int(11) NOT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `fecha_captura` datetime NOT NULL,
  `usuario_captura` int(11) NOT NULL,
  `estatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `perfil` varchar(255) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `perfil`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 1, '2025-02-14 20:26:37', '2025-02-14 20:26:37'),
(2, 'Operador', 1, '2025-02-17 16:05:40', '2025-02-17 16:05:40'),
(3, 'Consultor', 1, '2025-02-17 16:05:40', '2025-02-17 16:05:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios_producto`
--

CREATE TABLE `precios_producto` (
  `id_precio` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `precio_costo` decimal(10,2) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `producto` varchar(100) DEFAULT NULL,
  `codigo_barras` varchar(50) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `min` int(11) DEFAULT NULL,
  `unidad_medida` varchar(20) DEFAULT NULL,
  `imagen_producto` text DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `fecha_captura` datetime NOT NULL,
  `usuario_captura` int(11) NOT NULL,
  `estatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `producto`, `codigo_barras`, `max`, `min`, `unidad_medida`, `imagen_producto`, `id_proveedor`, `fecha_captura`, `usuario_captura`, `estatus`) VALUES
(1, 'Jamón de Pavo', '123456789012', 50, 10, 'kg', 'jamon_pavo.jpg', 1, '2025-02-19 15:00:00', 1, 'activo'),
(2, 'Lechuga Romana', '234567890123', 30, 5, 'piezas', 'lechuga_romana.jpg', NULL, '2025-02-19 15:00:00', 2, 'activo'),
(3, 'Tomates Saladette', '345678901234', 40, 8, 'kg', 'tomates_saladette.jpg', 3, '2025-02-19 15:00:00', 1, 'activo'),
(4, 'Manzanas Gala', '456789012345', 60, 12, 'kg', 'manzanas_gala.jpg', 4, '2025-02-19 15:00:00', 2, 'activo'),
(5, 'Huevos Blancos', '567890123456', 72, 15, 'piezas', 'huevos_blancos.jpg', 5, '2025-02-19 15:00:00', 1, 'activo'),
(6, 'Pollo Entero', '678901234567', 25, 5, 'kg', 'pollo_entero.jpg', 1, '2025-02-19 15:00:00', 2, 'activo'),
(7, 'Queso Oaxaca', '789012345678', 35, 8, 'kg', 'queso_oaxaca.jpg', 2, '2025-02-19 15:00:00', 1, 'activo'),
(8, 'Zanahorias', '890123456789', 45, 10, 'kg', 'zanahorias.jpg', 3, '2025-02-19 15:00:00', 2, 'activo'),
(9, 'Papas Blancas', '901234567890', 55, 12, 'kg', 'papas_blancas.jpg', 4, '2025-02-19 15:00:00', 1, 'activo'),
(10, 'Jitomates Bola', '012345678901', 35, 7, 'kg', 'jitomates_bola.jpg', 5, '2025-02-19 15:00:00', 2, 'activo'),
(11, 'Cebolla Blanca', '123456789012', 40, 9, 'kg', 'cebolla_blanca.jpg', 1, '2025-02-19 15:00:00', 1, 'activo'),
(12, 'Aguacate Hass', '234567890123', 25, 5, 'kg', 'aguacate_hass.jpg', 2, '2025-02-19 15:00:00', 2, 'activo'),
(13, 'Limones', '345678901234', 50, 10, 'kg', 'limones.jpg', 3, '2025-02-19 15:00:00', 1, 'activo'),
(14, 'Brócoli', '456789012345', 30, 6, 'piezas', 'brocoli.jpg', 4, '2025-02-19 15:00:00', 2, 'activo'),
(15, 'Plátanos Maduros', '567890123456', 45, 9, 'kg', 'platanos_maduros.jpg', 5, '2025-02-19 15:00:00', 1, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pedidos`
--

CREATE TABLE `productos_pedidos` (
  `id_producto_pedido` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `nombre_contacto` varchar(100) DEFAULT NULL,
  `telefono_contacto` varchar(15) DEFAULT NULL,
  `nombre_comercial` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `razon_fiscal` varchar(100) DEFAULT NULL,
  `fecha_captura` datetime NOT NULL,
  `usuario_captura` int(11) NOT NULL,
  `estatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `rfc`, `direccion`, `telefono`, `nombre_contacto`, `telefono_contacto`, `nombre_comercial`, `email`, `razon_fiscal`, `fecha_captura`, `usuario_captura`, `estatus`) VALUES
(1, 'Distribuidora ABC S.A. de C.V.', 'ABC123456789', 'Av. Principal 123, Ciudad, Estado', '5551234567', 'Juan Pérez', '5552345678', 'Distribuidora ABC', 'info@distribuidoraABC.com', 'Distribuidora ABC S.A. de C.V.', '2025-02-19 15:00:00', 1, 'activo'),
(2, 'Comercializadora XYZ S.A. de C.V.', 'XYZ987654321', 'Calle Secundaria 456, Municipio, Estado', '5559876543', 'María Gómez', '5558765432', 'Comercializadora XYZ', 'ventas@comercializadoraXYZ.com', 'Comercializadora XYZ S.A. de C.V.', '2025-02-19 15:00:00', 2, 'activo'),
(3, 'Proveedora Delta S.A. de C.V.', 'DEL456789123', 'Calle Terciaria 789, Localidad, Estado', '5553456789', 'José Hernández', '5552345678', 'Proveedora Delta', 'compras@proveedoraDelta.com', 'Proveedora Delta S.A. de C.V.', '2025-02-19 15:00:00', 1, 'activo'),
(4, 'Distribuidora Gamma S.A. de C.V.', 'GAM789456123', 'Avenida Alterna 321, Ciudad, Estado', '5556789012', 'Ana Martínez', '5557890123', 'Distribuidora Gamma', 'info@distribuidoraGamma.com', 'Distribuidora Gamma S.A. de C.V.', '2025-02-19 15:00:00', 2, 'activo'),
(5, 'Proveedores Unidos S.A. de C.V.', 'UNI159753852', 'Calle Paralela 654, Municipio, Estado', '5558521479', 'Luis Gómez', '5557412589', 'Proveedores Unidos', 'ventas@proveedoresunidos.com', 'Proveedores Unidos S.A. de C.V.', '2025-02-19 15:00:00', 1, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisiciones`
--

CREATE TABLE `requisiciones` (
  `id_requisicion` int(11) NOT NULL,
  `fecha_captura` datetime NOT NULL,
  `usuario_captura` int(11) NOT NULL,
  `estatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `clave`, `imagen`, `id_perfil`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@mercadoinsurgente.com', '$2y$10$/p5Gf50sI8Nib8u2NKSecuk7bgPnHwn0c1bne4YDBVmsiSlLs8YUi', 'admin.png', 1, 1, '2025-02-14 20:26:17', '2025-02-14 20:26:17'),
(2, 'Usuario de Prueba', 'prueba@mercadoinsurgente.com.mx', '$2y$10$C78I81UFYAhVlXTwkhG/iO8P3KBtLtnoAfmraEuE1/U3g4xaT8PeG', 'default.png', 3, 1, '2025-02-17 09:44:19', '2025-02-17 09:44:19'),
(3, 'Usuario Operador', 'operador@mercadoinsurgente.com.mx', '$2y$10$wW0Cg2LHwiKVO1d33bD/IeT51ONpFllZb1EEv46xt5fFRu5lZPK0y', 'default.png', 3, 1, '2025-02-17 20:18:37', '2025-02-17 20:18:37'),
(4, 'Alejandro', 'aabrego@junglesystem.com.mx', '$2y$10$aqdmA6xirXP6wb2FQLJQoe1wZTUuPd2onW7uGQKCqBX.s4q.qCcrW', 'default.png', 3, 1, '2025-02-17 20:21:05', '2025-02-17 20:21:05'),
(5, 'Prueba 3', 'prueba3@mercadoinsurgente.com', '$2y$10$S6dhmaR2EQ0CCTUZE7xSXefQRf9WhqmHpDyNXxVJ5YiSQHocUr0v6', 'default.png', 3, 0, '2025-02-18 09:13:45', '2025-02-18 09:13:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `usuario_captura` (`usuario_captura`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_requisicion` (`id_requisicion`),
  ADD KEY `usuario_captura` (`usuario_captura`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `precios_producto`
--
ALTER TABLE `precios_producto`
  ADD PRIMARY KEY (`id_precio`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `usuario_captura` (`usuario_captura`);

--
-- Indices de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  ADD PRIMARY KEY (`id_producto_pedido`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `usuario_captura` (`usuario_captura`);

--
-- Indices de la tabla `requisiciones`
--
ALTER TABLE `requisiciones`
  ADD PRIMARY KEY (`id_requisicion`),
  ADD KEY `usuario_captura` (`usuario_captura`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuarios_perfiles` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `precios_producto`
--
ALTER TABLE `precios_producto`
  MODIFY `id_precio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  MODIFY `id_producto_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `requisiciones`
--
ALTER TABLE `requisiciones`
  MODIFY `id_requisicion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`usuario_captura`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_requisicion`) REFERENCES `requisiciones` (`id_requisicion`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`usuario_captura`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `precios_producto`
--
ALTER TABLE `precios_producto`
  ADD CONSTRAINT `precios_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `precios_producto_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`usuario_captura`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  ADD CONSTRAINT `productos_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `productos_pedidos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `productos_pedidos_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`usuario_captura`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `requisiciones`
--
ALTER TABLE `requisiciones`
  ADD CONSTRAINT `requisiciones_ibfk_1` FOREIGN KEY (`usuario_captura`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_perfiles` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
