-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-06-2018 a las 00:39:19
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

DROP TABLE IF EXISTS `articulos`;
CREATE TABLE IF NOT EXISTS `articulos` (
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
  `Id_Categoria` int(11) NOT NULL,
  PRIMARY KEY (`Id_Articulo`),
  KEY `Id_Categoria` (`Id_Categoria`),
  KEY `Id_Proveedor` (`Id_Proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `Id_Categoria` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_Categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cierres_diarios`
--

DROP TABLE IF EXISTS `cierres_diarios`;
CREATE TABLE IF NOT EXISTS `cierres_diarios` (
  `Id_Cierre_Diario` varchar(20) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  `Ventas_Dia` double(10,2) NOT NULL,
  `Dinero_Caja` double(10,2) NOT NULL,
  `Caja_Chica` double(10,2) NOT NULL,
  `Diferencia` double(10,2) NOT NULL,
  `Justificacion_Diferencia` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_Cierre_Diario`),
  KEY `Id_Usuario` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `Id_Cliente` varchar(20) NOT NULL,
  `Nombres` varchar(100) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `RTN` varchar(14) NOT NULL,
  `Correo_Electronico` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_Cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `Id_Compra` varchar(20) NOT NULL,
  `Id_Proveedor` varchar(10) NOT NULL,
  `Id_Factura` varchar(19) NOT NULL,
  `Fecha_Compra` date NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  `Id_Orden` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_Compra`),
  KEY `Id_Proveedor` (`Id_Proveedor`),
  KEY `compras_ibfk_2` (`Id_Factura`),
  KEY `Id_Orden` (`Id_Orden`),
  KEY `compras_ibfk_4` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversiones`
--

DROP TABLE IF EXISTS `conversiones`;
CREATE TABLE IF NOT EXISTS `conversiones` (
  `Id_Conversion` varchar(10) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Cantidad_Inicial` int(11) NOT NULL,
  `Cantidad_Final` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Justificacion` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_Conversion`),
  KEY `Id_Articulo` (`Id_Articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones_compra`
--

DROP TABLE IF EXISTS `cotizaciones_compra`;
CREATE TABLE IF NOT EXISTS `cotizaciones_compra` (
  `Id_Cotizacion_Compra` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_Emision` date NOT NULL,
  PRIMARY KEY (`Id_Cotizacion_Compra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones_venta`
--

DROP TABLE IF EXISTS `cotizaciones_venta`;
CREATE TABLE IF NOT EXISTS `cotizaciones_venta` (
  `Id_Cotizacion_Venta` varchar(20) NOT NULL,
  `Id_Cliente` varchar(20) NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Sub_Total` double(10,2) NOT NULL,
  `Impuesto` double(10,2) NOT NULL,
  `Descuento` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL,
  PRIMARY KEY (`Id_Cotizacion_Venta`),
  KEY `Id_Cliente` (`Id_Cliente`),
  KEY `Id_Usuario` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_cotizacion_compra`
--

DROP TABLE IF EXISTS `detalles_cotizacion_compra`;
CREATE TABLE IF NOT EXISTS `detalles_cotizacion_compra` (
  `Num_Detalle` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Cotizacion` int(11) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` double(10,2) NOT NULL,
  `Ultimo_Precio` double(10,2) NOT NULL,
  PRIMARY KEY (`Num_Detalle`),
  KEY `Id_Articulo` (`Id_Articulo`),
  KEY `Id_Cotizacion` (`Id_Cotizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_cotizacion_venta`
--

DROP TABLE IF EXISTS `detalles_cotizacion_venta`;
CREATE TABLE IF NOT EXISTS `detalles_cotizacion_venta` (
  `Num_Detalle` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Cotizacion_Venta` varchar(20) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` double(10,2) NOT NULL,
  `Total_Detalle` double(10,2) NOT NULL,
  PRIMARY KEY (`Num_Detalle`),
  KEY `Id_Articulo` (`Id_Articulo`),
  KEY `detalles_cotizacion_venta_ibfk_2` (`Id_Cotizacion_Venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_factura_compra`
--

DROP TABLE IF EXISTS `detalles_factura_compra`;
CREATE TABLE IF NOT EXISTS `detalles_factura_compra` (
  `Num_Detalle` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Factura` varchar(19) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Costo` double(10,2) NOT NULL,
  PRIMARY KEY (`Num_Detalle`),
  KEY `Id_Articulo` (`Id_Articulo`),
  KEY `Id_Factura` (`Id_Factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_orden_compra`
--

DROP TABLE IF EXISTS `detalles_orden_compra`;
CREATE TABLE IF NOT EXISTS `detalles_orden_compra` (
  `Num_Detalle` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Orden_Compra` varchar(20) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_Unitario` double(10,2) NOT NULL,
  `Precio_Total` double(10,2) NOT NULL,
  PRIMARY KEY (`Num_Detalle`),
  KEY `Id_Articulo` (`Id_Articulo`),
  KEY `Id_Orden_Compra` (`Id_Orden_Compra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta`
--

DROP TABLE IF EXISTS `detalles_venta`;
CREATE TABLE IF NOT EXISTS `detalles_venta` (
  `Num_Detalle` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Venta` varchar(20) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Precio` double(10,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Total_Detalle` double(10,2) NOT NULL,
  PRIMARY KEY (`Num_Detalle`),
  KEY `Id_Articulo` (`Id_Articulo`),
  KEY `Id_Venta` (`Id_Venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta_tmp`
--

DROP TABLE IF EXISTS `detalles_venta_tmp`;
CREATE TABLE IF NOT EXISTS `detalles_venta_tmp` (
  `Num_Detalle_Tmp` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Venta_Tmp` varchar(20) NOT NULL,
  `Id_Articulo` varchar(10) NOT NULL,
  `Precio` double(10,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Total_Detalle` double(10,2) NOT NULL,
  PRIMARY KEY (`Num_Detalle_Tmp`),
  KEY `Id_Articulo` (`Id_Articulo`),
  KEY `Id_Venta_Tmp` (`Id_Venta_Tmp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
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
  `Correo_Electronico` varchar(150) NOT NULL,
  `Estado` int(11) NOT NULL,
  PRIMARY KEY (`Codigo_Empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_compra`
--

DROP TABLE IF EXISTS `facturas_compra`;
CREATE TABLE IF NOT EXISTS `facturas_compra` (
  `Id_Factura` varchar(19) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Id_Proveedor` varchar(10) NOT NULL,
  `Sub_Total` double(10,2) NOT NULL,
  `Descuento` double(10,2) NOT NULL,
  `Impuesto` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL,
  PRIMARY KEY (`Id_Factura`),
  KEY `Id_Proveedor` (`Id_Proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_compra`
--

DROP TABLE IF EXISTS `ordenes_compra`;
CREATE TABLE IF NOT EXISTS `ordenes_compra` (
  `Id_Orden_Compra` varchar(20) NOT NULL,
  `Id_Proveedor` varchar(10) NOT NULL,
  `Fecha_Emision` date NOT NULL,
  `Sub_Total` double(10,2) NOT NULL,
  `Impuesto` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL,
  PRIMARY KEY (`Id_Orden_Compra`),
  KEY `Id_Proveedor` (`Id_Proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `Id_Proveedor` varchar(10) NOT NULL,
  `Nombre_Proveedor` varchar(100) NOT NULL,
  `RTN_Proveedor` int(11) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Correo_Electronico` varchar(250) NOT NULL,
  `Estado` int(11) NOT NULL,
  PRIMARY KEY (`Id_Proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

DROP TABLE IF EXISTS `tipos_usuarios`;
CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
  `Id_Tipo_Usuario` varchar(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_Tipo_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `Id_Usuario` varchar(10) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Id_Tipo_Usuario` varchar(10) NOT NULL,
  `Codigo_Empleado` varchar(10) NOT NULL,
  PRIMARY KEY (`Id_Usuario`),
  KEY `Id_Tipo_Usuario` (`Id_Tipo_Usuario`),
  KEY `Codigo_Empleado` (`Codigo_Empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `Id_Venta` varchar(10) NOT NULL,
  `Id_Cliente` varchar(20) NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Sub_Total` double(10,2) NOT NULL,
  `Descuento` double(10,2) NOT NULL,
  `Impuesto` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL,
  PRIMARY KEY (`Id_Venta`),
  KEY `Id_Cliente` (`Id_Cliente`),
  KEY `Id_Usuario` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_tmp`
--

DROP TABLE IF EXISTS `ventas_tmp`;
CREATE TABLE IF NOT EXISTS `ventas_tmp` (
  `Id_Venta_Tmp` varchar(10) NOT NULL,
  `Id_Cliente` varchar(20) NOT NULL,
  `Id_Usuario` varchar(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Sub_Total` double(10,2) NOT NULL,
  `Descuento` double(10,2) NOT NULL,
  `Impuesto` double(10,2) NOT NULL,
  `Total` double(10,2) NOT NULL,
  PRIMARY KEY (`Id_Venta_Tmp`),
  KEY `Id_Cliente` (`Id_Cliente`),
  KEY `ventas_tmp_ibfk_2` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
