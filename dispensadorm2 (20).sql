-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2022 a las 00:17:55
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
-- Base de datos: `feedit`
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
(55);

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
  `comido` int(11) NOT NULL,
  `peso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`identificador`, `nombre`, `rfid`, `horaEntrada`, `horaSalida`, `dispensado`, `comido`, `peso`) VALUES
(1, 'Toby', '99F5FCB8', '2022-07-19 01:48:45', '2022-07-19 01:48:57', 100, 101, -1),
(3, 'Luna', '33159002', '2022-07-19 01:53:47', '2022-07-19 01:54:21', 500, 472, 28),
(4, 'Luna', '33159002', '2022-07-19 01:55:19', '2022-07-19 01:55:44', 300, 302, -2),
(5, 'Toby', '99F5FCB8', '2022-07-19 01:56:25', '2022-07-19 01:56:34', 100, 102, -2),
(6, 'Toby', '99F5FCB8', '2022-07-19 02:32:50', '2022-07-19 02:33:47', 100, 102, -2),
(7, 'Toby', '99F5FCB8', '2022-07-19 02:35:35', '2022-07-19 02:37:07', 100, 72, 28),
(8, 'Luna', '33159002', '2022-07-19 02:38:43', '2022-07-19 02:38:53', 300, 301, -1),
(9, 'Toby', '99F5FCB8', '2022-07-19 03:22:09', '2022-07-19 03:22:52', 100, 102, -2),
(10, 'Toby', '99F5FCB8', '2022-07-19 03:25:07', '2022-07-19 03:26:43', 100, 71, 29),
(11, 'Luna', '33159002', '2022-07-19 03:29:28', '2022-07-19 03:31:08', 300, 208, 92),
(12, 'Toby', '99F5FCB8', '2022-07-19 03:33:02', '2022-07-19 03:34:53', 100, 100, 0),
(13, 'Toby', '99F5FCB8', '2022-07-19 03:36:28', '2022-07-19 03:36:34', 100, 101, -1),
(14, 'Toby', '99F5FCB8', '2022-07-19 03:41:08', '2022-07-19 03:42:09', 200, 171, 29),
(15, 'Luna', '33159002', '2022-07-19 20:38:37', '2022-07-19 20:39:13', 300, 268, 32),
(16, 'Luna', '33159002', '2022-07-19 20:53:13', '2022-07-19 20:53:28', 300, 206, 94),
(17, 'Luna', '33159002', '2022-07-19 20:54:36', '2022-07-19 20:54:41', 300, 61, 239),
(18, 'Luna', '33159002', '2022-07-19 21:09:49', '2022-07-19 21:10:13', 300, 299, 1),
(19, 'Luna', '33159002', '2022-07-19 21:11:06', '2022-07-19 21:11:10', 300, 59, 241),
(20, 'Luna', '33159002', '2022-07-19 21:12:03', '2022-07-19 21:12:09', 300, 59, 241),
(21, 'Luna', '33159002', '2022-07-19 21:26:18', '2022-07-19 21:26:47', 300, 268, 32),
(22, 'Toby', '99F5FCB8', '2022-07-19 21:30:02', '2022-07-19 21:30:10', 100, 68, 32),
(23, 'Toby', '99F5FCB8', '2022-07-19 22:00:01', '2022-07-19 22:00:16', 100, 71, 29),
(25, 'Toby', '99F5FCB8', '2022-07-19 22:11:16', '2022-07-19 22:11:21', 100, 1, 99),
(26, 'Toby', '99F5FCB8', '2022-07-19 22:12:16', '2022-07-19 22:12:33', 100, 71, 29),
(27, 'Toby', '99F5FCB8', '2022-07-19 22:14:19', '2022-07-19 22:14:26', 100, 0, 172),
(28, 'Luna', '33159002', '2022-07-19 23:38:16', '2022-07-19 23:38:47', 300, 270, 30),
(29, 'Luna', '33159002', '2022-07-20 03:06:25', '2022-07-20 03:07:30', 300, 204, 96),
(31, 'Luna', '33159002', '2022-07-20 03:09:44', '2022-07-20 03:10:12', 300, 270, 30),
(32, 'Luna', '33159002', '2022-07-20 03:12:44', '2022-07-20 03:13:12', 300, 300, 0),
(33, 'Luna', '33159002', '2022-07-20 03:14:03', '2022-07-20 03:14:32', 300, 253, 47),
(34, 'Toby', '99F5FCB8', '2022-07-20 16:52:01', '2022-07-20 16:52:26', 100, 70, 30),
(35, 'Luna', '33159002', '2022-07-20 18:47:43', '2022-07-20 18:48:14', 0, 0, 0),
(36, 'Toby', '99F5FCB8', '2022-07-20 18:48:51', '2022-07-20 18:49:01', 100, 0, 238),
(37, 'Luna', '33159002', '2022-07-20 18:49:52', '2022-07-20 18:50:02', 300, 61, 239),
(38, 'Luna', '33159002', '2022-07-20 18:50:22', '2022-07-20 18:50:50', 300, 270, 30),
(39, 'Toby', '99F5FCB8', '2022-07-20 20:15:16', '2022-07-20 20:15:22', 100, 60, 40);

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
(187, '0349LKAJUSD', 'Rocky', 'yorkshire-terrier-im-grass-768x567.jpg', 'Macho', 'Yorkshire', 10, 8, 250, 3, 3, '0', '2022-07-18 18:31:40', '2022-07-18 03:00:00', 0),
(195, '897564342', 'Astor', 'mascotas-perros-razas-caniche-668x400x80xX.jpg', 'Macho', 'Caniche', 10, 10, 100, 1, 2, '0', '2022-07-18 21:49:53', '2022-07-18 03:00:00', 0),
(197, '99F5FCB8', 'Toby', 'toby.jpg', 'Macho', 'Labrador', 7, 25, 1000, 10, 5, '3', '2022-07-20 20:15:16', '2022-07-20 20:15:22', 0),
(198, '33159002', 'Luna', 'depositphotos_8405161-stock-photo-yellow-labrador-retriever.jpg', 'Hembra', 'Labrador', 10, 30, 3000, 10, 1, '7', '2022-07-20 18:50:22', '2022-07-20 18:50:50', 0);

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
(1, 'gaston', 'gastonmourelle99@gmail.com', 'feedit', 1, 0, '2022-07-03 06:23:19'),
(14, 'luis', 'luis@kjasd.com', 'luis', 0, 0, '2022-07-04 23:02:28'),
(15, 'mourelle', 'gbhf@gmail.com', 'mourelle', 0, 0, '2022-07-12 01:25:28'),
(16, 'multimedia', 'multimedia@prueba.com', 'multimedia', 0, 0, '2022-07-18 20:41:16'),
(17, 'gaston_mourelle', 'gaston_mourelle@gmail.com', 'gaston', 0, 0, '2022-07-18 21:04:19'),
(18, 'gastonmourelle', 'gastonmourelle@gmail.com', 'gaston', 0, 0, '2022-07-18 21:39:58'),
(19, 'prueba', 'prueba@gmail.com', 'prueba', 0, 0, '2022-07-19 01:38:40'),
(20, 'prueba2', 'prueba2@gmail.com', 'prueba2', 0, 0, '2022-07-19 03:39:54');

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
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
