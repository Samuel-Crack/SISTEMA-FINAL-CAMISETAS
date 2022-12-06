-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2022 a las 04:55:23
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `camisetas1`
--
CREATE DATABASE IF NOT EXISTS `camisetas1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `camisetas1`;

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GetNroBoletaMax` () RETURNS INT(11) NO SQL BEGIN
Declare Contador int DEFAULT 0;
Select max(idboletas) into Contador from boletas;
return Contador;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `idBoletaCliente` (`id` INT) RETURNS INT(11) NO SQL BEGIN
DECLARE contador int;

Select max(b.idboletas) into contador from boletas b
WHERE b.idclientes=id;

RETURN contador;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `NuevoIdBoleta` () RETURNS INT(11)  BEGIN
Declare Contador int DEFAULT 0;

Select max(idboletas) into Contador from boletas;
IF (Contador IS NULL) THEN
	set Contador=0;
end if;	
return Contador+1;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `NuevoNroBoleta` () RETURNS VARCHAR(10) CHARSET latin1  BEGIN
Declare Contador int DEFAULT 0;

Select max(right(numero,8)) into Contador from boletas;
IF (Contador IS NULL) THEN
	set Contador=0;
end if;	
return concat('B-',right(concat('00000000',Contador+1),8)) ;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `NumerosALetras` (`numero` NUMERIC(19,7)) RETURNS VARCHAR(512) CHARSET latin1  BEGIN


DECLARE lcRetorno VARCHAR(512);
DECLARE lnTerna INT;
DECLARE lcMiles VARCHAR(512);
DECLARE lcCadena VARCHAR(512);
DECLARE lnUnidades INT;
DECLARE lnDecenas INT;
DECLARE lnCentenas INT;
DECLARE lnEntero INT;
DECLARE lnDecimal INT;

Set lnEntero = truncate(numero,0);
Set lnDecimal = (numero - lnEntero)*100;

IF lnEntero > 0 THEN
SET lcRetorno = '';
SET lnTerna = 1 ;

WHILE lnEntero > 0 DO

-- Recorro columna por columna
SET lcCadena = '';

SET lnUnidades = RIGHT(lnEntero,1);
SET lnEntero = LEFT(lnEntero,LENGTH(lnEntero)-1) ;

SET lnDecenas = RIGHT(lnEntero,1);
SET lnEntero = LEFT(lnEntero,LENGTH(lnEntero)-1) ;

SET lnCentenas = RIGHT(lnEntero,1);
SET lnEntero = LEFT(lnEntero,LENGTH(lnEntero)-1) ;
-- Analizo las unidades
SET lcCadena =
CASE /* UNIDADES */
WHEN lnUnidades = 1 AND lnTerna = 1 THEN CONCAT('UNO ',lcCadena)
WHEN lnUnidades = 1 AND lnTerna <> 1 THEN CONCAT('UN',lcCadena)
WHEN lnUnidades = 2 THEN CONCAT('DOS ',lcCadena)
WHEN lnUnidades = 3 THEN CONCAT('TRES ',lcCadena)
WHEN lnUnidades = 4 THEN CONCAT('CUATRO ',lcCadena)
WHEN lnUnidades = 5 THEN CONCAT('CINCO ',lcCadena)
WHEN lnUnidades = 6 THEN CONCAT('SEIS ',lcCadena)
WHEN lnUnidades = 7 THEN CONCAT('SIETE ',lcCadena)
WHEN lnUnidades = 8 THEN CONCAT('OCHO ',lcCadena)
WHEN lnUnidades = 9 THEN CONCAT('NUEVE ',lcCadena)
ELSE lcCadena
END ;/* UNIDADES */

-- Analizo las decenas
SET lcCadena =
CASE /* DECENAS */
WHEN lnDecenas = 1 THEN
CASE lnUnidades
WHEN 0 THEN 'DIEZ '
WHEN 1 THEN 'ONCE '
WHEN 2 THEN 'DOCE '
WHEN 3 THEN 'TRECE '
WHEN 4 THEN 'CATORCE '
WHEN 5 THEN 'QUINCE '
ELSE CONCAT('DIECI',lcCadena)
END
WHEN lnDecenas = 2 AND lnUnidades = 0 THEN CONCAT('VEINTE ',lcCadena)
WHEN lnDecenas = 2 AND lnUnidades <> 0 THEN CONCAT('VEINTI',lcCadena)
WHEN lnDecenas = 3 AND lnUnidades = 0 THEN CONCAT('TREINTA ',lcCadena)
WHEN lnDecenas = 3 AND lnUnidades <> 0 THEN CONCAT('TREINTA Y ',lcCadena)
WHEN lnDecenas = 4 AND lnUnidades = 0 THEN CONCAT('CUARENTA ',lcCadena)
WHEN lnDecenas = 4 AND lnUnidades <> 0 THEN CONCAT('CUARENTA Y ',lcCadena)
WHEN lnDecenas = 5 AND lnUnidades = 0 THEN CONCAT('CINCUENTA ',lcCadena)
WHEN lnDecenas = 5 AND lnUnidades <> 0 THEN CONCAT('CINCUENTA Y ',lcCadena)
WHEN lnDecenas = 6 AND lnUnidades = 0 THEN CONCAT('SESENTA ',lcCadena)
WHEN lnDecenas = 6 AND lnUnidades <> 0 THEN CONCAT('SESENTA Y ',lcCadena)
WHEN lnDecenas = 7 AND lnUnidades = 0 THEN CONCAT('SETENTA ',lcCadena)
WHEN lnDecenas = 7 AND lnUnidades <> 0 THEN CONCAT('SETENTA Y ',lcCadena)
WHEN lnDecenas = 8 AND lnUnidades = 0 THEN CONCAT('OCHENTA ',lcCadena)
WHEN lnDecenas = 8 AND lnUnidades <> 0 THEN CONCAT('OCHENTA Y ',lcCadena)
WHEN lnDecenas = 9 AND lnUnidades = 0 THEN CONCAT('NOVENTA ',lcCadena)
WHEN lnDecenas = 9 AND lnUnidades <> 0 THEN CONCAT('NOVENTA Y ',lcCadena)
ELSE lcCadena
END ;/* DECENAS */

-- Analizo las centenas
SET lcCadena =
CASE /* CENTENAS */
WHEN lnCentenas = 1 AND lnUnidades = 0 AND lnDecenas = 0 THEN CONCAT('CIEN ',lcCadena)
WHEN lnCentenas = 1 AND NOT(lnUnidades = 0 AND lnDecenas = 0) THEN CONCAT('CIENTO ',lcCadena)
WHEN lnCentenas = 2 THEN CONCAT('DOSCIENTOS ',lcCadena)
WHEN lnCentenas = 3 THEN CONCAT('TRESCIENTOS ',lcCadena)
WHEN lnCentenas = 4 THEN CONCAT('CUATROCIENTOS ',lcCadena)
WHEN lnCentenas = 5 THEN CONCAT('QUINIENTOS ',lcCadena)
WHEN lnCentenas = 6 THEN CONCAT('SEISCIENTOS ',lcCadena)
WHEN lnCentenas = 7 THEN CONCAT('SETECIENTOS ',lcCadena)
WHEN lnCentenas = 8 THEN CONCAT('OCHOCIENTOS ',lcCadena)
WHEN lnCentenas = 9 THEN CONCAT('NOVECIENTOS ',lcCadena)
ELSE lcCadena
END ;/* CENTENAS */



