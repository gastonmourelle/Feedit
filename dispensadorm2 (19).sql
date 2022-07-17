-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2022 a las 23:34:12
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
-- Estructura de tabla para la tabla `almacenamiento`
--

CREATE TABLE `almacenamiento` (
  `ultrasonido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacenamiento`
--

INSERT INTO `almacenamiento` (`ultrasonido`) VALUES
(26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `identificador` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `rfid` varchar(255) NOT NULL,
  `horaEntrada` timestamp NOT NULL DEFAULT current_timestamp(),
  `horaSalida` timestamp NOT NULL DEFAULT current_timestamp(),
  `dispensado` int(11) NOT NULL,
  `peso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`identificador`, `nombre`, `rfid`, `horaEntrada`, `horaSalida`, `dispensado`, `peso`) VALUES
(1, 'Luna', '33159002', '2022-07-17 19:02:04', '2022-07-17 19:02:25', 150, -1),
(2, 'Rex', '99F5FCB8', '2022-07-17 19:02:35', '2022-07-17 19:02:50', 100, 29),
(3, 'Rex', '99F5FCB8', '2022-07-17 19:03:27', '2022-07-17 19:03:32', 50, 29),
(4, 'Rex', '99F5FCB8', '2022-07-17 19:03:53', '2022-07-17 19:03:58', 50, 93),
(5, 'Rex', '99F5FCB8', '2022-07-17 19:05:00', '2022-07-17 19:05:12', 50, 0),
(6, 'Luna', '33159002', '2022-07-17 19:09:33', '2022-07-17 19:09:56', 150, 93),
(7, 'Luna', '33159002', '2022-07-17 19:10:17', '2022-07-17 19:10:20', 150, 295),
(8, 'Rex', '99F5FCB8', '2022-07-17 19:10:30', '2022-07-17 19:10:32', 50, 295),
(9, 'Luna', '33159002', '2022-07-17 19:31:49', '2022-07-17 19:31:55', 200, 0),
(10, 'Luna', '33159002', '2022-07-17 19:32:34', '2022-07-17 19:33:11', 200, 0),
(11, 'Luna', '33159002', '2022-07-17 19:34:22', '2022-07-17 19:34:31', 100, 0),
(12, 'Luna', '33159002', '2022-07-17 19:34:45', '2022-07-17 19:35:19', 100, 30),
(13, 'Luna', '33159002', '2022-07-17 19:35:32', '2022-07-17 19:35:41', 100, 30),
(14, 'Luna', '33159002', '2022-07-17 19:36:04', '2022-07-17 19:36:11', 100, 295),
(15, 'Rex', '99F5FCB8', '2022-07-17 19:36:30', '2022-07-17 19:36:32', 50, 295),
(16, 'Rex', '99F5FCB8', '2022-07-17 19:36:44', '2022-07-17 19:36:47', 50, 30),
(17, 'Rex', '99F5FCB8', '2022-07-17 19:56:21', '2022-07-17 19:56:27', 50, 0),
(18, 'Luna', '33159002', '2022-07-17 19:56:45', '2022-07-17 19:57:01', 100, 0),
(19, 'Luna', '33159002', '2022-07-17 20:06:28', '2022-07-17 20:11:07', 50, 0),
(20, 'Luna', '33159002', '2022-07-17 20:11:38', '2022-07-17 20:11:44', 50, 0),
(21, 'Luna', '33159002', '2022-07-17 20:11:56', '2022-07-17 20:12:01', 50, 0),
(22, 'Luna', '33159002', '2022-07-17 20:12:16', '2022-07-17 20:12:20', 50, 30),
(23, 'Luna', '33159002', '2022-07-17 20:14:31', '2022-07-17 20:14:35', 50, 0),
(24, 'Rex', '99F5FCB8', '2022-07-17 20:14:51', '2022-07-17 20:15:01', 50, 0),
(25, 'Luna', '33159002', '2022-07-17 21:06:41', '2022-07-17 21:06:46', 50, 0),
(26, 'Luna', '33159002', '2022-07-17 21:07:00', '2022-07-17 21:07:06', 50, 0),
(27, 'Rex', '99F5FCB8', '2022-07-17 21:07:14', '2022-07-17 21:07:17', 100, 0),
(28, 'Rex', '99F5FCB8', '2022-07-17 21:07:35', '2022-07-17 21:07:36', 100, 0),
(29, 'Rex', '99F5FCB8', '2022-07-17 21:07:46', '2022-07-17 21:07:48', 100, 0),
(30, 'Rex', '99F5FCB8', '2022-07-17 21:08:08', '2022-07-17 21:08:22', 200, 0),
(31, 'Rex', '99F5FCB8', '2022-07-17 21:08:34', '2022-07-17 21:08:41', 100, 0),
(32, 'Rex', '99F5FCB8', '2022-07-17 21:12:08', '2022-07-17 21:12:30', 200, 0),
(33, 'Luna', '33159002', '2022-07-17 21:12:35', '2022-07-17 21:12:39', 50, 0),
(34, 'Rex', '99F5FCB8', '2022-07-17 21:12:50', '2022-07-17 21:12:52', 200, 295),
(35, 'Luna', '33159002', '2022-07-17 21:12:59', '2022-07-17 21:13:01', 50, 295),
(36, 'Luna', '33159002', '2022-07-17 21:13:48', '2022-07-17 21:13:54', 50, 0),
(37, 'Rex', '99F5FCB8', '2022-07-17 21:14:02', '2022-07-17 21:14:15', 200, 0),
(38, 'Rex', '99F5FCB8', '2022-07-17 21:14:49', '2022-07-17 21:14:51', 200, 294),
(39, 'Rex', '99F5FCB8', '2022-07-17 21:15:16', '2022-07-17 21:15:18', 200, 295),
(40, 'Rex', '99F5FCB8', '2022-07-17 21:24:23', '2022-07-17 21:25:11', 200, -1),
(41, 'Rex', '99F5FCB8', '2022-07-17 21:25:29', '2022-07-17 21:25:45', 200, -1),
(42, 'Luna', '33159002', '2022-07-17 21:26:12', '2022-07-17 21:26:16', 40, 0),
(43, 'Rex', '99F5FCB8', '2022-07-17 21:26:21', '2022-07-17 21:26:35', 200, -1),
(44, 'Rex', '99F5FCB8', '2022-07-17 21:26:45', '2022-07-17 21:26:49', 200, 295),
(45, 'Luna', '33159002', '2022-07-17 21:26:58', '2022-07-17 21:27:00', 40, 294),
(46, 'Luna', '33159002', '2022-07-17 21:27:16', '2022-07-17 21:27:19', 40, 29);

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
  `ultimaEntrada` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultimaSalida` timestamp NOT NULL DEFAULT current_timestamp(),
  `entro` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perros`
--

INSERT INTO `perros` (`identificador`, `id`, `nombre`, `foto`, `sexo`, `raza`, `edad`, `peso`, `racion`, `turnos`, `cooldown`, `veces`, `ultimaEntrada`, `ultimaSalida`, `entro`) VALUES
(173, '99F5FCB8', 'Rex', 'doberman.jpg', 'Macho', 'Doberman', 8, 30, 20000, 100, 3, '23', '2022-07-17 21:26:45', '2022-07-17 21:26:49', 0),
(176, '33159002', 'Luna', 'mascotas-perros-razas-caniche-668x400x80xX.jpg', 'Hembra', 'Caniche', 23, 2, 2000, 50, 3, '23', '2022-07-17 21:27:16', '2022-07-17 21:27:19', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `pass` varchar(255) NOT NULL,
  `rol` tinyint(4) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `email`, `pass`, `rol`, `estado`, `creado`) VALUES
(1, 'gaston', 'gastonmourelle99@gmail.com', 'dispensadorm2', 1, 0, '2022-07-03 06:23:19'),
(14, 'luis', 'luis@kjasd.com', 'luis', 0, 0, '2022-07-04 23:02:28'),
(15, 'mourelle', 'gbhf@gmail.com', 'mourelle', 0, 0, '2022-07-12 01:25:28');

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
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
