-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2022 a las 18:35:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dispensadorm2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `identificador` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `rfid` varchar(255) NOT NULL,
  `horaEntrada` timestamp NOT NULL DEFAULT current_timestamp(),
  `horaSalida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`identificador`, `nombre`, `rfid`, `horaEntrada`, `horaSalida`) VALUES
(1, 'Rex', '99F5FCB8', '2022-06-27 03:10:59', '2022-06-27 03:10:59'),
(2, 'Rex', '99F5FCB8', '2022-06-27 03:11:14', '2022-06-27 03:11:14'),
(3, 'Luna', '33159002', '2022-06-27 03:11:18', '2022-06-27 03:11:18'),
(4, 'Rex', '99F5FCB8', '2022-06-27 03:12:02', '2022-06-27 03:12:02'),
(5, 'Rex', '99F5FCB8', '2022-06-27 03:31:11', '2022-06-27 03:31:11'),
(6, 'Luna', '33159002', '2022-06-27 03:36:18', '2022-06-27 03:36:18'),
(7, 'Rex', '99F5FCB8', '2022-06-27 03:36:20', '2022-06-27 03:36:20'),
(8, 'Luna', '33159002', '2022-06-27 03:39:07', '2022-06-27 03:39:07'),
(9, 'Rex', '99F5FCB8', '2022-06-27 03:39:09', '2022-06-27 03:39:09'),
(10, 'Rex', '99F5FCB8', '2022-06-27 04:02:48', '2022-06-27 04:02:48'),
(11, 'Rex', '99F5FCB8', '2022-06-27 17:21:28', '2022-06-27 17:21:28'),
(12, 'Rex', '99F5FCB8', '2022-06-27 17:21:33', '2022-06-27 17:21:33'),
(13, 'Luna', '33159002', '2022-06-27 23:52:46', '2022-06-27 23:52:46'),
(14, 'Rex', '99F5FCB8', '2022-06-27 23:52:53', '2022-06-27 23:52:53'),
(15, 'Luna', '33159002', '2022-06-27 23:53:01', '2022-06-27 23:53:01'),
(16, 'Luna', '33159002', '2022-06-27 23:53:07', '2022-06-27 23:53:07'),
(17, 'Luna', '33159002', '2022-06-29 00:37:36', '2022-06-29 00:37:36'),
(18, 'Rex', '99F5FCB8', '2022-06-29 00:37:44', '2022-06-29 00:37:44'),
(19, 'Rex', '99F5FCB8', '2022-06-29 00:37:58', '2022-06-29 00:37:58'),
(20, 'Rex', '99F5FCB8', '2022-06-29 00:38:03', '2022-06-29 00:38:03'),
(21, 'Luna', '33159002', '2022-06-29 00:38:12', '2022-06-29 00:38:12'),
(22, 'Luna', '33159002', '2022-06-29 00:38:18', '2022-06-29 00:38:18'),
(23, 'Rex', '99F5FCB8', '2022-06-29 00:42:43', '2022-06-29 00:42:43'),
(24, 'Luna', '33159002', '2022-06-29 00:55:53', '2022-06-29 00:55:53'),
(25, 'Rex', '99F5FCB8', '2022-06-29 15:01:58', '2022-06-29 15:01:58'),
(26, 'Rex', '99F5FCB8', '2022-06-29 15:02:07', '2022-06-29 15:02:07'),
(27, 'Rex', '99F5FCB8', '2022-06-29 15:27:21', '2022-06-29 15:27:21'),
(28, 'Rex', '99F5FCB8', '2022-06-29 15:30:34', '2022-06-29 15:30:34'),
(29, 'Rex', '99F5FCB8', '2022-06-29 15:30:56', '2022-06-29 15:30:56'),
(30, 'Rex', '99F5FCB8', '2022-06-29 15:31:51', '2022-06-29 15:31:51'),
(31, 'Rex', '99F5FCB8', '2022-06-29 15:32:14', '2022-06-29 15:32:14'),
(32, 'Rex', '99F5FCB8', '2022-06-29 15:33:44', '2022-06-29 15:33:44'),
(33, 'Rex', '99F5FCB8', '2022-06-29 15:34:06', '2022-06-29 15:34:06'),
(34, 'Rex', '99F5FCB8', '2022-06-29 15:35:19', '2022-06-29 15:35:19'),
(35, 'Rex', '99F5FCB8', '2022-06-29 15:36:15', '2022-06-29 15:36:15'),
(36, 'Rex', '99F5FCB8', '2022-06-29 15:37:13', '2022-06-29 15:37:13'),
(37, 'Rex', '99F5FCB8', '2022-06-29 15:37:53', '2022-06-29 15:37:53'),
(38, 'Rex', '99F5FCB8', '2022-06-29 15:38:53', '2022-06-29 15:38:53'),
(39, 'Rex', '99F5FCB8', '2022-06-29 15:39:18', '2022-06-29 15:39:18'),
(40, 'Rex', '99F5FCB8', '2022-06-29 15:39:51', '2022-06-29 15:39:51'),
(41, 'Rex', '99F5FCB8', '2022-06-29 15:40:25', '2022-06-29 15:40:25'),
(42, 'Rex', '99F5FCB8', '2022-06-29 15:41:11', '2022-06-29 15:41:11'),
(43, 'Rex', '99F5FCB8', '2022-06-29 15:41:50', '2022-06-29 15:41:50'),
(44, 'Rex', '99F5FCB8', '2022-06-29 15:43:57', '2022-06-29 15:43:57'),
(45, 'Rex', '99F5FCB8', '2022-06-29 15:44:18', '2022-06-29 15:44:18'),
(46, 'Rex', '99F5FCB8', '2022-06-29 15:46:29', '2022-06-29 15:46:29'),
(47, 'Rex', '99F5FCB8', '2022-06-29 15:47:43', '2022-06-29 15:47:43'),
(48, 'Rex', '99F5FCB8', '2022-06-29 15:58:42', '2022-06-29 15:58:42'),
(49, 'Rex', '99F5FCB8', '2022-06-29 15:59:25', '2022-06-29 15:59:25'),
(50, 'Rex', '99F5FCB8', '2022-06-29 16:15:13', '2022-06-29 16:15:13'),
(51, 'Rex', '99F5FCB8', '2022-06-29 16:16:06', '2022-06-29 16:16:06'),
(52, 'Rex', '99F5FCB8', '2022-06-29 16:16:30', '2022-06-29 16:16:30'),
(53, 'Rex', '99F5FCB8', '2022-06-29 16:21:57', '2022-06-29 16:21:57'),
(54, 'Rex', '99F5FCB8', '2022-06-29 16:22:19', '2022-06-29 16:22:19'),
(55, 'Rex', '99F5FCB8', '2022-06-29 16:23:20', '2022-06-29 16:23:20'),
(56, 'Rex', '99F5FCB8', '2022-06-29 16:24:04', '2022-06-29 16:24:04'),
(57, 'Luna', '33159002', '2022-06-29 16:24:08', '2022-06-29 16:24:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perros`
--

