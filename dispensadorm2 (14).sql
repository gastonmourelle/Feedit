-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2022 a las 06:00:57
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
(1, 'Rex', '99F5FCB8', '2022-07-01 23:10:26', '2022-07-01 23:26:35'),
(2, 'Rex', '99F5FCB8', '2022-07-01 23:28:23', '2022-07-01 23:32:01'),
(3, 'Luna', '33159002', '2022-07-01 23:32:23', '2022-07-01 23:32:27'),
(4, 'Rex', '99F5FCB8', '2022-07-01 23:56:45', '2022-07-01 23:56:54'),
(5, 'Rex', '99F5FCB8', '2022-07-01 23:57:25', '2022-07-01 23:57:30'),
(6, 'Luna', '33159002', '2022-07-02 00:06:37', '2022-07-02 04:53:55'),
(7, 'Luna', '33159002', '2022-07-02 07:34:56', '2022-07-02 07:35:02'),
(8, 'Rex', '99F5FCB8', '2022-07-02 08:08:13', '2022-07-02 08:08:24'),
(9, 'Rex', '99F5FCB8', '2022-07-02 19:01:46', '2022-07-02 19:02:29'),
(10, 'Luna', '33159002', '2022-07-02 19:58:44', '2022-07-02 19:58:48'),
(11, 'Rex', '99F5FCB8', '2022-07-02 21:09:07', '2022-07-02 22:02:10'),
(12, 'Rex', '99F5FCB8', '2022-07-02 22:28:42', '2022-07-02 22:33:50'),
(13, 'Rex', '99F5FCB8', '2022-07-02 22:45:07', '2022-07-02 22:45:21'),
(14, 'Rex', '99F5FCB8', '2022-07-02 22:46:14', '2022-07-02 22:46:19'),
(15, 'Rex', '99F5FCB8', '2022-07-02 22:48:12', '2022-07-02 22:48:21'),
(16, 'Lunaa', '33159002', '2022-07-02 23:59:25', '2022-07-03 00:00:05'),
(17, 'Luna', '33159002', '2022-07-03 02:10:27', '2022-07-03 02:11:19'),
(18, 'Luna', '33159002', '2022-07-03 02:12:30', '2022-07-03 02:14:32'),
(19, 'Rex', '99F5FCB8', '2022-07-03 03:18:32', '2022-07-03 03:18:37'),
(20, 'Rex', '99F5FCB8', '2022-07-03 05:08:37', '2022-07-03 05:08:41'),
(21, 'Luna', '33159002', '2022-07-03 05:30:30', '2022-07-03 05:53:34'),
(22, 'Rex', '99F5FCB8', '2022-07-03 08:11:32', '2022-07-03 08:11:35'),
(23, 'Rex', '99F5FCB8', '2022-07-03 08:11:46', '2022-07-03 10:37:51'),
(25, 'Luna', '33159002', '2022-07-03 23:07:00', '2022-07-03 23:07:04'),
(26, 'Luna', '33159002', '2022-07-03 23:07:17', '2022-07-03 23:07:21'),
(27, 'Luna', '33159002', '2022-07-03 23:09:48', '2022-07-03 23:09:52'),
(28, 'Luna', '33159002', '2022-07-03 23:10:04', '2022-07-03 23:10:07'),
(29, 'Luna', '33159002', '2022-07-03 23:21:51', '2022-07-04 00:57:33'),
(30, 'Rex', '99F5FCB8', '2022-07-04 02:42:03', '2022-07-04 02:42:08'),
(31, 'Rex', '99F5FCB8', '2022-07-04 02:42:21', '2022-07-04 03:01:17'),
(32, 'Luna', '33159002', '2022-07-04 03:18:14', '2022-07-04 03:18:19'),
(33, 'Luna', '33159002', '2022-07-04 03:30:35', '2022-07-04 03:31:03'),
(34, 'Luna', '33159002', '2022-07-04 03:31:18', '2022-07-04 03:31:21');

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
(1, '99F5FCB8', 'Rex', 'doberman.jpg', 'Macho', 'Doberman', 6, 40, 600, 10, 6, '1', '2022-07-04 02:42:21', '2022-07-04 03:01:17', 0),
(92, '33159002', 'Luna', 'mascotas-perros-razas-caniche-668x400x80xX.jpg', 'Hembra', 'Caniche', 7, 6, 301, 3, 5, '3', '2022-07-04 03:31:18', '2022-07-04 03:31:21', 0),
(138, 'IAO9812034', 'Lola', 'pastor-aleman.jpg', 'Hembra', 'Ovejero alemán', 10, 40, 500, 2, 8, '0', '2022-07-04 03:33:41', '2022-07-04 03:00:00', 0),
(139, '293KJAA2908', 'Thor', 'boxer-cachorro-1200x675.jpg', 'Macho', 'Boxer', 2, 10, 200, 2, 4, '1', '2022-07-04 03:37:44', '2022-07-04 03:00:00', 0),
(140, '0ALKA230987', 'Minga', 'depositphotos_8405161-stock-photo-yellow-labrador-retriever.jpg', 'Hembra', 'Labrador Retriever', 7, 30, 400, 4, 6, '3', '2022-07-04 03:39:26', '2022-07-01 03:00:00', 0),
(141, '3498122938', 'Sol', 'cocker-spaniel_2.jpg', 'Hembra', 'Cocker', 9, 35, 350, 2, 6, '2', '2022-07-04 03:45:46', '2022-07-04 03:00:00', 0),
(153, '45398LASPAW32', 'Toby', 'raza-pug-simpatico.jpg.jpg', 'Macho', 'Pug', 3, 5, 300, 3, 4, '1', '2022-07-04 03:57:21', '2022-07-04 03:00:00', 0);

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
(5, 'yisf', 'asdpo@lkasd.com', 'asd', 0, 0, '2022-07-03 06:50:28'),
(6, 'ads', 'das@lkasd.com', 'll', 0, 0, '2022-07-03 06:50:56'),
(7, 'meli', 'meli@klasd.com', 'las', 0, 0, '2022-07-03 06:53:22'),
(8, 'asdwe', 'asd@lkasd.com', 'we', 0, 0, '2022-07-03 06:57:06'),
(9, 'pepe', 'pepe@tutu.com', 'pepe', 0, 0, '2022-07-03 07:23:05'),
(10, 'melina', 'melisa@lksd.com', 'pepe', 0, 0, '2022-07-03 07:26:08'),
(11, 'dsa', 'dsa@dsa.com', 'dsa', 0, 0, '2022-07-03 07:28:02'),
(12, 'meliii', 'meli@meli.com', 'asd', 0, 0, '2022-07-03 08:30:37');

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
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
