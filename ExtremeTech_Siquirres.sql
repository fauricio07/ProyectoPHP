-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: database
-- Tiempo de generación: 25-03-2020 a las 00:03:55
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
  `Descripcion` varchar(255) NOT NULL,
  `Marca` varchar(50) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Existencias` int(11) NOT NULL,
  `Foto` varchar(255) NOT NULL,
  `Descuento` int(11) NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  `Ced_UsuarioModificador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Articulos`
--

INSERT INTO `Articulos` (`Codigo`, `Descripcion`, `Marca`, `Precio`, `Categoria`, `Existencias`, `Foto`, `Descuento`, `Fecha_Modificacion`, `Ced_UsuarioModificador`) VALUES
(1, 'Monitor curvo 1500R de 24\", resolucion 1920x1080, frecuencia vertical 144 Hz, entradas HDMI - DisplayPort, tipo de panel MVA, AMD Freesync.', 'MSI', 159000, 'Monitores', 8, 'falta el URL de la imagen', 0, '2020-03-20', 702490253);

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
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
