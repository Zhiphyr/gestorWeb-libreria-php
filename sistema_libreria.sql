-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2025 a las 06:20:39
-- Versión del servidor: 8.0.43
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_libreria`
--
CREATE DATABASE IF NOT EXISTS `sistema_libreria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `sistema_libreria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `id_autor` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`id_autor`, `nombre`, `estado`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'J. K. Rowling', 0, '2025-11-24 22:05:42', '2025-11-30 11:26:13'),
(2, 'Stephen King', 1, '2025-11-24 22:41:56', '2025-11-24 22:41:56'),
(3, 'Stephenie Meyer', 1, '2025-11-24 23:44:57', '2025-11-24 23:44:57'),
(4, 'Alex Hirsch', 1, '2025-11-25 00:49:30', '2025-11-25 00:49:30'),
(5, 'Gege Akutami', 1, '2025-11-25 01:54:42', '2025-11-25 08:48:47'),
(6, 'Tatsuki Fujimoto', 1, '2025-11-25 10:38:25', '2025-11-25 10:38:25'),
(7, 'Eiichiro Oda', 1, '2025-11-29 19:43:15', '2025-11-29 19:43:15'),
(11, 'John Green', 1, '2025-11-29 20:34:44', '2025-11-29 20:34:44'),
(12, 'Mariana Enriquez', 1, '2025-11-29 20:38:31', '2025-11-29 20:38:31'),
(13, 'J.K. Rowling', 1, '2025-11-29 20:41:28', '2025-11-29 20:41:28'),
(14, 'Antoine de Saint-Exupéry', 1, '2025-12-02 12:16:22', '2025-12-02 12:16:22'),
(15, 'Miguel de Cervantes Saavedra', 1, '2025-12-04 13:28:42', '2025-12-04 13:28:42'),
(16, 'Akira Toriyama', 1, '2025-12-04 13:29:29', '2025-12-04 13:29:29'),
(17, 'J. R. R. Tolkien', 1, '2025-12-04 18:43:35', '2025-12-04 18:43:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text,
  `estado` int NOT NULL DEFAULT '1',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_eliminacion` datetime DEFAULT NULL,
  `fecha_restauracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`, `estado`, `fecha_creacion`, `fecha_eliminacion`, `fecha_restauracion`) VALUES
