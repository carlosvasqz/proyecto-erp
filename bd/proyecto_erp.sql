-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-07-2018 a las 03:59:04
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `proyecto_erp`
--
DROP DATABASE IF EXISTS `proyecto_erp`;
CREATE DATABASE IF NOT EXISTS `proyecto_erp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `proyecto_erp`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `Id_Articulo` varchar(10) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Existencias` int(11) NOT NULL,
  `Existencias_Minimas` int(11) NOT NULL,
  `Precio_Final` double(10,2) NOT NULL,
  `Porcentaje_Ganancia` double(10,2) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Id_Proveedor` varchar(10) NOT NULL,
  `Fecha_Ultima_Compra` date NOT NULL,
  `Fecha_Ultima_Venta` date NOT NULL,
  `Id_Categoria` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Id_Categoria` varchar(10) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cierres_diarios`
--

CREATE TABLE `cierres_diarios` (
  `Id_Cierre_Diario` varchar(20) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  `Ventas_Dia` double(10,2) NOT NULL,
  `Dinero_Caja` double(10,2) NOT NULL,
  `Caja_Chica` double(10,2) NOT NULL,
  `Diferencia` double(10,2) NOT NULL,
  `Justificacion_Diferencia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Id_Cliente` varchar(20) NOT NULL,
  `Nombres` varchar(100) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `RTN` varchar(14) NOT NULL,
  `Correo_Electronico` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Numero_Identidad` varchar(15) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Id_Cliente`, `Nombres`, `Apellido`, `Telefono`, `RTN`, `Correo_Electronico`, `Direccion`, `Numero_Identidad`, `Estado`) VALUES
('CLI.1', 'Carlos', 'Meza', '98234542', '03211999004325', 'asd@asd.asd', 'Sigua', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `Id_Compra` varchar(20) NOT NULL,
  `Id_Proveedor` varchar(10) NOT NULL,
  `Id_Factura` varchar(19) NOT NULL,
  `Fecha_Compra` date NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  `Id_Orden` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversiones`
--