CREATE TABLE `perros` (
  `identificador` int(11) NOT NULL,
  `id` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `sexo` enum('Macho','Hembra') NOT NULL,
  `raza` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `racion` int(11) NOT NULL,
  `turnos` int(11) NOT NULL,
  `cooldown` int(11) NOT NULL,
  `veces` varchar(255) NOT NULL,
  `ultima` timestamp NOT NULL DEFAULT current_timestamp(),
  `entro` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perros`
--

INSERT INTO `perros` (`identificador`, `id`, `nombre`, `foto`, `sexo`, `raza`, `edad`, `peso`, `racion`, `turnos`, `cooldown`, `veces`, `ultima`, `entro`) VALUES
(1, '99F5FCB8', 'Rex', 'sale', 'Macho', 'Doberman', 6, 40, 500, 3, 6, '2', '2022-06-29 16:24:04', 0),
(2, '33159002', 'Luna', 'sale', 'Hembra', 'Caniche', 6, 10, 300, 3, 4, '1', '2022-06-29 16:24:08', 0),
(12, '99F5FCB8as', 'Astor', '', 'Macho', 'Yorkshire', 8, 10, 200, 2, 8, '0', '2022-06-27 03:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `pass`) VALUES
(1, 'gaston', 'dispensadorm2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `perros`
--
ALTER TABLE `perros`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
