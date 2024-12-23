-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2024 a las 17:01:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `orden_compra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprobaciones`
--

CREATE TABLE `aprobaciones` (
  `id` int(11) NOT NULL,
  `id_orden_compra` int(11) DEFAULT NULL,
  `id_aprobador` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fecha_aprobacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aprobaciones`
--

INSERT INTO `aprobaciones` (`id`, `id_orden_compra`, `id_aprobador`, `id_estado`, `fecha_aprobacion`) VALUES
(12, 181, 27, 2, NULL),
(13, 181, 17, 1, NULL),
(15, 183, 13, 2, NULL),
(16, 183, 11, 3, NULL),
(17, 183, 1, 2, NULL),
(18, 183, 11, 3, NULL),
(19, 183, 1, 2, NULL),
(20, 183, 11, 3, NULL),
(21, 183, 1, 2, NULL),
(22, 183, 11, 3, NULL),
(23, 183, 1, 2, NULL),
(24, 183, 11, 3, NULL),
(25, 183, 1, 2, NULL),
(26, 184, 13, 2, NULL),
(27, 184, 11, 3, NULL),
(28, 184, 1, 2, NULL),
(29, 185, 13, 2, NULL),
(30, 185, 11, 3, NULL),
(31, 185, 1, 2, NULL),
(32, 186, 13, 2, NULL),
(33, 186, 11, 3, NULL),
(34, 186, 1, 2, NULL),
(35, 187, 13, 2, NULL),
(36, 188, 13, 2, NULL),
(37, 187, 11, 3, NULL),
(38, 187, 1, 2, NULL),
(39, 188, 11, 3, NULL),
(40, 188, 1, 2, NULL),
(41, 189, 13, 2, NULL),
(42, 189, 11, 3, NULL),
(43, 189, 1, 2, NULL),
(44, 190, 13, 2, NULL),
(45, 190, 11, 3, NULL),
(46, 190, 1, 2, NULL),
(47, 191, 13, 2, NULL),
(48, 192, 13, 2, NULL),
(49, 193, 13, 2, NULL),
(50, 193, 11, 3, NULL),
(51, 193, 1, 2, NULL),
(52, 192, 11, 3, NULL),
(53, 192, 1, 2, NULL),
(54, 191, 11, 3, NULL),
(55, 191, 1, 2, NULL),
(56, 194, 13, 2, NULL),
(57, 195, 13, 2, NULL),
(58, 196, 13, 2, NULL),
(59, 197, 13, 2, NULL),
(60, 194, 11, 3, NULL),
(61, 194, 1, 2, NULL),
(62, 197, 11, 3, NULL),
(63, 197, 1, 2, NULL),
(64, 195, 11, 3, NULL),
(65, 195, 1, 2, NULL),
(66, 196, 11, 3, NULL),
(67, 196, 1, 2, NULL),
(68, 198, 13, 2, NULL),
(69, 198, 11, 3, NULL),
(70, 198, 1, 2, NULL),
(71, 199, 13, 2, NULL),
(72, 199, 11, 2, NULL),
(73, 199, 1, 2, NULL),
(74, 200, 13, 2, NULL),
(75, 200, 11, 3, NULL),
(76, 200, 1, 2, NULL),
(77, 201, 13, 2, NULL),
(78, 202, 13, 2, NULL),
(79, 203, 13, 2, NULL),
(81, 205, 13, 2, NULL),
(82, 206, 13, 2, NULL),
(83, 207, 13, 2, NULL),
(84, 207, 11, 3, NULL),
(85, 207, 1, 2, NULL),
(86, 201, 11, 3, NULL),
(87, 201, 1, 2, NULL),
(88, 206, 11, 3, NULL),
(89, 206, 1, 2, NULL),
(90, 205, 11, 3, NULL),
(91, 205, 1, 2, NULL),
(92, 203, 11, 3, NULL),
(93, 203, 1, 2, NULL),
(94, 202, 11, 3, NULL),
(95, 202, 1, 2, NULL),
(96, 208, 13, 2, NULL),
(97, 208, 11, 3, NULL),
(98, 208, 1, 2, NULL),
(99, 209, 13, 2, NULL),
(100, 209, 11, 3, NULL),
(101, 209, 1, 2, NULL),
(102, 210, 13, 2, NULL),
(103, 211, 13, 2, NULL),
(104, 211, 11, 3, NULL),
(105, 211, 1, 2, NULL),
(106, 210, 11, 3, NULL),
(107, 210, 1, 2, NULL),
(108, 212, 13, 2, NULL),
(109, 212, 11, 3, NULL),
(110, 212, 1, 2, NULL),
(111, 213, 13, 2, NULL),
(112, 214, 15, 2, NULL),
(113, 213, 11, 3, NULL),
(114, 213, 1, 2, NULL),
(115, 214, 17, 2, NULL),
(116, 214, 11, 3, NULL),
(117, 214, 1, 2, NULL),
(118, 215, 13, 2, NULL),
(119, 216, 13, 2, NULL),
(120, 216, 11, 3, NULL),
(121, 216, 1, 2, NULL),
(122, 215, 11, 3, NULL),
(123, 215, 1, 2, NULL),
(124, 215, 1, 2, NULL),
(126, 218, 13, 2, NULL),
(128, 219, 13, 2, NULL),
(129, 220, 13, 2, NULL),
(130, 219, 11, 2, NULL),
(131, 219, 1, 2, NULL),
(132, 221, 13, 2, NULL),
(133, 222, 13, 2, NULL),
(134, 221, 11, 3, NULL),
(135, 222, 11, 2, NULL),
(136, 222, 1, 2, NULL),
(137, 215, 1, 2, NULL),
(138, 221, 1, 2, NULL),
(140, 221, 1, 2, NULL),
(141, 223, 13, 2, NULL),
(142, 223, 11, 2, NULL),
(143, 223, 1, 2, NULL),
(144, 224, 13, 2, NULL),
(145, 225, 13, 2, NULL),
(146, 226, 13, 2, NULL),
(147, 227, 13, 2, NULL),
(148, 227, 11, 2, NULL),
(149, 226, 11, 2, NULL),
(150, 225, 11, 2, NULL),
(151, 224, 11, 2, NULL),
(152, 228, 13, 2, NULL),
(153, 229, 13, 2, NULL),
(154, 228, 11, 3, NULL),
(155, 229, 11, 2, NULL),
(156, 228, 1, 2, NULL),
(157, 230, 13, 2, NULL),
(158, 230, 11, 2, NULL),
(159, 231, 13, 2, NULL),
(160, 231, 11, 2, NULL),
(161, 232, 13, 2, NULL),
(162, 232, 11, 3, NULL),
(163, 232, 1, 2, NULL),
(164, 233, 13, 2, NULL),
(165, 233, 11, 3, NULL),
(166, 233, 1, 2, NULL),
(167, 234, 13, 2, NULL),
(168, 234, 11, 3, NULL),
(169, 235, 13, 2, NULL),
(170, 235, 11, 3, NULL),
(171, 234, 1, 2, NULL),
(172, 235, 1, 2, NULL),
(173, 236, 13, 2, NULL),
(174, 237, 13, 2, NULL),
(175, 237, 11, 3, NULL),
(176, 236, 11, 3, NULL),
(177, 237, 1, 2, NULL),
(178, 236, 1, 2, NULL),
(179, 238, 13, 2, NULL),
(180, 238, 11, 3, NULL),
(181, 238, 1, 2, NULL),
(182, 239, 13, 2, NULL),
(183, 239, 11, 3, NULL),
(184, 239, 1, 2, NULL),
(185, 240, 13, 2, NULL),
(186, 240, 11, 3, NULL),
(187, 240, 1, 2, NULL),
(188, 241, 13, 2, NULL),
(189, 242, 13, 2, NULL),
(190, 243, 13, 2, NULL),
(191, 243, 11, 2, NULL),
(192, 242, 11, 2, NULL),
(193, 241, 11, 3, NULL),
(194, 241, 1, 2, NULL),
(195, 244, 13, 2, NULL),
(196, 245, 13, 2, NULL),
(198, 247, 13, 2, NULL),
(200, 249, 13, 2, NULL),
(201, 249, 11, 3, NULL),
(202, 247, 11, 3, NULL),
(203, 247, 1, 2, NULL),
(204, 249, 1, 2, NULL),
(205, 250, 13, 2, NULL),
(206, 250, 11, 2, NULL),
(207, 250, 11, 2, NULL),
(209, 251, 13, 2, NULL),
(210, 251, 11, 2, NULL),
(211, 245, 11, 3, NULL),
(212, 251, 1, 3, NULL),
(213, 252, 13, 2, NULL),
(214, 252, 11, 2, NULL),
(215, 244, 11, 3, NULL),
(216, 244, 11, 3, NULL),
(217, 252, 1, 3, NULL),
(218, 245, 1, 2, NULL),
(219, 244, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id` int(11) NOT NULL,
  `id_proyecto_asignados` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id`, `id_proyecto_asignados`, `id_usuario`) VALUES
(1, 1, 41),
(22, 6, 15),
(23, 6, 19),
(24, 6, 20),
(25, 6, 23),
(26, 6, 24),
(27, 6, 25),
(28, 6, 26),
(29, 6, 27),
(30, 6, 29),
(31, 6, 30),
(32, 6, 31),
(33, 6, 35),
(34, 6, 32),
(35, 6, 39),
(36, 6, 40),
(37, 6, 24),
(38, 6, 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificativo`
--

CREATE TABLE `calificativo` (
  `id` int(11) NOT NULL,
  `calificativo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificativo`
--

INSERT INTO `calificativo` (`id`, `calificativo`) VALUES
(1, 'excelente'),
(2, 'No confiable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `codigo_ordenCompra` int(11) NOT NULL,
  `persona` int(11) NOT NULL,
  `tecnico` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `id_estado_compra` int(11) DEFAULT NULL,
  `proyecto` int(11) NOT NULL,
  `codigo_oc` varchar(255) DEFAULT NULL,
  `compra_per` int(11) DEFAULT NULL,
  `consecutivo` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `retencion` decimal(10,2) NOT NULL,
  `centro_costos` text DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `forma_pago` text DEFAULT NULL,
  `lugar_entrega` text DEFAULT NULL,
  `cotizacion` text DEFAULT NULL,
  `id_poliza` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `codigo_ordenCompra`, `persona`, `tecnico`, `valor`, `id_estado_compra`, `proyecto`, `codigo_oc`, `compra_per`, `consecutivo`, `fecha`, `id_proveedor`, `retencion`, `centro_costos`, `observacion`, `subtotal`, `forma_pago`, `lugar_entrega`, `cotizacion`, `id_poliza`) VALUES
(162, 184, 41, 13, 997500, 2, 3, '3-3', 47, 3, '2024-11-03', NULL, 12.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(163, 183, 41, 13, 12852000, 2, 3, '3-2', 47, 2, '2024-11-01', NULL, 8.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 185, 41, 13, 36645000, 2, 3, '3-4', 47, 4, '2024-11-03', NULL, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(165, 186, 41, 13, 2147483647, 2, 3, '3-5', 47, 5, '2024-11-05', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 188, 41, 13, 207900, 2, 3, '3-7', 47, 7, '2024-11-05', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 187, 41, 13, 10000, 2, 3, '3-6', 47, 6, '2024-11-05', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 189, 41, 13, 110000, 2, 3, '3-8', 47, 8, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(169, 190, 41, 13, 1329900, 2, 3, '3-9', 47, 9, '2024-11-06', NULL, 12.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 193, 41, 13, 12600, 2, 3, '3-12', 47, 12, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, 192, 41, 13, 256200, 2, 3, '3-11', 47, 11, '2024-11-06', NULL, 1.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, 191, 41, 13, 700000000, 2, 3, '3-10', 47, 10, '2024-11-06', NULL, 12.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, 197, 41, 13, 337050, 2, 3, '3-16', 47, 16, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 195, 41, 13, 1100, 2, 3, '3-14', 47, 14, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, 194, 41, 13, 20000, 2, 3, '3-13', 47, 13, '2024-11-06', NULL, 12.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(176, 196, 41, 13, 12600, 2, 3, '3-15', 47, 15, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(177, 198, 41, 13, 10500, 2, 3, '3-17', 47, 17, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(178, 199, 41, 13, 116160, 2, 3, '3-18', 47, 18, '2024-11-06', NULL, 0.00, 'YO QUE PUTAS VOY A SABER', NULL, NULL, NULL, NULL, NULL, NULL),
(179, 200, 41, 13, 57715, 2, 3, '3-19', 47, 19, '2024-11-13', NULL, 0.00, '006', NULL, NULL, NULL, NULL, NULL, NULL),
(180, 207, 41, 13, 189003, 2, 3, '3-25', 47, 25, '2024-11-14', NULL, 0.00, '005', 'Holiiiiiiiii', 177780, NULL, NULL, NULL, NULL),
(181, 208, 41, 13, 55000, 2, 3, '3-26', 47, 26, '2024-11-18', NULL, 3.00, '005', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 50000, NULL, NULL, NULL, NULL),
(182, 209, 41, 13, 4612800, 2, 3, '3-27', 47, 27, '2024-11-18', NULL, 2.00, '005', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 4612800, NULL, NULL, NULL, NULL),
(183, 206, 41, 13, 106447, 2, 3, '3-24', 47, 24, '2024-11-14', NULL, 12.00, '006', 'Holiiiiiiiii', 96770, NULL, NULL, NULL, NULL),
(184, 205, 41, 13, 95603, 2, 3, '3-23', 47, 23, '2024-11-14', NULL, 27.00, '005', 'Holiiiiiiiii 2', 86912, NULL, NULL, NULL, NULL),
(185, 203, 41, 13, 37153, 1, 3, '3-22', 47, 22, '2024-11-14', NULL, 4.00, '006', 'Holiiiiiiiii 2', 31272, NULL, NULL, NULL, NULL),
(186, 202, 41, 13, 214550, 1, 3, '3-21', 47, 21, '2024-11-14', NULL, 10.00, '006', 'Holiiiiiiiii 2', 191000, NULL, NULL, NULL, NULL),
(187, 201, 41, 13, 84655, 1, 3, '3-20', 47, 20, '2024-11-14', NULL, 12.00, '006', 'Holiiiiiiiii', NULL, NULL, NULL, NULL, NULL),
(188, 211, 41, 13, 3223200, 2, 3, '3-29', 47, 29, '2024-11-18', NULL, 0.00, '005', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 3064000, NULL, NULL, NULL, NULL),
(189, 210, 41, 13, 6937400, 2, 3, '3-28', 47, 28, '2024-11-18', NULL, 3.00, '006', 'Holiiiiiiiii', 6308000, NULL, NULL, NULL, NULL),
(190, 212, 41, 13, 10455720, 2, 3, '3-30', 47, 30, '2024-11-18', NULL, 2.00, '006', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 9505200, NULL, NULL, NULL, NULL),
(191, 213, 41, 13, 792000, 2, 3, '3-31', 47, 31, '2024-11-19', NULL, 0.00, '005', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 720000, NULL, NULL, NULL, NULL),
(192, 214, 15, 17, 342720, 2, 265, '265-2', 47, 32, '2024-11-19', NULL, 0.00, '007', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 288000, NULL, NULL, NULL, NULL),
(193, 216, 41, 13, 10340000, 2, 3, '3-33', 47, 34, '2024-11-25', NULL, 2.00, '006', 'NO SEEE', 10340000, 'Especies', 'ESTACION FLORESTA', 'COTIZACIONES', 1),
(194, 219, 41, 13, 19200000, 2, 3, '3-36', 47, 37, '2024-11-26', NULL, 1.00, '006', 'NO SEEE', 17600000, 'Especies', 'ESTACION FLORESTA', 'COTIZACIONES', 1),
(195, 219, 41, 13, 19200000, 2, 3, '3-36', 47, 37, '2024-11-26', NULL, 1.00, '006', 'NO SEEE', 17600000, 'Especies', 'ESTACION FLORESTA', 'COTIZACIONES', 1),
(196, 215, 41, 13, 23100, 1, 3, '3-32', 47, 33, '2024-11-19', NULL, 0.00, '005', 'Pedir Documentacion del produco', 23100, NULL, NULL, NULL, NULL),
(197, 222, 41, 13, 18480000, 2, 3, '3-39', 47, 40, '2024-11-26', NULL, 0.00, '009', 'NO SEEE', 18480000, 'Especies', 'ARANJUEZ', 'COTIZACIONES', 1),
(198, 221, 41, 13, 2100, 1, 3, '3-38', 47, 39, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 2000, 'Especies', 'ahh', 'COTIZACIONES JJIIJ', 2),
(199, 223, 41, 13, 10780000, 2, 3, '3-40', 47, 41, '2024-11-26', NULL, 0.00, '005', 'NO', 10780000, 'pafo', 'ESTRELLA', 'SI', 1),
(200, 225, 41, 13, 21000, 2, 3, '3-42', 47, 43, '2024-11-26', NULL, 0.00, '006', 'Holiiiiiiiii 2', 20000, 'pafo', 'ESTRELLA', 'SI', 2),
(201, 227, 41, 13, 4999999, 2, 3, '3-44', 47, 45, '2024-11-26', NULL, 0.00, 'Centro costos', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 4999999, 'pafo', 'ESTRELLA', 'SI', 2),
(202, 226, 41, 13, 49999999, 2, 3, '3-43', 47, 44, '2024-11-26', NULL, 0.00, 'Centro costos', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 49999999, 'pafo', 'ESTRELLA', 'SI', 2),
(203, 224, 41, 13, 13800000, 2, 3, '3-41', 47, 42, '2024-11-26', NULL, 0.00, 'YO QUE PUTAS VOY A SABER', 'NO', 13800000, 'pafo', 'ESTRELLA', 'SI', 2),
(204, 229, 41, 13, 5000001, 2, 3, '3-46', 47, 47, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 5000001, 'Especies', 'ESTACION MIRAFLORES', 'COTIZACIONES JJIIJ', 2),
(205, 230, 41, 13, 80000000, 2, 3, '3-47', 47, 48, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 80000000, 'Especies', 'ESTACION FLORESTA', 'COTIZACIONES', 1),
(206, 230, 41, 13, 80000000, 2, 3, '3-47', 47, 48, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 80000000, 'Especies', 'ESTACION FLORESTA', 'COTIZACIONES', 1),
(207, 230, 41, 13, 80000000, 1, 3, '3-47', 47, 48, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 80000000, 'Especies', 'ESTACION FLORESTA', 'COTIZACIONES', 1),
(208, 231, 41, 13, 63000000, 2, 3, '3-48', 47, 49, '2024-11-26', NULL, 0.00, '006', 'NO', 63000000, 'pafo', 'ESTRELLA', 'SI', 1),
(209, 232, 41, 13, 60000000, 2, 3, '3-49', 47, 50, '2024-11-26', NULL, 3.00, '006', 'OBSERVACIONES', 60000000, 'PAGO', 'PUERTA', NULL, NULL),
(210, 233, 41, 13, 334200000, 2, 3, '3-50', 47, 51, '2024-11-26', NULL, 5.00, '008', 'NA', 334200000, '50-50', 'ACEMA INGENIERIA', NULL, NULL),
(211, 235, 41, 13, 10353000, 2, 3, '3-52', 47, 53, '2024-11-27', NULL, 0.00, '009', 'OBSERVACIONES', 8700000, 'forma de pagooo', 'lugar de entregaaa', NULL, NULL),
(212, 234, 41, 13, 13068000, 2, 3, '3-51', 47, 52, '2024-11-26', NULL, 5.00, '006', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA  CAER ', 11880000, '50-50', 'ACEMA INGENIERIA', NULL, NULL),
(213, 228, 41, 13, 4999999, 2, 3, '3-45', 47, 46, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 4999999, 'Especies', 'ARANJUEZ', NULL, NULL),
(214, 237, 41, 13, 14775040, 2, 3, '3-54', 47, 55, '2024-11-27', NULL, 3.00, '009', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 12416000, '50-50, primer pago a realizar el dia 29/10/2024, finalizacion de pago cuando llegue ', 'Acema ingenieria', 'aaaa', 1),
(215, 236, 41, 13, 10042410, 2, 3, '3-53', 47, 54, '2024-11-27', NULL, 2.00, '006', 'Observaciones', 8439000, 'Forma de pago ', 'Lugar de Entrega', 'holi', 1),
(216, 238, 41, 13, 11900000, 2, 3, '3-55', 47, 56, '2024-11-27', NULL, 5.00, '006', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 10000000, 'PAGO', 'PUERTA', 'aaa', 1),
(217, 239, 41, 13, 14190000, 2, 3, '3-56', 47, 57, '2024-11-27', NULL, 3.00, '005', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 12900000, '50-50, primer pago a realizar el dia 29/10/2024, finalizacion de pago cuando llegue ', 'ACEMA INGENIERIA', 'COTIZACIONES', 1),
(218, 240, 41, 13, 10230000, 1, 3, '3-57', 47, 58, '2024-11-27', NULL, 3.00, '005', 'Pedir Documentacion del produco', 9300000, '50-50', 'ACEMA INGENIERIA', 'COTIZACIONES', 1),
(219, 243, 41, 13, 120000, 1, 3, '3-60', 47, 61, '2024-11-29', NULL, 0.00, '005', 'Pedir Documentacion del produco', 120000, 'pafo', 'Acema ingenieria', 'NO ', 2),
(220, 242, 41, 13, 3520000, 1, 3, '3-59', 47, 60, '2024-11-29', NULL, 0.00, 'no sé , centro de costos', 'Pedir Documentacion del produco', 3200000, 'forma de pagooo', 'Acema ingenieria', 'SI', 2),
(221, 241, 41, 13, 47300000, 1, 3, '3-58', 47, 59, '2024-11-29', NULL, 0.00, '006', '', 43000000, '50-50', 'PUERTA', 'SI', 1),
(222, 247, 41, 13, 26160000, 1, 3, '3-63', 47, 64, '2024-11-29', NULL, 3.00, '005', 'OBSERVACIONES', 26160000, '50-50', 'Lugar de Entrega', 'COTIZACIONES', 1),
(223, 249, 41, 13, 17600000, 2, 3, '3-65', 47, 66, '2024-12-02', NULL, 2.00, '005', 'OBSERVACIONES', 16000000, 'PAGO', 'lugar de entregaaa', 'Cotizaciones', 1),
(224, 250, 41, 13, 682500, 2, 3, '3-66', 47, 67, '2024-12-02', NULL, 1.00, '', '', 650000, '', '', '', 2),
(225, 251, 41, 13, 940100, 2, 3, '3-67', 47, 68, '2024-12-02', NULL, 1.00, '', '', 790000, '', '', '', 2),
(226, 252, 41, 13, 3484800, 2, 3, '3-68', 47, 69, '2024-12-10', 11, 0.00, '006', 'NO', 3168000, '50-50', 'ESTRELLA', 'SI', 2),
(227, 245, 41, 13, 7339563, 1, 3, '3-62', 47, 63, '2024-11-29', NULL, 6.00, '006', 'OBSERVACIONES', 6167700, 'PAGO', 'Lugar de Entrega', 'COTIZACIONES', 2),
(228, 244, 41, 13, 10500011, 1, 3, '3-61', 47, 62, '2024-11-29', NULL, 2.00, '04', 'OBSERVACIONES', 10000010, 'Forma de pago ', 'Lugar de Entrega', 'COTIZACIONES', 1),
(229, 244, 41, 13, 10500011, 1, 3, '3-61', 47, 62, '2024-11-29', NULL, 2.00, '04', 'OBSERVACIONES', 10000010, 'Forma de pago ', 'Lugar de Entrega', 'COTIZACIONES', 1),
(230, 244, 41, 13, 10500011, 1, 3, '3-61', 47, 62, '2024-11-29', NULL, 2.00, '04', 'OBSERVACIONES', 10000010, 'Forma de pago ', 'Lugar de Entrega', 'COTIZACIONES', 1),
(231, 244, 41, 13, 10500011, 1, 3, '3-61', 47, 62, '2024-11-29', NULL, 2.00, '04', 'OBSERVACIONES', 10000010, 'Forma de pago ', 'Lugar de Entrega', 'COTIZACIONES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_item`
--

CREATE TABLE `compra_item` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) DEFAULT NULL,
  `item` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `codigo_item` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) DEFAULT 0.00,
  `valor_uni` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra_item`
--

INSERT INTO `compra_item` (`id`, `id_compra`, `item`, `cantidad`, `codigo_item`, `valor`, `descuento`, `valor_uni`) VALUES
(359, 162, 'pantalla', 1, '3-3-1', 997500.00, 5.00, NULL),
(360, 163, 'Pantalla', 1, '3-2-1', 12852000.00, 10.00, NULL),
(361, 164, 'Teclado ', 2, '3-4-1', 2016000.00, 3.00, NULL),
(362, 164, 'Pantalla', 1, '3-4-2', 34629000.00, 3.00, NULL),
(363, 165, 'n', 1, '3-5-1', 99999999.99, 0.00, NULL),
(364, 166, 'nooo', 1, '3-7-1', 207900.00, 10.00, NULL),
(365, 167, 'aaaa', 1, '3-6-1', 10000.00, 0.00, NULL),
(366, 168, 'q', 1, '3-8-1', 110000.00, 0.00, NULL),
(367, 169, 'adasdasd', 1, '3-9-1', 1329900.00, 0.00, NULL),
(368, 170, 'no se', 1, '3-12-1', 12600.00, 0.00, NULL),
(369, 171, 'w', 122, '3-11-1', 256200.00, 0.00, NULL),
(370, 172, 'sss', 1, '3-10-1', 99999999.99, 30.00, NULL),
(371, 173, 'qwew', 1, '3-16-1', 337050.00, 0.00, NULL),
(372, 174, 'pantalla', 1, '3-14-1', 1100.00, 0.00, NULL),
(373, 175, 'opaopa', 1, '3-13-1', 20000.00, 0.00, NULL),
(374, 176, 'aaa', 1, '3-15-1', 12600.00, 0.00, NULL),
(375, 177, 'Pantalla', 1, '3-17-1', 10500.00, 0.00, NULL),
(376, 178, 'aaaa', 1, '3-18-1', 116160.00, 12.00, NULL),
(377, 179, 'pc Lenovo ', 1, '3-19-1', 57715.00, 3.00, NULL),
(378, 180, 'pantalla', 1, '3-25-1', 123453.00, 13.00, 129000),
(379, 180, 'no', 1, '3-25-2', 65550.00, 5.00, 69000),
(380, 181, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-26-1', 55000.00, 0.00, 50000),
(381, 182, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1, '3-27-1', 1320000.00, 0.00, 1200000),
(382, 182, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-27-2', 3292800.00, 2.00, 3200000),
(383, 183, 'Pantalla', 1, '3-24-1', 50391.00, 9.00, 50900),
(384, 183, 'carro', 1, '3-24-2', 56056.00, 0.00, 56000),
(385, 184, 'pc Lenovo ', 1, '3-23-1', 46841.30, 3.00, 43900),
(386, 184, 'pantalla', 1, '3-23-2', 48761.90, 0.00, 45700),
(387, 185, 'pc Lenovo ', 1, '3-22-1', 739.20, 10.00, 700),
(388, 185, 'opaopa', 1, '3-22-2', 36414.00, 10.00, 34000),
(389, 186, 'no seee', 5, '3-21-1', 95550.00, 0.00, 20000),
(390, 186, 'op', 5, '3-21-2', 119000.00, 0.00, 20000),
(391, 187, 'no', 7, '3-20-1', 9055.20, 0.00, 1200),
(392, 187, 'no se', 6, '3-20-2', 75600.00, 0.00, 12000),
(393, 188, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-29-1', 132000.00, 0.00, 120000),
(394, 188, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1, '3-29-2', 3091200.00, 8.00, 3200000),
(395, 189, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1, '3-28-1', 3808000.00, 0.00, 3200000),
(396, 189, 'opaopa', 1, '3-28-2', 449400.00, 0.00, 428000),
(397, 189, 'no seeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 4, '3-28-3', 2680000.00, 0.00, 670000),
(398, 190, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 89, '3-30-1', 10455720.00, 11.00, 120000),
(399, 191, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 8, '3-31-1', 792000.00, 0.00, 90000),
(400, 192, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1, '265-2-1', 342720.00, 10.00, 320000),
(401, 193, 'Pantalla', 5, '3-33-1', 10340000.00, 6.00, 2000000),
(402, 194, 'Pantalla', 12, '3-36-1', 15840000.00, 0.00, 1200000),
(403, 194, 'PC', 1, '3-36-2', 3360000.00, 0.00, 3200000),
(404, 195, 'Pantalla', 12, '3-36-1', 15840000.00, 0.00, 1200000),
(405, 195, 'PC', 1, '3-36-2', 3360000.00, 0.00, 3200000),
(406, 196, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-32-1', 23100.00, 0.00, 21000),
(407, 197, 'vaso ', 4, '3-39-1', 18480000.00, 12.00, 5000000),
(408, 198, 'pan', 1, '3-38-1', 2100.00, 0.00, 2000),
(409, 199, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1, '3-40-1', 10780000.00, 0.00, 9800000),
(410, 200, 'palito de queso', 1, '3-42-1', 21000.00, 0.00, 20000),
(411, 201, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-44-1', 4999999.00, 0.00, 4999999),
(412, 202, 'Pantalla', 1, '3-43-1', 49999999.00, 0.00, 49999999),
(413, 203, 'tablero', 15, '3-41-1', 1800000.00, 0.00, 120000),
(414, 203, 'pc Lenovo ', 6, '3-41-2', 12000000.00, 0.00, 2000000),
(415, 204, 'VALOR', 1, '3-46-1', 5000001.00, 0.00, 5000001),
(416, 208, 'prueba', 1, '3-48-1', 63000000.00, 0.00, 60000000),
(417, 209, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-49-1', 60000000.00, 0.00, 60000000),
(418, 210, 'TRANSFORMADO DE 20X20 CON INTEGRACION DE LINEA DE ALTA TENSION TRIFASICO', 5, '3-50-1', 99999999.99, 19.00, 65000000),
(419, 210, 'TABLERO NO SE, ACUEATICO CON RUDAS MOVIBLES DE BASE EN FIBRA DE CARBONO', 3, '3-50-2', 44625000.00, 0.00, 12500000),
(420, 211, 'prueba ', 1, '3-52-1', 10353000.00, 0.00, 8700000),
(421, 212, 'TRANSFORMADO DE 20X20 CON INTEGRACION DE LINEA DE ALTA TENSION TRIFASICO', 3, '3-51-1', 13068000.00, 12.00, 4500000),
(422, 213, 'VALOR', 1, '3-45-1', 4999999.00, 0.00, 4999999),
(423, 214, 'pc lenovo, ideapack 3 8gb RAM , 500 gb ', 4, '3-54-1', 14775040.00, 3.00, 3200000),
(424, 215, 'prueba odf', 1, '3-53-1', 10042410.00, 3.00, 8700000),
(425, 216, 'prueba de check', 1, '3-55-1', 11900000.00, 0.00, 10000000),
(426, 217, 'pc Lenovo ', 3, '3-56-1', 14190000.00, 0.00, 4300000),
(427, 218, 'Pantalla', 1, '3-57-1', 10230000.00, 0.00, 9300000),
(428, 219, 'Pantalla', 1, '3-60-1', 120000.00, 0.00, 120000),
(429, 220, 'pc Lenovo ', 1, '3-59-1', 3520000.00, 0.00, 3200000),
(430, 221, 'Pantalla', 1, '3-58-1', 47300000.00, 0.00, 43000000),
(431, 222, 'Pantalla', 3, '3-63-1', 26160000.00, 0.00, 8720000),
(432, 223, 'item 1', 5, '3-65-1', 17600000.00, 0.00, 3200000),
(433, 224, 'Pantalla', 1, '3-66-1', 682500.00, 0.00, 650000),
(434, 225, 'pantalla', 1, '3-67-1', 940100.00, 0.00, 790000),
(435, 226, 'pc Lenovo ', 4, '3-68-1', 3484800.00, 1.00, 800000),
(436, 227, 'Servidor', 7, '3-62-1', 7339563.00, 1.00, 890000),
(437, 228, '', 1, '3-61-1', 10500010.50, 0.00, 10000010),
(438, 229, '', 1, '3-61-1', 10500010.50, 0.00, 10000010),
(439, 230, '', 1, '3-61-1', 10500010.50, 0.00, 10000010),
(440, 231, '', 1, '3-61-1', 10500010.50, 0.00, 10000010);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_llegada`
--

CREATE TABLE `compra_llegada` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) DEFAULT NULL,
  `id_persona_resive` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `fecha_llegada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra_llegada`
--

INSERT INTO `compra_llegada` (`id`, `id_compra`, `id_persona_resive`, `id_persona`, `id_ubicacion`, `fecha_llegada`) VALUES
(3, 162, 24, 24, 1, '2024-11-03'),
(4, 163, 53, 53, 1, '2024-11-03'),
(5, 164, 23, 23, 1, '2024-11-03'),
(6, 165, 32, 32, 2, '2024-11-05'),
(7, 166, 33, 33, 1, '2024-11-05'),
(8, 167, NULL, 33, 1, '2024-11-05'),
(9, 168, 27, 27, 1, '2024-11-06'),
(10, 169, 27, 27, 1, '2024-11-06'),
(11, 170, 31, 31, 1, '2024-11-06'),
(12, 171, 33, 33, 1, '2024-11-06'),
(13, 172, 36, 36, 1, '2024-11-06'),
(14, 173, 25, 25, 2, '2024-11-06'),
(15, 176, 26, 26, 2, '2024-11-06'),
(16, 177, 33, 33, 1, '2024-11-06'),
(17, 178, 30, 30, 1, '2024-11-06'),
(18, 180, 19, 19, 1, '2024-11-14'),
(19, 181, 30, 30, 1, '2024-11-18'),
(20, 179, 29, 29, 1, '2024-11-18'),
(21, 174, 19, 19, 1, '2024-11-18'),
(22, 182, 30, 30, 1, '2024-11-18'),
(23, 183, 15, 15, 1, '2024-11-18'),
(24, 184, 23, 23, 1, '2024-11-18'),
(25, 189, 22, 22, 1, '2024-11-18'),
(26, 188, 30, 30, 2, '2024-11-18'),
(27, 190, 32, 32, 2, '2024-11-18'),
(28, 191, 29, 29, 2, '2024-11-19'),
(29, 192, 25, 25, 1, '2024-11-19'),
(30, 201, 29, 29, 1, '2024-11-27'),
(31, 204, 27, 27, 2, '2024-11-27'),
(32, 200, 19, 19, 1, '2024-11-27'),
(33, 202, 30, 30, 1, '2024-11-27'),
(34, 203, 41, 41, 1, '2024-11-27'),
(35, 197, 43, 43, 1, '2024-11-27'),
(36, 193, 30, 30, 2, '2024-11-27'),
(37, 175, 15, 15, 2, '2024-11-27'),
(38, 210, 27, 27, 1, '2024-11-27'),
(39, 209, 20, 20, 1, '2024-11-27'),
(40, 205, 35, 35, 1, '2024-11-27'),
(41, 208, 21, 21, 1, '2024-11-27'),
(42, 199, 32, 32, 1, '2024-11-27'),
(43, 194, 30, 30, 1, '2024-11-27'),
(44, 195, 20, 20, 2, '2024-11-27'),
(45, 213, 20, 20, 1, '2024-11-27'),
(46, 211, 19, 19, 1, '2024-11-27'),
(47, 212, 29, 29, 1, '2024-11-27'),
(48, 214, 40, 40, 2, '2024-11-27'),
(49, 215, 19, 19, 1, '2024-11-27'),
(50, 217, 19, 19, 2, '2024-11-27'),
(51, 216, 19, 19, 1, '2024-11-27'),
(52, 206, 33, 33, 1, '2024-11-28'),
(53, 223, 27, 27, 1, '2024-12-02'),
(54, 225, 29, 29, 2, '2024-12-10'),
(55, 226, 10, 10, 3, '2024-12-10'),
(56, 224, 21, 21, 2, '2024-12-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `estado`) VALUES
(1, 'pendiente'),
(2, 'aprobado'),
(3, 'Aprobado aparte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_compra`
--

CREATE TABLE `estado_compra` (
  `id` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_compra`
--

INSERT INTO `estado_compra` (`id`, `estado`) VALUES
(1, 'pendiente'),
(2, 'llego');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_compra_item` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `ubicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `id_compra_item`, `cantidad`, `ubicacion`) VALUES
(317, 359, 0, 1),
(318, 360, 0, 1),
(319, 361, 0, 1),
(320, 362, 0, 1),
(321, 363, 1, 2),
(322, 366, 0, 1),
(323, 367, 0, 1),
(324, 368, 0, 1),
(325, 369, 0, 1),
(326, 370, 0, 1),
(327, 371, 1, 2),
(328, 374, 0, 2),
(329, 375, 0, 1),
(330, 376, 0, 1),
(331, 378, 0, 1),
(332, 379, 0, 1),
(333, 380, 0, 1),
(334, 377, 0, 1),
(335, 372, 0, 1),
(336, 381, 0, 1),
(337, 382, 0, 1),
(338, 383, 0, 1),
(339, 384, 1, 1),
(340, 385, 0, 1),
(341, 386, 1, 1),
(342, 395, 0, 1),
(343, 396, 1, 1),
(344, 393, 0, 2),
(345, 394, 0, 2),
(346, 398, 86, 2),
(347, 399, 8, 2),
(348, 400, 1, 1),
(349, 411, 1, 1),
(350, 415, 1, 2),
(351, 410, 1, 1),
(352, 412, 1, 1),
(353, 413, 8, 1),
(354, 414, 3, 1),
(355, 407, 4, 1),
(356, 401, 5, 2),
(357, 373, 1, 2),
(358, 418, 3, 1),
(359, 419, 3, 1),
(360, 417, 1, 1),
(361, 416, 1, 1),
(362, 409, 1, 1),
(363, 402, 12, 1),
(364, 404, 12, 2),
(365, 405, 1, 2),
(366, 422, 1, 1),
(367, 420, 1, 1),
(368, 421, 3, 1),
(369, 423, 4, 2),
(370, 424, 1, 1),
(371, 426, 3, 2),
(372, 425, 1, 1),
(373, 432, 5, 1),
(374, 434, 1, 2),
(375, 433, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_proyecto`
--

CREATE TABLE `inventario_proyecto` (
  `id` int(11) NOT NULL,
  `id_compra_item` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `ubicacion` int(11) NOT NULL,
  `id_inventario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario_proyecto`
--

INSERT INTO `inventario_proyecto` (`id`, `id_compra_item`, `cantidad`, `ubicacion`, `id_inventario`) VALUES
(1, 435, 4, 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_compra`
--

CREATE TABLE `item_compra` (
  `id` int(11) NOT NULL,
  `id_orden` int(11) DEFAULT NULL,
  `item` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `codigo_item` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `valor_uni` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `item_compra`
--

INSERT INTO `item_compra` (`id`, `id_orden`, `item`, `cantidad`, `codigo_item`, `valor`, `descuento`, `valor_uni`) VALUES
(5, 181, 'TRANSFORMADOR', 2, '265-1-1', 22440000.00, 15.00, NULL),
(7, 183, 'Pantalla', 1, '3-2-1', 12852000.00, 10.00, NULL),
(8, 184, 'pantalla', 1, '3-3-1', 997500.00, 5.00, NULL),
(9, 185, 'Teclado ', 2, '3-4-1', 2016000.00, 3.00, NULL),
(10, 185, 'Pantalla', 1, '3-4-2', 34629000.00, 3.00, NULL),
(11, 186, 'n', 1, '3-5-1', 99999999.99, 0.00, NULL),
(12, 187, 'aaaa', 1, '3-6-1', 10000.00, 0.00, NULL),
(13, 188, 'nooo', 1, '3-7-1', 207900.00, 10.00, NULL),
(14, 189, 'q', 1, '3-8-1', 110000.00, 0.00, NULL),
(15, 190, 'adasdasd', 1, '3-9-1', 1329900.00, 0.00, NULL),
(16, 191, 'sss', 1, '3-10-1', 99999999.99, 30.00, NULL),
(17, 192, 'w', 122, '3-11-1', 256200.00, 0.00, NULL),
(18, 193, 'no se', 1, '3-12-1', 12600.00, 0.00, NULL),
(19, 194, 'opaopa', 1, '3-13-1', 20000.00, 0.00, NULL),
(20, 195, 'pantalla', 1, '3-14-1', 1100.00, 0.00, NULL),
(21, 196, 'aaa', 1, '3-15-1', 12600.00, 0.00, NULL),
(22, 197, 'qwew', 1, '3-16-1', 337050.00, 0.00, NULL),
(23, 198, 'Pantalla', 1, '3-17-1', 10500.00, 0.00, NULL),
(24, 199, 'aaaa', 1, '3-18-1', 116160.00, 12.00, NULL),
(25, 200, 'pc Lenovo ', 1, '3-19-1', 57715.00, 3.00, NULL),
(26, 201, 'no', 7, '3-20-1', 9055.20, 0.00, 1200),
(27, 201, 'no se', 6, '3-20-2', 75600.00, 0.00, 12000),
(28, 202, 'no seee', 5, '3-21-1', 95550.00, 0.00, 20000),
(29, 202, 'op', 5, '3-21-2', 119000.00, 0.00, 20000),
(30, 203, 'pc Lenovo ', 1, '3-22-1', 739.20, 10.00, 700),
(31, 203, 'opaopa', 1, '3-22-2', 36414.00, 10.00, 34000),
(34, 205, 'pc Lenovo ', 1, '3-23-1', 46841.30, 3.00, 43900),
(35, 205, 'pantalla', 1, '3-23-2', 48761.90, 0.00, 45700),
(36, 206, 'Pantalla', 1, '3-24-1', 50391.00, 9.00, 50900),
(37, 206, 'carro', 1, '3-24-2', 56056.00, 0.00, 56000),
(38, 207, 'pantalla', 1, '3-25-1', 123453.00, 13.00, 129000),
(39, 207, 'no', 1, '3-25-2', 65550.00, 5.00, 69000),
(40, 208, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-26-1', 55000.00, 0.00, 50000),
(41, 209, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1, '3-27-1', 1320000.00, 0.00, 1200000),
(42, 209, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-27-2', 3292800.00, 2.00, 3200000),
(43, 210, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1, '3-28-1', 3808000.00, 0.00, 3200000),
(44, 210, 'opaopa', 1, '3-28-2', 449400.00, 0.00, 428000),
(45, 210, 'no seeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 4, '3-28-3', 2680000.00, 0.00, 670000),
(46, 211, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-29-1', 132000.00, 0.00, 120000),
(47, 211, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1, '3-29-2', 3091200.00, 8.00, 3200000),
(48, 212, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 89, '3-30-1', 10455720.00, 11.00, 120000),
(49, 213, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 8, '3-31-1', 792000.00, 0.00, 90000),
(50, 214, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1, '265-2-1', 342720.00, 10.00, 320000),
(51, 215, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-32-1', 23100.00, 0.00, 21000),
(52, 216, 'Pantalla', 5, '3-33-1', 10340000.00, 6.00, 2000000),
(54, 218, 'PC', 3, '3-35-1', 18150000.00, 0.00, 5500000),
(55, 219, 'Pantalla', 12, '3-36-1', 15840000.00, 0.00, 1200000),
(56, 219, 'PC', 1, '3-36-2', 3360000.00, 0.00, 3200000),
(57, 220, 'VALOR', 1, '3-37-1', 12100000.00, 0.00, 11000000),
(58, 221, 'pan', 1, '3-38-1', 2100.00, 0.00, 2000),
(59, 222, 'vaso ', 4, '3-39-1', 18480000.00, 12.00, 5000000),
(60, 223, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1, '3-40-1', 10780000.00, 0.00, 9800000),
(61, 224, 'tablero', 15, '3-41-1', 1800000.00, 0.00, 120000),
(62, 224, 'pc Lenovo ', 6, '3-41-2', 12000000.00, 0.00, 2000000),
(63, 225, 'palito de queso', 1, '3-42-1', 21000.00, 0.00, 20000),
(64, 226, 'Pantalla', 1, '3-43-1', 49999999.00, 0.00, 49999999),
(65, 227, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-44-1', 4999999.00, 0.00, 4999999),
(66, 228, 'VALOR', 1, '3-45-1', 4999999.00, 0.00, 4999999),
(67, 229, 'VALOR', 1, '3-46-1', 5000001.00, 0.00, 5000001),
(68, 230, 'Pantalla', 1, '3-47-1', 80000000.00, 0.00, 80000000),
(69, 231, 'prueba', 1, '3-48-1', 63000000.00, 0.00, 60000000),
(70, 232, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1, '3-49-1', 60000000.00, 0.00, 60000000),
(71, 233, 'TRANSFORMADO DE 20X20 CON INTEGRACION DE LINEA DE ALTA TENSION TRIFASICO', 5, '3-50-1', 99999999.99, 19.00, 65000000),
(72, 233, 'TABLERO NO SE, ACUEATICO CON RUDAS MOVIBLES DE BASE EN FIBRA DE CARBONO', 3, '3-50-2', 44625000.00, 0.00, 12500000),
(73, 234, 'TRANSFORMADO DE 20X20 CON INTEGRACION DE LINEA DE ALTA TENSION TRIFASICO', 3, '3-51-1', 13068000.00, 12.00, 4500000),
(74, 235, 'prueba ', 1, '3-52-1', 10353000.00, 0.00, 8700000),
(75, 236, 'prueba odf', 1, '3-53-1', 10042410.00, 3.00, 8700000),
(76, 237, 'pc lenovo, ideapack 3 8gb RAM , 500 gb ', 4, '3-54-1', 14775040.00, 3.00, 3200000),
(77, 238, 'prueba de check', 1, '3-55-1', 11900000.00, 0.00, 10000000),
(78, 239, 'pc Lenovo ', 3, '3-56-1', 14190000.00, 0.00, 4300000),
(79, 240, 'Pantalla', 1, '3-57-1', 10230000.00, 0.00, 9300000),
(80, 241, 'Pantalla', 1, '3-58-1', 47300000.00, 0.00, 43000000),
(81, 242, 'pc Lenovo ', 1, '3-59-1', 3520000.00, 0.00, 3200000),
(82, 243, 'Pantalla', 1, '3-60-1', 120000.00, 0.00, 120000),
(83, 244, '', 1, '3-61-1', 10500010.50, 0.00, 10000010),
(84, 245, 'Servidor', 7, '3-62-1', 7339563.00, 1.00, 890000),
(86, 247, 'Pantalla', 3, '3-63-1', 26160000.00, 0.00, 8720000),
(88, 249, 'item 1', 5, '3-65-1', 17600000.00, 0.00, 3200000),
(89, 250, 'Pantalla', 1, '3-66-1', 682500.00, 0.00, 650000),
(90, 251, 'pantalla', 1, '3-67-1', 940100.00, 0.00, 790000),
(91, 252, 'pc Lenovo ', 4, '3-68-1', 3484800.00, 1.00, 800000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id` int(11) NOT NULL,
  `codigo_orden` varchar(255) NOT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  `persona` int(11) DEFAULT NULL,
  `id_tecnico` int(11) DEFAULT NULL,
  `valor` int(11) NOT NULL,
  `compra_per` int(11) DEFAULT NULL,
  `consecutivo` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `retencion` decimal(10,2) NOT NULL,
  `centro_costos` text DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `forma_pago` text DEFAULT NULL,
  `lugar_entrega` text DEFAULT NULL,
  `cotizacion` text DEFAULT NULL,
  `id_poliza` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id`, `codigo_orden`, `id_proyecto`, `persona`, `id_tecnico`, `valor`, `compra_per`, `consecutivo`, `fecha`, `id_proveedor`, `retencion`, `centro_costos`, `observacion`, `subtotal`, `forma_pago`, `lugar_entrega`, `cotizacion`, `id_poliza`) VALUES
(181, '265-1', 265, 27, 17, 22440000, 47, 1, '2024-10-30', NULL, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(183, '3-2', 3, 41, 13, 12852000, 47, 2, '2024-11-01', NULL, 8.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(184, '3-3', 3, 41, 13, 997500, 47, 3, '2024-11-03', NULL, 12.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, '3-4', 3, 41, 13, 36645000, 47, 4, '2024-11-03', NULL, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(186, '3-5', 3, 41, 13, 2147483647, 47, 5, '2024-11-05', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(187, '3-6', 3, 41, 13, 10000, 47, 6, '2024-11-05', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(188, '3-7', 3, 41, 13, 207900, 47, 7, '2024-11-05', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(189, '3-8', 3, 41, 13, 110000, 47, 8, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(190, '3-9', 3, 41, 13, 1329900, 47, 9, '2024-11-06', NULL, 12.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(191, '3-10', 3, 41, 13, 700000000, 47, 10, '2024-11-06', NULL, 12.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(192, '3-11', 3, 41, 13, 256200, 47, 11, '2024-11-06', NULL, 1.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(193, '3-12', 3, 41, 13, 12600, 47, 12, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(194, '3-13', 3, 41, 13, 20000, 47, 13, '2024-11-06', NULL, 12.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(195, '3-14', 3, 41, 13, 1100, 47, 14, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(196, '3-15', 3, 41, 13, 12600, 47, 15, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(197, '3-16', 3, 41, 13, 337050, 47, 16, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(198, '3-17', 3, 41, 13, 10500, 47, 17, '2024-11-06', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(199, '3-18', 3, 41, 13, 116160, 47, 18, '2024-11-06', NULL, 0.00, 'YO QUE PUTAS VOY A SABER', NULL, NULL, NULL, NULL, NULL, NULL),
(200, '3-19', 3, 41, 13, 57715, 47, 19, '2024-11-13', NULL, 0.00, '006', NULL, NULL, NULL, NULL, NULL, NULL),
(201, '3-20', 3, 41, 13, 84655, 47, 20, '2024-11-14', NULL, 12.00, '006', 'Holiiiiiiiii', NULL, NULL, NULL, NULL, NULL),
(202, '3-21', 3, 41, 13, 214550, 47, 21, '2024-11-14', NULL, 10.00, '006', 'Holiiiiiiiii 2', 191000, NULL, NULL, NULL, NULL),
(203, '3-22', 3, 41, 13, 37153, 47, 22, '2024-11-14', NULL, 4.00, '006', 'Holiiiiiiiii 2', 31272, NULL, NULL, NULL, NULL),
(205, '3-23', 3, 41, 13, 95603, 47, 23, '2024-11-14', NULL, 27.00, '005', 'Holiiiiiiiii 2', 86912, NULL, NULL, NULL, NULL),
(206, '3-24', 3, 41, 13, 106447, 47, 24, '2024-11-14', NULL, 12.00, '006', 'Holiiiiiiiii', 96770, NULL, NULL, NULL, NULL),
(207, '3-25', 3, 41, 13, 189003, 47, 25, '2024-11-14', NULL, 0.00, '005', 'Holiiiiiiiii', 177780, NULL, NULL, NULL, NULL),
(208, '3-26', 3, 41, 13, 55000, 47, 26, '2024-11-18', NULL, 3.00, '005', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 50000, NULL, NULL, NULL, NULL),
(209, '3-27', 3, 41, 13, 4612800, 47, 27, '2024-11-18', NULL, 2.00, '005', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 4612800, NULL, NULL, NULL, NULL),
(210, '3-28', 3, 41, 13, 6937400, 47, 28, '2024-11-18', NULL, 3.00, '006', 'Holiiiiiiiii', 6308000, NULL, NULL, NULL, NULL),
(211, '3-29', 3, 41, 13, 3223200, 47, 29, '2024-11-18', NULL, 0.00, '005', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 3064000, NULL, NULL, NULL, NULL),
(212, '3-30', 3, 41, 13, 10455720, 47, 30, '2024-11-18', NULL, 2.00, '006', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 9505200, NULL, NULL, NULL, NULL),
(213, '3-31', 3, 41, 13, 792000, 47, 31, '2024-11-19', NULL, 0.00, '005', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 720000, NULL, NULL, NULL, NULL),
(214, '265-2', 265, 15, 17, 342720, 47, 32, '2024-11-19', NULL, 0.00, '007', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 288000, NULL, NULL, NULL, NULL),
(215, '3-32', 3, 41, 13, 23100, 47, 33, '2024-11-19', NULL, 0.00, '005', 'Pedir Documentacion del produco', 23100, NULL, NULL, NULL, NULL),
(216, '3-33', 3, 41, 13, 10340000, 47, 34, '2024-11-25', NULL, 2.00, '006', 'NO SEEE', 10340000, 'Especies', 'ESTACION FLORESTA', 'COTIZACIONES', 1),
(218, '3-35', 3, 41, 13, 18150000, 47, 36, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 18150000, 'Especies', 'ESTACION FLORESTA', 'COTIZACIONES JJIIJ', 1),
(219, '3-36', 3, 41, 13, 19200000, 47, 37, '2024-11-26', NULL, 1.00, '006', 'NO SEEE', 17600000, 'Especies', 'ESTACION FLORESTA', 'COTIZACIONES', 1),
(220, '3-37', 3, 41, 13, 12100000, 47, 38, '2024-11-26', NULL, 0.00, '009', 'NO SEEE', 12100000, 'Especies', 'ARANJUEZ', 'COTIZACIONES', 1),
(221, '3-38', 3, 41, 13, 2100, 47, 39, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 2000, 'Especies', 'ahh', 'COTIZACIONES JJIIJ', 2),
(222, '3-39', 3, 41, 13, 18480000, 47, 40, '2024-11-26', NULL, 0.00, '009', 'NO SEEE', 18480000, 'Especies', 'ARANJUEZ', 'COTIZACIONES', 1),
(223, '3-40', 3, 41, 13, 10780000, 47, 41, '2024-11-26', NULL, 0.00, '005', 'NO', 10780000, 'pafo', 'ESTRELLA', 'SI', 1),
(224, '3-41', 3, 41, 13, 13800000, 47, 42, '2024-11-26', NULL, 0.00, 'YO QUE PUTAS VOY A SABER', 'NO', 13800000, 'pafo', 'ESTRELLA', 'SI', 2),
(225, '3-42', 3, 41, 13, 21000, 47, 43, '2024-11-26', NULL, 0.00, '006', 'Holiiiiiiiii 2', 20000, 'pafo', 'ESTRELLA', 'SI', 2),
(226, '3-43', 3, 41, 13, 49999999, 47, 44, '2024-11-26', NULL, 0.00, 'Centro costos', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 49999999, 'pafo', 'ESTRELLA', 'SI', 2),
(227, '3-44', 3, 41, 13, 4999999, 47, 45, '2024-11-26', NULL, 0.00, 'Centro costos', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 4999999, 'pafo', 'ESTRELLA', 'SI', 2),
(228, '3-45', 3, 41, 13, 4999999, 47, 46, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 4999999, 'Especies', 'ARANJUEZ', 'COTIZACIONES JJIIJ', 2),
(229, '3-46', 3, 41, 13, 5000001, 47, 47, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 5000001, 'Especies', 'ESTACION MIRAFLORES', 'COTIZACIONES JJIIJ', 2),
(230, '3-47', 3, 41, 13, 80000000, 47, 48, '2024-11-26', NULL, 0.00, '006', 'NO SEEE', 80000000, 'Especies', 'ESTACION FLORESTA', 'COTIZACIONES', 1),
(231, '3-48', 3, 41, 13, 63000000, 47, 49, '2024-11-26', NULL, 0.00, '006', 'NO', 63000000, 'pafo', 'ESTRELLA', 'SI', 1),
(232, '3-49', 3, 41, 13, 60000000, 47, 50, '2024-11-26', NULL, 3.00, '006', 'OBSERVACIONES', 60000000, 'PAGO', 'PUERTA', 'COTIZACIONES', 2),
(233, '3-50', 3, 41, 13, 334200000, 47, 51, '2024-11-26', NULL, 5.00, '008', 'NA', 334200000, '50-50', 'ACEMA INGENIERIA', 'NO ', 1),
(234, '3-51', 3, 41, 13, 13068000, 47, 52, '2024-11-26', NULL, 5.00, '006', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA  CAER ', 11880000, '50-50', 'ACEMA INGENIERIA', 'COTIZACIONES', 1),
(235, '3-52', 3, 41, 13, 10353000, 47, 53, '2024-11-27', NULL, 0.00, '009', 'OBSERVACIONES', 8700000, 'forma de pagooo', 'lugar de entregaaa', 'COTIZACIONES', 1),
(236, '3-53', 3, 41, 13, 10042410, 47, 54, '2024-11-27', NULL, 2.00, '006', 'Observaciones', 8439000, 'Forma de pago ', 'Lugar de Entrega', 'Cotizaciones', 1),
(237, '3-54', 3, 41, 13, 14775040, 47, 55, '2024-11-27', NULL, 3.00, '009', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 12416000, '50-50, primer pago a realizar el dia 29/10/2024, finalizacion de pago cuando llegue ', 'Acema ingenieria', 'si', 1),
(238, '3-55', 3, 41, 13, 11900000, 47, 56, '2024-11-27', NULL, 5.00, '006', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 10000000, 'PAGO', 'PUERTA', 'COTIZACIONES', 1),
(239, '3-56', 3, 41, 13, 14190000, 47, 57, '2024-11-27', NULL, 3.00, '005', 'RECOGER EN LA PUERTA DE LA CASA DE AL LADO: LLEVAR EN LA PARTE TRASERA DEL CARRO DONDE NO SE VA CAER ', 12900000, '50-50, primer pago a realizar el dia 29/10/2024, finalizacion de pago cuando llegue ', 'ACEMA INGENIERIA', 'COTIZACIONES', 1),
(240, '3-57', 3, 41, 13, 10230000, 47, 58, '2024-11-27', NULL, 3.00, '005', 'Pedir Documentacion del produco', 9300000, '50-50', 'ACEMA INGENIERIA', 'COTIZACIONES', 1),
(241, '3-58', 3, 41, 13, 47300000, 47, 59, '2024-11-29', NULL, 0.00, '006', '', 43000000, '50-50', 'PUERTA', 'SI', 1),
(242, '3-59', 3, 41, 13, 3520000, 47, 60, '2024-11-29', NULL, 0.00, 'no sé , centro de costos', 'Pedir Documentacion del produco', 3200000, 'forma de pagooo', 'Acema ingenieria', 'SI', 2),
(243, '3-60', 3, 41, 13, 120000, 47, 61, '2024-11-29', NULL, 0.00, '005', 'Pedir Documentacion del produco', 120000, 'pafo', 'Acema ingenieria', 'NO ', 2),
(244, '3-61', 3, 41, 13, 10500011, 47, 62, '2024-11-29', NULL, 2.00, '04', 'OBSERVACIONES', 10000010, 'Forma de pago ', 'Lugar de Entrega', 'COTIZACIONES', 1),
(245, '3-62', 3, 41, 13, 7339563, 47, 63, '2024-11-29', NULL, 6.00, '006', 'OBSERVACIONES', 6167700, 'PAGO', 'Lugar de Entrega', 'COTIZACIONES', 2),
(247, '3-63', 3, 41, 13, 26160000, 47, 64, '2024-11-29', NULL, 3.00, '005', 'OBSERVACIONES', 26160000, '50-50', 'Lugar de Entrega', 'COTIZACIONES', 1),
(249, '3-65', 3, 41, 13, 17600000, 47, 66, '2024-12-02', NULL, 2.00, '005', 'OBSERVACIONES', 16000000, 'PAGO', 'lugar de entregaaa', 'Cotizaciones', 1),
(250, '3-66', 3, 41, 13, 682500, 47, 67, '2024-12-02', NULL, 1.00, '', '', 650000, '', '', '', 2),
(251, '3-67', 3, 41, 13, 940100, 47, 68, '2024-12-02', NULL, 1.00, '', '', 790000, '', '', '', 2),
(252, '3-68', 3, 41, 13, 3484800, 47, 69, '2024-12-10', 11, 0.00, '006', 'NO', 3168000, '50-50', 'ESTRELLA', 'SI', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra_rechazada`
--

CREATE TABLE `orden_compra_rechazada` (
  `id` int(11) NOT NULL,
  `id_codigo_orden` int(11) DEFAULT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  `persona` int(11) DEFAULT NULL,
  `id_tecnico` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `compra_per` int(11) DEFAULT NULL,
  `consecutivo` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliza`
--

CREATE TABLE `poliza` (
  `id` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `poliza`
--

INSERT INTO `poliza` (`id`, `estado`) VALUES
(1, 'poliza'),
(2, 'NA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `nit` varchar(255) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre`, `direccion`, `ciudad`, `nit`, `id_categoria`) VALUES
(11, 'COL', 'CLL # 21 ', 'medellin', '32124', NULL),
(13, 'COLANTA', 'cll 34 --5', 'Bogota', '664321', 1),
(14, 'EPM', 'Ciudad del rio ', 'MEDELLIN', '783219', 1),
(15, 'Salds Fruco', 'Cll 87 aa SUR-67|', 'Medellin', '322145', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `nombre`) VALUES
(1, 'GESTIÓN GERENCIA GENERAL'),
(2, 'GESTIÓN ADMINISTRATIVA - FINANZAS'),
(3, 'GESTIÓN ADMINISTRATIVA - ÁREA TI'),
(4, 'GESTIÓN ADMINISTRATIVA - COMPRAS'),
(5, 'GESTION ADMINISTRATIVA Y COMERCIAL'),
(6, 'GESTION RECURSOS HUMANOS Y CALIDAD'),
(7, 'GESTIÓN INGENIERÍA'),
(35, 'SISTEMAS DE MULTIPLEXACIÓN RUBIALES - PARTE 2'),
(45, 'PSM REFICAR'),
(49, 'INGENIERÍA SANTA MÓNICA Y NUEVA ESPERANZA'),
(69, 'RETROFIT URRÁ'),
(75, 'SUMINISTROS DE MULTIPLEXORES GRANJA SOLAR REFICAR'),
(89, 'CONFIGURACIÓN RELES CPF OROTOY'),
(100, 'SUMINISTRO MODULOS SFP BLC'),
(113, 'RETROFIT RELÉ GE - 750 POR RELÉ SE - 751'),
(138, 'CENTROS DE TRANSFORMACIÓN PS INTI'),
(152, 'ESTUDIOS DE CONEXIÓN MINIGRANJAS'),
(155, 'ZIKLOSOLAR - CONSTRUCCIÓN, AMPLIACIÓN SE NIATA RED MT, SE HIDROCASANARE'),
(170, 'INGENIERIA, SUMINISTRO, INSTALACION Y PRUEBAS GRANJA SOLAR URRA'),
(232, 'SUMINISTRO CENTRO DE TRANSFORMACION DE 1.25MVA DE 13.8KV Y RECONECTADOR'),
(265, 'LA ACEIBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_asignado`
--

CREATE TABLE `proyecto_asignado` (
  `id` int(11) NOT NULL,
  `id_lider` int(11) DEFAULT NULL,
  `id_proyecto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyecto_asignado`
--

INSERT INTO `proyecto_asignado` (`id`, `id_lider`, `id_proyecto`) VALUES
(1, 13, 3),
(2, 12, 138),
(6, 17, 265),
(7, 10, 3),
(8, 10, 138);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rechazada_item`
--

CREATE TABLE `rechazada_item` (
  `id` int(11) NOT NULL,
  `id_orden_compra_rechazada` int(11) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `codigo_item` varchar(255) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remision`
--

CREATE TABLE `remision` (
  `id` int(11) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `nit` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `contacto` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `fecha_remision` date NOT NULL,
  `proyecto` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `id_proyecto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `remision`
--

INSERT INTO `remision` (`id`, `empresa`, `nit`, `direccion`, `contacto`, `telefono`, `correo`, `fecha_remision`, `proyecto`, `ciudad`, `descripcion`, `id_proyecto`) VALUES
(36, 'CONECTORES ANTIOQUIA', '1293321', 'CLL 66 #21', '3244243', '321298231', 'CONECTORESA@gmail.com', '2024-11-03', '0', 'MEDELLIN', NULL, NULL),
(37, 'Colanta', '1233', 'En la esquina ', 'Camilo el de las vacas', '123342', 'aaaa@correo.com', '2024-11-03', '0', 'La Apartada', NULL, NULL),
(38, '', '', '', '', '', '', '2024-11-06', '0', '', NULL, NULL),
(39, '', '', '', '', '', '', '2024-11-06', '0', '', NULL, NULL),
(40, '', '', '', '', '', '', '2024-11-06', '0', '', NULL, NULL),
(41, '', '', '', '', '', '', '2024-11-06', '0', '', NULL, NULL),
(42, '', '', '', '', '', '', '2024-11-06', '0', '', NULL, NULL),
(43, 'opaa', 'opaaa', 'opaaa', 'aaaa', '1233313', '12dsadac', '2024-11-06', '0', 'opaaa', NULL, NULL),
(44, '', '', '', '', '', '', '2024-11-06', '0', '', NULL, NULL),
(45, '', '', '', '', '', '', '2024-11-06', '0', '', NULL, NULL),
(46, '', '', '', '', '', '', '2024-11-06', '0', '', NULL, NULL),
(47, '', '', '', '', '', '', '2024-11-08', '0', '', NULL, NULL),
(48, 'CONECTORES ANTIOQUIA', '12321', 'En la esquina ', 'Eduardo Otero', '1234321', 'CONECTORESA@gmail.com', '2024-11-08', '0', 'Medellin', NULL, NULL),
(49, '', '', '', '', '', '', '2024-11-18', '0', '', NULL, NULL),
(50, '', '', '', '', '', '', '2024-11-18', '0', '', NULL, NULL),
(51, '', '', '', '', '', '', '2024-11-18', '0', '', NULL, NULL),
(52, '', '', '', '', '', '', '2024-11-18', '0', '', NULL, NULL),
(53, '', '', '', '', '', '', '2024-11-18', '0', '', NULL, NULL),
(54, '', '', '', '', '', '', '2024-11-18', '0', '', NULL, NULL),
(55, '', '', '', '', '', '', '2024-11-18', '0', '', NULL, NULL),
(56, 'CONECTORES ANTIOQUIA', '129321', 'cll 88 aa sur', 'Eduardo Otero', '324921321', 'CONECTORESA@gmail.com', '2024-12-11', '0', 'MEDELLIN', NULL, NULL),
(57, '', '', '', '', '', '', '2024-12-11', '0', '', NULL, NULL),
(58, '', '', '', '', '', '', '2024-12-12', '0', '', NULL, NULL),
(59, '', '', '', '', '', '', '2024-12-12', '0', '', NULL, NULL),
(60, '', '', '', '', '', '', '2024-12-12', '0', '', NULL, NULL),
(61, '', '', '', '', '', '', '2024-12-12', '0', '', NULL, NULL),
(62, '', '', '', '', '', '', '2024-12-12', '0', '', NULL, NULL),
(63, '', '', '', '', '', '', '2024-12-12', '0', '', NULL, NULL),
(64, '', '', '', '', '', '', '2024-12-12', '0', '', NULL, NULL),
(65, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, NULL),
(66, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, NULL),
(67, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, NULL),
(68, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, NULL),
(69, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, 3),
(70, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, NULL),
(71, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, NULL),
(72, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, NULL),
(73, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, NULL),
(74, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, NULL),
(75, '', '', '', '', '', '', '2024-12-16', '0', '', NULL, NULL),
(76, '', '', '', '', '', '', '2024-12-17', '0', '', NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remisionaprobacion`
--

CREATE TABLE `remisionaprobacion` (
  `id` int(11) NOT NULL,
  `id_remision` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `remisionaprobacion`
--

INSERT INTO `remisionaprobacion` (`id`, `id_remision`, `id_persona`, `id_estado`) VALUES
(1, 69, 10, 1),
(2, 70, 10, 1),
(3, 71, 10, 1),
(4, 72, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remision_item`
--

CREATE TABLE `remision_item` (
  `id` int(11) NOT NULL,
  `id_inventario` int(11) DEFAULT NULL,
  `id_remision` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `remision_item`
--

INSERT INTO `remision_item` (`id`, `id_inventario`, `id_remision`, `descripcion`, `cantidad`) VALUES
(1, 317, 36, 'pantalla', 1),
(2, 318, 36, 'Pantalla', 1),
(3, 319, 37, 'Teclado ', 1),
(4, 320, 37, 'Pantalla', 1),
(5, 325, 38, 'w', 35),
(6, 325, 39, 'w', 10),
(7, 328, 39, 'aaa', 1),
(8, 326, 39, 'sss', 1),
(9, 325, 39, 'w', 11),
(10, 325, 40, 'w', 10),
(11, 325, 41, 'w', 10),
(12, 319, 42, 'Teclado ', 1),
(13, 325, 43, 'w', 8),
(14, 325, 44, 'w', 4),
(15, 325, 45, 'w', 9),
(16, 325, 46, 'w', 2),
(17, 322, 48, 'q', 1),
(18, 325, 48, 'w', 1),
(19, 325, 49, 'w', 4),
(20, 336, 49, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1),
(21, 333, 49, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1),
(22, 337, 50, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1),
(23, 325, 50, 'w', 5),
(24, 331, 51, 'pantalla', 1),
(25, 325, 51, 'w', 5),
(26, 342, 51, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1),
(27, 324, 51, 'no se', 1),
(28, 344, 52, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1),
(29, 345, 53, 'pc Lenovo  CON MUCHAS COSAS DE LUCESITAS QUE HACEN QUE SE VEA SUPER SUPER SUPER WOOOW', 1),
(30, 340, 53, 'pc Lenovo ', 1),
(31, 346, 54, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 2),
(32, 346, 55, 'Pantalla FULL HD 4K CON DESTELLOS EN LOS  COSTADOS Y FILTRO DE AIRE UNI', 1),
(33, 323, 55, 'adasdasd', 1),
(34, 353, 56, 'tablero', 7),
(35, 325, 64, 'w', 2),
(36, 332, 64, 'no', 1),
(37, 325, 65, 'w', 1),
(38, 330, 65, 'aaaa', 1),
(39, 325, 66, 'w', 2),
(40, 354, 66, 'pc Lenovo ', 3),
(41, 358, 66, 'TRANSFORMADO DE 20X20 CON INTEGRACION DE LINEA DE ALTA TENSION TRIFASICO', 2),
(42, 325, 67, 'w', 2),
(43, 325, 68, 'w', 1),
(44, 334, 69, 'pc Lenovo ', 1),
(45, 335, 70, 'pantalla', 1),
(46, 329, 71, 'Pantalla', 1),
(47, 338, 72, 'Pantalla', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retencion_compra`
--

CREATE TABLE `retencion_compra` (
  `id` int(11) NOT NULL,
  `id_Compra` int(11) NOT NULL,
  `retencion` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `retencion_compra`
--

INSERT INTO `retencion_compra` (`id`, `id_Compra`, `retencion`) VALUES
(4, 162, 119700.00),
(5, 163, 1028160.00),
(6, 164, 3664500.00),
(7, 165, 0.00),
(8, 166, 0.00),
(9, 167, 0.00),
(10, 168, 0.00),
(11, 169, 159588.00),
(12, 170, 0.00),
(13, 171, 2562.00),
(14, 172, 84000000.00),
(15, 173, 0.00),
(16, 174, 0.00),
(17, 175, 2400.00),
(18, 176, 0.00),
(19, 177, 0.00),
(20, 178, 0.00),
(21, 179, 0.00),
(22, 180, 0.00),
(23, 181, 1500.00),
(24, 182, 92256.00),
(25, 183, 11612.40),
(26, 184, 23466.24),
(27, 185, 1250.88),
(28, 186, 19100.00),
(29, 187, 0.00),
(30, 188, 0.00),
(31, 189, 189240.00),
(32, 190, 190104.00),
(33, 191, 0.00),
(34, 192, 0.00),
(35, 193, 206800.00),
(36, 194, 176000.00),
(37, 195, 176000.00),
(38, 196, 0.00),
(39, 197, 0.00),
(40, 198, 0.00),
(41, 199, 0.00),
(42, 200, 0.00),
(43, 201, 0.00),
(44, 202, 0.00),
(45, 203, 0.00),
(46, 204, 0.00),
(47, 205, 0.00),
(48, 206, 0.00),
(49, 207, 0.00),
(50, 208, 0.00),
(51, 209, 1800000.00),
(52, 210, 16710000.00),
(53, 211, 0.00),
(54, 212, 594000.00),
(55, 213, 0.00),
(56, 214, 372480.00),
(57, 215, 168780.00),
(58, 216, 500000.00),
(59, 217, 387000.00),
(60, 218, 279000.00),
(61, 219, 0.00),
(62, 220, 0.00),
(63, 221, 0.00),
(64, 222, 784800.00),
(65, 223, 320000.00),
(66, 224, 7800.00),
(67, 225, 10270.00),
(68, 226, 9504.00),
(69, 227, 370062.00),
(70, 228, 200000.20),
(71, 229, 200000.20),
(72, 230, 200000.20),
(73, 231, 200000.20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retencion_ordencompra`
--

CREATE TABLE `retencion_ordencompra` (
  `id` int(11) NOT NULL,
  `id_ordenCompra` int(11) DEFAULT NULL,
  `retencion` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `retencion_ordencompra`
--

INSERT INTO `retencion_ordencompra` (`id`, `id_ordenCompra`, `retencion`) VALUES
(5, 181, 2244000.00),
(7, 183, 1028160.00),
(8, 184, 119700.00),
(9, 185, 3664500.00),
(10, 186, 0.00),
(11, 187, 0.00),
(12, 188, 0.00),
(13, 189, 0.00),
(14, 190, 159588.00),
(15, 191, 84000000.00),
(16, 192, 2562.00),
(17, 193, 0.00),
(18, 194, 2400.00),
(19, 195, 0.00),
(20, 196, 0.00),
(21, 197, 0.00),
(22, 198, 0.00),
(23, 199, 0.00),
(24, 200, 0.00),
(25, 201, 0.00),
(26, 202, 19100.00),
(27, 203, 1250.88),
(29, 205, 23466.24),
(30, 206, 11612.40),
(31, 207, 0.00),
(32, 208, 1500.00),
(33, 209, 92256.00),
(34, 210, 189240.00),
(35, 211, 0.00),
(36, 212, 190104.00),
(37, 213, 0.00),
(38, 214, 0.00),
(39, 215, 0.00),
(40, 216, 206800.00),
(42, 218, 0.00),
(43, 219, 176000.00),
(44, 220, 0.00),
(45, 221, 0.00),
(46, 222, 0.00),
(47, 223, 0.00),
(48, 224, 0.00),
(49, 225, 0.00),
(50, 226, 0.00),
(51, 227, 0.00),
(52, 228, 0.00),
(53, 229, 0.00),
(54, 230, 0.00),
(55, 231, 0.00),
(56, 232, 1800000.00),
(57, 233, 16710000.00),
(58, 234, 594000.00),
(59, 235, 0.00),
(60, 236, 168780.00),
(61, 237, 372480.00),
(62, 238, 500000.00),
(63, 239, 387000.00),
(64, 240, 279000.00),
(65, 241, 0.00),
(66, 242, 0.00),
(67, 243, 0.00),
(68, 244, 200000.20),
(69, 245, 370062.00),
(71, 247, 784800.00),
(73, 249, 320000.00),
(74, 250, 7800.00),
(75, 251, 10270.00),
(76, 252, 9504.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`) VALUES
(1, 'Superusuario'),
(2, 'Técnico Aprobador'),
(3, 'Director de Proyecto'),
(4, 'Gerente Proyecto'),
(5, 'Administrativa'),
(6, 'Gerencia'),
(7, 'colaborador'),
(8, 'encargado proyecto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_remision`
--

CREATE TABLE `temp_remision` (
  `id` int(11) NOT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `nit` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_remision_item`
--

CREATE TABLE `temp_remision_item` (
  `id` int(11) NOT NULL,
  `id_inventario` int(11) DEFAULT NULL,
  `id_remsion` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id` int(11) NOT NULL,
  `ubicacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id`, `ubicacion`) VALUES
(1, 'Oficina Medellin'),
(2, 'Bodega Medellin'),
(3, 'Proyecto'),
(4, '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `cargo`, `correo`, `password`, `id_rol`) VALUES
(1, 'Alejandro', 'Zapata', 'NA', 'gerencia@acemaingenieria.com', 'Acema2024*', 1),
(2, 'Felipe', 'Gutierrez Zapata', 'NA', 'felipe.gutierrez@acemaingenieria.com', 'Acema2024*', 2),
(10, 'persona que resive', 'proyecto', 'NA', 'miguepz12@gmail.com', 'Acema2024*', 8),
(11, 'Mariana', 'Agudelo', 'NA', 'mariana.agudelo@acemaingenieria.com', 'Acema2024*', 4),
(12, 'Natalia ', ' Villegas', 'NA', 'natalia.villegas@acemaingenieria.com', 'Acema2024*', 3),
(13, 'Santiago ', 'Montoya Marín', 'NA', 'santiago.montoya@acemaingenieria.com', 'Acema2024*', 3),
(14, 'Winder', 'Gutierrez Zapata', 'NA', 'winder.juarez@acemaingenieria.com', 'Acema2024*', 3),
(15, 'Alejandro', 'Rivera', 'NA', 'alejandro.rivera@acemaingenieria.com', 'Acema2024*', 7),
(16, 'Andrés', 'Arroyave', 'NA', 'andres.arroyave@acemaingenieria.com', 'Acema2024*', 3),
(17, 'Natalia', 'Ochoa Blanco', 'NA', 'any.i.ochoa@acemaingenieria.com', 'Acema2024*', 3),
(18, 'Brayan', 'Rodriguez', 'NA', 'brayan.rodriguez@acemaingenieria.com', 'Acema2024*', 3),
(19, 'Carlos', 'Ruales', 'NA', 'carlos.ruales@acemaingenieria.com', 'Acema2024*', 7),
(20, 'Carlos Alberto', 'Vasquez', 'NA', 'carlos.vasquez@acemaingenieria.com', 'Acema2024*', 7),
(21, 'Daniela', 'Ruiz', 'NA', 'daniela.ruiz@acemaingenieria.com', 'Acema2024*', 7),
(22, 'Daniela', 'Tobón Muñoz', 'NA', 'daniela.tobon@acemaingenieria.com', 'Acema2024*', 7),
(23, 'David Camilo', 'Osorio', 'NA', 'david.osorio@acemaingenieria.com', 'Acema2024*', 7),
(24, 'Diego Alexander', 'Otalvaro', 'NA', 'diego.otalvaro@acemaingenieria.com', 'Acema2024*', 7),
(25, 'Duvan', 'Muñoz', 'NA', 'duvan.munoz@acemaingenieria.com', 'Acema2024*', 7),
(26, 'Duvian Alejandro', 'Gallo', 'NA', 'duvian.gallo@acemaingenieria.com', 'Acema2024*', 7),
(27, 'Edilson', 'Sierra', 'NA', 'edilson.sierra@acemaingenieria.com', 'Acema2024*', 7),
(28, 'Felipe', 'Gutiérrez Zapata', 'NA', 'felipe.gutierrez@acemaingenieria.coom', 'Acema2024*', 3),
(29, 'John Esleyder', 'Cardona López', 'NA', 'john.cardona@acemaingenieria.com', 'Acema2024*', 7),
(30, 'Johny Ferney', 'Londoño', 'NA', 'johny.londono@acemaingenieria.com', 'Acema2024*', 7),
(31, 'Jonathan', 'Molano', 'NA', 'jonathan.molano@acemaingenieria.com', 'Acema2024*', 7),
(32, 'Jorge', 'Toro', 'NA', 'jorge.toro@acemaingenieria.com', 'Acema2024*', 7),
(33, 'Kevin Smit', 'Montes', 'NA', 'kevin.montes@acemaingenieria.com', 'Acema2024*', 7),
(34, 'Lady Johanna', 'González', 'NA', 'lady.gonzalez@acemaingenieria.com', 'Acema2024*', 2),
(35, 'Leonardo', 'Londoño', 'NA', 'leonardo.londono@acemaingenieria.com', 'Acema2024*', 7),
(36, 'Lina María', 'Panesso', 'NA', 'lina.panesso@acemaingenieria.com', 'Acema2024*', 7),
(37, 'Madeleyn', 'Ramírez', 'NA', 'madeleyn.ramirez@acemaingenieria.com', 'Acema2024*', 7),
(38, 'María José', 'Sierra', 'NA', 'mariaj.sierra@acemaingenieria.com', 'Acema2024*', 7),
(39, 'Mateo', 'Sepulveda', 'NA', 'mateo.sepulveda@acemaingenieria.com', 'Acema2024*', 7),
(40, 'Michael', 'Zapata', 'NA', 'michael.zapata@acemaingenieria.com', 'Acema2024*', 7),
(41, 'Miguel Ángel', 'Largo', 'NA', 'miguel.largo@acemaingenieria.com', 'Acema2024*', 7),
(42, 'Miguel Angel', 'Toro', 'NA', 'miguel.toro@acemaingenieria.com', 'Acema2024*', 7),
(43, 'Natalia', 'Restrepo', 'NA', 'natalia.restrepo@acemaingenieria.com', 'Acema2024*', 7),
(44, 'Santiago', 'Ríos', 'NA', 'santiago.rios@acemaingenieria.com', 'Acema2024*', 7),
(45, 'Valentina', 'Arango Barrada', 'NA', 'valentina.arango@acemaingenieria.com', 'Acema2024*', 7),
(47, 'Yuliana', 'David', 'NA', 'yuliana.david@acemaingenieria.com', 'Acema2024*', 5),
(48, 'Alejandro', 'Zapata Ferraro', 'NA', 'AlejandroZapataFerraro@ACEMASAS.onmicrosoft.com\r\n', 'Acema2024*', 7),
(49, 'Andrés', 'Felipe  Ruiz', 'NA', 'felipe.ruiz@acemaingenieria.com\r\n', 'Acema2024*', 3),
(50, 'Andrés Felipe', 'Carvajal', 'NA', 'felipe.carvajal@acemaingenieria.com\r\n', 'Acema2024*', 3),
(51, 'Laura', 'Cristina Rendón', 'NA', 'laura.rendon@acemaingenieria.com', 'Acema2024*', 7),
(52, 'María José ', 'Santodomingo', 'NA', 'maria.santodomingo@acemaingenieria.com\r\n', 'Acema2024*', 7),
(53, 'Misael', 'Magallanes', 'NA', 'misael.magallanes@acemaingenieria.com', 'Acema2024*', 7),
(54, 'Natalia María \r\n', 'Correa', 'NA', 'natalia.correa@acemaingenieria.com\r\n', 'Acema2024*', 7),
(55, 'Oscar ', 'Sánchez', 'NA', 'oscar.sanchez@acemaingenieria.com', 'Acema2024*', 7),
(56, 'supervisor HSEQ1', '-', 'NA', 'supervisor.HSEQ1@acemaingenieria.com\r\n', 'Acema2024*', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_iva`
--

CREATE TABLE `valor_iva` (
  `id` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valor_iva`
--

INSERT INTO `valor_iva` (`id`, `id_orden`, `iva`, `valor`) VALUES
(5, 181, 10, 2040000.00),
(7, 183, 19, 2052000.00),
(8, 184, 5, 47500.00),
(9, 185, 5, 96000.00),
(10, 185, 19, 5529000.00),
(11, 188, 10, 18900.00),
(12, 189, 10, 10000.00),
(13, 190, 10, 120900.00),
(14, 193, 5, 600.00),
(15, 195, 10, 100.00),
(16, 196, 5, 600.00),
(17, 197, 5, 16050.00),
(18, 198, 5, 500.00),
(19, 199, 10, 10560.00),
(20, 200, 19, 9215.00),
(21, 201, 5, 3600.00),
(22, 201, 10, 823.20),
(23, 202, 5, 4550.00),
(24, 202, 19, 19000.00),
(25, 203, 10, 67.20),
(26, 203, 19, 5814.00),
(29, 205, 10, 8691.20),
(30, 206, 10, 9677.00),
(31, 207, 10, 11223.00),
(32, 208, 10, 5000.00),
(33, 209, 5, 156800.00),
(34, 209, 10, 120000.00),
(35, 210, 5, 21400.00),
(36, 210, 19, 608000.00),
(37, 211, 5, 147200.00),
(38, 211, 10, 12000.00),
(39, 212, 10, 950520.00),
(40, 213, 10, 72000.00),
(41, 214, 19, 54720.00),
(42, 215, 10, 2100.00),
(43, 216, 10, 940000.00),
(45, 218, 10, 1650000.00),
(46, 219, 5, 160000.00),
(47, 219, 10, 1440000.00),
(48, 220, 10, 1100000.00),
(49, 221, 5, 100.00),
(50, 222, 5, 880000.00),
(51, 223, 10, 980000.00),
(52, 225, 5, 1000.00),
(53, 231, 5, 3000000.00),
(54, 233, 10, 26325000.00),
(55, 233, 19, 7125000.00),
(56, 234, 10, 1188000.00),
(57, 235, 19, 1653000.00),
(58, 236, 19, 1603410.00),
(59, 237, 19, 2359040.00),
(60, 238, 19, 1900000.00),
(61, 239, 10, 1290000.00),
(62, 240, 10, 930000.00),
(63, 241, 10, 4300000.00),
(64, 242, 10, 320000.00),
(65, 244, 5, 500000.50),
(66, 245, 19, 1171863.00),
(68, 249, 10, 1600000.00),
(69, 250, 5, 32500.00),
(70, 251, 19, 150100.00),
(71, 252, 10, 316800.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_iva_compra`
--

CREATE TABLE `valor_iva_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `iva` decimal(10,2) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valor_iva_compra`
--

INSERT INTO `valor_iva_compra` (`id`, `id_compra`, `iva`, `valor`) VALUES
(4, 162, 5.00, 47500.00),
(5, 163, 19.00, 2052000.00),
(6, 164, 5.00, 96000.00),
(7, 164, 19.00, 5529000.00),
(8, 166, 10.00, 18900.00),
(9, 168, 10.00, 10000.00),
(10, 169, 10.00, 120900.00),
(11, 170, 5.00, 600.00),
(12, 173, 5.00, 16050.00),
(13, 174, 10.00, 100.00),
(14, 176, 5.00, 600.00),
(15, 177, 5.00, 500.00),
(16, 178, 10.00, 10560.00),
(17, 179, 19.00, 9215.00),
(18, 180, 10.00, 11223.00),
(19, 181, 10.00, 5000.00),
(20, 182, 5.00, 156800.00),
(21, 182, 10.00, 120000.00),
(22, 183, 10.00, 9677.00),
(23, 184, 10.00, 8691.20),
(24, 185, 10.00, 67.20),
(25, 185, 19.00, 5814.00),
(26, 186, 5.00, 4550.00),
(27, 186, 19.00, 19000.00),
(28, 187, 5.00, 3600.00),
(29, 187, 10.00, 823.20),
(30, 188, 5.00, 147200.00),
(31, 188, 10.00, 12000.00),
(32, 189, 5.00, 21400.00),
(33, 189, 19.00, 608000.00),
(34, 190, 10.00, 950520.00),
(35, 191, 10.00, 72000.00),
(36, 192, 19.00, 54720.00),
(37, 193, 10.00, 940000.00),
(38, 194, 5.00, 160000.00),
(39, 194, 10.00, 1440000.00),
(40, 195, 5.00, 160000.00),
(41, 195, 10.00, 1440000.00),
(42, 196, 10.00, 2100.00),
(43, 197, 5.00, 880000.00),
(44, 198, 5.00, 100.00),
(45, 199, 10.00, 980000.00),
(46, 200, 5.00, 1000.00),
(47, 208, 5.00, 3000000.00),
(48, 210, 10.00, 26325000.00),
(49, 210, 19.00, 7125000.00),
(50, 211, 19.00, 1653000.00),
(51, 212, 10.00, 1188000.00),
(52, 214, 19.00, 2359040.00),
(53, 215, 19.00, 1603410.00),
(54, 216, 19.00, 1900000.00),
(55, 217, 10.00, 1290000.00),
(56, 218, 10.00, 930000.00),
(57, 220, 10.00, 320000.00),
(58, 221, 10.00, 4300000.00),
(59, 223, 10.00, 1600000.00),
(60, 224, 5.00, 32500.00),
(61, 225, 19.00, 150100.00),
(62, 226, 10.00, 316800.00),
(63, 227, 19.00, 1171863.00),
(64, 228, 5.00, 500000.50),
(65, 229, 5.00, 500000.50),
(66, 230, 5.00, 500000.50),
(67, 231, 5.00, 500000.50);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprobaciones`
--
ALTER TABLE `aprobaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orden_compra` (`id_orden_compra`),
  ADD KEY `id_aprobador` (`id_aprobador`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proyecto_asignados` (`id_proyecto_asignados`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `calificativo`
--
ALTER TABLE `calificativo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_ordenCompra` (`codigo_ordenCompra`),
  ADD KEY `persona` (`persona`),
  ADD KEY `tecnico` (`tecnico`),
  ADD KEY `id_estado_compra` (`id_estado_compra`),
  ADD KEY `proyecto` (`proyecto`),
  ADD KEY `fk_compra_per_compra` (`compra_per`),
  ADD KEY `fk_compra_proveedor` (`id_proveedor`),
  ADD KEY `fk_compra_poliza` (`id_poliza`);

--
-- Indices de la tabla `compra_item`
--
ALTER TABLE `compra_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `compra_llegada`
--
ALTER TABLE `compra_llegada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_persona_resive` (`id_persona_resive`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_ubicacion` (`id_ubicacion`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_compra`
--
ALTER TABLE `estado_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra_item` (`id_compra_item`),
  ADD KEY `ubicacion` (`ubicacion`);

--
-- Indices de la tabla `inventario_proyecto`
--
ALTER TABLE `inventario_proyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra_item` (`id_compra_item`),
  ADD KEY `ubicacion` (`ubicacion`);

--
-- Indices de la tabla `item_compra`
--
ALTER TABLE `item_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orden` (`id_orden`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tecnico` (`id_tecnico`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `persona` (`persona`),
  ADD KEY `compra_per` (`compra_per`),
  ADD KEY `fk_orden_compra_proveedor` (`id_proveedor`),
  ADD KEY `fk_orden_compra_poliza` (`id_poliza`);

--
-- Indices de la tabla `orden_compra_rechazada`
--
ALTER TABLE `orden_compra_rechazada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `persona` (`persona`),
  ADD KEY `id_tecnico` (`id_tecnico`),
  ADD KEY `compra_per` (`compra_per`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `poliza`
--
ALTER TABLE `poliza`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_categoria` (`id_categoria`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto_asignado`
--
ALTER TABLE `proyecto_asignado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lider` (`id_lider`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `rechazada_item`
--
ALTER TABLE `rechazada_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orden_compra_rechazada` (`id_orden_compra_rechazada`);

--
-- Indices de la tabla `remision`
--
ALTER TABLE `remision`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `remisionaprobacion`
--
ALTER TABLE `remisionaprobacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_remision` (`id_remision`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `remision_item`
--
ALTER TABLE `remision_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inventario` (`id_inventario`),
  ADD KEY `id_remision` (`id_remision`);

--
-- Indices de la tabla `retencion_compra`
--
ALTER TABLE `retencion_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Compra` (`id_Compra`);

--
-- Indices de la tabla `retencion_ordencompra`
--
ALTER TABLE `retencion_ordencompra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ordenCompra` (`id_ordenCompra`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temp_remision`
--
ALTER TABLE `temp_remision`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temp_remision_item`
--
ALTER TABLE `temp_remision_item`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `valor_iva`
--
ALTER TABLE `valor_iva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_valor_iva_orden` (`id_orden`);

--
-- Indices de la tabla `valor_iva_compra`
--
ALTER TABLE `valor_iva_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_valor_iva_compra` (`id_compra`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aprobaciones`
--
ALTER TABLE `aprobaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `calificativo`
--
ALTER TABLE `calificativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT de la tabla `compra_item`
--
ALTER TABLE `compra_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;

--
-- AUTO_INCREMENT de la tabla `compra_llegada`
--
ALTER TABLE `compra_llegada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_compra`
--
ALTER TABLE `estado_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- AUTO_INCREMENT de la tabla `inventario_proyecto`
--
ALTER TABLE `inventario_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `item_compra`
--
ALTER TABLE `item_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT de la tabla `orden_compra_rechazada`
--
ALTER TABLE `orden_compra_rechazada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `poliza`
--
ALTER TABLE `poliza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT de la tabla `proyecto_asignado`
--
ALTER TABLE `proyecto_asignado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rechazada_item`
--
ALTER TABLE `rechazada_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `remision`
--
ALTER TABLE `remision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `remisionaprobacion`
--
ALTER TABLE `remisionaprobacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `remision_item`
--
ALTER TABLE `remision_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `retencion_compra`
--
ALTER TABLE `retencion_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `retencion_ordencompra`
--
ALTER TABLE `retencion_ordencompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `temp_remision`
--
ALTER TABLE `temp_remision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temp_remision_item`
--
ALTER TABLE `temp_remision_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `valor_iva`
--
ALTER TABLE `valor_iva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `valor_iva_compra`
--
ALTER TABLE `valor_iva_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprobaciones`
--
ALTER TABLE `aprobaciones`
  ADD CONSTRAINT `aprobaciones_ibfk_1` FOREIGN KEY (`id_orden_compra`) REFERENCES `orden_compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aprobaciones_ibfk_2` FOREIGN KEY (`id_aprobador`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `aprobaciones_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aprobaciones_orden` FOREIGN KEY (`id_orden_compra`) REFERENCES `orden_compra` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`id_proyecto_asignados`) REFERENCES `proyecto_asignado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_asignaciones_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`codigo_ordenCompra`) REFERENCES `orden_compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`persona`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`tecnico`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_4` FOREIGN KEY (`id_estado_compra`) REFERENCES `estado_compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_5` FOREIGN KEY (`proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_compra_per_compra` FOREIGN KEY (`compra_per`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_compra_poliza` FOREIGN KEY (`id_poliza`) REFERENCES `poliza` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_compra_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `compra_item`
--
ALTER TABLE `compra_item`
  ADD CONSTRAINT `compra_item_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_compra_item_compra` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `compra_llegada`
--
ALTER TABLE `compra_llegada`
  ADD CONSTRAINT `compra_llegada_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_llegada_ibfk_2` FOREIGN KEY (`id_persona_resive`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_llegada_ibfk_3` FOREIGN KEY (`id_persona`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_llegada_ibfk_4` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_compra_llegada_compra` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_inventario_compra_item` FOREIGN KEY (`id_compra_item`) REFERENCES `compra_item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_compra_item`) REFERENCES `compra_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`ubicacion`) REFERENCES `ubicacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario_proyecto`
--
ALTER TABLE `inventario_proyecto`
  ADD CONSTRAINT `inventario_proyecto_ibfk_1` FOREIGN KEY (`id_compra_item`) REFERENCES `compra_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_proyecto_ibfk_2` FOREIGN KEY (`ubicacion`) REFERENCES `ubicacion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `item_compra`
--
ALTER TABLE `item_compra`
  ADD CONSTRAINT `fk_item_compra_orden` FOREIGN KEY (`id_orden`) REFERENCES `orden_compra` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_compra_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `orden_compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `fk_orden_compra_poliza` FOREIGN KEY (`id_poliza`) REFERENCES `poliza` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_orden_compra_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`),
  ADD CONSTRAINT `orden_compra_ibfk_1` FOREIGN KEY (`id_tecnico`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_compra_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_compra_ibfk_3` FOREIGN KEY (`persona`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_compra_ibfk_4` FOREIGN KEY (`compra_per`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `orden_compra_rechazada`
--
ALTER TABLE `orden_compra_rechazada`
  ADD CONSTRAINT `orden_compra_rechazada_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orden_compra_rechazada_ibfk_2` FOREIGN KEY (`persona`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orden_compra_rechazada_ibfk_3` FOREIGN KEY (`id_tecnico`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orden_compra_rechazada_ibfk_4` FOREIGN KEY (`compra_per`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orden_compra_rechazada_ibfk_5` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `calificativo` (`id`);

--
-- Filtros para la tabla `proyecto_asignado`
--
ALTER TABLE `proyecto_asignado`
  ADD CONSTRAINT `fk_proyecto_asignado_proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `proyecto_asignado_ibfk_1` FOREIGN KEY (`id_lider`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `proyecto_asignado_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rechazada_item`
--
ALTER TABLE `rechazada_item`
  ADD CONSTRAINT `rechazada_item_ibfk_1` FOREIGN KEY (`id_orden_compra_rechazada`) REFERENCES `orden_compra_rechazada` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `remision`
--
ALTER TABLE `remision`
  ADD CONSTRAINT `fk_id_proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `remisionaprobacion`
--
ALTER TABLE `remisionaprobacion`
  ADD CONSTRAINT `remisionaprobacion_ibfk_1` FOREIGN KEY (`id_remision`) REFERENCES `remision` (`id`),
  ADD CONSTRAINT `remisionaprobacion_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `remisionaprobacion_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `remision_item`
--
ALTER TABLE `remision_item`
  ADD CONSTRAINT `fk_remision_item_inventario` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_remision_item_remision` FOREIGN KEY (`id_remision`) REFERENCES `remision` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `remision_item_ibfk_1` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `remision_item_ibfk_2` FOREIGN KEY (`id_remision`) REFERENCES `remision` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `retencion_compra`
--
ALTER TABLE `retencion_compra`
  ADD CONSTRAINT `fk_retencion_Compra_compra` FOREIGN KEY (`id_Compra`) REFERENCES `compra` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `retencion_ordencompra`
--
ALTER TABLE `retencion_ordencompra`
  ADD CONSTRAINT `fk_retencion_ordenCompra_orden` FOREIGN KEY (`id_ordenCompra`) REFERENCES `orden_compra` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `valor_iva`
--
ALTER TABLE `valor_iva`
  ADD CONSTRAINT `fk_valor_iva_orden` FOREIGN KEY (`id_orden`) REFERENCES `orden_compra` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `valor_iva_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `orden_compra` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `valor_iva_compra`
--
ALTER TABLE `valor_iva_compra`
  ADD CONSTRAINT `fk_valor_iva_compra` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `valor_iva_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
