-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2024 a las 19:22:11
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nomina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `codBanco` int(11) NOT NULL,
  `nombreBanco` varchar(20) NOT NULL,
  `telefonoBanco` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `banco`
--

INSERT INTO `banco` (`codBanco`, `nombreBanco`, `telefonoBanco`) VALUES
(1, 'Banco de Bogotá', '1234567890'),
(2, 'Banco Popular', '9876543210'),
(3, 'Bancolombia', '1112223334'),
(4, 'Banco Davivienda', '1112223334'),
(5, 'Banco Caja Social', '1112223334'),
(6, 'Banco Falabella', '1112223334'),
(7, 'Banco Itaú', '1112223334'),
(8, 'Banco Occidente', '1112223334'),
(9, 'Banco Coomeva', '1112223334');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `codCargo` int(11) NOT NULL,
  `nombreCargo` varchar(20) NOT NULL,
  `funciones` varchar(50) NOT NULL,
  `grado` varchar(20) DEFAULT NULL,
  `idNivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`codCargo`, `nombreCargo`, `funciones`, `grado`, `idNivel`) VALUES
(4, 'Desarrollador', 'Desarrollo de software', 'Senior', 1),
(5, 'Diseñador', 'Diseño gráfico', 'Junior', 2),
(6, 'Contador', 'Contabilidad y finanzas', 'Senior', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `codContrato` varchar(20) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `codCargo` int(11) NOT NULL,
  `salario` float NOT NULL,
  `codTipoContrato` int(11) NOT NULL,
  `identificacionE` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`codContrato`, `fechaInicio`, `fechaFin`, `codCargo`, `salario`, `codTipoContrato`, `identificacionE`) VALUES
('1232321', '2024-02-13', '0000-00-00', 6, 1200000, 1, '1024582197'),
('123456', '2023-12-08', '0000-00-00', 5, 3000000, 1, '2222222222'),
('2233422', '2024-02-04', '2024-03-27', 4, 1500000, 1, '33333333'),
('CON001', '2022-01-01', '2023-01-01', 4, 5000000, 1, '1234567890'),
('CON002', '2022-02-01', '2023-02-01', 5, 3500000, 2, '2345678901'),
('CON003', '2022-03-01', '2023-03-01', 6, 4500000, 1, '3456789012');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `numCuenta` varchar(20) NOT NULL,
  `codBanco` int(11) NOT NULL,
  `idTipoCuenta` int(11) NOT NULL,
  `identificacionE` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`numCuenta`, `codBanco`, `idTipoCuenta`, `identificacionE`) VALUES
('111222333444', 3, 1, '3456789012'),
('123456789012', 1, 1, '1234567890'),
('31223324324', 3, 2, '33333333'),
('31232321232', 6, 2, '1024582197'),
('31232421232', 7, 3, '44444444'),
('313213214312', 5, 1, '1024582197'),
('32321232321', 7, 2, '1024582197'),
('3233333543', 3, 2, '2222222222'),
('987654321098', 2, 2, '2345678901');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `identificacionE` varchar(11) NOT NULL,
  `tipoDocumento` varchar(20) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `fechaExpedicion` date NOT NULL,
  `nombre1` varchar(20) NOT NULL,
  `nombre2` varchar(20) DEFAULT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) DEFAULT NULL,
  `estadoCivil` varchar(20) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `nivelEstudio` varchar(30) NOT NULL,
  `telefono1` varchar(11) NOT NULL,
  `telefono2` varchar(11) DEFAULT NULL,
  `departamento` varchar(30) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `correo1` varchar(50) NOT NULL,
  `correo2` varchar(50) DEFAULT NULL,
  `nit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`identificacionE`, `tipoDocumento`, `fechaNacimiento`, `fechaExpedicion`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `estadoCivil`, `genero`, `nivelEstudio`, `telefono1`, `telefono2`, `departamento`, `ciudad`, `direccion`, `correo1`, `correo2`, `nit`) VALUES
