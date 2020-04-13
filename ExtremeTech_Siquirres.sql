-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: database
-- Tiempo de generación: 13-04-2020 a las 07:07:23
-- Versión del servidor: 5.7.29
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ExtremeTech_Siquirres`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Articulos`
--

CREATE TABLE `Articulos` (
  `Codigo` int(11) NOT NULL,
  `Descripcion` mediumtext NOT NULL,
  `Marca` varchar(50) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Existencias` int(11) NOT NULL,
  `Foto` varchar(255) NOT NULL,
  `Fecha_Modificacion` varchar(15) NOT NULL,
  `Ced_UsuarioModificador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Articulos`
--

INSERT INTO `Articulos` (`Codigo`, `Descripcion`, `Marca`, `Precio`, `Categoria`, `Existencias`, `Foto`, `Fecha_Modificacion`, `Ced_UsuarioModificador`) VALUES
(1, 'Monitor curvo 1500R de 24\", resolucion 1920x1080, frecuencia vertical 144 Hz, entradas HDMI - DisplayPort, tipo de panel MVA, AMD Freesync.', 'MSI', 159000, 'Monitores', 8, 'img/Monitores/msi-optix-mag241c-144-hz-1-ms-freesync.jpg', '2020-03-20', 702490253),
(2, 'ASUS VIVOBOOK X540UA - CORE I3 8130 - 4 GB RAM - Memoria 4 GB DDR4 2400 - Intel HD Graphics 620 - Disco Duro 1 TB - Pantalla 15\" 1366 x 768 resolución', 'ASUS', 244000, 'Laptops', 5, 'img/Computadoras/asus-vivobook-x540ma.jpg', '2020-04-04', 702490253),
(3, 'ASUS ROG STRIX SCAR II - Pantalla: 17.3 pulgadas – 1920 x 1080 resolución - 144 Hz - 3 ms - Procesador: Intel Core i7 8750H - Memoria: 16 GB DDR4 2666 - Graficos: NVIDIA GeForce RTX 2070 8 GB - Disco Duro: 1 TB SSHD Hibrido / Seagate Firecuda - Disco SSD: 256 GB.', 'ASUS', 1215000, 'Laptop', 5, 'img/pc1.jpg', '2020-04-12', 702490253),
(4, 'ASUS ROG STRIX G531GT - Pantalla: 15 pulgadas – 1920 x 1080 resolución - Procesador: Intel Core i7 9750H - Memoria: 8 GB DDR4 2666 - Graficos: NVIDIA GeForce GTX 1650 4 GB - Disco SSD: 512 GB M.2 NVME.', 'ASUS', 725000, 'Laptops', 7, 'img/pc2.jpg', '2020-04-12', 702490253),
(5, 'ASUS VIVOBOOK X540UA - Pantalla: 15 pulgadas – 1366 x 768 resolución - Procesador: Intel Core i3 8130U - Memoria: 4 GB DDR4 2400 - Graficos: Intel HD Graphics 620 - Disco Duro: 1 TB.', 'ASUS', 244000, 'Laptops', 10, 'img/pc3.jpg', '2020-04-12', 702490253);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `Cedula` int(11) NOT NULL,
  `Nombre_Completo` varchar(50) NOT NULL,
  `Foto` varchar(255) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  `Ced_UsuarioCreador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`Cedula`, `Nombre_Completo`, `Foto`, `Correo`, `Contraseña`, `Descripcion`, `Fecha_Creacion`, `Fecha_Modificacion`, `Ced_UsuarioCreador`) VALUES
(702490253, 'Fauricio Alonso Calderon Quintana', 'falta URL de la imagen', 'a-fauriciocq@hotmail.com', 'alonso123', 'Usuario administrador', '2020-03-20', '2020-03-20', 702490253);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Articulos`
--
ALTER TABLE `Articulos`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`Cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Articulos`
--
ALTER TABLE `Articulos`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
