-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2017 a las 19:51:03
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblio`
--
CREATE DATABASE IF NOT EXISTS `biblio` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `biblio`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

DROP TABLE IF EXISTS `autores`;
CREATE TABLE IF NOT EXISTS `autores` (
  `aut_ID` int(11) NOT NULL,
  `nombreApe` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nacionalidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`aut_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`aut_ID`, `nombreApe`, `nacionalidad`) VALUES
(1, 'Stephen King', 'Estados Unidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

DROP TABLE IF EXISTS `catalogo`;
CREATE TABLE IF NOT EXISTS `catalogo` (
  `cat_ID` int(11) NOT NULL,
  `lib_ID` int(11) NOT NULL,
  `cantTotal` int(11) NOT NULL,
  `cantDisponible` int(11) NOT NULL,
  PRIMARY KEY (`cat_ID`),
  KEY `catalogo_libro` (`lib_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_libros`
--

DROP TABLE IF EXISTS `estados_libros`;
CREATE TABLE IF NOT EXISTS `estados_libros` (
  `est_ID` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`est_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estados_libros`
--

INSERT INTO `estados_libros` (`est_ID`, `descripcion`) VALUES
(1, 'Ingresado'),
(2, 'Disponible'),
(3, 'Prestado'),
(4, 'Dañado'),
(5, 'Perdido - Robado'),
(6, 'Fuera Stock');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionalidades`
--

DROP TABLE IF EXISTS `funcionalidades`;
CREATE TABLE IF NOT EXISTS `funcionalidades` (
  `func_ID` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`func_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `funcionalidades`
--

INSERT INTO `funcionalidades` (`func_ID`, `descripcion`, `comentario`) VALUES
(1, 'Alta de Libros', ''),
(2, 'Alta de Autores', ''),
(3, 'Alta de socios', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

DROP TABLE IF EXISTS `libros`;
CREATE TABLE IF NOT EXISTS `libros` (
  `lib_ID` int(11) NOT NULL,
  `aut_ID` int(11) NOT NULL,
  `est_ID` int(11) NOT NULL,
  `isbn` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `genero` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `subgenero` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `editorial` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `copiaNro` int(11) NOT NULL,
  PRIMARY KEY (`lib_ID`),
  KEY `libro_autor` (`aut_ID`),
  KEY `libro_estado` (`est_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`lib_ID`, `aut_ID`, `est_ID`, `isbn`, `nombre`, `genero`, `subgenero`, `editorial`, `copiaNro`) VALUES
(1, 1, 1, '9781444707861', 'IT', 'Novela', 'Terror', 'Ediciones B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE IF NOT EXISTS `perfiles` (
  `perf_ID` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`perf_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`perf_ID`, `nombre`, `eliminado`) VALUES
(1, 'Administrador', 0),
(2, 'Operador', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perf_funcionalidad`
--

DROP TABLE IF EXISTS `perf_funcionalidad`;
CREATE TABLE IF NOT EXISTS `perf_funcionalidad` (
  `perFunc_iD` int(11) NOT NULL,
  `per_ID` int(11) NOT NULL,
  `func_ID` int(11) NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`perFunc_iD`),
  KEY `perFunc_perfil` (`per_ID`),
  KEY `perFunc_func` (`func_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perf_funcionalidad`
--

INSERT INTO `perf_funcionalidad` (`perFunc_iD`, `per_ID`, `func_ID`, `eliminado`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 2, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
CREATE TABLE IF NOT EXISTS `prestamos` (
  `pres_ID` int(11) NOT NULL,
  `soc_ID` int(11) NOT NULL,
  `res_ID` int(11) NOT NULL,
  `lib_ID` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL,
  PRIMARY KEY (`pres_ID`),
  KEY `prestamo_socio` (`soc_ID`),
  KEY `prestamo_libro` (`lib_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `res_ID` int(11) NOT NULL,
  `soc_ID` int(11) NOT NULL,
  `lib_ID` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL,
  `realizada` tinyint(1) NOT NULL,
  PRIMARY KEY (`res_ID`),
  KEY `reserva_libro` (`lib_ID`),
  KEY `reserva_socio` (`soc_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sanciones`
--

DROP TABLE IF EXISTS `sanciones`;
CREATE TABLE IF NOT EXISTS `sanciones` (
  `san_ID` int(11) NOT NULL,
  `pres_ID` int(11) NOT NULL,
  `tip_ID` int(11) NOT NULL,
  `soc_ID` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  PRIMARY KEY (`san_ID`),
  KEY `sancion_socio` (`soc_ID`),
  KEY `sancion_prestamo` (`pres_ID`),
  KEY `sancion_tipo` (`tip_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

DROP TABLE IF EXISTS `socios`;
CREATE TABLE IF NOT EXISTS `socios` (
  `soc_ID` int(11) NOT NULL,
  `usu_ID` int(11) NOT NULL,
  `nombreApe` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `barrio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codPostal` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`soc_ID`),
  KEY `socio_usuario` (`usu_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_sanciones`
--

DROP TABLE IF EXISTS `tipos_sanciones`;
CREATE TABLE IF NOT EXISTS `tipos_sanciones` (
  `tip_ID` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`tip_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipos_sanciones`
--

INSERT INTO `tipos_sanciones` (`tip_ID`, `descripcion`) VALUES
(1, 'Temporal'),
(2, 'Definitiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usu_ID` int(11) NOT NULL,
  `perf_ID` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fechaAlta` date NOT NULL,
  `fechaBaja` date DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`usu_ID`),
  KEY `usuarios_perfiles` (`perf_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_ID`, `perf_ID`, `login`, `clave`, `fechaAlta`, `fechaBaja`, `eliminado`) VALUES
(1, 1, 'vic', 'victor', '2017-09-17', NULL, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD CONSTRAINT `catalogo_libro` FOREIGN KEY (`lib_ID`) REFERENCES `libros` (`lib_ID`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libro_autor` FOREIGN KEY (`aut_ID`) REFERENCES `autores` (`aut_ID`),
  ADD CONSTRAINT `libro_estado` FOREIGN KEY (`est_ID`) REFERENCES `estados_libros` (`est_ID`);

--
-- Filtros para la tabla `perf_funcionalidad`
--
ALTER TABLE `perf_funcionalidad`
  ADD CONSTRAINT `perFunc_func` FOREIGN KEY (`func_ID`) REFERENCES `funcionalidades` (`func_ID`),
  ADD CONSTRAINT `perFunc_perfil` FOREIGN KEY (`per_ID`) REFERENCES `perfiles` (`perf_ID`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamo_libro` FOREIGN KEY (`lib_ID`) REFERENCES `libros` (`lib_ID`),
  ADD CONSTRAINT `prestamo_socio` FOREIGN KEY (`soc_ID`) REFERENCES `socios` (`soc_ID`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reserva_libro` FOREIGN KEY (`lib_ID`) REFERENCES `libros` (`lib_ID`),
  ADD CONSTRAINT `reserva_socio` FOREIGN KEY (`soc_ID`) REFERENCES `socios` (`soc_ID`);

--
-- Filtros para la tabla `sanciones`
--
ALTER TABLE `sanciones`
  ADD CONSTRAINT `sancion_prestamo` FOREIGN KEY (`pres_ID`) REFERENCES `prestamos` (`pres_ID`),
  ADD CONSTRAINT `sancion_socio` FOREIGN KEY (`soc_ID`) REFERENCES `socios` (`soc_ID`),
  ADD CONSTRAINT `sancion_tipo` FOREIGN KEY (`tip_ID`) REFERENCES `tipos_sanciones` (`tip_ID`);

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socio_usuario` FOREIGN KEY (`usu_ID`) REFERENCES `usuarios` (`usu_ID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_perfiles` FOREIGN KEY (`perf_ID`) REFERENCES `perfiles` (`perf_ID`);


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla autores
--

--
-- Metadatos para la tabla catalogo
--

--
-- Metadatos para la tabla estados_libros
--

--
-- Metadatos para la tabla funcionalidades
--

--
-- Metadatos para la tabla libros
--

--
-- Metadatos para la tabla perfiles
--

--
-- Metadatos para la tabla perf_funcionalidad
--

--
-- Metadatos para la tabla prestamos
--

--
-- Metadatos para la tabla reservas
--

--
-- Metadatos para la tabla sanciones
--

--
-- Metadatos para la tabla socios
--

--
-- Metadatos para la tabla tipos_sanciones
--

--
-- Metadatos para la tabla usuarios
--

--
-- Metadatos para la base de datos biblio
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