CREATE TABLE `conversiones` (
  `Id_Conversion` varchar(10) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Cantidad_Inicial` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Cantidad_Final` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Justificacion` varchar(255) NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones_compra`
--

CREATE TABLE `cotizaciones_compra` (
  `Id_Cotizacion_Compra` int(11) NOT NULL,
  `Fecha_Emision` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones_venta`
--

CREATE TABLE `cotizaciones_venta` (
  `Id_Cotizacion_Venta` varchar(20) NOT NULL,
  `Id_Cliente` varchar(20) NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Sub_Total` double(10,2) NOT NULL,
  `Impuesto` double(10,2) NOT NULL,
  `Descuento` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_cotizacion_compra`
--

CREATE TABLE `detalles_cotizacion_compra` (
  `Num_Detalle` int(11) NOT NULL,
  `Id_Cotizacion` int(11) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` double(10,2) NOT NULL,
  `Ultimo_Precio` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_cotizacion_venta`
--

CREATE TABLE `detalles_cotizacion_venta` (
  `Num_Detalle` int(11) NOT NULL,
  `Id_Cotizacion_Venta` varchar(20) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` double(10,2) NOT NULL,
  `Total_Detalle` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_factura_compra`
--

CREATE TABLE `detalles_factura_compra` (
  `Num_Detalle` int(11) NOT NULL,
  `Id_Factura` varchar(19) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Costo` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_orden_compra`
--

CREATE TABLE `detalles_orden_compra` (
  `Num_Detalle` int(11) NOT NULL,
  `Id_Orden_Compra` varchar(20) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_Unitario` double(10,2) NOT NULL,
  `Precio_Total` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta`
--

CREATE TABLE `detalles_venta` (
  `Num_Detalle` int(11) NOT NULL,
  `Id_Venta` varchar(20) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Precio` double(10,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Total_Detalle` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta_tmp`
--

CREATE TABLE `detalles_venta_tmp` (
  `Num_Detalle_Tmp` int(11) NOT NULL,
  `Id_Venta_Tmp` varchar(20) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Precio` double(10,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Total_Detalle` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `Codigo_Empleado` varchar(10) NOT NULL,
  `ID` varchar(15) NOT NULL,
  `Nombres` varchar(100) NOT NULL,
  `Apellido_1` varchar(25) NOT NULL,
  `Apellido_2` varchar(25) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Genero` varchar(1) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Correo_Electronico` varchar(150) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`Codigo_Empleado`, `ID`, `Nombres`, `Apellido_1`, `Apellido_2`, `Fecha_Nacimiento`, `Fecha_Ingreso`, `Genero`, `Direccion`, `Telefono`, `Correo_Electronico`, `Estado`) VALUES
('EMP.00001', '0318-1978-00345', 'Manuel Josue', 'Osorio', 'Pineda', '1978-07-03', '2010-02-12', 'M', 'Bo. El Centro, Siguatepeque', '(504) 9345-7313', 'osorio.manuel345@hotmail.com', 1),
('EMP.00002', '0401-1991-00123', 'Marta ', 'Perez', 'Agustin', '1991-06-12', '2018-02-13', 'F', 'Bo. San Miguel', '(504) 3245-6734', 'perezagustin54@gmail.com', 1),
('EMP.00003', '0321-1998-00332', 'Carlos', 'Vasquez', '', '1997-11-22', '2017-06-01', 'M', 'Taulabe', '(504) 9646-4137', 'asd@asd.asd', 1),
('EMP.00004', '0321-1998-00333', 'Josue David', 'Portillo', '', '1998-06-01', '2018-06-02', 'M', 'Siguatepeque', '(111) 1111-1111', 'qwe@qwe.qwe', 0),
('EMP.00005', '1231-2312-32312', 'asd', 'asd', 'asd', '2018-07-01', '2018-07-16', 'M', 'asd', '(121) 2312-3123', 'asd@qwe.zxc', 0),
('EMP.00006', '1111-1111-11111', 'poi', 'poi', 'poi', '2018-06-26', '2018-07-09', 'F', 'zxc', '(222) 2222-2222', 'zxc@zxc.zxc', 0),
('EMP.00007', '4444-4444-44444', 'ert', 'ert', 'ert', '2018-07-30', '2018-07-02', 'M', 'dfsd', '(333) 3333-3333', 'sdf@sdf.sdf', 0),
('EMP.00008', '5555-5555-55555', 'qqq', 'qqq', 'qqq', '2018-07-10', '2018-06-25', 'F', 'eeee', '(222) 2222-2222', 'kjh@kkjh.kj', 1),
('EMP.00009', '8888-8888-88888', 'uyt', 'uyt', 'uyt', '2018-07-09', '2018-07-03', 'M', 'uyt', '(777) 7777-7777', 'uyt@uyt.uyt', 1),
('EMP.00010', '6666-6666-66666', 'nbv', 'nbv', 'nbv', '2018-06-24', '2018-07-04', 'M', 'bnv', '(555) 5555-5555', 'jhg@jhg.jhg', 1),
('EMP.00011', '1444-4444-44444', 'erte', 'rty', '09kj', '2018-06-24', '2018-07-30', 'F', 'sdfcgfhrtdvcb', '(876) 5387-6543', 'dfbdf@agh.kdfs', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_compra`
--

CREATE TABLE `facturas_compra` (
  `Id_Factura` varchar(19) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Id_Proveedor` varchar(10) NOT NULL,
  `Sub_Total` double(10,2) NOT NULL,
  `Descuento` double(10,2) NOT NULL,
  `Impuesto` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_compra`
--

CREATE TABLE `ordenes_compra` (
  `Id_Orden_Compra` varchar(20) NOT NULL,
  `Id_Proveedor` varchar(10) NOT NULL,
  `Fecha_Emision` date NOT NULL,
  `Sub_Total` double(10,2) NOT NULL,
  `Impuesto` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `Id_Proveedor` varchar(10) NOT NULL,
  `Nombre_Proveedor` varchar(100) NOT NULL,
  `RTN_Proveedor` varchar(16) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Correo_Electronico` varchar(250) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`Id_Proveedor`, `Nombre_Proveedor`, `RTN_Proveedor`, `Direccion`, `Telefono`, `Correo_Electronico`, `Estado`) VALUES
('PRO.00001', 'asd', '1231-1231-123111', 'qwe', '(111) 1111-1111', 'qwe@qwe.qwe', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE `tipos_usuarios` (
  `Id_Tipo_Usuario` varchar(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`Id_Tipo_Usuario`, `Nombre`, `Descripcion`, `Estado`) VALUES
('1', 'Superusuario', 'Super usuario', 1),
('2', 'Administracion', 'Usuarios que tomen decisiones admisnitrativas', 1),
('3', 'Compras', 'Usuarios encargados de la compra y manejo de compras de articulos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuario` varchar(10) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Id_Tipo_Usuario` varchar(10) NOT NULL,
  `Estado` int(1) NOT NULL,
  `Codigo_Empleado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Contraseña`, `Id_Tipo_Usuario`, `Estado`, `Codigo_Empleado`) VALUES
('USU.00001', 'admin1', '2', 1, 'EMP.00001'),
('USU.00002', 'tecno1', '3', 1, 'EMP.00002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `Id_Venta` varchar(10) NOT NULL,
  `Id_Cliente` varchar(20) NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Sub_Total` double(10,2) NOT NULL,
  `Descuento` double(10,2) NOT NULL,
  `Impuesto` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_tmp`
--

CREATE TABLE `ventas_tmp` (
  `Id_Venta_Tmp` varchar(10) NOT NULL,
  `Id_Cliente` varchar(20) NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Sub_Total` double(10,2) NOT NULL,
  `Descuento` double(10,2) NOT NULL,
  `Impuesto` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`Id_Articulo`),
  ADD KEY `Id_Proveedor` (`Id_Proveedor`),
  ADD KEY `Id_Categoria` (`Id_Categoria`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Id_Categoria`);

--
-- Indices de la tabla `cierres_diarios`
--
ALTER TABLE `cierres_diarios`
  ADD PRIMARY KEY (`Id_Cierre_Diario`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id_Cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`Id_Compra`),
  ADD KEY `Id_Proveedor` (`Id_Proveedor`),
  ADD KEY `compras_ibfk_2` (`Id_Factura`),
  ADD KEY `Id_Orden` (`Id_Orden`),
  ADD KEY `compras_ibfk_4` (`Id_Usuario`);

--
-- Indices de la tabla `conversiones`
--
ALTER TABLE `conversiones`
  ADD PRIMARY KEY (`Id_Conversion`),
  ADD KEY `Id_Articulo` (`Id_Articulo`);

--
-- Indices de la tabla `cotizaciones_compra`
--
ALTER TABLE `cotizaciones_compra`
  ADD PRIMARY KEY (`Id_Cotizacion_Compra`);

--
-- Indices de la tabla `cotizaciones_venta`
--
ALTER TABLE `cotizaciones_venta`
  ADD PRIMARY KEY (`Id_Cotizacion_Venta`),
  ADD KEY `Id_Cliente` (`Id_Cliente`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `detalles_cotizacion_compra`
--
ALTER TABLE `detalles_cotizacion_compra`
  ADD PRIMARY KEY (`Num_Detalle`),
  ADD KEY `Id_Articulo` (`Id_Articulo`),
  ADD KEY `Id_Cotizacion` (`Id_Cotizacion`);

--
-- Indices de la tabla `detalles_cotizacion_venta`
--
ALTER TABLE `detalles_cotizacion_venta`
  ADD PRIMARY KEY (`Num_Detalle`),
  ADD KEY `Id_Articulo` (`Id_Articulo`),
  ADD KEY `detalles_cotizacion_venta_ibfk_2` (`Id_Cotizacion_Venta`);

--
-- Indices de la tabla `detalles_factura_compra`
--
ALTER TABLE `detalles_factura_compra`
  ADD PRIMARY KEY (`Num_Detalle`),
  ADD KEY `Id_Articulo` (`Id_Articulo`),
  ADD KEY `Id_Factura` (`Id_Factura`);

--
-- Indices de la tabla `detalles_orden_compra`
--
ALTER TABLE `detalles_orden_compra`
  ADD PRIMARY KEY (`Num_Detalle`),
  ADD KEY `Id_Articulo` (`Id_Articulo`),
  ADD KEY `Id_Orden_Compra` (`Id_Orden_Compra`);

--
-- Indices de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD PRIMARY KEY (`Num_Detalle`),
  ADD KEY `Id_Articulo` (`Id_Articulo`),
  ADD KEY `Id_Venta` (`Id_Venta`);

--
-- Indices de la tabla `detalles_venta_tmp`
--
ALTER TABLE `detalles_venta_tmp`
  ADD PRIMARY KEY (`Num_Detalle_Tmp`),
  ADD KEY `Id_Articulo` (`Id_Articulo`),
  ADD KEY `Id_Venta_Tmp` (`Id_Venta_Tmp`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`Codigo_Empleado`);

--
-- Indices de la tabla `facturas_compra`
--
ALTER TABLE `facturas_compra`
  ADD PRIMARY KEY (`Id_Factura`),
  ADD KEY `Id_Proveedor` (`Id_Proveedor`);

--
-- Indices de la tabla `ordenes_compra`
--
ALTER TABLE `ordenes_compra`
  ADD PRIMARY KEY (`Id_Orden_Compra`),
  ADD KEY `Id_Proveedor` (`Id_Proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`Id_Proveedor`);

--
-- Indices de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  ADD PRIMARY KEY (`Id_Tipo_Usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `Id_Tipo_Usuario` (`Id_Tipo_Usuario`),
  ADD KEY `Codigo_Empleado` (`Codigo_Empleado`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`Id_Venta`),
  ADD KEY `Id_Cliente` (`Id_Cliente`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `ventas_tmp`
--
ALTER TABLE `ventas_tmp`
  ADD PRIMARY KEY (`Id_Venta_Tmp`),
  ADD KEY `Id_Cliente` (`Id_Cliente`),
  ADD KEY `ventas_tmp_ibfk_2` (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cotizaciones_compra`
--
ALTER TABLE `cotizaciones_compra`
  MODIFY `Id_Cotizacion_Compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_cotizacion_compra`
--
ALTER TABLE `detalles_cotizacion_compra`
  MODIFY `Num_Detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_cotizacion_venta`
--
ALTER TABLE `detalles_cotizacion_venta`
  MODIFY `Num_Detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_factura_compra`
--
ALTER TABLE `detalles_factura_compra`
  MODIFY `Num_Detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_orden_compra`
--
ALTER TABLE `detalles_orden_compra`
  MODIFY `Num_Detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  MODIFY `Num_Detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_venta_tmp`
--
ALTER TABLE `detalles_venta_tmp`
  MODIFY `Num_Detalle_Tmp` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`Id_Proveedor`) REFERENCES `proveedores` (`Id_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_ibfk_3` FOREIGN KEY (`Id_Categoria`) REFERENCES `categorias` (`Id_Categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cierres_diarios`
--
ALTER TABLE `cierres_diarios`
  ADD CONSTRAINT `cierres_diarios_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`Id_Proveedor`) REFERENCES `proveedores` (`Id_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`Id_Factura`) REFERENCES `facturas_compra` (`Id_Factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_3` FOREIGN KEY (`Id_Orden`) REFERENCES `ordenes_compra` (`Id_Orden_Compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_4` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `conversiones`
--
ALTER TABLE `conversiones`
  ADD CONSTRAINT `conversiones_ibfk_1` FOREIGN KEY (`Id_Articulo`) REFERENCES `articulos` (`Id_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cotizaciones_venta`
--
ALTER TABLE `cotizaciones_venta`
  ADD CONSTRAINT `cotizaciones_venta_ibfk_1` FOREIGN KEY (`Id_Cliente`) REFERENCES `clientes` (`Id_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizaciones_venta_ibfk_2` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_cotizacion_compra`
--
ALTER TABLE `detalles_cotizacion_compra`
  ADD CONSTRAINT `detalles_cotizacion_compra_ibfk_1` FOREIGN KEY (`Id_Articulo`) REFERENCES `articulos` (`Id_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_cotizacion_compra_ibfk_2` FOREIGN KEY (`Id_Cotizacion`) REFERENCES `cotizaciones_compra` (`Id_Cotizacion_Compra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_cotizacion_venta`
--
ALTER TABLE `detalles_cotizacion_venta`
  ADD CONSTRAINT `detalles_cotizacion_venta_ibfk_1` FOREIGN KEY (`Id_Articulo`) REFERENCES `articulos` (`Id_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_cotizacion_venta_ibfk_2` FOREIGN KEY (`Id_Cotizacion_Venta`) REFERENCES `cotizaciones_venta` (`Id_Cotizacion_Venta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_factura_compra`
--
ALTER TABLE `detalles_factura_compra`
  ADD CONSTRAINT `detalles_factura_compra_ibfk_1` FOREIGN KEY (`Id_Articulo`) REFERENCES `articulos` (`Id_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_factura_compra_ibfk_2` FOREIGN KEY (`Id_Factura`) REFERENCES `facturas_compra` (`Id_Factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_orden_compra`
--
ALTER TABLE `detalles_orden_compra`
  ADD CONSTRAINT `detalles_orden_compra_ibfk_1` FOREIGN KEY (`Id_Articulo`) REFERENCES `articulos` (`Id_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_orden_compra_ibfk_2` FOREIGN KEY (`Id_Orden_Compra`) REFERENCES `ordenes_compra` (`Id_Orden_Compra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD CONSTRAINT `detalles_venta_ibfk_1` FOREIGN KEY (`Id_Articulo`) REFERENCES `articulos` (`Id_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`Id_Venta`) REFERENCES `ventas` (`Id_Venta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_venta_tmp`
--
ALTER TABLE `detalles_venta_tmp`
  ADD CONSTRAINT `detalles_venta_tmp_ibfk_1` FOREIGN KEY (`Id_Articulo`) REFERENCES `articulos` (`Id_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_venta_tmp_ibfk_2` FOREIGN KEY (`Id_Venta_Tmp`) REFERENCES `ventas_tmp` (`Id_Venta_Tmp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas_compra`
--
ALTER TABLE `facturas_compra`
  ADD CONSTRAINT `facturas_compra_ibfk_1` FOREIGN KEY (`Id_Proveedor`) REFERENCES `proveedores` (`Id_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes_compra`
--
ALTER TABLE `ordenes_compra`
  ADD CONSTRAINT `ordenes_compra_ibfk_1` FOREIGN KEY (`Id_Proveedor`) REFERENCES `proveedores` (`Id_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Id_Tipo_Usuario`) REFERENCES `tipos_usuarios` (`Id_Tipo_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`Codigo_Empleado`) REFERENCES `empleados` (`Codigo_Empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`Id_Cliente`) REFERENCES `clientes` (`Id_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas_tmp`
--
ALTER TABLE `ventas_tmp`
  ADD CONSTRAINT `ventas_tmp_ibfk_1` FOREIGN KEY (`Id_Cliente`) REFERENCES `clientes` (`Id_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_tmp_ibfk_2` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
