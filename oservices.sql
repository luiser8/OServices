-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 04, 2018 at 09:58 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oservices`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `Clave` text COLLATE utf8_spanish_ci NOT NULL,
  `CodNivel` int(10) UNSIGNED NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`id`, `Nombre`, `Clave`, `CodNivel`, `Fecha`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-07-02 14:52:40'),
(2, 'luiser', '81dc9bdb52d04dc20036dbd8313ed055', 3, '2018-07-02 14:57:36'),
(3, 'carlos', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2018-07-02 15:24:44'),
(4, 'luiser1', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2018-07-02 17:13:40'),
(5, 'luiser3', '81dc9bdb52d04dc20036dbd8313ed055', 4, '2018-07-02 20:01:51'),
(6, 'luiser4', '81dc9bdb52d04dc20036dbd8313ed055', 5, '2018-07-02 20:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `carrito`
--

CREATE TABLE `carrito` (
  `CodCarrito` int(11) NOT NULL,
  `CodigoProd` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `Cliente` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `NombreProd` varchar(155) COLLATE utf8_spanish_ci NOT NULL,
  `Precio` varchar(155) COLLATE utf8_spanish_ci NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Subtotal` varchar(155) COLLATE utf8_spanish_ci NOT NULL,
  `Estado` int(11) NOT NULL DEFAULT '1',
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `carrito`
--

INSERT INTO `carrito` (`CodCarrito`, `CodigoProd`, `Cliente`, `NombreProd`, `Precio`, `Cantidad`, `Subtotal`, `Estado`, `Fecha`) VALUES
(50, 'pa001', '16068389', 'Resma', '5000.00', 2, '10000', 1, '2018-07-04 19:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `CodigoCat` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`CodigoCat`, `Nombre`, `Descripcion`) VALUES
('01', 'Papelería', 'Productos Papeleros'),
('02', 'Higiénico', 'Papeles Higiénicos'),
('03', 'Limpieza', 'Productos de Limpieza');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `RIF` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `NombreCompleto` varchar(70) NOT NULL,
  `Clave` text NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`RIF`, `Nombre`, `NombreCompleto`, `Clave`, `Direccion`, `Telefono`, `Email`) VALUES
