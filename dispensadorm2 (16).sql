-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2022 a las 19:46:47
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
(1, 'Luna', '33159002', '2022-07-01 23:05:00', '2022-07-01 23:05:05'),
(2, 'Rex', '99F5FCB8', '2022-07-04 23:10:30', '2022-07-04 23:10:34'),
(3, 'Rex', '99F5FCB8', '2022-07-04 23:10:50', '2022-07-04 23:10:53'),
(4, 'Luna', '33159002', '2022-07-04 23:26:27', '2022-07-04 23:26:42'),
(5, 'Luna', '33159002', '2022-07-04 23:30:53', '2022-07-05 00:46:37'),
(6, 'Luna', '33159002', '2022-07-05 00:47:14', '2022-07-05 00:47:17'),
(7, 'Rex', '99F5FCB8', '2022-07-04 23:14:49', '2022-07-05 00:47:42'),
(8, 'Rex', '99F5FCB8', '2022-07-05 00:47:57', '2022-07-05 00:48:02'),
(9, 'Rex', '99F5FCB8', '2022-07-05 00:53:43', '2022-07-05 00:53:46'),
(10, 'Rex', '99F5FCB8', '2022-07-05 00:56:35', '2022-07-05 00:56:39'),
(11, 'Rex', '99F5FCB8', '2022-07-05 04:46:49', '2022-07-05 04:46:52'),
(12, 'Rex', '99F5FCB8', '2022-07-05 05:02:17', '2022-07-05 05:02:22');

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
(1, '99F5FCB8', 'Rex', 'doberman.jpg', 'Macho', 'Doberman', 6, 40, 600, 10, 6, '2', '2022-07-05 05:02:17', '2022-07-05 05:02:22', 0),
(139, '54159089', 'Thor', 'boxer-cachorro-1200x675.jpg', 'Macho', 'Boxer', 2, 10, 200, 2, 4, '0', '2022-07-04 03:37:44', '2022-07-04 03:00:00', 0),
(141, '33159001', 'Sol', 'cocker-spaniel_2.jpg', 'Hembra', 'Cocker', 9, 35, 350, 2, 6, '0', '2022-07-04 03:45:46', '2022-07-04 03:00:00', 0),
(153, '67159002', 'Toby', 'raza-pug-simpatico.jpg.jpg', 'Macho', 'Pug', 3, 5, 300, 3, 4, '0', '2022-07-04 03:57:21', '2022-07-04 03:00:00', 0),
(158, '33159002', 'Luna', 'mascotas-perros-razas-caniche-668x400x80xX.jpg', 'Hembra', 'Caniche', 7, 7, 300, 3, 3, '0', '2022-07-05 00:47:14', '2022-07-05 00:47:17', 0);

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
(14, 'luis', 'luis@kjasd.com', 'luis', 0, 0, '2022-07-04 23:02:28');

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
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