(1, 'Fantasia', 'Historias que contienen magia, mundos imaginarios, criaturas míticas y elementos sobrenaturales.', 1, '2025-11-23 22:37:20', NULL, NULL),
(2, 'Ciencia Ficción', 'Historias basadas en el futuro, tecnología avanzada, viajes espaciales, vida extraterrestre y especulación científica.', 1, '2025-11-23 22:39:04', NULL, '2025-11-23 23:00:41'),
(3, 'Romance', 'Historias enfocadas en la relación amorosa y emocional entre los personajes.', 1, '2025-11-23 23:00:06', NULL, '2025-11-24 17:57:19'),
(4, 'Horror / Terror', 'Historias diseñadas para evocar miedo, repulsión o shock, a menudo involucrando elementos sobrenaturales, monstruos o amenazas psicológicas.', 1, '2025-11-24 18:01:25', NULL, NULL),
(5, 'Biografía / Autobiografía / Memorias', 'Cuentan la vida de una persona (biografía), la vida del propio autor (autobiografía), o recuentos de experiencias y eventos específicos de la vida del autor (memorias).', 0, '2025-11-24 18:01:51', NULL, NULL),
(6, 'Historia', 'Libros que examinan y analizan eventos, personas y períodos del pasado.', 1, '2025-11-24 18:02:05', NULL, NULL),
(7, 'Política y Ciencias Sociales', 'Incluye temas sobre gobierno, economía, sociología, psicología y asuntos de actualidad.', 0, '2025-11-24 18:02:30', NULL, NULL),
(8, 'Viajes', 'Documentación de viajes, experiencias personales en otros lugares, o guías prácticas para turistas.', 1, '2025-11-24 18:02:46', NULL, NULL),
(9, 'Historieta', 'Serie de dibujos que narran una historia de forma secuencial, combinando texto e imágenes', 1, '2025-11-25 00:46:54', NULL, NULL),
(10, 'Manga', 'Cómics de origen japonés con estilo artístico y narrativo particular.', 1, '2025-11-25 01:53:19', NULL, NULL),
(11, 'Infantil', 'Textos y diseños adaptados a la etapa de desarrollo de los niños, utilizando un lenguaje sencillo, tramas directas e ilustraciones llamativas para captar su interés.', 1, '2025-12-02 12:15:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `estado` int DEFAULT '1',
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `documento`, `telefono`, `correo`, `estado`, `fecha_registro`, `fecha_actualizacion`) VALUES
(1, 'LUIS ANGEL CASTILLO GUEVARA', '75405436', '947010376', 'luisgcastilllo@gmail.com', 1, '2025-11-30 00:00:27', '2025-11-30 11:18:37'),
(2, 'TIENDAS POR DEPARTAMENTO RIPLEY S.A.C.', '20337564373', '999222111', 'ripley@gmail.com', 1, '2025-11-30 11:23:36', '2025-11-30 11:23:36'),
(3, 'CLIENTE VARIOS', '00000000', NULL, NULL, 1, '2025-11-30 13:35:55', '2025-11-30 13:35:55'),
(4, 'HIPERMERCADOS TOTTUS S.A', '20508565934', NULL, NULL, 1, '2025-11-30 14:54:32', '2025-11-30 14:54:32'),
(5, 'LIBRERIAS CRISOL S.A.C.', '20501457869', NULL, NULL, 1, '2025-12-06 05:28:50', '2025-12-06 05:28:50'),
(6, 'GLORIA LELI GUEVARA ALVARADO', '42792967', NULL, NULL, 1, '2025-12-06 05:51:18', '2025-12-06 05:51:18'),
(7, 'ANGELLA NICOL HUAMAN GUEVARA', '75402839', NULL, NULL, 1, '2025-12-06 16:21:14', '2025-12-06 16:21:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas_venta`
--

CREATE TABLE `cuotas_venta` (
  `id_cuota` int NOT NULL,
  `id_venta` int NOT NULL,
  `numero_cuota` int NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `monto_cuota` decimal(10,2) NOT NULL,
  `monto_pagado` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estado` tinyint NOT NULL DEFAULT '0',
  `observacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cuotas_venta`
--

INSERT INTO `cuotas_venta` (`id_cuota`, `id_venta`, `numero_cuota`, `fecha_vencimiento`, `monto_cuota`, `monto_pagado`, `estado`, `observacion`) VALUES
(1, 4, 1, '2026-01-05', 36.61, 36.61, 1, NULL),
(2, 4, 2, '2026-02-05', 36.61, 0.00, 0, NULL),
(3, 4, 3, '2026-03-05', 36.61, 0.00, 0, NULL),
(4, 5, 1, '2025-12-20', 80.83, 80.83, 1, NULL),
(5, 5, 2, '2026-01-04', 80.83, 0.00, 0, NULL),
(6, 5, 3, '2026-01-19', 80.84, 0.00, 0, NULL),
(7, 6, 1, '2025-12-21', 22.12, 0.00, 4, NULL),
(8, 6, 2, '2026-01-05', 22.13, 0.00, 4, NULL),
(9, 7, 1, '2026-01-06', 37.58, 0.00, 4, NULL),
(10, 7, 2, '2026-02-06', 37.58, 0.00, 4, NULL),
(11, 7, 3, '2026-03-06', 37.59, 0.00, 4, NULL),
(12, 8, 1, '2026-01-06', 33.26, 0.00, 4, NULL),
(13, 8, 2, '2026-02-06', 33.26, 0.00, 4, NULL),
(14, 8, 3, '2026-03-06', 33.28, 0.00, 4, NULL),
(15, 9, 1, '2026-01-06', 37.58, 0.00, 4, NULL),
(16, 9, 2, '2026-02-06', 37.58, 0.00, 4, NULL),
(17, 9, 3, '2026-03-06', 37.59, 0.00, 4, NULL),
(18, 11, 1, '2026-01-06', 165.10, 165.10, 1, NULL),
(19, 11, 2, '2026-02-06', 165.10, 0.00, 0, NULL),
(20, 11, 3, '2026-03-06', 165.10, 0.00, 0, NULL),
(21, 11, 4, '2026-04-06', 165.10, 0.00, 0, NULL),
(22, 11, 5, '2026-05-06', 165.10, 0.00, 0, NULL),
(23, 14, 1, '2025-12-13', 94.40, 0.00, 0, NULL),
(24, 14, 2, '2025-12-20', 94.40, 0.00, 0, NULL),
(25, 14, 3, '2025-12-27', 94.40, 0.00, 0, NULL),
(26, 15, 1, '2025-12-15', 110.52, 0.00, 0, NULL),
(27, 15, 2, '2025-12-22', 110.53, 0.00, 0, NULL),
(28, 16, 1, '2025-12-11', 19.97, 0.00, 0, NULL),
(29, 16, 2, '2025-12-18', 19.97, 0.00, 0, NULL),
(30, 16, 3, '2025-12-25', 19.99, 0.00, 0, NULL),
(31, 17, 1, '2025-12-10', 19.97, 0.00, 0, NULL),
(32, 17, 2, '2025-12-17', 19.97, 0.00, 0, NULL),
(33, 17, 3, '2025-12-24', 19.99, 0.00, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_detalle` int NOT NULL,
  `id_venta` int NOT NULL,
  `id_libro` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unit` decimal(10,2) NOT NULL,
  `desc_monto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id_detalle`, `id_venta`, `id_libro`, `cantidad`, `precio_unit`, `desc_monto`, `subtotal`) VALUES
(1, 1, 1, 1, 44.25, 0.00, 44.25),
(2, 2, 1, 2, 44.25, 0.00, 88.50),
(3, 2, 41, 3, 35.50, 0.00, 106.50),
(4, 2, 45, 3, 49.90, 0.00, 149.70),
(5, 3, 1, 1, 44.25, 0.00, 44.25),
(6, 4, 4, 1, 59.93, 0.00, 59.93),
(7, 4, 5, 1, 49.90, 0.00, 49.90),
(8, 5, 2, 5, 68.50, 0.00, 342.50),
(9, 6, 1, 1, 44.25, 0.00, 44.25),
(10, 7, 1, 1, 44.25, 0.00, 44.25),
(11, 7, 2, 1, 68.50, 0.00, 68.50),
(12, 8, 5, 2, 49.90, 0.00, 99.80),
(13, 9, 1, 1, 44.25, 0.00, 44.25),
(14, 9, 2, 1, 68.50, 0.00, 68.50),
(15, 10, 1, 1, 44.25, 0.00, 44.25),
(16, 11, 47, 5, 34.30, 0.00, 171.50),
(17, 11, 48, 5, 35.50, 0.00, 177.50),
(18, 11, 49, 5, 29.90, 0.00, 149.50),
(19, 11, 56, 5, 39.90, 0.00, 199.50),
(20, 11, 57, 5, 25.50, 0.00, 127.50),
(21, 12, 5, 2, 49.90, 0.00, 99.80),
(22, 13, 57, 1, 25.50, 0.00, 25.50),
(23, 14, 42, 8, 35.40, 0.00, 283.20),
(24, 15, 1, 1, 44.25, 0.00, 44.25),
(25, 15, 5, 2, 49.90, 0.00, 99.80),
(26, 15, 35, 2, 38.50, 0.00, 77.00),
(27, 16, 4, 1, 59.93, 0.00, 59.93),
(28, 17, 4, 1, 59.93, 0.00, 59.93),
(29, 18, 57, 1, 25.50, 0.00, 25.50),
(30, 18, 45, 1, 49.90, 0.00, 49.90);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `id_editorial` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`id_editorial`, `nombre`, `estado`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Salamandra', 1, '2025-11-24 22:08:41', '2025-11-24 22:08:41'),
(2, 'Debolsillo', 1, '2025-11-24 22:42:19', '2025-11-25 09:01:02'),
(3, 'Planeta', 1, '2025-11-25 00:48:14', '2025-11-25 00:48:14'),
(4, 'Norma', 1, '2025-11-25 01:54:53', '2025-11-25 01:54:53'),
(5, 'Ivrea Argentina', 1, '2025-11-25 10:38:42', '2025-11-25 10:38:42'),
(6, 'EDITORIAL PANINI MEXICO', 1, '2025-11-29 19:43:15', '2025-11-29 19:43:54'),
(7, 'Planeta Cómic', 1, '2025-11-29 19:46:33', '2025-11-29 19:46:33'),
(10, 'EDITORIAL PANINI MEXICO S.A DE C.V.', 1, '2025-11-29 20:10:09', '2025-11-29 20:10:09'),
(11, 'Lectorum Publications', 1, '2025-11-29 20:21:14', '2025-11-29 20:21:14'),
(12, 'NUBE DE TINTA', 1, '2025-11-29 20:34:44', '2025-11-29 20:34:44'),
(13, 'Anagrama', 1, '2025-11-29 20:38:31', '2025-11-29 20:38:31'),
(14, 'National Geographic Books', 1, '2025-11-29 20:39:28', '2025-11-29 20:39:28'),
(15, 'Pottermore Publishing', 1, '2025-11-29 20:41:28', '2025-11-29 20:41:28'),
(16, 'Babelcube Inc.', 1, '2025-12-02 12:16:22', '2025-12-02 12:16:22'),
(17, 'EDAF', 1, '2025-12-04 13:28:42', '2025-12-04 13:28:42'),
(18, 'Señor de los Anillos', 1, '2025-12-04 18:46:03', '2025-12-04 18:46:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `id_categoria` int NOT NULL,
  `id_autor` int NOT NULL,
  `id_editorial` int NOT NULL,
  `año_publicacion` year NOT NULL,
  `numero_paginas` int NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `idioma` varchar(50) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `stock` int UNSIGNED NOT NULL DEFAULT '0',
  `stock_minimo` int UNSIGNED NOT NULL DEFAULT '0',
  `foto` varchar(255) DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mostrar` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `nombre`, `descripcion`, `id_categoria`, `id_autor`, `id_editorial`, `año_publicacion`, `numero_paginas`, `ISBN`, `idioma`, `precio_compra`, `precio_venta`, `stock`, `stock_minimo`, `foto`, `estado`, `fecha_creacion`, `fecha_actualizacion`, `mostrar`) VALUES
(1, 'Harry Potter y la piedra filosofal', 'Es la primera novela de la serie, que narra cómo Harry Potter, \r\nun niño huérfano que vive con sus tíos maltratadores, descubre en su undécimo cumpleaños que es un mago. Recibe una carta que lo invita a \r\nasistir al Colegio Hogwarts de Magia y Hechicería, donde vivirá su primera aventura y \r\ndescubrirá la historia de su pasado y la amenaza que representa Lord Voldemort.', 1, 13, 1, '1997', 288, '9789585234048', 'Español', 34.50, 44.25, 7, 5, 'uploads/libros/1764052654_harry_potter_piedra_filosofal.jpg', 1, '2025-11-25 03:14:46', '2025-12-06 21:50:25', 1),
(2, 'La tormenta del siglo', 'La tormenta del siglo no solo trae consigo vientos huracanados y copiosas nevadas, sino también algo mucho peor... Por primera vez, Stephen King nos presenta un relato escrito expresamente para la televisión.', 4, 2, 2, '2003', 576, '84-9759-383-9', 'Español', 59.90, 68.50, 5, 5, 'uploads/libros/1764052513_la_tormenta_del_siglo.jpg', 1, '2025-11-25 03:51:53', '2025-12-12 01:05:10', 0),
(3, 'Crepúsculo', 'Narra la historia de Isabella \"Bella\" Swan, una adolescente que se muda a Forks, Washington, y se enamora de Edward Cullen, un misterioso y atractivo compañero de clase que en realidad es un vampiro.', 3, 3, 2, '2005', 512, '9786125227065', 'Español', 35.80, 49.90, 3, 5, 'uploads/libros/1764052461_crepusculo.png', 1, '2025-11-25 04:46:29', '2025-12-04 18:48:10', 0),
(4, 'El libro de Bill', 'El demonio que aterrorizó Gravity Falls está de vuelta desde el más allá para contar por fin su versión de la historia en El libro de Bill, escrito nada menos que por el mismísimo Bill Clave. En estas páginas, Bill comparte sus extraños orígenes, su siniestro efecto en la historia de la humanidad, los secretos más vergonzosos de la familia Pines y la receta para conquistar el mundo (con una práctica guía paso a paso). Este caótico y bello tomo ilustrado contiene confusos acertijos, claves indescifrables, páginas perdidas del Diario 3, maneras de engañar la muerte, el significado de la vida y un capítulo completo sobre popotes bobos con formas divertidas. Pero lo más importante es que El libro de Bill está muy, muy maldito. Alex Hirsch, el autor bestseller, resucita a este infame villano e invita a los fans a ver el universo Gravity Falls desde la perspectiva de Bill. Muchos creen que este libro es demasiado peligroso para las manos humanas. Pero si no logras resistirte, debes saber esto: una vez que haces un trato con Bill, no es fácil retractarte... ¿Lo extrañaste? Admítelo, lo extrañaste.', 9, 4, 3, '2024', 208, '9786123320003', 'Español', 46.70, 59.93, 7, 7, 'uploads/libros/1764053405_libro_de_bill.jpg', 1, '2025-11-25 05:51:10', '2025-12-11 21:40:35', 0),
(5, 'Jujutsu Kaisen 13', '¡DAGON HA COMPLETADO SU TRANSFORMACIÓN Y AHORA ES UN TERRIBLE ESPÍRITU MALDITO! ¡¡Y su infinito torrente de poder maldito cae sobre Naobito, Maki y Nanami!! ¡Por otro lado, el grupo de hechiceros malditos que siguen a Getô, con tal de recuperar su cuerpo, despiertan a aquel a quien más deberían evitar, pero…!', 10, 5, 4, '2021', 192, '9788467947700', 'Español', 34.00, 49.90, 8, 4, 'uploads/libros/1764053784_jujutsu_kaisen_13.jpg', 1, '2025-11-25 06:56:24', '2025-12-06 21:50:25', 1),
(6, 'Chainsaw Man 1', 'Denji es un chico sin un duro que se deja la piel trabajando como Devil Hunter junto a su perro demoníaco Pochita para resarcir una deuda astronómica, pero entonces... ¡¡Una sangrienta traición da un giro radical a su miserable vida!!', 10, 6, 5, '2020', 200, '9788418562273', 'Español', 25.50, 40.70, 6, 5, 'uploads/libros/1764085178_chainsaw_man_1.jpg', 1, '2025-11-25 15:39:38', '2025-12-05 05:18:48', 1),
(9, 'Chainsaw Man 2', '¡APARECE UN NUEVO ENEMIGO, EL DEMONIO PISTOLA! Motivado por la obsesión de robar unas buenas peras, Denji lucha a muerte contra el Demonio Murciélago. ¿Conseguirá su objetivo tras la conclusión de la batalla?', 10, 6, 5, '2020', 200, '9788418645006', 'Español', 28.50, 45.90, 4, 6, 'uploads/libros/1764085565_chainsaw_man_2.jpg', 1, '2025-11-25 15:46:05', '2025-12-05 05:39:34', 1),
(35, 'One Piece 1', 'Esta es la gran Era Pirata. Gold Roger, el legendario “Rey de los piratas” ha dejado el “One Piece” - su legendario Tesoro - escondido en una zona del mundo llamada “GRAND LINE” y los piratas más fuertes compiten por hallarlo. Un niño llamado Luffy idolatraba a los piratas, en especial a Shanks, el líder de una tripulación que visitó su villa. Un día, por accidente, Luffy comió una “fruta del diablo” del botín de Shanks. Gracias a esa fruta, su cuerpo se ha vuelto de goma pero nunca podrá nadar. El día que los piratas abandonaron la villa, Shanks le obsequió a Luffy su mas preciada posesión: su sombrero de paja. Diez años han pasado desde ese día y Luffy ha salido al mar buscando convertirse en el nuevo “Rey de los piratas”. ¡Aquí inicia la gran aventura de Luffy!', 10, 7, 6, '2018', 213, '9786075280073', 'Español', 28.30, 38.50, 9, 5, 'uploads/libros/1764463448_one_piece_1.jpg', 1, '2025-11-30 00:43:29', '2025-12-06 21:50:25', 0),
(36, 'One Piece 2', 'El manga de la serie más pirata de la tele Monkey D. Luffy ha reclutado al primer miembro de su tripulación: Rolonoa Zoro, el espadachín de las tres espadas. Juntos quieren apoderarse del mapa de la Gran Ruta Marina, pero para eso deberán pelear contra Buggy y sus hombres. Luffy, decidido a convertirse en el rey de los piratas, se alía con Nami, una joven ladrona de tesoros.', 10, 7, 7, '2022', 204, '9788491539087', 'Español', 29.90, 39.90, 10, 4, 'uploads/libros/1764463840_one_piece_2.jpg', 1, '2025-11-30 00:50:40', '2025-11-30 00:51:05', 0),
(37, 'One Piece 3', 'El capitán Buggy \"El payaso\" y Luffy, tienen una espectacular pelea como solo podría suceder con dos poseedores de las habilidades de las frutas del diablo. Durante la pelea aprendemos más del pasado en común de Shanks y Buggy. Ahora que Nami y Zoro se han unido a la tripulación de Luffy es momento de continuar su camino hacia la \"Grand Line\". Han desembarcado en una villa para buscar un barco más resistente y algo de comida. Ahí se encuentran con el orgulloso pero mentiroso Usopp y es gracias a él que conocen a Kaya, la persona más rica de la villa, a quien le piden un barco. Sin embargo, el mayordomo Kurahadol se entromete y Luffy tiene que renunciar trágicamente a su petición.', 10, 7, 6, '2022', 204, '9786076365489', 'Español', 25.50, 35.90, 11, 4, 'uploads/libros/1764464290_one_piece_3.jpg', 1, '2025-11-30 00:57:51', '2025-11-30 00:58:10', 0),
(38, 'One Piece 4', 'Luffy por fin se enfrenta cara a cara con Kurahadol, ¡con el cruel mayordomo que resultó ser el capitán pirata Kuro! En la pendiente que lleva a la villa se ha desatado una batalla encarnizada que ha alcanzado su límite, ¡Ha llegado el momento de la verdad! Para salvar sus vidas, Kaya y los niños se internaron en el bosque pero no saben de la amenaza los sigue de cerca. ¡Usopp y Zoro deben apresurarse si quieren rescatarlos!', 10, 7, 10, '2019', 196, '9786075280646', 'Español', 29.90, 45.50, 11, 4, 'uploads/libros/1764465030_google.jpg', 1, '2025-11-30 01:10:33', '2025-11-30 01:15:12', 0),
(39, 'One Piece 5', 'Luffy por fin se enfrenta cara a cara con Kurahadol, ¡con el cruel mayordomo que resultó ser el capitán pirata Kuro! En la pendiente que lleva a la villa se ha desatado una batalla encarnizada que ha alcanzado su límite, ¡Ha llegado el momento de la verdad! Para salvar sus vidas, Kaya y los niños se internaron en el bosque pero no saben de la amenaza los sigue de cerca. ¡Usopp y Zoro deben apresurarse si quieren rescatarlos!', 10, 7, 10, '2019', 196, '9786075280882', 'Español', 30.00, 40.00, 7, 3, 'uploads/libros/1764465438_google.jpg', 1, '2025-11-30 01:17:21', '2025-11-30 01:17:21', 0),
(40, 'One Piece 6', 'Luffy y su tripulación hacen escala en el restaurante marítimo Baratie con la intención de encontrar a un cocinero. Mientras que Don Krieg (el almirante de una flota pirata de 50 embarcaciones) lleva a cabo su plan para secuestrar barcos; cierto personaje muy poderoso y lleno de misterio hace su aparición frente a la tripulación de Luffy…', 10, 7, 10, '2019', 196, '9786075280967', 'Español', 35.60, 45.90, 11, 7, 'uploads/libros/1764465559_one_piece_6.jpg', 1, '2025-11-30 01:19:19', '2025-11-30 01:19:19', 0),
(41, 'Harry Potter y la cámara secreta', 'Tras derrotar una vez más a lord Voldemort, su siniestro enemigo en Harry Potter y la piedra filosofal, Harry espera impaciente en casa de sus insoportables tíos el inicio del segundo curso del Colegio Hogwarts de Magia y Hechicería. Sin embargo, la espera dura poco, pues un elfo aparece en su habitación y le advierte que una amenaza mortal se cierne sobre la escuela. Así pues, Harry no se lo piensa dos veces y, acompañado de Ron, su mejor amigo, se dirige a Hogwarts en un coche volador. Pero ¿puede un aprendiz de mago defender la escuela de los malvados que pretenden destruirla? Sin saber que alguien ha abierto la Cámara de los Secretos, dejando escapar una serie de monstruos peligrosos, Harry y sus amigos Ron y Hermione tendrán que enfrentarse con arañas gigantes, serpientes encantadas, fantasmas enfurecidos y, sobre todo, con la mismísima reencarnación de su más temible adversario.', 1, 13, 11, '1999', 288, '9788478884957', 'Español', 24.40, 35.50, 16, 7, 'uploads/libros/1764465744_harry_potter_camara_secreta.jpg', 1, '2025-11-30 01:22:24', '2025-12-05 05:25:11', 1),
(42, 'Bajo la misma estrella', 'Bajo la misma estrella es la novela que ha catapultado a John Green al éxito. Una historia que explora cuán exquisita y trágica puede ser la aventura de saberse vivo y querer a alguien. Emotiva, irónica y afilada. Una novela teñida de humor y de tragedia que habla de nuestra capacidad para soñar incluso en las circunstancias más difíciles. A Hazel y a Gus les gustaría tener vidas más corrientes. Algunos dirían que no han nacido con estrella, que su mundo es injusto. Hazel y Gus son solo adolescentes, pero si algo les ha enseñado el cáncer que ambos padecen es que no hay tiempo para lamentaciones, porque, nos guste o no, solo existe el hoy y el ahora. Y por ello, con la intención de hacer realidad el mayor deseo de Hazel -conocer a su escritor favorito-, cruzarán juntos el Atlántico para vivir una aventura contrarreloj, tan catártica como desgarradora. Destino: Amsterdam, el lugar donde reside el enigmático y malhumorado escritor, la única persona que tal vez pueda ayudarles a ordenar las piezas del enorme puzle del que forman parte... Mejor libro del año según Time y Entretaintment Weekly. Más de 7 millones de ejemplares vendidos en el mundo. Número 1 en las listas de best sellers durante meses. La crítica ha dicho... «Una novela sobre la vida y la muerte, y sobre los que están atrapados entre las dos... Reirás, llorarás y te quedarás con ganas de más.» Markus Zusak, autor de La ladrona de libros «Una novela imposible de olvidar, para jóvenes y no tan jóvenes.» USA Today «Absolutamente genial. [...] Un ejemplo perfecto de por qué los adultos leen novelas juveniles.» Time «Esta novela es un triunfo.» Booklist «Divertida... Conmovedora... Luminosa.» Entretaintment Weekly «Una mezcla de melancolía, dulzura, filosofía y humor.» New York Times «John Green aúna lo profundo y lo cotidiano en esta desgarradora novela.» Washington Post «Una historia dolorosamente bella sobre la vida y las pérdidas.» School Library Journal', 3, 11, 12, '2012', 248, '9788415594048', 'Español', 29.90, 35.40, 17, 5, 'uploads/libros/1764466507_google.jpg', 1, '2025-11-30 01:35:08', '2025-12-06 21:32:38', 1),
(43, 'Nuestra parte de noche', 'La herencia, el deseo de pervivir, la paternidad, el horror, lo íntimo y lo político. Una novela libre y osada, hechizante y genial. Un padre y un hijo atraviesan Argentina por carretera, desde Buenos Aires hacia las cataratas de Iguazú, en la frontera norte con Brasil. Son los años de la junta militar, hay controles de soldados armados y tensión en el ambiente. El hijo se llama Gaspar y el padre trata de protegerlo del destino que le ha sido asignado. La madre murió en circunstancias poco claras, en un accidente que acaso no lo fue. Como su padre, Gaspar está llamado a ser un médium en una sociedad secreta, la Orden, que contacta con la Oscuridad en busca de la vida eterna mediante atroces rituales. En ellos es vital disponer de un médium, pero el destino de estos seres dotados de poderes especiales es cruel, porque su desgaste físico y mental es rápido e implacable. Los orígenes de la Orden, regida por la poderosa familia de la madre de Gaspar, se remontan a siglos atrás, cuando el conocimiento de la Oscuridad llegó desde el corazón de Africa a Inglaterra y desde allí se extendió hasta Argentina --', 4, 12, 13, '2019', 667, '9788433998859', 'Español', 18.50, 28.50, 10, 4, 'uploads/libros/1764466739_google.jpg', 2, '2025-11-30 01:38:59', '2025-11-30 01:39:22', 0),
(44, 'Nuestra parte de noche / Our Night Party', 'El legado, el deseo de vivir, la paternidad, el horror, lo íntimo y lo político. El terror sobrenatural se entrelaza con terrores muy reales en esta osada y perturbadora novela. Un padre y su hijo atraviesan Argentina por carretera, desde Buenos Aires hacia las cataratas de Iguazú, en la frontera norte con Brasil. Son los años de la junta militar, hay controles de soldados armados y tensión en el ambiente. El padre de Gaspar trata de protegerlo del destino que le ha sido asignado después de que su madre muriese en circunstancias poco claras; en un accidente que acaso no lo fue. Como su padre, Gaspar está llamado a ser un médium en una sociedad secreta, la Orden, que contacta con la Oscuridad en busca de la vida eterna mediante atroces rituales. Para ellos es vital disponer de un médium, pero el destino de estos seres dotados de poderes especiales es cruel, y el desgaste físico y mental es rápido e implacable. Los orígenes de la Orden, regida por la poderosa familia de la madre de Gaspar, se remontan a siglos atrás, cuando el conocimiento de la Oscuridad llegó desde el corazón de África a Inglaterra y desde allí se extendió hasta Argentina. El lector emprenderá un viaje entre la represión de la dictadura militar argentina y el Londres psicodélico de los años sesenta, donde la madre de Gaspar conoció a un joven cantante de aire andrógino llamado David; descubrirá casas cuyo interior muta, pasadizos que esconden monstruos inimaginables, rituales con fieros sacrificios humanos, enigmáticas liturgias sexuales y la carga de una herencia atroz. ENGLISH DESCRIPTION A father and a son cross Argentina by road, from Buenos Aires to the Iguazu Falls. It\'s the military regime era, there are controls of armed soldiers and tension in the environment. The son\'s name is Gaspar and the father tries to protect him from his destiny after his mother died in unclear circumstances.', 4, 12, 14, '2021', 672, '9780593312452', 'Español', 35.60, 49.90, 11, 4, 'uploads/libros/1764466799_google.jpg', 2, '2025-11-30 01:40:00', '2025-11-30 01:40:29', 0),
(45, 'Harry Potter y las Reliquias de la Muerte', 'Entregadme a Harry Potter -dijo la voz de Voldemort-y nadie sufrirá ningún daño. Entregadme a Harry Potter y dejaré el colegio intacto. Entregadme a Harry Potter y seréis recompensados. Cuando se monta en el sidecar de la moto de Hagrid y se elevan hacia el cielo, dejando atrás Privet Drive por última vez, Harry Potter sabe que Lord Voldemort y los mortífagos no deben estar muy lejos de ellos. El hechizo protector que ha mantenido a salvo a Harry hasta ahora se ha roto, pero no puede seguir escondiéndose. El Señor Tenebroso está infundiendo el miedo en todo y todos aquellos a quienes Harry ama y para detenerle Harry tendrá que encontrar y destruir los Horrocruxes restantes. La batalla final debe comenzar y Harry debe enfrentarse a su enemigo... Esta edición está traducida al castellano. Existe otra edición disponible para los lectores de español latinoamericano. Tema musical compuesto por James Hannigan.', 1, 13, 1, '2015', 787, '9781781102701', 'Español', 35.60, 49.90, 25, 5, 'uploads/libros/1764466914_google.jpg', 1, '2025-11-30 01:41:56', '2025-12-12 04:34:58', 1),
(46, 'El Principito', 'Desde un pequeño asteroide, muy lejos de este planeta que se debate por sobrevivir, destella la imagen de este dulce niño tratando de rescatar los mejores sentimientos humanos olvidados o relegados. Saint-Exupéry escribe este canto de amor y ternura inigualable dirigido a los adultos, aunque quizá sean los nños los que puedan entender su hermosisimo mensaje.', 11, 14, 16, '2017', 98, '9781507170656', 'Español', 28.00, 30.00, 12, 4, 'uploads/libros/1764702126_google.jpg', 1, '2025-12-02 19:02:07', '2025-12-05 05:25:16', 1),
(47, 'Dragon Ball Super no 16', 'La secuela del shônen más famoso. Granola sobrevivió al genocidio de los cerealianos perpetrado por el ejército de Freezer y los saiyanos. Movido por el ánimo de venganza, utiliza las bolas de dragón del planeta Cereal para convertirse en el mejor guerrero del universo. Por su parte, ¿¡los Heeter encargan a Goku y Vegeta que acaben con Granola...!?', 10, 16, 7, '2023', 194, '9788411128605', 'Español', 26.30, 34.30, 6, 4, 'uploads/libros/1764872994_google.jpg', 1, '2025-12-04 18:29:56', '2025-12-06 10:30:35', 1),
(48, 'Dragon Ball Super no 10', '¡Sigue la mítica serie shônen, creada por Akira Toriyama! El atroz criminal Moro, capturado hace 10 millones de años, ha conseguido escapar de la cárcel galáctica. Ahora se dirige al nuevo planeta Namek con la intención de utilizar las bolas de dragón para recuperar el poder que tenía en su época de mayor esplendor. Goku y Vegeta se enfrentan a él, pero ¿¡Moro absorbe su energía...!?', 10, 16, 7, '2023', 194, '9788413422091', 'Español', 25.50, 35.50, 2, 3, 'uploads/libros/1764889113_google.jpg', 1, '2025-12-04 22:58:36', '2025-12-06 10:30:35', 1),
(49, 'Dragon Ball Super no 11', 'Sigue la secuela del gran shonen de Toriyama. El Gran Kaiôshin, que estaba latente dentro de Bû, se suma a la batalla contra el malvado Moro: tras haberse desplazado al espacio, la contienda regresa a la superficie de Nuevo Namek. ¡¡Sin embargo, Goku y los demás se ven obligados a batirse en retirada cuando Moro, a través de su tercer deseo, hace que se giren las tornas!! ¿¡Habrá alguna técnica con la que Goku y los demás puedan hacer frente a la amenaza!?', 10, 16, 7, '2023', 194, '9788413425306', 'Español', 24.30, 29.90, 5, 4, 'uploads/libros/1764889539_google.jpg', 1, '2025-12-04 23:05:42', '2025-12-06 10:30:35', 1),
(55, 'El Señor de Los Anillos 2. Las DOS Torres (TV Tie-In). the Lord of the Rings 2. the Two Towers (TV Tie-In) (Spanish Edition)', 'La misión parece abocada al fracaso pero la aventura continua... La Compañía se ha disuelto y sus integrantes emprenden caminos separados. Frodo y Sam continúan solos su viaje a lo largo del río Anduin, perseguidos por la sombra misteriosa de un ser extraño que también ambiciona la posesión del Anillo. Mientras, hombres, elfos y enanos se preparan para la batalla final contra las fuerzas del Señor del Mal. ENGLISH DESCRIPTION The Two Towers is the second volume of J.R.R. Tolkien\'s epic saga, The Lord of the Rings. The Fellowship has been forced to split up. Frodo and Sam must continue alone towards Mount Doom, where the One Ring must be destroyed. Meanwhile, at Helm\'s Deep and Isengard, the first great battles of the War of the Ring take shape. In this splendid, unabridged audio production of Tolkien\'s great work, all the inhabitants of a magical universe - hobbits, elves, and wizards - spring to life. Rob Inglis\' narration has been praised as a masterpiece of audio.', 1, 17, 18, '2022', 480, '9786070792397', 'Español', 28.40, 39.90, 15, 5, 'uploads/libros/1764892012_google.jpg', 2, '2025-12-04 23:46:52', '2025-12-04 23:58:08', 1),
(56, 'Dragon Ball Super no 03', 'Sigue la continuación de Dragon Ball, formato recopilatorio Trunks ha vuelto una vez más del futuro. En su mundo, un hombre idéntico a Goku, Goku Black, se dispone a exterminar a la humanidad. ¿¡Qué será de Goku y Vegeta, que se dirigen al futuro!? Mientras tanto, Zamasu, candidato a Kaiôshin del décimo universo, se fija en Goku...', 10, 16, 7, '2023', 210, '9788491741565', 'Español', 19.90, 39.90, 6, 5, 'uploads/libros/1764892737_dragon_ball_super_no_3.jpg', 1, '2025-12-04 23:58:57', '2025-12-06 10:30:35', 1),
(57, 'Dragon Ball Super no 13', 'La secuela del shonen de Toriyama. Las tropas de Moro han llegado a la Tierra, ¡y su batalla contra los guerreros terrestres se intensifica sobremanera! Finalmente, también Moro baja a la superficie. Gohan y los demás sufren lo indecible en su enfrentamiento contra un Saganbo al que Moro confiere más y más poder. ¿¡Llegarán a tiempo Goku y Vegeta para salvar el planeta del desastre!?', 10, 16, 7, '2023', 194, '9788411122702', 'Español', 19.90, 25.50, 18, 7, 'uploads/libros/1764892852_google.jpg', 1, '2025-12-05 00:00:55', '2025-12-12 04:34:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_inventario`
--

CREATE TABLE `movimientos_inventario` (
  `id_movimiento` int NOT NULL,
  `id_libro` int NOT NULL,
  `id_usuario` int NOT NULL,
  `tipo` enum('INGRESO','AJUSTE_POSITIVO','AJUSTE_NEGATIVO','INICIAL','VENTA') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'INGRESO',
  `cantidad` int NOT NULL,
  `stock_anterior` int NOT NULL,
  `stock_nuevo` int NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `fecha_mov` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `movimientos_inventario`
--

INSERT INTO `movimientos_inventario` (`id_movimiento`, `id_libro`, `id_usuario`, `tipo`, `cantidad`, `stock_anterior`, `stock_nuevo`, `motivo`, `fecha_mov`) VALUES
(1, 1, 4, 'INGRESO', 8, 0, 8, 'Nuevo ingreso de libros porque el stock actual era menor al stock mínimo.', '2025-12-04 14:33:48'),
(2, 1, 4, 'AJUSTE_NEGATIVO', 1, 8, 7, 'Un libro se encontró en mal estado.', '2025-12-04 17:34:53'),
(5, 56, 4, 'INICIAL', 7, 7, 7, 'Stock inicial al registrar el libro', '2025-12-04 18:58:57'),
(6, 57, 9, 'INICIAL', 25, 25, 25, 'Stock inicial al registrar el libro', '2025-12-04 19:00:55'),
(7, 56, 9, 'AJUSTE_NEGATIVO', 1, 7, 6, 'Uno de los libros del ingreso inicial llego en mal estado.', '2025-12-04 19:01:52'),
(8, 56, 5, 'INGRESO', 5, 6, 11, 'Nuevo ingreso de libros faltantes del pedido.', '2025-12-04 20:27:50'),
(9, 1, 5, 'AJUSTE_POSITIVO', 1, 7, 8, 'Anulación de la venta ID 1', '2025-12-05 12:38:48'),
(10, 1, 4, 'AJUSTE_POSITIVO', 1, 7, 8, 'Anulación de la venta ID 6', '2025-12-06 03:40:09'),
(11, 1, 4, 'AJUSTE_POSITIVO', 1, 7, 8, 'Anulación de la venta ID 7', '2025-12-06 03:45:30'),
(12, 2, 4, 'AJUSTE_POSITIVO', 1, 4, 5, 'Anulación de la venta ID 7', '2025-12-06 03:45:30'),
(13, 5, 4, 'AJUSTE_POSITIVO', 2, 8, 10, 'Anulación de la venta ID 8', '2025-12-06 03:51:44'),
(14, 5, 4, 'AJUSTE_POSITIVO', 2, 10, 12, 'Anulación de la venta ID 8', '2025-12-06 04:09:37'),
(15, 1, 4, 'AJUSTE_POSITIVO', 1, 7, 8, 'Anulación de la venta ID 9', '2025-12-06 04:19:20'),
(16, 2, 4, 'AJUSTE_POSITIVO', 1, 4, 5, 'Anulación de la venta ID 9', '2025-12-06 04:19:20'),
(17, 1, 4, 'VENTA', 1, 8, 7, 'Venta ID 10', '2025-12-06 05:00:12'),
(18, 1, 4, 'AJUSTE_POSITIVO', 1, 7, 8, 'Anulación de la venta ID 10', '2025-12-06 05:01:58'),
(19, 47, 4, 'VENTA', 5, 11, 6, 'Venta ID 11', '2025-12-06 05:30:35'),
(20, 48, 4, 'VENTA', 5, 7, 2, 'Venta ID 11', '2025-12-06 05:30:35'),
(21, 49, 4, 'VENTA', 5, 10, 5, 'Venta ID 11', '2025-12-06 05:30:35'),
(22, 56, 4, 'VENTA', 5, 11, 6, 'Venta ID 11', '2025-12-06 05:30:35'),
(23, 57, 4, 'VENTA', 5, 25, 20, 'Venta ID 11', '2025-12-06 05:30:35'),
(24, 5, 4, 'VENTA', 2, 12, 10, 'Venta ID 12', '2025-12-06 05:51:43'),
(25, 57, 4, 'VENTA', 1, 20, 19, 'Venta ID 13', '2025-12-06 16:21:23'),
(26, 42, 4, 'VENTA', 8, 25, 17, 'Venta ID 14', '2025-12-06 16:32:38'),
(27, 1, 4, 'VENTA', 1, 8, 7, 'Venta ID 15', '2025-12-06 16:50:25'),
(28, 5, 4, 'VENTA', 2, 10, 8, 'Venta ID 15', '2025-12-06 16:50:25'),
(29, 35, 4, 'VENTA', 2, 11, 9, 'Venta ID 15', '2025-12-06 16:50:25'),
(30, 4, 4, 'VENTA', 1, 9, 8, 'Venta ID 16', '2025-12-11 16:36:34'),
(31, 4, 4, 'VENTA', 1, 8, 7, 'Venta ID 17', '2025-12-11 16:40:35'),
(32, 57, 4, 'VENTA', 1, 19, 18, 'Venta ID 18', '2025-12-11 23:34:58'),
(33, 45, 4, 'VENTA', 1, 26, 25, 'Venta ID 18', '2025-12-11 23:34:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `icono` varchar(100) DEFAULT NULL,
  `ruta` varchar(100) DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id`, `nombre`, `clave`, `descripcion`, `icono`, `ruta`, `estado`) VALUES
(1, 'Dashboard', 'dashboard', 'Panel principal', 'fas fa-home', 'views/dashboard.php', 1),
(2, 'Gestión de Usuarios', 'gestion_usuarios', 'Administrar usuarios del sistema', 'fas fa-users', 'views/gestionUsuarios.php', 1),
(3, 'Gestión de Perfiles', 'gestion_perfiles', 'Administrar perfiles', 'fas fa-id-card', 'views/gestionPerfiles.php', 1),
(4, 'Gestión de Categorías', 'gestion_categorias', 'Administrar categorías', 'fas fa-tags', 'views/gestionCategorias.php', 1),
(5, 'Gestión de Catálogo', 'gestion_catalogo', 'Administrar el catálogo', 'fa-solid fa-newspaper', 'views/gestionCatalogo.php', 1),
(6, 'Gestión de Slider', 'gestion_slider', 'Administrar imágenes slider', 'fas fa-images', 'views/gestionSlider.php', 0),
(7, 'Gestión de Ventas', 'gestion_ventas', 'Administrar ventas', 'fas fa-shopping-cart', 'views/gestionVentas.php', 1),
(8, 'Gestión de Clientes', 'gestion_clientes', 'Administrar clientes', 'fas fa-user-tie', 'views/gestionClientes.php', 1),
(9, 'Gestión de Autores', 'gestion_autores', 'Administrar autores', 'fa-solid fa-image-portrait', 'views/gestionAutores.php', 1),
(10, 'Gestión de Editoriales', 'gestion_editoriales', 'Administrar editoriales', 'fa-solid fa-book-bookmark', 'views/gestionEditoriales.php', 1),
(11, 'Gestión de Inventario', 'gestion_inventario', 'Administrar el inventario de libros.', 'fa-solid fa-box-open', 'views/gestionInventario.php', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_cuota`
--

CREATE TABLE `pagos_cuota` (
  `id_pago` int NOT NULL,
  `id_cuota` int NOT NULL,
  `fecha_pago` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `monto_pagado` decimal(10,2) NOT NULL,
  `medio_pago` varchar(50) NOT NULL,
  `comentario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pagos_cuota`
--

INSERT INTO `pagos_cuota` (`id_pago`, `id_cuota`, `fecha_pago`, `monto_pagado`, `medio_pago`, `comentario`) VALUES
(1, 1, '2025-12-05 03:47:07', 36.61, 'Yape/Plin', ''),
(2, 4, '2025-12-06 05:53:47', 80.83, 'Yape/Plin', ''),
(3, 18, '2025-12-06 06:38:32', 165.10, 'Efectivo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'Acceso a todo el sistema.', 1),
(2, 'Ventas', 'Acceso al sistema de ventas.', 1),
(3, 'Logística', 'Acceso a la gestión de libros y categorías', 0),
(4, 'Administrador de Catálogo', 'Principal encargado de gestionar los libros y el catálogo web.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_opcion`
--

CREATE TABLE `perfil_opcion` (
  `id_perfil` int NOT NULL,
  `id_opcion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `perfil_opcion`
--

INSERT INTO `perfil_opcion` (`id_perfil`, `id_opcion`) VALUES
(1, 1),
(2, 1),
(1, 2),
(1, 3),
(1, 4),
(3, 4),
(4, 4),
(1, 5),
(3, 5),
(4, 5),
(1, 6),
(3, 6),
(4, 6),
(1, 7),
(2, 7),
(1, 8),
(1, 9),
(4, 9),
(1, 10),
(4, 10),
(1, 11),
(4, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sliders`
--

CREATE TABLE `sliders` (
  `id_slide` int NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `descripcion` text,
  `imagen` varchar(255) NOT NULL,
  `enlace` varchar(255) DEFAULT NULL,
  `orden` int NOT NULL DEFAULT '0',
  `estado` tinyint NOT NULL DEFAULT '1',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sliders`
--

INSERT INTO `sliders` (`id_slide`, `titulo`, `descripcion`, `imagen`, `enlace`, `orden`, `estado`, `fecha_creacion`) VALUES
(1, 'Lectura para Todos', 'Desde ciencia ficción hasta novelas románticas.', 'uploads/sliders/1764297831_slider1.jpg', '', 2, 1, '2025-11-27 21:43:51'),
(2, 'Tu Próxima Aventura Te Espera', 'Abre un libro y viaja a galaxias lejanas o sumérgete en épocas pasadas. ¡La imaginación es el destino!', 'uploads/sliders/1764298338_slider2.jpg', '', 3, 1, '2025-11-27 21:52:18'),
(3, 'Novedades Editoriales', 'Los libros más esperados y los lanzamientos del mes. Sé el primero en leerlos.', 'uploads/sliders/1764298457_slider3.jpg', '', 1, 1, '2025-11-27 21:54:17'),
(4, 'Aprender y Crecer', 'Amplía tu mente con los mejores títulos de historia, biografías y guías de desarrollo personal.', 'uploads/sliders/1764299148_slider4.jpg', NULL, 4, 1, '2025-11-27 22:05:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_comprobante`
--

CREATE TABLE `tipos_comprobante` (
  `id_tipo` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `serie` varchar(10) NOT NULL,
  `correlativo_actual` int NOT NULL DEFAULT '0',
  `estado` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipos_comprobante`
--

INSERT INTO `tipos_comprobante` (`id_tipo`, `nombre`, `serie`, `correlativo_actual`, `estado`) VALUES
(1, 'BOLETA', 'B001', 14, 1),
(2, 'FACTURA', 'F001', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `correo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `id_perfil` int NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `clave`, `correo`, `estado`, `id_perfil`, `fecha_registro`) VALUES
(4, 'Luis Castillo', 'Luis', '$2y$10$0E1yjLbdCq1niVAmibB.H.CZ/adiC6Id0mCo7yiAt.XsA9ZNt.wSa', 'luisCastillo@gmail.com', 1, 1, '2025-11-23 00:53:44'),
(5, 'Raul Alfaro', 'Raul', '$2y$10$JSAP7eQvfxagSTbKaerdG.r5V5TkMTNDtDvJUnJVptDBzT9wpB7Cu', 'raul@gmail.com', 1, 1, '2025-11-23 00:54:01'),
(6, 'Julieta Torres', 'Julieta_ventas', '$2y$10$WsIRoHnrCSSYdHeBe0w6OuWG9GwWsDZnjDtcZWLZdxF.rmOUo8EB.', 'julieta@gmail.com', 0, 2, '2025-11-23 13:39:43'),
(7, 'Prueba de Eliminacion', 'Eliminacion', '$2y$10$oCxpry29k334kLvAO/9cC.axCVzyKjW.tg7.zX3q.oOX/BClUrZQy', 'eliminacion@gmail.com', 2, 2, '2025-11-23 14:41:19'),
(8, 'Luis Adrian', 'Adrian', '$2y$10$AIrmy8qIAuvp5RvTO02wvuIsImKIMP4quWCFJjYeidOMwRbgYEDWe', 'adrian@gmail.com', 1, 4, '2025-11-23 20:28:01'),
(9, 'Karina Paredes', 'Karina', '$2y$10$dZkBdya7Pnrf3dtFpfClwuSFmGb9Rue7QjnwmXY9PXW4fVfxhAmyu', 'karina@gmail.com', 1, 4, '2025-11-25 11:47:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int NOT NULL,
  `id_tipo` int NOT NULL,
  `numero` int NOT NULL,
  `id_cliente` int NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha_venta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subtotal` decimal(10,2) NOT NULL,
  `descuento_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `observacion` varchar(255) DEFAULT NULL,
  `forma_pago` tinyint NOT NULL DEFAULT '1',
  `saldo_pendiente` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pago_inicial` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_tipo`, `numero`, `id_cliente`, `id_usuario`, `fecha_venta`, `subtotal`, `descuento_total`, `total`, `estado`, `observacion`, `forma_pago`, `saldo_pendiente`, `pago_inicial`) VALUES
(1, 1, 1, 1, 4, '2025-11-30 15:33:17', 44.25, 0.00, 44.00, 0, '', 1, 0.00, 0.00),
(2, 2, 1, 4, 4, '2025-11-30 15:47:31', 344.70, 0.00, 344.00, 1, '', 1, 0.00, 0.00),
(3, 1, 2, 1, 4, '2025-12-02 14:04:04', 44.25, 0.00, 44.00, 1, '', 1, 0.00, 0.00),
(4, 1, 3, 1, 5, '2025-12-05 02:52:35', 109.83, 0.00, 109.00, 1, '', 2, 73.22, 0.00),
(5, 2, 2, 4, 5, '2025-12-05 03:19:52', 342.50, 0.00, 342.00, 1, '', 2, 161.67, 100.00),
(6, 1, 4, 1, 4, '2025-12-06 03:37:43', 44.25, 0.00, 44.00, 0, '', 2, 0.00, 0.00),
(7, 1, 5, 3, 4, '2025-12-06 03:45:16', 112.75, 0.00, 112.00, 0, '', 2, 0.00, 0.00),
(8, 1, 6, 3, 4, '2025-12-06 03:51:32', 99.80, 0.00, 99.00, 0, '', 2, 0.00, 0.00),
(9, 1, 7, 3, 4, '2025-12-06 04:17:36', 112.75, 0.00, 112.75, 0, '', 2, 0.00, 0.00),
(10, 1, 8, 3, 4, '2025-12-06 05:00:12', 44.25, 0.00, 44.25, 0, '', 1, 0.00, 44.00),
(11, 2, 3, 5, 4, '2025-12-06 05:30:35', 825.50, 0.00, 825.50, 1, '', 2, 660.40, 0.00),
(12, 1, 9, 3, 4, '2025-12-06 05:51:43', 99.80, 0.00, 99.80, 1, '', 1, 0.00, 99.00),
(13, 1, 10, 7, 4, '2025-12-06 16:21:23', 25.50, 0.00, 25.50, 1, '', 1, 0.00, 25.00),
(14, 2, 4, 4, 4, '2025-12-06 16:32:38', 283.20, 0.00, 283.20, 1, '', 2, 283.20, 0.00),
(15, 1, 11, 3, 4, '2025-12-06 16:50:25', 221.05, 0.00, 221.05, 1, '', 2, 221.05, 0.00),
(16, 1, 12, 3, 4, '2025-12-11 16:36:34', 59.93, 0.00, 59.93, 1, '', 2, 59.93, 0.00),
(17, 1, 13, 3, 4, '2025-12-11 16:40:35', 59.93, 0.00, 59.93, 1, '', 2, 59.93, 0.00),
(18, 1, 14, 1, 4, '2025-12-11 23:34:58', 75.40, 0.00, 75.40, 1, '', 1, 0.00, 75.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id_autor`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `cuotas_venta`
--
ALTER TABLE `cuotas_venta`
  ADD PRIMARY KEY (`id_cuota`),
  ADD KEY `fk_cuota_venta` (`id_venta`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_detalle_venta` (`id_venta`),
  ADD KEY `fk_detalle_libro` (`id_libro`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`id_editorial`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`),
  ADD UNIQUE KEY `ISBN` (`ISBN`),
  ADD KEY `fk_libros_categorias` (`id_categoria`),
  ADD KEY `fk_libros_autor` (`id_autor`),
  ADD KEY `fk_libros_editorial` (`id_editorial`);

--
-- Indices de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `fk_mov_libro` (`id_libro`),
  ADD KEY `fk_mov_usuario` (`id_usuario`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- Indices de la tabla `pagos_cuota`
--
ALTER TABLE `pagos_cuota`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_cuota` (`id_cuota`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil_opcion`
--
ALTER TABLE `perfil_opcion`
  ADD PRIMARY KEY (`id_perfil`,`id_opcion`),
  ADD KEY `id_opcion` (`id_opcion`);

--
-- Indices de la tabla `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indices de la tabla `tipos_comprobante`
--
ALTER TABLE `tipos_comprobante`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_perfil` (`id_perfil`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_ventas_tipo` (`id_tipo`),
  ADD KEY `fk_ventas_cliente` (`id_cliente`),
  ADD KEY `fk_ventas_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `id_autor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cuotas_venta`
--
ALTER TABLE `cuotas_venta`
  MODIFY `id_cuota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `id_editorial` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  MODIFY `id_movimiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pagos_cuota`
--
ALTER TABLE `pagos_cuota`
  MODIFY `id_pago` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id_slide` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipos_comprobante`
--
ALTER TABLE `tipos_comprobante`
  MODIFY `id_tipo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuotas_venta`
--
ALTER TABLE `cuotas_venta`
  ADD CONSTRAINT `fk_cuota_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `fk_detalle_libro` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  ADD CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `fk_libros_autor` FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id_autor`),
  ADD CONSTRAINT `fk_libros_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fk_libros_editorial` FOREIGN KEY (`id_editorial`) REFERENCES `editorial` (`id_editorial`);

--
-- Filtros para la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  ADD CONSTRAINT `fk_mov_libro` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  ADD CONSTRAINT `fk_mov_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pagos_cuota`
--
ALTER TABLE `pagos_cuota`
  ADD CONSTRAINT `pagos_cuota_ibfk_1` FOREIGN KEY (`id_cuota`) REFERENCES `cuotas_venta` (`id_cuota`);

--
-- Filtros para la tabla `perfil_opcion`
--
ALTER TABLE `perfil_opcion`
  ADD CONSTRAINT `perfil_opcion_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id`),
  ADD CONSTRAINT `perfil_opcion_ibfk_2` FOREIGN KEY (`id_opcion`) REFERENCES `opciones` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `fk_ventas_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipos_comprobante` (`id_tipo`),
  ADD CONSTRAINT `fk_ventas_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
