-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2022 a las 05:09:14
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
(1, 'Rex', '99F5FCB8', '2022-06-30 23:49:44', '2022-06-30 23:49:47'),
(2, 'Luna', '33159002', '2022-06-30 23:49:56', '2022-06-30 23:49:59'),
(3, 'Luna', '33159002', '2022-06-30 23:50:14', '2022-06-30 23:50:17'),
(4, 'Luna', '33159002', '2022-06-30 23:50:30', '2022-06-30 23:50:33'),
(5, 'Rex', '99F5FCB8', '2022-07-01 00:50:42', '2022-07-01 00:50:46'),
(6, 'Rex', '99F5FCB8', '2022-07-01 00:50:56', '2022-07-01 00:50:58'),
(7, 'Rex', '99F5FCB8', '2022-07-01 02:47:03', '2022-07-01 02:47:15'),
(8, 'Luna', '33159002', '2022-07-01 03:01:15', '2022-07-01 03:01:19'),
(9, 'Luna', '33159002', '2022-07-01 03:01:54', '2022-07-01 03:01:58'),
(10, 'Luna', '33159002', '2022-07-01 03:03:01', '2022-07-01 03:03:04'),
(11, 'Rex', '99F5FCB8', '2022-07-01 03:04:39', '2022-07-01 03:04:44'),
(12, 'Rex', '99F5FCB8', '2022-07-01 03:06:51', '2022-07-01 03:06:57');

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
(1, '99F5FCB8', 'Rex', 'doberman.jpg', 'Macho', 'Doberman', 6, 40, 700, 4, 6, '2', '2022-07-01 03:06:51', '2022-07-01 03:06:57', 0),
(13, '33159002', 'Luna', 'mascotas-perros-razas-caniche-668x400x80xX.jpg', 'Hembra', 'Caniche', 6, 7, 600, 3, 5, '0', '2022-07-01 03:03:01', '2022-07-01 03:03:04', 0);

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
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
