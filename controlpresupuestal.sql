-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-04-2021 a las 18:35:05
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlpresupuestal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_costo`
--

CREATE TABLE `centro_costo` (
  `id` int(5) NOT NULL,
  `centro_costo` varchar(50) NOT NULL,
  `nom_ccosto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `centro_costo`
--

INSERT INTO `centro_costo` (`id`, `centro_costo`, `nom_ccosto`) VALUES
(1, 'NPP', 'Planta'),
(2, 'NPL', 'Logistica'),
(3, 'NPA', 'Adobo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_correos`
--

CREATE TABLE `control_correos` (
  `id` int(5) NOT NULL,
  `sum_gastos` int(50) NOT NULL,
  `centro_costo` int(5) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `control_correos`
--

INSERT INTO `control_correos` (`id`, `sum_gastos`, `centro_costo`, `fecha`) VALUES
(1, 0, 1, '2021-04-06'),
(2, 0, 2, '2021-04-06'),
(3, 0, 3, '2021-04-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `articulo` varchar(100) NOT NULL,
  `valor_total` varchar(50) NOT NULL,
  `centro_costo` int(5) NOT NULL,
  `proveedor` varchar(100) NOT NULL,
  `detalles` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20210311203247, 'TableUsuarios', '2021-03-13 03:04:37', '2021-03-13 03:04:37', 0),
(20210317151052, 'Tablecentrocosto', '2021-03-17 21:16:06', '2021-03-17 21:16:06', 0),
(20210317160115, 'Tablecentrocosto', '2021-03-17 22:06:35', '2021-03-17 22:06:35', 0),
(20210317160317, 'TableMantenimiento', '2021-03-17 22:06:35', '2021-03-17 22:06:35', 0),
(20210317183516, 'Tablecentrocosto', '2021-03-18 00:39:05', '2021-03-18 00:39:05', 0),
(20210317183957, 'Tablemantenimiento', '2021-03-18 00:51:40', '2021-03-18 00:51:40', 0),
(20210317190929, 'TableCentroCosto', '2021-03-18 01:17:04', '2021-03-18 01:17:04', 0),
(20210317191828, 'TableCentroscostoMantenimiento', '2021-03-18 01:19:09', '2021-03-18 01:19:09', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE `presupuesto` (
  `id` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `centro_costo` int(5) NOT NULL,
  `presupuesto` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_empleado` varchar(25) NOT NULL,
  `contra_empleado` varchar(255) NOT NULL,
  `nivel_acceso` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_empleado`, `contra_empleado`, `nivel_acceso`) VALUES
('1', 'admin', '1'),
('admin', 'admin', '1'),
('prueba', 'prueba', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nivel_acceso` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `centro_costo`
--
ALTER TABLE `centro_costo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `control_correos`
--
ALTER TABLE `control_correos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centro_costo` (`centro_costo`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centro_costo` (`centro_costo`);

--
-- Indices de la tabla `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centro_costo` (`centro_costo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_empleado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `centro_costo`
--
ALTER TABLE `centro_costo`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `control_correos`
--
ALTER TABLE `control_correos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `control_correos`
--
ALTER TABLE `control_correos`
  ADD CONSTRAINT `control_correos_ibfk_1` FOREIGN KEY (`centro_costo`) REFERENCES `centro_costo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `mantenimiento_ibfk_1` FOREIGN KEY (`centro_costo`) REFERENCES `centro_costo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD CONSTRAINT `presupuesto_ibfk_1` FOREIGN KEY (`centro_costo`) REFERENCES `centro_costo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