('16068389', 'emiru48', 'Emir Urbano', '81dc9bdb52d04dc20036dbd8313ed055', 'Puerto la Cruz, Estado Anzoátegui', '04148283661', 'emiru48@gmail.com'),
('J123456', 'pruebax', 'Pedro Perez', '81dc9bdb52d04dc20036dbd8313ed055', 'Barcelona', '555555', 'hola@gmail.com'),
('J1234567', 'prueba2', 'Empresa de Prueba', '81dc9bdb52d04dc20036dbd8313ed055', 'Puerto la Cruz, Estado Anzoátegui', '123456', 'micorreo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cuentabanco`
--

CREATE TABLE `cuentabanco` (
  `id` int(50) NOT NULL,
  `NumeroCuenta` varchar(100) NOT NULL,
  `NombreBanco` varchar(100) NOT NULL,
  `NombreBeneficiario` varchar(100) NOT NULL,
  `TipoCuenta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuentabanco`
--

INSERT INTO `cuentabanco` (`id`, `NumeroCuenta`, `NombreBanco`, `NombreBeneficiario`, `TipoCuenta`) VALUES
(1, '01340062870621035057', 'Banesco', 'Inversora Oriente Services CA', 'Corriente');

-- --------------------------------------------------------

--
-- Table structure for table `detalle`
--

CREATE TABLE `detalle` (
  `NumPedido` int(20) NOT NULL,
  `CodigoProd` varchar(30) NOT NULL,
  `CantidadProductos` int(20) NOT NULL,
  `PrecioProd` decimal(30,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle`
--

INSERT INTO `detalle` (`NumPedido`, `CodigoProd`, `CantidadProductos`, `PrecioProd`) VALUES
(10, 'pa001', 1, '5000.00'),
(11, 'pa001', 2, '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `niveles`
--

CREATE TABLE `niveles` (
  `CodNivel` int(11) NOT NULL,
  `Nivel` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `niveles`
--

INSERT INTO `niveles` (`CodNivel`, `Nivel`, `Fecha`) VALUES
(1, 'Administrador del sistema', '2018-07-02 14:31:15'),
(2, 'Almacenista', '2018-07-02 14:31:15'),
(3, 'Tesorero', '2018-07-02 14:31:15'),
(4, 'Gerente de Comercialización', '2018-07-02 14:31:15'),
(5, 'Gerente de General', '2018-07-02 14:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int(20) NOT NULL,
  `CodigoProd` varchar(30) NOT NULL,
  `NombreProd` varchar(30) NOT NULL,
  `CodigoCat` varchar(30) NOT NULL,
  `Precio` decimal(30,2) NOT NULL,
  `Descuento` int(2) NOT NULL,
  `Presentación` varchar(30) NOT NULL,
  `Marca` varchar(30) NOT NULL,
  `Stock` int(20) NOT NULL,
  `RIFProveedor` varchar(30) NOT NULL,
  `Imagen` varchar(150) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `CodigoProd`, `NombreProd`, `CodigoCat`, `Precio`, `Descuento`, `Presentación`, `Marca`, `Stock`, `RIFProveedor`, `Imagen`, `Nombre`, `Estado`) VALUES
(1, 'HG-01', 'Papel Institucional 9 Pulgadas', '02', '20000.00', 0, 'Bulto de 6 Rollos', 'PAVECA', 19, '305837260', 'HG-01.jpg', 'admin', 'Activo'),
(2, 'pa001', 'Resma', '01', '5000.00', 0, 'Resma 500 Hojas', 'Alpes', 10, '305837260', 'pa001.png', 'admin', 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `RIFProveedor` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `NombreCompleto` varchar(70) NOT NULL,
  `Clave` text NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`RIFProveedor`, `Nombre`, `NombreCompleto`, `Clave`, `Direccion`, `Telefono`, `Email`) VALUES
('305837260', 'emiru48', 'Emir Urbano', '81dc9bdb52d04dc20036dbd8313ed055', 'Puerto la Cruz, Estado Anzoátegui', '04148283661', 'emiru48@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `NumPedido` int(20) NOT NULL,
  `Fecha` varchar(150) NOT NULL,
  `RIF` varchar(30) NOT NULL,
  `TotalPagar` decimal(30,2) NOT NULL,
  `Estado` varchar(150) NOT NULL,
  `NumeroDeposito` varchar(50) NOT NULL,
  `TipoEnvio` varchar(37) NOT NULL,
  `NombreEnvio` varchar(70) NOT NULL,
  `DirEnvio` varchar(200) NOT NULL,
  `TlfEnvio` varchar(20) NOT NULL,
  `Adjunto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`NumPedido`, `Fecha`, `RIF`, `TotalPagar`, `Estado`, `NumeroDeposito`, `TipoEnvio`, `NombreEnvio`, `DirEnvio`, `TlfEnvio`, `Adjunto`) VALUES
(10, '04-07-2018', '16068389', '5000.00', 'verificado', '565555555555555555', 'Recoger Por Tienda', 'Jose', 'bna', '04121805865', 'Sin archivo adjunto'),
(11, '04-07-2018', '16068389', '10000.00', 'verificado', '565555555555555555', 'Recoger Por Tienda', 'Jose', 'bna', '04121805865', 'Sin archivo adjunto');

-- --------------------------------------------------------

--
-- Table structure for table `verificado`
--

CREATE TABLE `verificado` (
  `CodVerf` int(11) NOT NULL,
  `NumPedido` int(11) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `verificado`
--

INSERT INTO `verificado` (`CodVerf`, `NumPedido`, `Estado`, `Fecha`) VALUES
(3, 1, 1, '0000-00-00 00:00:00'),
(4, 3, 1, '0000-00-00 00:00:00'),
(5, 4, 1, '0000-00-00 00:00:00'),
(6, 5, 1, '0000-00-00 00:00:00'),
(7, 6, 1, '0000-00-00 00:00:00'),
(8, 7, 1, '0000-00-00 00:00:00'),
(9, 8, 1, '0000-00-00 00:00:00'),
(10, 9, 1, '0000-00-00 00:00:00'),
(11, 10, 1, '0000-00-00 00:00:00'),
(12, 11, 1, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`CodCarrito`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CodigoCat`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`RIF`);

--
-- Indexes for table `cuentabanco`
--
ALTER TABLE `cuentabanco`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalle`
--
ALTER TABLE `detalle`
  ADD KEY `NumPedido` (`NumPedido`),
  ADD KEY `CodigoProd` (`CodigoProd`);

--
-- Indexes for table `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`CodNivel`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CodigoCat` (`CodigoCat`),
  ADD KEY `NITProveedor` (`RIFProveedor`),
  ADD KEY `Agregado` (`Nombre`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`RIFProveedor`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`NumPedido`),
  ADD KEY `NIT` (`RIF`);

--
-- Indexes for table `verificado`
--
ALTER TABLE `verificado`
  ADD PRIMARY KEY (`CodVerf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carrito`
--
ALTER TABLE `carrito`
  MODIFY `CodCarrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `cuentabanco`
--
ALTER TABLE `cuentabanco`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `niveles`
--
ALTER TABLE `niveles`
  MODIFY `CodNivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `NumPedido` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `verificado`
--
ALTER TABLE `verificado`
  MODIFY `CodVerf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`NumPedido`) REFERENCES `venta` (`NumPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`CodigoCat`) REFERENCES `categoria` (`CodigoCat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`RIFProveedor`) REFERENCES `proveedor` (`RIFProveedor`) ON UPDATE CASCADE;

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`RIF`) REFERENCES `cliente` (`RIF`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