('1024582197', 'Cedula', '1997-07-16', '2015-07-22', 'Jorge', 'Luis', 'Martinez', 'Pinto', 'Soltero/a', 'Masculino', 'tecnologico', '3182679120', '', 'Cundinamarca', 'Soacha', 'calle 33 #24B - 171', 'jlmartinezpinto@gmail.com', '', '700111222'),
('1234567890', 'Cédula', '1990-01-15', '2010-05-20', 'Juan', 'Carlos', 'Gómez', 'Pérez', 'Casado', 'Masculino', 'Profesional', '3219876543', '3112345678', 'Antioquia', 'Medellín', 'Calle 1', 'juan@example.com', 'juan.carlos@example.com', '900123456'),
('2222222222', 'Cedula', '2023-12-14', '2023-11-27', 'Jorge', '', 'Martinez', 'Pinto', 'Soltero/a', 'Masculino', 'tecnologico', '432432443', '', 'Bogotá, D.C.', 'Bogotá', 'calle 33 #24B - 171', 'jlmartinezpinto@gmail.com', '', '700111222'),
('2345678901', 'Tarjeta Identidad', '1985-08-22', '2005-03-10', 'Ana', 'María', 'López', 'García', 'Soltero', 'Femenino', 'Técnico', '3009876542', '3108765432', 'Valle del Cauca', 'Cali', 'Carrera 2', 'ana@example.com', 'ana.maria@example.com', '800987654'),
('33333333', 'Cedula', '2007-11-30', '2021-07-15', 'Juan ', 'Pedro', 'Perez', 'Gonzalez', 'Soltero/a', 'Masculino', 'maestria', '33221321222', '', 'La Guajira', 'Riohacha', 'calle 33 # 24B - 123', 'jorge@gmail.com', '', '900123456'),
('3456789012', 'Cédula', '1993-11-05', '2012-09-15', 'Pedro', NULL, 'Ramírez', NULL, 'Casado', 'Masculino', 'Bachiller', '3501234567', NULL, 'Atlántico', 'Barranquilla', 'Avenida 3', 'pedro@example.com', NULL, '700111222'),
('44444444', 'T.Identidad', '2024-02-07', '2024-02-04', 'Juan ', '', 'Peña', 'Nieto', 'Casado/a', 'Masculino', 'tecnico', '3123232123', '', 'Guainía', 'Inírida', 'calle 33 # 24B - 123', 'jorge@gmail.com', '', '900123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `nit` varchar(20) NOT NULL,
  `nombreEmpresa` varchar(50) NOT NULL,
  `direccionE` varchar(50) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `departamento` varchar(30) NOT NULL,
  `ciudad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`nit`, `nombreEmpresa`, `direccionE`, `telefono`, `correo`, `departamento`, `ciudad`) VALUES
('700111222', 'Empresa C', 'Carrera 789', '1112223334', 'empresaC@example.com', 'Atlántico', 'Barranquilla'),
('800987654', 'Empresa B', 'Avenida 456', '9876543210', 'empresaB@example.com', 'Valle del Cauca', 'Cali'),
('900123456', 'Empresa A', 'Calle 123', '1234567890', 'empresaA@example.com', 'Antioquia', 'Medellín');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `idNivel` int(11) NOT NULL,
  `descripcionF` varchar(50) NOT NULL,
  `salario` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`idNivel`, `descripcionF`, `salario`) VALUES
(1, 'Nivel Alto', 5000000),
(2, 'Nivel Medio', 3500000),
(3, 'Nivel Bajo', 2500000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parientes`
--

CREATE TABLE `parientes` (
  `identificacionP` varchar(11) NOT NULL,
  `tipoDocumento` varchar(20) NOT NULL,
  `nombre1` varchar(20) NOT NULL,
  `nombre2` varchar(20) DEFAULT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `parentesco` varchar(20) NOT NULL,
  `telefono1` varchar(11) NOT NULL,
  `telefono2` varchar(11) DEFAULT NULL,
  `identificacionE` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parientes`
--

INSERT INTO `parientes` (`identificacionP`, `tipoDocumento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `correo`, `fechaNacimiento`, `parentesco`, `telefono1`, `telefono2`, `identificacionE`) VALUES
('7654321098', 'Cédula', 'Luz', 'Elena', 'Ramírez', 'García', 'luz@example.com', '1980-12-15', 'Madre', '3108765432', 'null', '3456789012'),
('8765432109', 'Tarjeta Identidad', 'Carlos', NULL, 'López', NULL, 'carlos@example.com', '2000-06-28', 'Primo', '3101234567', 'null', '2345678901'),
('9876543210', 'Cédula', 'María', 'Isabel', 'Gómez', 'Pérez', 'maria@example.com', '1988-02-10', 'Hermana', '3159876541', 'null', '1234567890');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontrato`
--

CREATE TABLE `tipocontrato` (
  `codTipoContrato` int(11) NOT NULL,
  `nombreTipoCont` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipocontrato`
--

INSERT INTO `tipocontrato` (`codTipoContrato`, `nombreTipoCont`) VALUES
(1, 'Término indefinido'),
(2, 'Término fijo'),
(3, 'Obra o labor'),
(4, 'Aprendizaje'),
(5, 'Prestación de servic'),
(6, 'Por horas'),
(7, 'Por días'),
(8, 'Por meses'),
(9, 'Teletrabajo'),
(10, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocuenta`
--

CREATE TABLE `tipocuenta` (
  `idTipoCuenta` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipocuenta`
--

INSERT INTO `tipocuenta` (`idTipoCuenta`, `descripcion`) VALUES
(1, 'Ahorros'),
(2, 'Corriente'),
(3, 'Daviplata'),
(4, 'Nequi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `codTipoUsuario` int(11) NOT NULL,
  `nombreTipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`codTipoUsuario`, `nombreTipo`) VALUES
(1, 'Jefe RH'),
(2, 'Contador'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` varchar(11) NOT NULL,
  `tipoDocumento` varchar(2) NOT NULL,
  `nombreU` varchar(20) NOT NULL,
  `apellidoU` varchar(20) NOT NULL,
  `correoU` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `codTipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `tipoDocumento`, `nombreU`, `apellidoU`, `correoU`, `contraseña`, `codTipoUsuario`) VALUES
('1024582197', 'CC', 'Jorge ', 'Martinez', 'jorgelm65@gmail.com', '$2y$10$L1Sw2kIdSk6iWamn4yEcbO4bn4mAkGZYf64/EhxQC2WoSZNmmmkVO', 3),
('1024582973', 'CC', 'Jorge', 'Luis', 'jlmartinezpinto@gmail.com', '$2y$10$Ry4phVg02Kj8tw2tnC1cOeY5TWTcmZZo1dxOuEbbBDwmVZu/K7/26', 3),
('1111111111', 'CC', 'Jorge', 'Martinez', 'jlmartinezpinto@gmail.com', '$2y$10$oABIRDY/cSQwuEwZMvs5n.S3Fu7gohrqjtLBjNx2mVUlQ9dTWYiYa', 1),
('22222222', 'CC', 'Jorge', 'Luis', 'jorgelm65@gmail.com', '$2y$10$YIAs7mqjrn1dZR2kbRMjRe7Gc3zJPlNxOXSFVFcrTmneSqmvpsTtW', 2),
('3333333333', 'CC', 'Jorge', 'Martinez', 'jlmartinezpinto@gmail.com', '$2y$10$7OfY8j5iis38C0.Xx5gNUuiR.OEZ8JImmLXsINBoyicRmHie9x51u', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`codBanco`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`codCargo`),
  ADD KEY `idNivel` (`idNivel`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`codContrato`),
  ADD KEY `identificacionE` (`identificacionE`),
  ADD KEY `codTipoContrato` (`codTipoContrato`),
  ADD KEY `codCargo` (`codCargo`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`numCuenta`),
  ADD KEY `codBanco` (`codBanco`),
  ADD KEY `idTipoCuenta` (`idTipoCuenta`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`identificacionE`),
  ADD KEY `nit` (`nit`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`idNivel`);

--
-- Indices de la tabla `parientes`
--
ALTER TABLE `parientes`
  ADD PRIMARY KEY (`identificacionP`),
  ADD KEY `identificacionE` (`identificacionE`);

--
-- Indices de la tabla `tipocontrato`
--
ALTER TABLE `tipocontrato`
  ADD PRIMARY KEY (`codTipoContrato`);

--
-- Indices de la tabla `tipocuenta`
--
ALTER TABLE `tipocuenta`
  ADD PRIMARY KEY (`idTipoCuenta`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`codTipoUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `codTipoUsuario` (`codTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banco`
--
ALTER TABLE `banco`
  MODIFY `codBanco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `codCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `idNivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipocontrato`
--
ALTER TABLE `tipocontrato`
  MODIFY `codTipoContrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipocuenta`
--
ALTER TABLE `tipocuenta`
  MODIFY `idTipoCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `codTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `cargo_ibfk_1` FOREIGN KEY (`idNivel`) REFERENCES `nivel` (`idNivel`);

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`codTipoContrato`) REFERENCES `tipocontrato` (`codTipoContrato`),
  ADD CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`identificacionE`) REFERENCES `empleado` (`identificacionE`),
  ADD CONSTRAINT `contrato_ibfk_3` FOREIGN KEY (`codCargo`) REFERENCES `cargo` (`codCargo`),
  ADD CONSTRAINT `contrato_ibfk_4` FOREIGN KEY (`codTipoContrato`) REFERENCES `tipocontrato` (`codTipoContrato`),
  ADD CONSTRAINT `contrato_ibfk_5` FOREIGN KEY (`codCargo`) REFERENCES `cargo` (`codCargo`),
  ADD CONSTRAINT `contrato_ibfk_6` FOREIGN KEY (`codCargo`) REFERENCES `cargo` (`codCargo`);

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`codBanco`) REFERENCES `banco` (`codBanco`),
  ADD CONSTRAINT `cuenta_ibfk_2` FOREIGN KEY (`idTipoCuenta`) REFERENCES `tipocuenta` (`idTipoCuenta`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`nit`) REFERENCES `empresa` (`nit`);

--
-- Filtros para la tabla `parientes`
--
ALTER TABLE `parientes`
  ADD CONSTRAINT `parientes_ibfk_1` FOREIGN KEY (`identificacionE`) REFERENCES `empleado` (`identificacionE`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codTipoUsuario`) REFERENCES `tipousuario` (`codTipoUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
