-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2015 a las 22:52:35
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Quiz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `nomApellidos` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `telefono` int(9) NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `otrosIntereses` text NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`nomApellidos`, `email`, `password`, `telefono`, `especialidad`, `otrosIntereses`, `foto`) VALUES
('Juan Perez Corta', 'jvadillo101@ikasle.ehu.es', 'e10adc3949ba59abbe56e057f20f883e', 123456789, 'Robotica', 'qweqweqwe', ''),
('Juan Perez Corta', 'jvadillo102@ikasle.ehu.es', 'e10adc3949ba59abbe56e057f20f883e', 123456789, 'Robotica', 'qweqweqwe', ''),
('Juan Perez Corta', 'jvadillo103@ikasle.ehu.es', 'e10adc3949ba59abbe56e057f20f883e', 123456789, 'Robotica', 'qweqweqwe', ''),
('Juan Perez Corta', 'jvadillo105@ikasle.ehu.es', 'e10adc3949ba59abbe56e057f20f883e', 123456789, 'hardware', 'asdasd', ''),
('Juan Perez Corta', 'jvadillo106@ikasle.ehu.es', 'e10adc3949ba59abbe56e057f20f883e', 123456789, 'hardware', 'asdasd', ''),
('Juan Perez Corta', 'jvadillo107@ikasle.ehu.es', 'e10adc3949ba59abbe56e057f20f883e', 123456789, 'hardware', 'asdasd', ''),
('Juan Perez Corta', 'jvadillo108@ikasle.ehu.es', 'e10adc3949ba59abbe56e057f20f883e', 123456789, 'hardware', 'asdasd', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