-- Analizo los millares
SET lcCadena =
CASE /* TERNA */
WHEN lnTerna = 1 THEN lcCadena
WHEN lnTerna = 2 AND (lnUnidades + lnDecenas + lnCentenas <> 0) THEN CONCAT(lcCadena,' MIL ')
WHEN lnTerna = 3 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0 THEN CONCAT(lcCadena,' MILLON ')
WHEN lnTerna = 3 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND NOT (lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0) THEN CONCAT(lcCadena,' MILLONES ')
WHEN lnTerna = 4 AND (lnUnidades + lnDecenas + lnCentenas <> 0) THEN CONCAT(lcCadena,' MIL MILLONES ')
WHEN lnTerna = 5 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0 THEN CONCAT(lcCadena,' BILLON ')
WHEN lnTerna = 5 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND NOT (lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0) THEN CONCAT(lcCadena,' BILLONES ')
WHEN lnTerna = 6 AND (lnUnidades + lnDecenas + lnCentenas <> 0) THEN CONCAT(lcCadena,' MIL BILLONES ')
WHEN lnTerna = 7 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0 THEN CONCAT(lcCadena,' TRILLON ')
WHEN lnTerna = 7 AND (lnUnidades + lnDecenas + lnCentenas <> 0) AND NOT (lnUnidades = 1 AND lnDecenas = 0 AND lnCentenas = 0) THEN CONCAT(lcCadena,' TRILLONES ')
WHEN lnTerna = 8 AND (lnUnidades + lnDecenas + lnCentenas <> 0) THEN CONCAT(lcCadena,' MIL TRILLONES ')
ELSE ''
END ;/* MILLARES */


-- Armo el retorno columna a columna
SET lcRetorno = CONCAT(lcCadena,lcRetorno);

SET lnTerna = lnTerna + 1;

END WHILE ; /* WHILE */
ELSE
SET lcRetorno = 'CERO' ;
END IF ;

return concat(RTRIM(lcRetorno),' y ',lnDecimal,'/100') ;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `idauditoria` int(11) NOT NULL,
  `tabla` varchar(30) DEFAULT NULL,
  `data_new` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_new`)),
  `data_old` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_old`)),
  `usuario` varchar(15) DEFAULT NULL,
  `ip` varchar(32) DEFAULT NULL,
  `accion` varchar(1) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`idauditoria`, `tabla`, `data_new`, `data_old`, `usuario`, `ip`, `accion`, `fecha`) VALUES
