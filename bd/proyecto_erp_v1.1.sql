-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-06-2018 a las 16:30:58
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
  `Id_Categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Id_Categoria` int(11) NOT NULL,
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
  `Telefono` int(11) NOT NULL,
  `RTN` varchar(14) NOT NULL,
  `Correo_Electronico` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `Cantidad_Final` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Justificacion` varchar(255) NOT NULL
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
  `Genero` int(11) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Correo_Electronico` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `RTN_Proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE `tipos_usuarios` (
  `Id_Tipo_Usuario` varchar(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuario` varchar(10) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Id_Tipo_Usuario` varchar(10) NOT NULL,
  `Codigo_Empleado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD KEY `Id_Categoria` (`Id_Categoria`),
  ADD KEY `Id_Proveedor` (`Id_Proveedor`);

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
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Id_Categoria` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`Id_Categoria`) REFERENCES `categorias` (`Id_Categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`Id_Proveedor`) REFERENCES `proveedores` (`Id_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
