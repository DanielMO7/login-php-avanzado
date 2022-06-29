-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2022 a las 16:32:03
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `documento` varchar(120) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `rol` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `email`, `documento`, `contrasena`, `rol`, `estado`) VALUES
(75, 'Daniel Mendez Ospina', 'daniel@gmail.com', '1', '$2y$10$xjBefc.bpHF16Xz3mLyRCeEvz1x5E4nxCJL0URNwsUgo1mtrWnz26', 'Administrador', 1),
(76, 'Juan Camilo Velez', 'juan@gmail.com', '2', '$2y$10$PIindG6p0o2pUGFs8j1Eh..hXYA4k7WvdH2dRucexT9SJMcn9wU3i', 'Empleado', 1),
(77, '', '', '', '$2y$10$uNToqinNi/sgT1JYBnv9nu4AGZjLG7aWoWO2xyUrHkYKopHC4Dy0a', 'Administrador', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `documento` (`documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
