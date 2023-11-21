-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2023 a las 21:18:09
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_tiendadecomics`
--
DROP DATABASE IF EXISTS bd_tiendadecomics;
CREATE DATABASE IF NOT EXISTS bd_tiendadecomics;
USE bd_tiendadecomics;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comics`
--

CREATE TABLE `comics` (
  `idcomic` bigint(20) UNSIGNED NOT NULL,
  `nomcomic` varchar(255) NOT NULL,
  `proveedor` varchar(255) NOT NULL,
  `editorial` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `costo` decimal(5,2) NOT NULL,
  `inclusiones` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `existencia` decimal(5,2) NOT NULL DEFAULT '100.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comics`
--

INSERT INTO `comics` (`idcomic`, `nomcomic`, `proveedor`, `editorial`, `tipo`, `costo`, `inclusiones`, `img`, `existencia`) VALUES
(1, 'kanojo mo kanojo', 'Areli Martinez', 'paninimanga', 'manga', '150.00', 'contiene stikers de los personajes', 'kmk.jpg', '87.00'),
(2, 'carnage', 'José Pérez', 'Panini', 'revista', '283.00', 'contiene targetas coleccionables de regalo', 'carnage.jpg', '94.00'),
(3, 'Super Girl: La mujer del mañana', 'Itzel Yañez', 'comic universe', 'revista', '429.99', 'contiene una tarjeta coleccionable', 'superg.jpg', '100.00'),
(4, 'STAR WARS: DOCTOR APHRA VOL.5', 'Aramara Ortiz', 'panini comics', 'revista', '179.00', 'contiene stickers de la serie y trajetas coleccionables', 'swvol5.jpg', '94.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comics_vendidos`
--

CREATE TABLE `comics_vendidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcomic` bigint(20) UNSIGNED NOT NULL,
  `cantidad` bigint(20) UNSIGNED NOT NULL,
  `idventa` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comics_vendidos`
--

INSERT INTO `comics_vendidos` (`id`, `idcomic`, `cantidad`, `idventa`) VALUES
(1, 1, 9, 3),
(2, 4, 3, 4),
(3, 2, 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idventa` bigint(20) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idventa`, `fecha`, `total`) VALUES
(3, '2023-11-21 21:16:05', '1350.00'),
(4, '2023-11-21 21:16:47', '2235.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`idcomic`);

--
-- Indices de la tabla `comics_vendidos`
--
ALTER TABLE `comics_vendidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcomic` (`idcomic`),
  ADD KEY `idventa` (`idventa`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idventa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comics`
--
ALTER TABLE `comics`
  MODIFY `idcomic` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comics_vendidos`
--
ALTER TABLE `comics_vendidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idventa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comics_vendidos`
--
ALTER TABLE `comics_vendidos`
  ADD CONSTRAINT `comics_vendidos_ibfk_1` FOREIGN KEY (`idcomic`) REFERENCES `comics` (`idcomic`) ON DELETE CASCADE,
  ADD CONSTRAINT `comics_vendidos_ibfk_2` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`idventa`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