(1, 'talla', '{\"idtalla\": 5, \"talla\": \"probando\"}', NULL, 'root@localhost', 'PC-CASA', 'N', '2022-12-06 02:22:33'),
(2, 'calidad', '{\"idcalidad\": 4, \"calidad\": \"Exelente\"}', NULL, 'root@localhost', 'PC-CASA', 'N', '2022-12-06 02:30:06'),
(3, 'marca', '{\"idmarca\": 4, \"marca\": \"prueba\"}', NULL, 'root@localhost', 'PC-CASA', 'N', '2022-12-06 02:33:22'),
(4, 'camisetas', '{\"idcamisetas\": 13, \"descripcion\": \"PRUEBA\"}', NULL, 'root@localhost', 'PC-CASA', 'N', '2022-12-06 02:38:48'),
(5, 'modelo_calidad', '{\"idmodelo_calidad\": 5, \"idcalidad\": 2, \"idmodelos\": 2}', NULL, 'root@localhost', 'PC-CASA', 'N', '2022-12-06 02:55:02'),
(6, 'talla', '{\"idtalla\": 5, \"talla\": \"nuevpo\"}', NULL, 'root@localhost', 'PC-CASA', 'N', '2022-12-06 03:12:32'),
(7, 'talla', NULL, '{\"idtalla\": 5, \"talla\": \"nuevpo\"}', 'root@localhost', 'PC-CASA', 'D', '2022-12-06 03:12:32'),
(8, 'calidad', '{\"idcalidad\": 4, \"calidad\": \"PROBANDO\"}', NULL, 'root@localhost', 'PC-CASA', 'N', '2022-12-06 03:15:44'),
(9, 'calidad', NULL, '{\"idcalidad\": 4, \"calidad\": \"PROBANDO\"}', 'root@localhost', 'PC-CASA', 'N', '2022-12-06 03:15:44'),
(10, 'detalles_camisetas', '{\"iddetalles_camisetas\": 11, \"precio\": 120.0000000, \"stock\": \"45\", \"idcamisetas\": 11, \"idmodelo_talla\": 1, \"idmodelo_calidad\": 2, \"idmodelo_seleccion\": 11}', NULL, 'root@localhost', 'PC-CASA', 'N', '2022-12-06 03:21:36'),
(11, 'detalles_camisetas', NULL, '{\"iddetalles_camisetas\": 11, \"precio\": 120.0000000, \"stock\": \"45\", \"idcamisetas\": 11, \"idmodelo_talla\": 1, \"idmodelo_calidad\": 2, \"idmodelo_seleccion\": 11}', 'root@localhost', 'PC-CASA', 'N', '2022-12-06 03:21:36'),
(13, 'calidad', NULL, '{\"idcalidad\": 5, \"calidad\": \"Duradera\"}', 'root@localhost', 'PC-CASA', 'N', '2022-12-06 03:22:05'),
(14, 'detalles_camisetas', '{\"iddetalles_camisetas\": 11, \"precio\": 25.0000000, \"stock\": \"45\", \"idcamisetas\": 11, \"idmodelo_talla\": 1, \"idmodelo_calidad\": 1, \"idmodelo_seleccion\": 11}', NULL, 'root@localhost', 'PC-CASA', 'N', '2022-12-06 03:24:04'),
(15, 'boletas', '{\"idboletas\": 17, \"fecha\": \"2022-12-05 22:40:08\", \"total\": 70.8000000, \"idclientes\": 7, \"idvendedor\": 1, \"numero\": \"B-00000017\"}', NULL, 'root@localhost', 'PC-CASA', 'N', '2022-12-06 03:40:08'),
(16, 'boletas', NULL, '{\"idboletas\": 17, \"fecha\": \"2022-12-05 22:40:08\", \"total\": 70.8000000, \"idclientes\": 7, \"idvendedor\": 1, \"numero\": \"B-00000017\"}', 'root@localhost', 'PC-CASA', 'D', '2022-12-06 03:40:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletas`
--

CREATE TABLE `boletas` (
  `idboletas` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `total` decimal(19,7) DEFAULT NULL,
  `idclientes` int(11) NOT NULL,
  `idvendedor` int(11) NOT NULL,
  `numero` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `boletas`
--

INSERT INTO `boletas` (`idboletas`, `fecha`, `total`, `idclientes`, `idvendedor`, `numero`) VALUES
(1, '2022-10-11 00:00:00', '300.0000000', 1, 1, 'B-00000001'),
(2, '2022-09-17 00:00:00', '92.0000000', 2, 2, 'B-00000002'),
(3, '2022-09-17 00:00:00', '62.0000000', 4, 3, 'B-00000003'),
(4, '2022-10-10 00:00:00', '450.0000000', 4, 4, 'B-00000004'),
(5, '2022-11-13 18:24:10', '53.1000000', 1, 1, 'B-00000005'),
(6, '2022-11-13 18:35:56', '53.1000000', 1, 1, 'B-00000006'),
(7, '2022-11-13 18:52:29', '106.2000000', 1, 1, 'B-00000007'),
(8, '2022-11-13 18:57:35', '497.9600000', 7, 1, 'B-00000008'),
(9, '2022-11-14 23:17:08', '70.8000000', 7, 1, 'B-00000009'),
(10, '2022-11-18 00:05:13', '122.7200000', 7, 1, 'B-00000010'),
(11, '2022-11-19 19:47:27', '70.8000000', 7, 1, 'B-00000011'),
(12, '2022-11-19 19:59:17', '212.4000000', 7, 1, 'B-00000012'),
(13, '2022-11-23 19:14:32', '70.8000000', 16, 1, 'B-00000013'),
(14, '2022-11-23 23:25:08', '70.8000000', 5, 1, 'B-00000014'),
(15, '2022-12-01 00:03:56', '122.7200000', 7, 1, 'B-00000015'),
(16, '2022-12-04 17:46:32', '106.2000000', 7, 1, 'B-00000016'),
(17, '2022-12-05 22:40:08', '70.8000000', 7, 1, 'B-00000017');

--
-- Disparadores `boletas`
--
DELIMITER $$
CREATE TRIGGER `Audit_DelBoletas` AFTER INSERT ON `boletas` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_old, fecha, ip , usuario)
values ('boletas', 'Del', json_object
('idboletas', new.idboletas, 'fecha', new.fecha, 'total', new.total, 'idclientes',new.idclientes, 'idvendedor', new.idvendedor, 'numero',new.numero), now(), @@hostname,user());

end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audit_NewBoletas` AFTER INSERT ON `boletas` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_new, fecha, ip , usuario)
values ('boletas', 'New', json_object
('idboletas', new.idboletas, 'fecha', new.fecha, 'total', new.total, 'idclientes',new.idclientes, 'idvendedor', new.idvendedor, 'numero',new.numero), now(), @@hostname,user());

end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `NuevaBoleta` BEFORE INSERT ON `boletas` FOR EACH ROW begin
	set new.idboletas=NuevoIdBoleta();
    set new.numero=NuevoNroBoleta();
    set new.fecha=now();
 end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calidad`
--

CREATE TABLE `calidad` (
  `idcalidad` int(11) NOT NULL,
  `calidad` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calidad`
--

INSERT INTO `calidad` (`idcalidad`, `calidad`) VALUES
(1, 'BUENA'),
(2, 'Duradera'),
(3, 'REGULAR');

--
-- Disparadores `calidad`
--
DELIMITER $$
CREATE TRIGGER `Audit_NewCalidad` AFTER INSERT ON `calidad` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_new, fecha, ip , usuario)
values ('calidad', 'New', json_object
('idcalidad', new.idcalidad, 'calidad', new.calidad), now(), @@hostname,user());

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camisetas`
--

CREATE TABLE `camisetas` (
  `idcamisetas` int(11) NOT NULL,
  `descripcion` varchar(455) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `camisetas`
--

INSERT INTO `camisetas` (`idcamisetas`, `descripcion`) VALUES
(1, 'Camiseta de Perú '),
(2, 'Camisetas de Argentina '),
(3, 'Camisetas de Brasil '),
(4, 'Camiseta Uruguay'),
(5, 'Camisetas de Portugal'),
(6, 'Camisetas de Francia'),
(7, 'Camisetas de Bélgica'),
(8, 'Camisetas de Ecuador '),
(9, 'Camisetas de Alemania'),
(10, 'Camisetas de España'),
(11, 'Camiseta de Senegal'),
(12, 'Camiseta de Chile');

--
-- Disparadores `camisetas`
--
DELIMITER $$
CREATE TRIGGER `Audit_DelCamiseta` AFTER INSERT ON `camisetas` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_old, fecha, ip , usuario)
values ('camisetas', 'Del', json_object
('idcamisetas', new.idcamisetas, 'descripcion', new.descripcion), now(), @@hostname,user());

end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audit_NewCamiseta` AFTER INSERT ON `camisetas` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_new, fecha, ip , usuario)
values ('camisetas', 'New', json_object
('idcamisetas', new.idcamisetas, 'descripcion', new.descripcion), now(), @@hostname,user());

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idclientes` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `dni` varchar(12) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `nacionalidad` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `pasword` varchar(45) DEFAULT NULL,
  `estado` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `idperfil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idclientes`, `nombres`, `apellidos`, `dni`, `direccion`, `telefono`, `nacionalidad`, `login`, `pasword`, `estado`, `email`, `idperfil`) VALUES
(1, 'Kylian', 'Mbappe', '04423514', 'Paris', '984756123', 'Francia', 'kylian', 'paris', '1', 'mbappe@gmail.com', NULL),
(2, 'Neymar', 'Jr', '58745123', 'Sao Paulo', '368745189', 'Brasil', NULL, NULL, NULL, NULL, NULL),
(3, 'Luis Alexander', 'Coaquira', '71885442', 'Moquegua', '965148745', 'Peru', 'luis', 'cartas', '1', 'luis@gmail.com', 3),
(4, 'Karim            ', 'Benzema            ', '04456985  ', 'Madrid', '910255478    ', 'España            ', NULL, NULL, NULL, '\r\n            ', NULL),
(5, 'leo', 'peñaloza', '45687123', 'samegua', '987548712', 'peru', 'leonardo', '123', '1', 'leonardo@gmail.com', 2),
(6, 'Abelardo', 'Gutierrez', '25684579', 'AV balta', '965874123', 'Peru', 'abel', 'abel', '1', 'abelduran@gmail.com', 2),
(7, 'Samuel', 'Huanca', '78541265', 'AV. Manuel C. de la Torre', '987541265', 'Peru', 'samuel', 'iejcm', '1', 'samuel@gmail.com', 1),
(16, 'Kylian', 'Benzema', '04423514', 'Croacia', '910444135', 'España', 'psg', 'psg', NULL, 'covid19procracks2020@gmail.com', 2),
(21, 'Pierre', 'Aubameyang', '04423514', 'Croacia', '910444135', 'Croata', 'edward', '159', NULL, 'samuelhuanca15@gmail.com', 2),
(37, 'CRISTIANO', 'RONALDO', '04458745', 'PORTUGAL', '958745123', 'PORTUGUESA', 'cr7', 'cr7', NULL, 'samuelhuanca15@gmail.com', 2),
(41, 'CRISTIANO', 'RONALDO', 'dni', 'Sao Paulooo', '910444135', 'Croata', 'cr7', 'cr7', NULL, 'samuelhuanca15@gmail.com', 2);

--
-- Disparadores `clientes`
--
DELIMITER $$
CREATE TRIGGER `Audit_NewClientes` AFTER INSERT ON `clientes` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_new, fecha, ip , usuario)
values ('clientes', 'New', json_object
('idclientes', new.idclientes, 'nombres', new.nombres, 'apellidos', new.apellidos, 'dni',new.dni, 'direccion', new.direccion,
 'telefono',new.telefono, 'nacionalidad', new.nacionalidad, 'login', new.login, 'pasword', new.pasword, 'email', new.email, 'idperfil', new.idperfil), now(), @@hostname,user());

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_camisetas`
--

CREATE TABLE `detalles_camisetas` (
  `iddetalles_camisetas` int(11) NOT NULL,
  `precio` decimal(19,7) DEFAULT NULL,
  `stock` varchar(45) DEFAULT NULL,
  `idcamisetas` int(11) NOT NULL,
  `idmodelo_talla` int(11) NOT NULL,
  `idmodelo_calidad` int(11) NOT NULL,
  `idmodelo_seleccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalles_camisetas`
--

INSERT INTO `detalles_camisetas` (`iddetalles_camisetas`, `precio`, `stock`, `idcamisetas`, `idmodelo_talla`, `idmodelo_calidad`, `idmodelo_seleccion`) VALUES
(1, '52.0000000', '15', 1, 1, 1, 1),
(2, '60.0000000', '10', 2, 1, 1, 2),
(3, '45.0000000', '50', 3, 2, 1, 3),
(4, '25.0000000', '16', 4, 2, 1, 4),
(5, '60.0000000', '20', 5, 3, 2, 5),
(6, '30.0000000', '20', 6, 2, 1, 6),
(7, '25.0000000', '36', 7, 2, 4, 7),
(8, '15.0000000', '10', 8, 2, 3, 8),
(9, '25.0000000', '30', 9, 1, 3, 9),
(10, '30.0000000', '28', 10, 2, 3, 10),
(11, '25.0000000', '45', 11, 1, 1, 11);

--
-- Disparadores `detalles_camisetas`
--
DELIMITER $$
CREATE TRIGGER `Audit_NewDetalles_camisetas` AFTER INSERT ON `detalles_camisetas` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_new, fecha, ip , usuario)
values ('detalles_camisetas', 'New', json_object
('iddetalles_camisetas', new.iddetalles_camisetas, 'precio', new.precio, 'stock', new.stock, 'idcamisetas',new.idcamisetas, 'idmodelo_talla', new.idmodelo_talla, 'idmodelo_calidad',new.idmodelo_calidad, 'idmodelo_seleccion', new.idmodelo_seleccion), now(), @@hostname,user());

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_boleta`
--

