-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2022 a las 06:11:37
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `constructora`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler`
--

CREATE TABLE `alquiler` (
  `id` int(11) NOT NULL,
  `cliente` int(11) DEFAULT NULL,
  `maquinaria` int(11) DEFAULT NULL,
  `fechaentrega` date DEFAULT NULL,
  `fechadevolucion` date NOT NULL,
  `fechadevuelve` date DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `garantia` double DEFAULT NULL,
  `multa` double NOT NULL,
  `total` double NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `alquiler`
--

INSERT INTO `alquiler` (`id`, `cliente`, `maquinaria`, `fechaentrega`, `fechadevolucion`, `fechadevuelve`, `importe`, `descuento`, `garantia`, `multa`, `total`, `status`) VALUES
(1, 1, 1, '2022-07-14', '2022-07-21', NULL, 700, 10, 70, 0, 0, 0),
(2, 1, 1, '2022-07-18', '2022-07-27', NULL, 900, 90, 81, 0, 891, 0),
(3, 1, 1, '2022-07-18', '2022-07-28', NULL, 1000, 100, 90, 0, 990, 0),
(4, 1, 1, '2022-07-18', '2022-07-27', '2022-07-19', 900, 90, 81, 0, 891, 1),
(5, 2, 1, '2022-07-18', '2022-07-20', NULL, 200, 0, 20, 0, 220, 0),
(6, 2, 1, '2022-07-11', '2022-07-13', NULL, 200, 0, 20, 0, 220, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cedula` varchar(11) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombres` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `apellidos` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `direccion` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecharegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `cedula`, `nombres`, `apellidos`, `direccion`, `telefono`, `email`, `fecharegistro`) VALUES
(1, '0707059945', 'Jhonatan rafael ', 'Iñiguez Rodriguez ', 'machala libre ', '0979276437', 'urbanwolf1998@gmail.com', '2022-07-14 01:12:05'),
(2, '1105803546', 'alice', 'jaramillo', 'machala libre ', '0979276437', 'urbanwolf1998@gmail.com', '2022-07-18 22:42:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinaria`
--

CREATE TABLE `maquinaria` (
  `id` int(11) NOT NULL,
  `codigo` varchar(3) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `maquina` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tarifa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `maquinaria`
--

INSERT INTO `maquinaria` (`id`, `codigo`, `maquina`, `tarifa`) VALUES
(1, 'C01', 'Tractores', 100),
(2, 'C02', 'Mezcladores', 50),
(3, 'C03', 'Volquetas', 150);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `maquinaria` (`maquinaria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD CONSTRAINT `alquiler_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `alquiler_ibfk_2` FOREIGN KEY (`maquinaria`) REFERENCES `maquinaria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
