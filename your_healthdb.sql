-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2020 a las 06:40:23
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `your_healthdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areastrabajo`
--

CREATE TABLE `areastrabajo` (
  `idArea` int(11) NOT NULL,
  `aniosExp` varchar(2) NOT NULL,
  `idTipoCita` tinyint(10) NOT NULL,
  `idMedico` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `areastrabajo`
--

INSERT INTO `areastrabajo` (`idArea`, `aniosExp`, `idTipoCita`, `idMedico`) VALUES
(16, '69', 7, 'M123'),
(17, '3', 8, 'M123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areatrabajo_cupo`
--

CREATE TABLE `areatrabajo_cupo` (
  `idareatrabajocupo` int(11) NOT NULL,
  `idareatrabajo` int(11) NOT NULL,
  `idcupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `areatrabajo_cupo`
--

INSERT INTO `areatrabajo_cupo` (`idareatrabajocupo`, `idareatrabajo`, `idcupo`) VALUES
(16, 16, 5),
(17, 16, 4),
(18, 17, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citamedica`
--

CREATE TABLE `citamedica` (
  `idCita` int(11) NOT NULL,
  `idMedico` varchar(20) NOT NULL,
  `idTipoCita` tinyint(11) NOT NULL,
  `idPaciente` varchar(20) NOT NULL,
  `idAdministrador` varchar(20) NOT NULL,
  `detallesCita` varchar(150) NOT NULL,
  `fechaCita` varchar(15) NOT NULL,
  `estadoCita` varchar(50) NOT NULL,
  `idCupo` int(11) NOT NULL,
  `institucion` varchar(100) NOT NULL,
  `fechaCreacion` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citamedica`
--

INSERT INTO `citamedica` (`idCita`, `idMedico`, `idTipoCita`, `idPaciente`, `idAdministrador`, `detallesCita`, `fechaCita`, `estadoCita`, `idCupo`, `institucion`, `fechaCreacion`) VALUES
(3, 'M123', 7, 'P123', 'Default', 'Holi', '21/05/2020', 'Esperando confirmaciÃ³n', 5, 'El rosario', 'Jueves, 21 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupo`
--

CREATE TABLE `cupo` (
  `idCupo` int(11) NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `hora` varchar(50) NOT NULL,
  `disponible` varchar(50) NOT NULL,
  `institucion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cupo`
--

INSERT INTO `cupo` (`idCupo`, `lugar`, `hora`, `disponible`, `institucion`) VALUES
(4, 'sala 2-4', '8:0', 'nodisponible', 'El rosario'),
(5, 'consultÃ³rio odontolÃ³gico', '10:0', 'nodisponible', 'El rosario'),
(6, 'sala de fisioterapia', '12:0', 'nodisponible', 'El rosario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `idMedico` varchar(20) NOT NULL,
  `descripcionMedico` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`idMedico`, `descripcionMedico`) VALUES
('asasokas1', 'buen trabajador'),
('M123', 'gfjht');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocita`
--

CREATE TABLE `tipocita` (
  `idTipoCita` tinyint(10) NOT NULL,
  `nombreTipoCita` varchar(100) NOT NULL,
  `detalleTipoCita` varchar(200) NOT NULL,
  `urlImagenCita` varchar(100) NOT NULL,
  `institucion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipocita`
--

INSERT INTO `tipocita` (`idTipoCita`, `nombreTipoCita`, `detalleTipoCita`, `urlImagenCita`, `institucion`) VALUES
(7, 'odontÃ³logia', 'limpieza dental', 'imagenes/odontÃ³logiaElrosario.jpg', 'El rosario'),
(8, 'fisioterapia', 'estudio fÃ­sico', 'imagenes/fisioterapiaElrosario.jpg', 'El rosario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `numeroDocumento` varchar(100) NOT NULL,
  `tipoDocumento` varchar(100) NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `fechaNacimientoUsuario` varchar(100) NOT NULL,
  `sexoUsuario` varchar(50) NOT NULL,
  `correoUsuario` varchar(100) NOT NULL,
  `contrasenaUsuario` varchar(100) NOT NULL,
  `telefonoUsuario` varchar(50) NOT NULL,
  `institucionUsuario` varchar(100) NOT NULL,
  `fotoPerfilUsuario` varchar(200) DEFAULT NULL,
  `tipoUsuario` varchar(100) NOT NULL,
  `fechaRegistro` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`numeroDocumento`, `tipoDocumento`, `nombreUsuario`, `fechaNacimientoUsuario`, `sexoUsuario`, `correoUsuario`, `contrasenaUsuario`, `telefonoUsuario`, `institucionUsuario`, `fotoPerfilUsuario`, `tipoUsuario`, `fechaRegistro`) VALUES
('AA12334', 'Identificacion laboral', 'Jesus', '1994-08-09', 'Masculino', 'Jesus@gmail.com', 'qwerty', '3115540543', 'El rosario', 'imagenes/15886559474709.jpg', 'Administrador', ''),
('asasokas1', 'Cedula de Cuidadania', 'parra', '22/02/2020', 'Masculino', 'c@gmail.com', 'qwerty', '454515151515', 'El rosario', 'imagenes/asasokas1.jpg', 'Medico', 'Jueves,21deMayode2020'),
('M123', 'Identificacion laboral', 'Parra', '03/05/2020', 'Masculino', 'parra@gmail.com', 'hrgju', '63828', 'El rosario', 'imagenes/M123.jpg', 'Medico', 'Jueves,21deMayode2020'),
('P123', 'Cedula de Ciudadania', 'Parra', '03/05/2020', 'Masculino', 'vvx@gmail.com', 'brvjrdvh', '929', 'El rosario', 'imagenes/P123.jpg', 'Paciente', 'Jueves,21deMayode2020');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areastrabajo`
--
ALTER TABLE `areastrabajo`
  ADD PRIMARY KEY (`idArea`),
  ADD KEY `fkcitaarea` (`idTipoCita`),
  ADD KEY `fkareamedico` (`idMedico`);

--
-- Indices de la tabla `areatrabajo_cupo`
--
ALTER TABLE `areatrabajo_cupo`
  ADD PRIMARY KEY (`idareatrabajocupo`),
  ADD KEY `fkarea` (`idareatrabajo`),
  ADD KEY `fkcupo` (`idcupo`);

--
-- Indices de la tabla `citamedica`
--
ALTER TABLE `citamedica`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `fkmedicocita` (`idMedico`),
  ADD KEY `fktipocita` (`idTipoCita`),
  ADD KEY `fkcitapaciente` (`idPaciente`),
  ADD KEY `fkcitacupo` (`idCupo`);

--
-- Indices de la tabla `cupo`
--
ALTER TABLE `cupo`
  ADD PRIMARY KEY (`idCupo`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`idMedico`);

--
-- Indices de la tabla `tipocita`
--
ALTER TABLE `tipocita`
  ADD PRIMARY KEY (`idTipoCita`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`numeroDocumento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areastrabajo`
--
ALTER TABLE `areastrabajo`
  MODIFY `idArea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `areatrabajo_cupo`
--
ALTER TABLE `areatrabajo_cupo`
  MODIFY `idareatrabajocupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `citamedica`
--
ALTER TABLE `citamedica`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cupo`
--
ALTER TABLE `cupo`
  MODIFY `idCupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipocita`
--
ALTER TABLE `tipocita`
  MODIFY `idTipoCita` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areastrabajo`
--
ALTER TABLE `areastrabajo`
  ADD CONSTRAINT `fkareamedico` FOREIGN KEY (`idMedico`) REFERENCES `medico` (`idMedico`),
  ADD CONSTRAINT `fkcitaarea` FOREIGN KEY (`idTipoCita`) REFERENCES `tipocita` (`idTipoCita`);

--
-- Filtros para la tabla `areatrabajo_cupo`
--
ALTER TABLE `areatrabajo_cupo`
  ADD CONSTRAINT `fkarea` FOREIGN KEY (`idareatrabajo`) REFERENCES `areastrabajo` (`idArea`),
  ADD CONSTRAINT `fkcupo` FOREIGN KEY (`idcupo`) REFERENCES `cupo` (`idCupo`);

--
-- Filtros para la tabla `citamedica`
--
ALTER TABLE `citamedica`
  ADD CONSTRAINT `fkcitacupo` FOREIGN KEY (`idCupo`) REFERENCES `cupo` (`idCupo`),
  ADD CONSTRAINT `fkcitapaciente` FOREIGN KEY (`idPaciente`) REFERENCES `usuario` (`numeroDocumento`),
  ADD CONSTRAINT `fkmedicocita` FOREIGN KEY (`idMedico`) REFERENCES `medico` (`idMedico`),
  ADD CONSTRAINT `fktipocita` FOREIGN KEY (`idTipoCita`) REFERENCES `tipocita` (`idTipoCita`);

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `fkmedicousuario` FOREIGN KEY (`idMedico`) REFERENCES `usuario` (`numeroDocumento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