CREATE TABLE `detalle_boleta` (
  `iddetalle_boleta` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(19,7) DEFAULT NULL,
  `subtotal` decimal(19,7) DEFAULT NULL,
  `producto` varchar(200) DEFAULT NULL,
  `idboletas` int(11) NOT NULL,
  `iddetalles_camisetas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_boleta`
--

INSERT INTO `detalle_boleta` (`iddetalle_boleta`, `cantidad`, `precio_unitario`, `subtotal`, `producto`, `idboletas`, `iddetalles_camisetas`) VALUES
(1, 12, '30.0000000', '210.0000000', 'camiseta de Peru', 1, 1),
(2, 15, '30.0000000', '210.0000000', 'camiseta de Argentina', 1, 1),
(3, 20, '20.0000000', '210.0000000', 'camiseta de Brasil', 1, 7),
(16, 1, '60.0000000', '60.0000000', 'Talla: S - Modelo de imagen: argentina.jpg', 11, 2),
(17, 3, '60.0000000', '180.0000000', 'Talla: XL - Modelo de imagen: argentina.jpg', 12, 2),
(18, 1, '60.0000000', '60.0000000', 'Talla: S - Modelo de imagen: argentina.jpg', 13, 2),
(19, 1, '60.0000000', '60.0000000', 'Talla: L - Modelo de imagen: portugal01.jpg', 14, 5),
(20, 2, '52.0000000', '104.0000000', 'Talla: XL - Modelo de imagen: peru02.jpg', 15, 1),
(21, 2, '45.0000000', '90.0000000', 'Talla: XL - Modelo de imagen: brasil01.jpg', 16, 3),
(22, 1, '60.0000000', '60.0000000', 'Talla: S - Modelo de imagen: argentina.jpg', 17, 2);

--
-- Disparadores `detalle_boleta`
--
DELIMITER $$
CREATE TRIGGER `SetNroBoleta` BEFORE INSERT ON `detalle_boleta` FOR EACH ROW begin
	set new.idboletas = GetNroBoletaMax();
 end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_producto`
--

CREATE TABLE `imagenes_producto` (
  `idimagen` int(11) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `iddetalles_camisetas` int(11) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes_producto`
--

INSERT INTO `imagenes_producto` (`idimagen`, `url`, `iddetalles_camisetas`, `nombre`) VALUES
(1, 'peru.jpg', 1, 'Peru'),
(2, 'argentina.jpg', 2, 'Argentina'),
(3, 'brasil.jpg', 3, 'Brasil'),
(4, 'uruguay.jpg', 4, 'Uruguay'),
(5, 'portugal.jpg', 5, 'Portugal'),
(6, 'francia.jpg', 6, 'Francia'),
(7, 'belgica.jpg', 7, 'Belgica'),
(8, 'ecuador.jpg', 8, 'Ecuador'),
(9, 'alemania.jpg', 9, 'Alemania'),
(10, 'españa.jpg', 10, 'España'),
(11, 'peru01.jpg', 1, 'Peru01'),
(12, 'peru02.jpg', 1, 'Peru02'),
(13, 'argentina01.jpg', 2, 'Argentina01'),
(14, 'argentina02.jpg', 2, 'Argentina02'),
(15, 'brasil01.jpg', 3, 'Brasil01'),
(16, 'brasil02.jpg', 3, 'Brasil02'),
(17, 'uruguay01.jpg', 4, 'Uruguay01'),
(18, 'portugal01.jpg', 5, 'Portugal01'),
(19, 'portugal02.jpg', 5, 'Portugal02'),
(20, 'francia01.jpg', 6, 'Francia01'),
(21, 'francia02.jpg', 6, 'Francia02'),
(22, 'belgica01.jpg', 7, 'Belgica01'),
(23, 'belgica02.jpg', 7, 'Belgica02'),
(24, 'ecuador01.jpg', 8, 'Ecuador01'),
(25, 'alemania01.jpg', 9, 'Alemania01'),
(29, 'chile.jpg', 0, '12'),
(9, 'argentina.jpg', 0, '9'),
(9, 'argentina.jpg', 0, '9'),
(9, 'argentina.jpg', 0, '9'),
(30, 'seneal.jpg', 0, '11'),
(30, 'seneal.jpg', 0, '11'),
(29, 'senegal.jpg', 0, '11'),
(29, 'senegal.jpg', 0, '11'),
(26, 'alemania02.jpg', 9, 'alemania 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL,
  `marca` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idmarca`, `marca`) VALUES
(1, 'NIKE'),
(2, 'PUMA'),
(3, 'ADIDAS'),
(4, 'prueba');

--
-- Disparadores `marca`
--
DELIMITER $$
CREATE TRIGGER `Audit_NewMarca` AFTER INSERT ON `marca` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_new, fecha, ip , usuario)
values ('marca', 'New', json_object
('idmarca', new.idmarca, 'marca', new.marca), now(), @@hostname,user());

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `idmodelos` int(11) NOT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `idmarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`idmodelos`, `modelo`, `idmarca`) VALUES
(1, 'Equipacion 1', 1),
(2, 'Equipacion 2', 1),
(3, 'Equipacion 3', 1),
(4, 'Equipacion 1 y 2', 1),
(5, 'Francia Equipacion 1,2 y 3', 1),
(6, 'Argentina equipacion 3', 3),
(7, 'Belgica equipacion 2', 1),
(8, 'Peru equipacion 3', 1),
(9, 'Alemania Equipacion 1', 2),
(10, 'Uruguay Equipacion 1 y 2', 1),
(11, 'Francia Equipacion 1', 2),
(12, 'Argentina equipacion 2', 2),
(13, 'Brasil equipacion 1', 2),
(14, 'Brasil equipacion 3', 3),
(15, 'Belgica Equipacion 1', 3),
(16, 'Francia Equipacion 1,2 ', 3),
(17, 'Alemania Equipacion 1y 2', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo_calidad`
--

CREATE TABLE `modelo_calidad` (
  `idmodelo_calidad` int(11) NOT NULL,
  `idcalidad` int(11) NOT NULL,
  `idmodelos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modelo_calidad`
--

INSERT INTO `modelo_calidad` (`idmodelo_calidad`, `idcalidad`, `idmodelos`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 3, 3),
(4, 3, 4),
(5, 2, 2);

--
-- Disparadores `modelo_calidad`
--
DELIMITER $$
CREATE TRIGGER `Audit_NewModelo_calidad` AFTER INSERT ON `modelo_calidad` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_new, fecha, ip , usuario)
values ('modelo_calidad', 'New', json_object
('idmodelo_calidad', new.idmodelo_calidad, 'idcalidad', new.idcalidad, 'idmodelos', new.idmodelos), now(), @@hostname,user());

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo_seleccion`
--

CREATE TABLE `modelo_seleccion` (
  `idmodelo_seleccion` int(11) NOT NULL,
  `idseleccion` int(11) NOT NULL,
  `descripcion` varchar(160) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `idmodelos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modelo_seleccion`
--

INSERT INTO `modelo_seleccion` (`idmodelo_seleccion`, `idseleccion`, `descripcion`, `color`, `idmodelos`) VALUES
(1, 1, 'Camiseta de Perú Original ', 'rojo', 1),
(2, 2, 'Camiseta de Argentina   /Campeón de la copa América ', 'Celeste', 1),
(3, 3, 'Camiseta de Brasil QATAR Desde Talla LA S HASTA LA XL', 'Amarillo', 1),
(4, 4, 'Camiseta Uruguay Mundial 2022 DISPONIBLE TALLAS S-XL', 'Azul', 1),
(5, 5, 'Camiseta Nuevas de la Selección de Portugal', 'Rojo', 1),
(6, 6, 'Camiseta de Francia del Campeón del Mundo 2018', 'Azul', 1),
(7, 7, 'Camisetas de Bélgica disponible todas las tallas', 'Rojo', 1),
(8, 8, 'Camisetas de Ecuador Recién Importados', 'Amarrillo', 4),
(9, 9, 'Camiseta de la Selección de Alemania Campeón 2014 ', 'Plomo', 4),
(10, 10, 'Camiseta del Campeón del Mundial 2010', 'Rojo', 4),
(11, 11, 'Camiseta de Senegal', 'Verde', 1),
(12, 12, 'Camiseta de Chile', 'Rojo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo_talla`
--

CREATE TABLE `modelo_talla` (
  `idmodelo_talla` int(11) NOT NULL,
  `idtalla` int(11) NOT NULL,
  `idmodelos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modelo_talla`
--

INSERT INTO `modelo_talla` (`idmodelo_talla`, `idtalla`, `idmodelos`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4);

--
-- Disparadores `modelo_talla`
--
DELIMITER $$
CREATE TRIGGER `Audit_NewModelo_talla` AFTER INSERT ON `modelo_talla` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_new, fecha, ip , usuario)
values ('modelo_talla', 'New', json_object
('idmodelo_talla', new.idmodelo_talla, 'idtalla', new.idtalla, 'idmodelos', new.idmodelos), now(), @@hostname,user());

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `idperfil` int(11) NOT NULL,
  `perfil` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`idperfil`, `perfil`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `descripcion` varchar(8000) DEFAULT NULL,
  `pu` decimal(19,7) DEFAULT NULL,
  `idmodelo` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `nombre`, `descripcion`, `pu`, `idmodelo`, `stock`) VALUES
(1, 'Camiseta de Peru', 'Camiseta de Peru Original', '45.0000000', 6, 30),
(2, 'Camiseta de Argentina', 'Camiseta de Argentina/Capeon de la copa america', '50.0000000', 2, 30),
(3, 'Camisetas de Brasil', 'Camiseta de Brasil QATAR Desde Talla LA S HASTA LA XL', '35.0000000', 3, 40),
(4, 'Camisetas de Uruguay', 'Camiseta Uruguay Mundial 2022 DISPONIBLE TALLAS S-XL', '55.0000000', 4, 30),
(5, 'Camisetas de Portugal', 'Camiseta Nuevas de la Seleccion de Portugal', '50.0000000', 5, 40),
(6, 'Camisetas de Francia', 'Camiseta del Campeon del Mundo 2018', '60.0000000', 6, 60),
(7, 'Camisetas de Belgica', 'Camisetas de Belgica disponible todas las tallas', '45.0000000', 7, 48),
(8, 'Camisetas de Ecuador', 'Camisetas de Ecuador Recien Importados', '30.0000000', 8, 36),
(9, 'Camisetas de Alemania', 'Camiseta de la Seleccion de Alemania Campeon 2014 ', '35.0000000', 9, 30),
(10, 'Camisetas de España', 'Camiseta del Campeon del mUNDIAL 2010', '50.0000000', 10, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seleccion`
--

CREATE TABLE `seleccion` (
  `idseleccion` int(11) NOT NULL,
  `seleccion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seleccion`
--

INSERT INTO `seleccion` (`idseleccion`, `seleccion`) VALUES
(1, 'PERU'),
(2, 'ARGENTINA'),
(3, 'BRASIL'),
(4, 'Uruguay'),
(5, 'Portugal'),
(6, 'Francia'),
(7, 'Belgica'),
(8, 'Ecuador'),
(9, 'Alemania'),
(10, 'España'),
(11, 'Senegal'),
(12, 'Chile');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla`
--

CREATE TABLE `talla` (
  `idtalla` int(11) NOT NULL,
  `talla` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `talla`
--

INSERT INTO `talla` (`idtalla`, `talla`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL');

--
-- Disparadores `talla`
--
DELIMITER $$
CREATE TRIGGER `Audit_DelTalla` AFTER INSERT ON `talla` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_old, fecha, ip , usuario)
values ('talla', 'Del', json_object
('idtalla', new.idtalla, 'talla', new.talla), now(), @@hostname,user());

end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audit_NewTalla` AFTER INSERT ON `talla` FOR EACH ROW begin 
insert into auditoria (tabla, accion, data_new, fecha, ip , usuario)
values ('talla', 'New', json_object
('idtalla', new.idtalla, 'talla', new.talla), now(), @@hostname,user());

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `login` varchar(15) DEFAULT NULL,
  `pasword` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaalta` datetime DEFAULT NULL,
  `idperfil` int(11) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `login`, `pasword`, `estado`, `fechaalta`, `idperfil`, `email`, `telefono`) VALUES
(1, 'SAMUEL', 'samuel', 'tecno', 1, '2022-10-10 16:23:57', 1, 'samuelhuanca15@gmail.com', '928097168');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `idvendedor` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `dni` varchar(12) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`idvendedor`, `nombres`, `apellidos`, `dni`, `telefono`, `direccion`) VALUES
(1, 'Leonel', 'Messi', '12345678', '564154998', 'Argentina'),
(2, 'Paolo', 'Guerrero', '12045874', '369874521', 'Peru'),
(3, 'cristian', 'cueva', '25874658', '985471236', 'Peru lima'),
(4, 'Cristiano', 'Ronaldo', '98754123', '956874586', 'Portugal');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_boletas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_boletas` (
`idboletas` int(11)
,`fecha` datetime
,`total` decimal(19,7)
,`NumerosALetras` varchar(512)
,`idclientes` int(11)
,`idvendedor` int(11)
,`numero` varchar(45)
,`cantidad` int(11)
,`precio_unitario` decimal(19,7)
,`subtotal` decimal(19,7)
,`iddetalles_camisetas` int(11)
,`producto` varchar(200)
,`nomcliente` varchar(45)
,`apecliente` varchar(45)
,`dni` varchar(12)
,`direccion` varchar(100)
,`telefono` varchar(15)
,`nacionalidad` varchar(45)
,`email` varchar(100)
,`nomvendedor` varchar(45)
,`apevendedor` varchar(45)
,`precio` decimal(19,7)
,`stock` varchar(45)
,`idmodelo_talla` int(11)
,`idmodelo_calidad` int(11)
,`idmodelo_seleccion` int(11)
,`desccamiseta` varchar(455)
,`idseleccion` int(11)
,`descseleccion` varchar(160)
,`color` varchar(45)
,`modelseleccion` int(11)
,`seleccion` varchar(45)
,`idtalla` int(11)
,`modeltalla` int(11)
,`talla` varchar(45)
,`idcalidad` int(11)
,`modelcalidad` int(11)
,`calidad` varchar(45)
,`modelo` varchar(45)
,`idmarca` int(11)
,`marca` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_detalles_camisetas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_detalles_camisetas` (
`iddetalles_camisetas` int(11)
,`precio` decimal(19,7)
,`stock` varchar(45)
,`idcamisetas` int(11)
,`idmodelo_talla` int(11)
,`idmodelo_calidad` int(11)
,`idmodelo_seleccion` int(11)
,`camiseta` varchar(455)
,`idtalla` int(11)
,`idmodelos` int(11)
,`talla` varchar(45)
,`modelo` varchar(45)
,`descripcion` varchar(160)
,`color` int(11)
,`seleccion` varchar(45)
,`calidad` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_detalles_camisetas01`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_detalles_camisetas01` (
`iddetalles_camisetas` int(11)
,`precio` decimal(19,7)
,`stock` varchar(45)
,`idcamisetas` int(11)
,`idmodelo_talla` int(11)
,`idmodelo_calidad` int(11)
,`idmodelo_seleccion` int(11)
,`camiseta` varchar(455)
,`idtalla` int(11)
,`idmodelos` int(11)
,`talla` varchar(45)
,`modelo` varchar(45)
,`descripcion` varchar(160)
,`color` int(11)
,`seleccion` varchar(45)
,`calidad` varchar(45)
,`url` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_detalle_boleta`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_detalle_boleta` (
`iddetalle_boleta` int(11)
,`cantidad` int(11)
,`precio_unitario` decimal(19,7)
,`subtotal` decimal(19,7)
,`producto` varchar(200)
,`idboletas` int(11)
,`iddetalles_camisetas` int(11)
,`total` decimal(19,7)
,`stock` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_graf_modelos_x_marca`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_graf_modelos_x_marca` (
`marca` varchar(45)
,`cant` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_imagenes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_imagenes` (
`idimagen` int(11)
,`url` varchar(50)
,`iddetalles_camisetas` int(11)
,`nombre` varchar(250)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_modelos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_modelos` (
`idmodelos` int(11)
,`modelo` varchar(45)
,`idmarca` int(11)
,`marca` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_modelo_calidad`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_modelo_calidad` (
`idmodelo_calidad` int(11)
,`idcalidad` int(11)
,`idmodelos` int(11)
,`modelo` varchar(45)
,`calidad` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_modelo_seleccion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_modelo_seleccion` (
`idmodelo_seleccion` int(11)
,`idseleccion` int(11)
,`descripcion` varchar(160)
,`color` varchar(45)
,`modelo` varchar(45)
,`seleccion` varchar(45)
,`idmodelos` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_modelo_talla`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_modelo_talla` (
`idmodelo_talla` int(11)
,`idtalla` int(11)
,`idmodelos` int(11)
,`modelo` varchar(45)
,`talla` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_boletas`
--
DROP TABLE IF EXISTS `v_boletas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_boletas`  AS SELECT `b`.`idboletas` AS `idboletas`, `b`.`fecha` AS `fecha`, `b`.`total` AS `total`, `NumerosALetras`(`b`.`total`) AS `NumerosALetras`, `b`.`idclientes` AS `idclientes`, `b`.`idvendedor` AS `idvendedor`, `b`.`numero` AS `numero`, `db`.`cantidad` AS `cantidad`, `db`.`precio_unitario` AS `precio_unitario`, `db`.`subtotal` AS `subtotal`, `db`.`iddetalles_camisetas` AS `iddetalles_camisetas`, `db`.`producto` AS `producto`, `cl`.`nombres` AS `nomcliente`, `cl`.`apellidos` AS `apecliente`, `cl`.`dni` AS `dni`, `cl`.`direccion` AS `direccion`, `cl`.`telefono` AS `telefono`, `cl`.`nacionalidad` AS `nacionalidad`, `cl`.`email` AS `email`, `v`.`nombres` AS `nomvendedor`, `v`.`apellidos` AS `apevendedor`, `dc`.`precio` AS `precio`, `dc`.`stock` AS `stock`, `dc`.`idmodelo_talla` AS `idmodelo_talla`, `dc`.`idmodelo_calidad` AS `idmodelo_calidad`, `dc`.`idmodelo_seleccion` AS `idmodelo_seleccion`, `ca`.`descripcion` AS `desccamiseta`, `ms`.`idseleccion` AS `idseleccion`, `ms`.`descripcion` AS `descseleccion`, `ms`.`color` AS `color`, `ms`.`idmodelos` AS `modelseleccion`, `s`.`seleccion` AS `seleccion`, `mt`.`idtalla` AS `idtalla`, `mt`.`idmodelos` AS `modeltalla`, `t`.`talla` AS `talla`, `mc`.`idcalidad` AS `idcalidad`, `mc`.`idmodelos` AS `modelcalidad`, `c`.`calidad` AS `calidad`, `mo`.`modelo` AS `modelo`, `mo`.`idmarca` AS `idmarca`, `ma`.`marca` AS `marca` FROM (((((((((((((`boletas` `b` join `detalle_boleta` `db` on(`b`.`idboletas` = `db`.`idboletas`)) join `clientes` `cl` on(`b`.`idclientes` = `cl`.`idclientes`)) join `vendedor` `v` on(`b`.`idvendedor` = `v`.`idvendedor`)) join `detalles_camisetas` `dc` on(`db`.`iddetalles_camisetas` = `dc`.`iddetalles_camisetas`)) join `camisetas` `ca` on(`dc`.`idcamisetas` = `ca`.`idcamisetas`)) join `modelo_seleccion` `ms` on(`dc`.`idmodelo_seleccion` = `ms`.`idmodelo_seleccion`)) join `seleccion` `s` on(`ms`.`idseleccion` = `s`.`idseleccion`)) join `modelo_talla` `mt` on(`dc`.`idmodelo_talla` = `mt`.`idmodelo_talla`)) join `talla` `t` on(`mt`.`idtalla` = `t`.`idtalla`)) join `modelo_calidad` `mc` on(`dc`.`idmodelo_calidad` = `mc`.`idmodelo_calidad`)) join `calidad` `c` on(`mc`.`idcalidad` = `c`.`idcalidad`)) join `modelos` `mo` on(`ms`.`idmodelos` = `mo`.`idmodelos`)) join `marca` `ma` on(`mo`.`idmarca` = `ma`.`idmarca`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_detalles_camisetas`
--
DROP TABLE IF EXISTS `v_detalles_camisetas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detalles_camisetas`  AS SELECT `dc`.`iddetalles_camisetas` AS `iddetalles_camisetas`, `dc`.`precio` AS `precio`, `dc`.`stock` AS `stock`, `dc`.`idcamisetas` AS `idcamisetas`, `dc`.`idmodelo_talla` AS `idmodelo_talla`, `dc`.`idmodelo_calidad` AS `idmodelo_calidad`, `dc`.`idmodelo_seleccion` AS `idmodelo_seleccion`, `c`.`descripcion` AS `camiseta`, `mt`.`idtalla` AS `idtalla`, `mt`.`idmodelos` AS `idmodelos`, `t`.`talla` AS `talla`, `m`.`modelo` AS `modelo`, `ms`.`descripcion` AS `descripcion`, `ms`.`idmodelo_seleccion` AS `color`, `se`.`seleccion` AS `seleccion`, `ca`.`calidad` AS `calidad` FROM ((((((((`detalles_camisetas` `dc` join `camisetas` `c` on(`dc`.`idcamisetas` = `c`.`idcamisetas`)) join `modelo_talla` `mt` on(`dc`.`idmodelo_talla` = `mt`.`idmodelo_talla`)) join `talla` `t` on(`mt`.`idtalla` = `t`.`idtalla`)) join `modelos` `m` on(`mt`.`idmodelos` = `m`.`idmodelos`)) join `modelo_seleccion` `ms` on(`ms`.`idmodelo_seleccion` = `dc`.`idmodelo_seleccion`)) join `seleccion` `se` on(`se`.`idseleccion` = `ms`.`idseleccion`)) join `modelo_calidad` `mc` on(`mc`.`idmodelo_calidad` = `dc`.`idmodelo_calidad`)) join `calidad` `ca` on(`ca`.`idcalidad` = `mc`.`idcalidad`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_detalles_camisetas01`
--
DROP TABLE IF EXISTS `v_detalles_camisetas01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detalles_camisetas01`  AS SELECT `dc`.`iddetalles_camisetas` AS `iddetalles_camisetas`, `dc`.`precio` AS `precio`, `dc`.`stock` AS `stock`, `dc`.`idcamisetas` AS `idcamisetas`, `dc`.`idmodelo_talla` AS `idmodelo_talla`, `dc`.`idmodelo_calidad` AS `idmodelo_calidad`, `dc`.`idmodelo_seleccion` AS `idmodelo_seleccion`, `c`.`descripcion` AS `camiseta`, `mt`.`idtalla` AS `idtalla`, `mt`.`idmodelos` AS `idmodelos`, `t`.`talla` AS `talla`, `m`.`modelo` AS `modelo`, `ms`.`descripcion` AS `descripcion`, `ms`.`idmodelo_seleccion` AS `color`, `se`.`seleccion` AS `seleccion`, `ca`.`calidad` AS `calidad`, `im`.`url` AS `url` FROM (((((((((`detalles_camisetas` `dc` join `camisetas` `c` on(`dc`.`idcamisetas` = `c`.`idcamisetas`)) join `modelo_talla` `mt` on(`dc`.`idmodelo_talla` = `mt`.`idmodelo_talla`)) join `talla` `t` on(`mt`.`idtalla` = `t`.`idtalla`)) join `modelos` `m` on(`mt`.`idmodelos` = `m`.`idmodelos`)) join `modelo_seleccion` `ms` on(`ms`.`idmodelo_seleccion` = `dc`.`idmodelo_seleccion`)) join `seleccion` `se` on(`se`.`idseleccion` = `ms`.`idseleccion`)) join `modelo_calidad` `mc` on(`mc`.`idmodelo_calidad` = `dc`.`idmodelo_calidad`)) join `calidad` `ca` on(`ca`.`idcalidad` = `mc`.`idcalidad`)) left join `imagenes_producto` `im` on(`dc`.`iddetalles_camisetas` = `im`.`iddetalles_camisetas`)) GROUP BY `dc`.`iddetalles_camisetas`, `dc`.`precio`, `dc`.`stock`, `dc`.`idcamisetas`, `dc`.`idmodelo_talla`, `dc`.`idmodelo_calidad`, `dc`.`idmodelo_seleccion`, `c`.`descripcion`, `mt`.`idtalla`, `mt`.`idmodelos`, `t`.`talla`, `m`.`modelo`, `ms`.`descripcion`, `ms`.`color`, `se`.`seleccion`, `ca`.`calidad``calidad`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_detalle_boleta`
--
DROP TABLE IF EXISTS `v_detalle_boleta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detalle_boleta`  AS SELECT `detalle_boleta`.`iddetalle_boleta` AS `iddetalle_boleta`, `detalle_boleta`.`cantidad` AS `cantidad`, `detalle_boleta`.`precio_unitario` AS `precio_unitario`, `detalle_boleta`.`subtotal` AS `subtotal`, `detalle_boleta`.`producto` AS `producto`, `detalle_boleta`.`idboletas` AS `idboletas`, `detalle_boleta`.`iddetalles_camisetas` AS `iddetalles_camisetas`, `boletas`.`total` AS `total`, `detalles_camisetas`.`stock` AS `stock` FROM ((`detalle_boleta` join `boletas` on(`detalle_boleta`.`idboletas` = `boletas`.`idboletas`)) join `detalles_camisetas` on(`detalle_boleta`.`iddetalles_camisetas` = `detalles_camisetas`.`iddetalles_camisetas`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_graf_modelos_x_marca`
--
DROP TABLE IF EXISTS `v_graf_modelos_x_marca`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_graf_modelos_x_marca`  AS SELECT `ma`.`marca` AS `marca`, count(`mo`.`idmodelos`) AS `cant` FROM (`marca` `ma` join `modelos` `mo` on(`ma`.`idmarca` = `mo`.`idmarca`)) GROUP BY `ma`.`marca``marca`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_imagenes`
--
DROP TABLE IF EXISTS `v_imagenes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_imagenes`  AS SELECT `im`.`idimagen` AS `idimagen`, `im`.`url` AS `url`, `im`.`iddetalles_camisetas` AS `iddetalles_camisetas`, `im`.`nombre` AS `nombre` FROM (`imagenes_producto` `im` join `detalles_camisetas` `dc` on(`im`.`iddetalles_camisetas` = `dc`.`iddetalles_camisetas`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_modelos`
--
DROP TABLE IF EXISTS `v_modelos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_modelos`  AS SELECT `modelos`.`idmodelos` AS `idmodelos`, `modelos`.`modelo` AS `modelo`, `modelos`.`idmarca` AS `idmarca`, `marca`.`marca` AS `marca` FROM (`modelos` join `marca` on(`modelos`.`idmarca` = `marca`.`idmarca`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_modelo_calidad`
--
DROP TABLE IF EXISTS `v_modelo_calidad`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_modelo_calidad`  AS SELECT `modelo_calidad`.`idmodelo_calidad` AS `idmodelo_calidad`, `modelo_calidad`.`idcalidad` AS `idcalidad`, `modelo_calidad`.`idmodelos` AS `idmodelos`, `modelos`.`modelo` AS `modelo`, `calidad`.`calidad` AS `calidad` FROM ((`modelo_calidad` join `calidad` on(`modelo_calidad`.`idcalidad` = `calidad`.`idcalidad`)) join `modelos` on(`modelo_calidad`.`idmodelos` = `modelos`.`idmodelos`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_modelo_seleccion`
--
DROP TABLE IF EXISTS `v_modelo_seleccion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_modelo_seleccion`  AS SELECT `modelo_seleccion`.`idmodelo_seleccion` AS `idmodelo_seleccion`, `modelo_seleccion`.`idseleccion` AS `idseleccion`, `modelo_seleccion`.`descripcion` AS `descripcion`, `modelo_seleccion`.`color` AS `color`, `modelos`.`modelo` AS `modelo`, `seleccion`.`seleccion` AS `seleccion`, `modelo_seleccion`.`idmodelos` AS `idmodelos` FROM ((`modelo_seleccion` join `seleccion` on(`modelo_seleccion`.`idseleccion` = `seleccion`.`idseleccion`)) join `modelos` on(`modelo_seleccion`.`idmodelos` = `modelos`.`idmodelos`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_modelo_talla`
--
DROP TABLE IF EXISTS `v_modelo_talla`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_modelo_talla`  AS SELECT `modelo_talla`.`idmodelo_talla` AS `idmodelo_talla`, `modelo_talla`.`idtalla` AS `idtalla`, `modelo_talla`.`idmodelos` AS `idmodelos`, `modelos`.`modelo` AS `modelo`, `talla`.`talla` AS `talla` FROM ((`modelo_talla` join `talla` on(`modelo_talla`.`idtalla` = `talla`.`idtalla`)) join `modelos` on(`modelo_talla`.`idmodelos` = `modelos`.`idmodelos`))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`idauditoria`);

--
-- Indices de la tabla `boletas`
--
ALTER TABLE `boletas`
  ADD PRIMARY KEY (`idboletas`),
  ADD KEY `fk_boleta_clientes_idx` (`idclientes`),
  ADD KEY `fk_boletas_vendedor1_idx` (`idvendedor`);

--
-- Indices de la tabla `calidad`
--
ALTER TABLE `calidad`
  ADD PRIMARY KEY (`idcalidad`);

--
-- Indices de la tabla `camisetas`
--
ALTER TABLE `camisetas`
  ADD PRIMARY KEY (`idcamisetas`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idclientes`),
  ADD KEY `fk_clientes_perfiles` (`idperfil`);

--
-- Indices de la tabla `detalles_camisetas`
--
ALTER TABLE `detalles_camisetas`
  ADD PRIMARY KEY (`iddetalles_camisetas`),
  ADD KEY `fk_detalles_camisetas_camisetas1_idx` (`idcamisetas`),
  ADD KEY `fk_detalles_camisetas_modelo_talla1_idx` (`idmodelo_talla`),
  ADD KEY `fk_detalles_camisetas_modelo_calidad1_idx` (`idmodelo_calidad`),
  ADD KEY `fk_detalles_camisetas_modelo_seleccion1_idx` (`idmodelo_seleccion`);

--
-- Indices de la tabla `detalle_boleta`
--
ALTER TABLE `detalle_boleta`
  ADD PRIMARY KEY (`iddetalle_boleta`),
  ADD KEY `fk_detalle_boleta_boletas1_idx` (`idboletas`),
  ADD KEY `fk_detalle_boleta_detalles_camisetas1_idx` (`iddetalles_camisetas`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarca`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`idmodelos`),
  ADD KEY `fk_modelos_marca1_idx` (`idmarca`);

--
-- Indices de la tabla `modelo_calidad`
--
ALTER TABLE `modelo_calidad`
  ADD PRIMARY KEY (`idmodelo_calidad`),
  ADD KEY `fk_modelo_calidad_calidad1_idx` (`idcalidad`),
  ADD KEY `fk_modelo_calidad_modelos1_idx` (`idmodelos`);

--
-- Indices de la tabla `modelo_seleccion`
--
ALTER TABLE `modelo_seleccion`
  ADD PRIMARY KEY (`idmodelo_seleccion`),
  ADD KEY `fk_modelo_seleccion_seleccion1_idx` (`idseleccion`),
  ADD KEY `fk_modelo_seleccion_modelos1_idx` (`idmodelos`);

--
-- Indices de la tabla `modelo_talla`
--
ALTER TABLE `modelo_talla`
  ADD PRIMARY KEY (`idmodelo_talla`),
  ADD KEY `fk_modelo_talla_talla1_idx` (`idtalla`),
  ADD KEY `fk_modelo_talla_modelos1_idx` (`idmodelos`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`idperfil`);

--
-- Indices de la tabla `seleccion`
--
ALTER TABLE `seleccion`
  ADD PRIMARY KEY (`idseleccion`);

--
-- Indices de la tabla `talla`
--
ALTER TABLE `talla`
  ADD PRIMARY KEY (`idtalla`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`idvendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `idauditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `boletas`
--
ALTER TABLE `boletas`
  MODIFY `idboletas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `calidad`
--
ALTER TABLE `calidad`
  MODIFY `idcalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `camisetas`
--
ALTER TABLE `camisetas`
  MODIFY `idcamisetas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idclientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `detalle_boleta`
--
ALTER TABLE `detalle_boleta`
  MODIFY `iddetalle_boleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `idmodelos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `modelo_calidad`
--
ALTER TABLE `modelo_calidad`
  MODIFY `idmodelo_calidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `modelo_seleccion`
--
ALTER TABLE `modelo_seleccion`
  MODIFY `idmodelo_seleccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `seleccion`
--
ALTER TABLE `seleccion`
  MODIFY `idseleccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `talla`
--
ALTER TABLE `talla`
  MODIFY `idtalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `idvendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boletas`
--
ALTER TABLE `boletas`
  ADD CONSTRAINT `fk_boleta_clientes` FOREIGN KEY (`idclientes`) REFERENCES `clientes` (`idclientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_boletas_vendedor1` FOREIGN KEY (`idvendedor`) REFERENCES `vendedor` (`idvendedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_perfiles` FOREIGN KEY (`idperfil`) REFERENCES `perfiles` (`idperfil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_camisetas`
--
ALTER TABLE `detalles_camisetas`
  ADD CONSTRAINT `fk_detalles_camisetas_camisetas1` FOREIGN KEY (`idcamisetas`) REFERENCES `camisetas` (`idcamisetas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalles_camisetas_modelo_calidad1` FOREIGN KEY (`idmodelo_calidad`) REFERENCES `modelo_calidad` (`idmodelo_calidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalles_camisetas_modelo_seleccion1` FOREIGN KEY (`idmodelo_seleccion`) REFERENCES `modelo_seleccion` (`idmodelo_seleccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalles_camisetas_modelo_talla1` FOREIGN KEY (`idmodelo_talla`) REFERENCES `modelo_talla` (`idmodelo_talla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_boleta`
--
ALTER TABLE `detalle_boleta`
  ADD CONSTRAINT `fk_detalle_boleta_boletas1` FOREIGN KEY (`idboletas`) REFERENCES `boletas` (`idboletas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_boleta_detalles_camisetas1` FOREIGN KEY (`iddetalles_camisetas`) REFERENCES `detalles_camisetas` (`iddetalles_camisetas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `fk_modelos_marca1` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modelo_calidad`
--
ALTER TABLE `modelo_calidad`
  ADD CONSTRAINT `fk_modelo_calidad_calidad1` FOREIGN KEY (`idcalidad`) REFERENCES `calidad` (`idcalidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_modelo_calidad_modelos1` FOREIGN KEY (`idmodelos`) REFERENCES `modelos` (`idmodelos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modelo_seleccion`
--
ALTER TABLE `modelo_seleccion`
  ADD CONSTRAINT `fk_modelo_seleccion_modelos1` FOREIGN KEY (`idmodelos`) REFERENCES `modelos` (`idmodelos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_modelo_seleccion_seleccion1` FOREIGN KEY (`idseleccion`) REFERENCES `seleccion` (`idseleccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modelo_talla`
--
ALTER TABLE `modelo_talla`
  ADD CONSTRAINT `fk_modelo_talla_modelos1` FOREIGN KEY (`idmodelos`) REFERENCES `modelos` (`idmodelos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_modelo_talla_talla1` FOREIGN KEY (`idtalla`) REFERENCES `talla` (`idtalla`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
