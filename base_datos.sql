-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-10-2013 a las 11:19:22
-- Versión del servidor: 5.5.30-30.2
-- Versión de PHP: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bnmasiv1_atlanto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_cargo`
--

CREATE TABLE IF NOT EXISTS `atl_cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `atl_cargo`
--

INSERT INTO `atl_cargo` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Analista de información', ''),
(2, 'Asistente contable', ''),
(3, 'Asistente contable de compras', ''),
(4, 'Asistente de almacen', ''),
(5, 'Asistente de gerencia', ''),
(7, 'Asistente de operaciones', ''),
(8, 'Asistente de recurso humano', ''),
(9, 'Auxiliar de almacen', ''),
(10, 'Auxiliar de RRHH', ''),
(11, 'Auxiliar de seguridad', ''),
(12, 'Auxiliar programación mantenimiento', ''),
(13, 'Coordinador', ''),
(14, 'Director de gestión integral', ''),
(15, 'Director de mantenimiento', ''),
(16, 'Director de operaciones', ''),
(17, 'Director de recurso humano', ''),
(18, 'Director financiero', ''),
(19, 'Gerente general', ''),
(20, 'Jefe de accidentes', ''),
(21, 'Jefe de almacen', ''),
(22, 'Jefe de contabilidad', ''),
(23, 'Jefe de operaciones', ''),
(24, 'Jefe de prevención', ''),
(25, 'Jefe de taller', ''),
(26, 'Jefe de taller auxiliar', ''),
(27, 'Portero', ''),
(28, 'Profesional de desarrollo', ''),
(29, 'Profesional de informática', ''),
(30, 'Profesional de planeación', ''),
(31, 'Profesional de selección', ''),
(32, 'Profesional junior de planeación', ''),
(33, 'Profesional programacion mantenimiento', ''),
(34, 'Psicologa', ''),
(35, 'Supervisor de operaciones', ''),
(36, 'Supervisor de mantenimiento', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_componente_discoduro`
--

CREATE TABLE IF NOT EXISTS `atl_componente_discoduro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `rpm` int(11) NOT NULL,
  `cache` varchar(100) NOT NULL,
  `id_interfaz` int(11) NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_componente_interfaz`
--

CREATE TABLE IF NOT EXISTS `atl_componente_interfaz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `atl_componente_interfaz`
--

INSERT INTO `atl_componente_interfaz` (`id`, `nombre`, `descripcion`) VALUES
(1, 'SATA', ''),
(2, 'IDE', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_componente_memoria`
--

CREATE TABLE IF NOT EXISTS `atl_componente_memoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `tamano` int(11) NOT NULL,
  `frecuencia` int(11) DEFAULT NULL,
  `id_memoria_tipo` int(11) NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_componente_memoria_tipo`
--

CREATE TABLE IF NOT EXISTS `atl_componente_memoria_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `atl_componente_memoria_tipo`
--

INSERT INTO `atl_componente_memoria_tipo` (`id`, `nombre`, `descripcion`) VALUES
(1, 'DDR', ''),
(2, 'DDR2', ''),
(3, 'DDR3', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_componente_procesador`
--

CREATE TABLE IF NOT EXISTS `atl_componente_procesador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `frecuencia` int(11) NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_componente_tarjeta_interfaz`
--

CREATE TABLE IF NOT EXISTS `atl_componente_tarjeta_interfaz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `atl_componente_tarjeta_interfaz`
--

INSERT INTO `atl_componente_tarjeta_interfaz` (`id`, `nombre`, `descripcion`) VALUES
(1, 'PCI', ''),
(2, 'PCI Express', ''),
(3, 'SATA', ''),
(4, 'SCSI', ''),
(5, 'USB', ''),
(6, 'AGP', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_componente_tvideo`
--

CREATE TABLE IF NOT EXISTS `atl_componente_tvideo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `memoria` int(11) NOT NULL,
  `id_interfaz` int(11) NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador`
--

CREATE TABLE IF NOT EXISTS `atl_computador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `id_ubicacion` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `fabricante` varchar(150) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `n_serie` varchar(100) NOT NULL,
  `n_activo` varchar(50) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_dominio` int(11) DEFAULT NULL,
  `id_red` int(11) NOT NULL,
  `id_SO` int(11) NOT NULL,
  `es_plantilla` int(11) NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estado` (`id_estado`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador_componente`
--

CREATE TABLE IF NOT EXISTS `atl_computador_componente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `componente` varchar(30) NOT NULL,
  `id_computador` int(11) NOT NULL,
  `id_componente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador_discoduro`
--

CREATE TABLE IF NOT EXISTS `atl_computador_discoduro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_computador` int(11) NOT NULL,
  `id_componente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_computador` (`id_computador`),
  KEY `id_componente` (`id_componente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador_dispositivo`
--

CREATE TABLE IF NOT EXISTS `atl_computador_dispositivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_computador` int(11) NOT NULL,
  `id_dispositivo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_computador` (`id_computador`,`id_dispositivo`),
  KEY `id_dispositivo` (`id_dispositivo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador_impresora`
--

CREATE TABLE IF NOT EXISTS `atl_computador_impresora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_computador` int(11) NOT NULL,
  `id_impresora` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_computador` (`id_computador`),
  KEY `id_impresora` (`id_impresora`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador_memoria`
--

CREATE TABLE IF NOT EXISTS `atl_computador_memoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_computador` int(11) NOT NULL,
  `id_componente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_computador` (`id_computador`),
  KEY `id_componente` (`id_componente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador_monitor`
--

CREATE TABLE IF NOT EXISTS `atl_computador_monitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_computador` int(11) NOT NULL,
  `id_monitor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_computador` (`id_computador`),
  KEY `id_monitor` (`id_monitor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador_procesador`
--

CREATE TABLE IF NOT EXISTS `atl_computador_procesador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_computador` int(11) NOT NULL,
  `id_componente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_computador` (`id_computador`),
  KEY `id_componente` (`id_componente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador_software`
--

CREATE TABLE IF NOT EXISTS `atl_computador_software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_computador` int(11) NOT NULL,
  `id_software` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_computador` (`id_computador`),
  KEY `id_software` (`id_software`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador_tipo`
--

CREATE TABLE IF NOT EXISTS `atl_computador_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `atl_computador_tipo`
--

INSERT INTO `atl_computador_tipo` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Escritorio', 'Computador de escritorio'),
(2, 'Portatil', 'Computador portatil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_computador_tvideo`
--

CREATE TABLE IF NOT EXISTS `atl_computador_tvideo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_computador` int(11) NOT NULL,
  `id_componente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_computador` (`id_computador`),
  KEY `id_componente` (`id_componente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_config`
--

CREATE TABLE IF NOT EXISTS `atl_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto_inicio` text NOT NULL,
  `texto_pie_pagina` text NOT NULL,
  `correo_sistema` varchar(150) NOT NULL,
  `correo_remitente` varchar(150) NOT NULL,
  `nombre_sistema` varchar(100) NOT NULL,
  `firma_sistema` text NOT NULL,
  `repo_leyenda` text NOT NULL,
  `repo_horientacion` varchar(20) NOT NULL,
  `repo_formato` varchar(20) NOT NULL,
  `repo_creador` varchar(150) NOT NULL,
  `repo_autor` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `atl_config`
--

INSERT INTO `atl_config` (`id`, `texto_inicio`, `texto_pie_pagina`, `correo_sistema`, `correo_remitente`, `nombre_sistema`, `firma_sistema`, `repo_leyenda`, `repo_horientacion`, `repo_formato`, `repo_creador`, `repo_autor`) VALUES
(1, '<h3>Bienvenido</h3>\r\n   <p>Con el fin de llevar un control completo de la infraestructura informática de la compañía \r\n    implementamos el Sistema de Control de Informática, donde el personal de la empresa puede \r\n    solicitar soporte en caso de alguna incidencia o eventualidad. Además podrá consultar el \r\n    registro historio de su equipo de computo o elementos de comunicación asignados.</p>', '<p>Sistema de control de infórmatica, Blanco y Negro Masivo S.A. <b>2013</b></p>', 'informatica@blancoynegromasivo.com.co', '', 'SIC', 'Mensaje generado automaticamente, favor no responder.\r\n\r\nSistema de control de informatica\r\ninformatica@blancoynegromasivo.com.co\r\nBlanco y Negro Masivo S.A.', 'Sistema de control de informatica', 'PORTRAIT', 'A4', 'Departamento de Informática', 'Departamento de Informática');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_correo`
--

CREATE TABLE IF NOT EXISTS `atl_correo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `cargo` varchar(150) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `creado` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=849 ;

--
-- Volcado de datos para la tabla `atl_correo`
--

INSERT INTO `atl_correo` (`id`, `cedula`, `nombre`, `cargo`, `correo`, `creado`, `eliminado`) VALUES
(1, '16697736', 'ACOSTA ARIAS HELMER', 'OPERADOR ALIMENTADOR', 'helmer.acosta@blancoynegromasivo.com.co', 1, 0),
(2, '18005076', 'ACOSTA ASTUDILLO CELICO', 'OPERADOR ALIMENTADOR', 'celico.acosta@blancoynegromasivo.com.co', 1, 0),
(3, '16839981', 'ACOSTA MONTANO EDWARD ENRIQUE', 'FLOTA AUXILIAR', 'edward.acosta@blancoynegromasivo.com.co', 1, 0),
(4, '94309957', 'ACOSTA MUNOZ LUIS SANDRO', 'OPERADOR ALIMENTADOR', 'luis.acosta@blancoynegromasivo.com.co', 1, 0),
(5, '16763370', 'AGREDO CORTES JUAN CARLOS', 'OPERADOR PADRON', 'juan.agredo@blancoynegromasivo.com.co', 1, 0),
(6, '1130594773', 'AGREDO FALLA DIEGO FERNANDO', 'MECANICO C', 'diego.agredo@blancoynegromasivo.com.co', 1, 0),
(7, '94529405', 'AGRON VIAFARA FRANCISCO JAVIER', 'OPERADOR PADRON', 'francisco.agron@blancoynegromasivo.com.co', 1, 0),
(8, '16934494', 'AGUADO DOMINGUEZ CARLOS ANDRES', 'OPERADOR ARTICULADO', 'carlos.aguado@blancoynegromasivo.com.co', 1, 0),
(9, '94377039', 'AGUADO VALENCIA DIEGO FERNANDO', 'OPERADOR PADRON', 'diego.aguado@blancoynegromasivo.com.co', 1, 0),
(10, '16788588', 'AGUIRRE BOLANOS LEONARDO', 'OPERADOR ALIMENTADOR', 'leonardo.aguirre@blancoynegromasivo.com.co', 1, 0),
(11, '94388103', 'AGUIRRE CASTANO HECTOR FABIO', 'OPERADOR PADRON', 'hector.aguirre@blancoynegromasivo.com.co', 1, 0),
(12, '14837315', 'AGUIRRE DELGADO ARLEX', 'OPERADOR ALIMENTADOR', 'arlex.aguirre@blancoynegromasivo.com.co', 1, 0),
(13, '94403219', 'AGUIRRE IMBAJOA SIGILFREDO', 'TECNICO C', 'sigilfredo.aguirre@blancoynegromasivo.com.c', 1, 0),
(14, '94428135', 'AGUIRRE RIOS HERNAN ADOLFO', 'OPERADOR PADRON', 'hernan.aguirre@blancoynegromasivo.com.co', 1, 0),
(15, '14608158', 'AHUMADA CRIOLLO EDWARDO FERNANDO', 'OPERADOR ALIMENTADOR', 'edwardo.ahumada@blancoynegromasivo.com.co', 1, 0),
(16, '6334087', 'AHUMADA MANCHABAJOY JHON ALEXANDER', 'OPERADOR PADRON', 'jhon.ahumada@blancoynegromasivo.com.co', 1, 0),
(17, '94531150', 'ALARCON MAURICIO', 'MECANICO FRENERO', 'mauricio.alarcon@blancoynegromasivo.com.co', 1, 0),
(18, '16726902', 'ALEGRIA TOBAR MIYAN DOSMAN', 'OPERADOR ALIMENTADOR', 'miyan.alegria@blancoynegromasivo.com.co', 1, 0),
(19, '16847737', 'ALMENDRAS MARTINEZ HECTOR FABIO', 'OPERADOR PADRON', 'hector.almendras@blancoynegromasivo.com.co', 1, 0),
(20, '1058673183', 'ALVAREZ NOGUERA VICTOR ANDRES', 'LAVADOR', 'victor.alvarez@blancoynegromasivo.com.co', 1, 0),
(21, '1144148807', 'ALVAREZ PERDOMO CHRISTIAN', 'MECANICO B', 'christian.alvarez@blancoynegromasivo.com.co', 1, 0),
(22, '1130674591', 'ALVAREZ USMA DIEGO FELIPE', 'MECANICO C', 'diego.alvarez@blancoynegromasivo.com.co', 1, 0),
(23, '94422540', 'ALVAREZ VALENCIA DIEGO ORLANDO', 'OPERADOR PADRON', 'diego.alvarez@blancoynegromasivo.com.co', 1, 0),
(24, '16740569', 'ALVAREZ VELASQUEZ OSCAR MARIO', 'OPERADOR ALIMENTADOR', 'oscar.alvarez@blancoynegromasivo.com.co', 1, 0),
(25, '94529938', 'ALZATE RODRIGUEZ CARLOS AUGUSTO', 'OPERADOR PADRON', 'carlos.alzate@blancoynegromasivo.com.co', 1, 0),
(26, '1107036337', 'ALZATE TORRES ANTHONY JOSE', 'OPERADOR ALIMENTADOR', 'anthony.alzate@blancoynegromasivo.com.co', 1, 0),
(27, '10690633', 'AMAYA HERIBERTO', 'OPERADOR PADRON', 'heriberto.amaya@blancoynegromasivo.com.co', 1, 0),
(28, '16632283', 'AMAYA LENIS ALFREDO EUGENIO', 'OPERADOR PADRON', 'alfredo.amaya@blancoynegromasivo.com.co', 1, 0),
(29, '76323513', 'ANACONA CARLOS ANDRES', 'OPERADOR ALIMENTADOR', 'andres.anacona@blancoynegromasivo.com.co', 1, 0),
(30, '93478261', 'ANGEL BUSTOS EVER', 'OPERADOR ALIMENTADOR', 'ever.angel@blancoynegromasivo.com.co', 1, 0),
(31, '76260317', 'ANGOLA VERGARA JORGE ORLANDO', 'OPERADOR ALIMENTADOR', 'jorge.angola@blancoynegromasivo.com.co', 1, 0),
(32, '76283962', 'ANGULO GIRON LUIS EDUARDO', 'OPERADOR ARTICULADO', 'luis.angulo@blancoynegromasivo.com.co', 1, 0),
(33, '1144153408', 'APRAEZ URREA JUAN CARLOS', 'OPERADOR ALIMENTADOR', 'juan.apraez@blancoynegromasivo.com.co', 1, 0),
(34, '1005890436', 'APRAEZ URREA JULIO CESAR', 'OPERADOR PADRON', 'julio.apraez@blancoynegromasivo.com.co', 1, 0),
(35, '4661871', 'ARAGON MINA EZEQUIEL', 'OPERADOR ARTICULADO', 'ezequiel.aragon@blancoynegromasivo.com.co', 1, 0),
(36, '16930128', 'ARANDA CAJIAO FABIAN ANDRES', 'OPERADOR ARTICULADO', 'fabian.aranda@blancoynegromasivo.com.co', 1, 0),
(37, '94042467', 'ARANGO LOPEZ JONATHAN MANUEL', 'OPERADOR PADRON', 'jonathan.arango@blancoynegromasivo.com.co', 1, 0),
(38, '94467359', 'ARANGO MUNOZ CARLOS HERNAN', 'OPERADOR ALIMENTADOR', 'carlos.arango@blancoynegromasivo.com.co', 1, 0),
(39, '94468274', 'ARARAT GARCIA JOSE EDUAR', 'OPERADOR ARTICULADO', 'jose.ararat@blancoynegromasivo.com.co', 1, 0),
(40, '16763265', 'ARAYON PARDO MARIO ANDRES', 'OPERADOR ARTICULADO', 'mario.arayon@blancoynegromasivo.com.co', 1, 0),
(41, '94042680', 'ARBOLEDA PORTOCARRERO HECTOR EMILIO', 'OPERADOR ALIMENTADOR', 'hector.arboleda@blancoynegromasivo.com.co', 1, 0),
(42, '1118294492', 'ARENAS APARICIO RAMON ALEXIS', 'OPERADOR ALIMENTADOR', 'ramon.arenas@blancoynegromasivo.com.co', 1, 0),
(43, '16780358', 'ARIAS CASTANEDA LUIS ALBERTO', 'MECANICO B', 'luis.arias@blancoynegromasivo.com.co', 1, 0),
(44, '94372869', 'ARIAS HURTADO MAURICIO', 'OPERADOR ALIMENTADOR', 'mauricio.arias@blancoynegromasivo.com.co', 1, 0),
(45, '16724005', 'ARIAS VELEZ OSCAR ALBEIRO', 'OPERADOR PADRON', 'oscar.arias@blancoynegromasivo.com.co', 1, 0),
(46, '94487778', 'ARISTIZABAL CRUZ CARLOS HUMBERTO', 'OPERADOR ARTICULADO', 'carlos.aristizabal@blancoynegromasivo.com.c', 1, 0),
(47, '1130662415', 'ARRAHONDO PORFIDIO', 'LAVADOR', 'porfidio.arrahondo@blancoynegromasivo.com.c', 1, 0),
(48, '6255709', 'ARRECHEA DIAZ CESAR', 'OPERADOR ARTICULADO', 'cesar.arrechea@blancoynegromasivo.com.co', 1, 0),
(49, '1130602083', 'ARRIERO CHAUX MARLON EMYR', 'OPERADOR PADRON', 'marlon.arriero@blancoynegromasivo.com.co', 1, 0),
(50, '94474127', 'ARRIETA BARROS SILVIO RODRIGO', 'OPERADOR ALIMENTADOR', 'silvio.arrieta@blancoynegromasivo.com.co', 1, 0),
(51, '94431936', 'ARTEAGA CAMACHO RICARDO', 'OPERADOR PADRON', 'ricardo.arteaga@blancoynegromasivo.com.co', 1, 0),
(52, '98369381', 'ARTURO ERASO SAULO RONALD', 'OPERADOR ALIMENTADOR', 'saulo.arturo@blancoynegromasivo.com.co', 1, 0),
(53, '16689239', 'ASCUE JUMBE JOSE EMILIANO', 'OPERADOR ALIMENTADOR', 'jose.ascue@blancoynegromasivo.com.co', 1, 0),
(54, '12747732', 'ASCUNTAR LOPEZ EDER EMILIO', 'OPERADOR ALIMENTADOR', 'eder.ascuntar@blancoynegromasivo.com.co', 1, 0),
(55, '1130587696', 'ASTUDILLO JARAMILLO LUIS FERNANDO', 'OPERADOR PADRON', 'luis.astudillo@blancoynegromasivo.com.co', 1, 0),
(56, '76318214', 'AVIRAMA ASTAIZA IDELVER', 'OPERADOR ALIMENTADOR', 'idelver.avirama@blancoynegromasivo.com.co', 1, 0),
(57, '16287998', 'AYALA HURTADO ALVARO ALIRIO', 'AUXILIAR DE LLANTAS Y COMBUSTIBLE', 'alvaro.ayala@blancoynegromasivo.com.co', 1, 0),
(58, '94550889', 'BALCAZAR VALENCIA CARLOS JULIO', 'COORDINADOR DE LAVADO', 'carlos.balcazar@blancoynegromasivo.com.co', 1, 0),
(59, '16074381', 'BARCO VALLEJO JOSE WILMAR', 'OPERADOR ALIMENTADOR', 'jose.barco@blancoynegromasivo.com.co', 1, 0),
(60, '16893265', 'BARONA BURBANO LIBARDO ANTONIO', 'OPERADOR PADRON', 'libardo.barona@blancoynegromasivo.com.co', 1, 0),
(61, '14622044', 'BARONA GIRALDO RODRIGO', 'OPERADOR ALIMENTADOR', 'rodrigo.barona@blancoynegromasivo.com.co', 1, 0),
(62, '6422456', 'BARRERA FRANCO JUAN GUILLERMO', 'OPERADOR PADRON', 'juan.barrera@blancoynegromasivo.com.co', 1, 0),
(63, '16620568', 'BARRERA VALENCIA LUIS ARVEY', 'OPERADOR ALIMENTADOR', 'luis.barrera@blancoynegromasivo.com.co', 1, 0),
(64, '14443114', 'BARRETO GUZMAN CESAR AUGUSTO', 'OPERADOR PADRON', 'cesar.barreto@blancoynegromasivo.com.co', 1, 0),
(65, '7541712', 'BARRETO MEDINA FERNANDO', 'OPERADOR PADRON', 'fernando.barreto@blancoynegromasivo.com.co', 1, 0),
(66, '94493171', 'BASTIDAS ARTUNDUAGA ANDRES', 'OPERADOR PADRON', 'andres.bastidas@blancoynegromasivo.com.co', 1, 0),
(67, '16738710', 'BASTIDAS JARAMILLO MIGUEL ANGEL', 'OPERADOR ALIMENTADOR', 'miguel.bastidas@blancoynegromasivo.com.co', 1, 0),
(68, '1143935884', 'BAUTISTA CHAVEZ MIGUEL ANGEL', 'OPERADOR PADRON', 'miguel.bautista@blancoynegromasivo.com.co', 1, 0),
(69, '94498392', 'BECERRA LUNA OSCAR MARIO', 'OPERADOR ALIMENTADOR', 'oscar.becerra@blancoynegromasivo.com.co', 1, 0),
(70, '16677484', 'BEDOYA BRAVO LUIS GERARDO', 'OPERADOR PADRON', 'luis.bedoya@blancoynegromasivo.com.co', 1, 0),
(71, '94519581', 'BEDOYA MORENO JEFFERSON', 'OPERADOR PADRON', 'jefferson.bedoya@blancoynegromasivo.com.co', 1, 0),
(72, '1130604992', 'BELALCAZAR LONDONO MICHEL MAURICIO', 'ASISTENTE DE ALMACEN', 'michael.belalcazar@blancoynegromasivo.com.c', 1, 0),
(73, '16711181', 'BELLINI AYALA EDUARDO', 'GERENTE GENERAL', 'ebellini@blancoynegro.com.co', 1, 0),
(74, '1143840651', 'BELTRAN FLOREZ YESID', 'OPERADOR PADRON', 'yesid.beltran@blancoynegromasivo.com.co', 1, 0),
(75, '1143937196', 'BELTRAN JUAN DAVID', 'LAVADOR', 'juan.beltran@blancoynegromasivo.com.co', 1, 0),
(76, '76318722', 'BELTRAN VALENCIA JULIAN IGNACIO', 'DIRECTOR DE OPERACIONES', 'julian.beltran@blancoynegromasivo.com.co', 1, 0),
(77, '1070610022', 'BENAVIDES HURTADO JUAN DAVID', 'LAVADOR', 'juan.benavidez@blancoynegromasivo.com.co', 1, 0),
(78, '76027976', 'BENAVIDES PALECHOR HARBEY', 'LAVADOR', 'harbey.benavides@blancoynegromasivo.com.co', 1, 0),
(79, '94413152', 'BENAVIDEZ LLANTEN LUIS HERNANDO', 'OPERADOR PADRON', 'luis.benavidez@blancoynegromasivo.com.co', 1, 0),
(80, '79106600', 'BENITEZ ESCARRAGA HECTOR HORACIO', 'OPERADOR ALIMENTADOR', 'hector.benitez@blancoynegromasivo.com.co', 1, 0),
(81, '94451370', 'BENITEZ MORALEZ CARLOS ARTURO', 'OPERADOR ALIMENTADOR', 'carlos.benitez@blancoynegromasivo.com.co', 1, 0),
(82, '98429489', 'BENITEZ SOLIS ALVARO ANCISAR', 'OPERADOR PADRON', 'alvaro.benitez@blancoynegromasivo.com.co', 1, 0),
(83, '94070480', 'BENITEZ VELEZ EMERSON', 'OPERADOR PADRON', 'emerson.benitez@blancoynegromasivo.com.co', 1, 0),
(84, '16724630', 'BERMEO MOLINA JOSE RICARDO', 'OPERADOR PADRON', 'jose.bermeo@blancoynegromasivo.com.co', 1, 0),
(85, '1062288477', 'BERMUDEZ GENOY ANDRES FERNANDO', 'OPERADOR PADRON', 'andres.bermudez@blancoynegromasivo.com.co', 1, 0),
(86, '14835531', 'BERMUDEZ HERRERA JORGE MARIO', 'OPERADOR PADRON', 'jorge.bermudez@blancoynegromasivo.com.co', 1, 0),
(87, '16702007', 'BERNAL VALENCIA MIGUEL ANTONIO', 'OPERADOR ALIMENTADOR', 'miguel.bernal@blancoynegromasivo.com.co', 1, 0),
(88, '94040484', 'BETANCOURT GUTIERREZ JOSE HOLMES', 'COORDINADOR DE OPERACIONES', 'jose.betancourt@blancoynegromasivo.com.co', 1, 0),
(89, '16700405', 'BETANCOURT SANCHEZ JOSE ALBEIRO', 'OPERADOR ALIMENTADOR', 'albeiro.betancourt@blancoynegromasivo.com.c', 1, 0),
(90, '10237605', 'BETANCUR DUQUE SALOMON', 'OPERADOR PADRON', 'salomon.betancurt@blancoynegromasivo.com.co', 1, 0),
(91, '16228779', 'BETANCUR HERRERA GUSTAVO ADOLFO', 'OPERADOR PADRON', 'gustavo.betancur@blancoynegromasivo.com.co', 1, 0),
(92, '14466947', 'BETANCUR MUNOZ ALEXANDER', 'PORTEROS', 'alexander.betancur@blancoynegromasivo.com.c', 1, 0),
(93, '16799138', 'BLANCO GIL MIGUEL ANGEL', 'OPERADOR PADRON', 'miguel.blanco@blancoynegromasivo.com.co', 1, 0),
(94, '14623212', 'BOHORQUEZ LOPEZ LUIS CARLOS', 'OPERADOR PADRON', 'luis.bohorquez@blancoynegromasivo.com.co', 1, 0),
(95, '16842547', 'BOLANOS BOLANOS MARCO AURELIO', 'MECANICO B', 'marco.bolanos@blancoynegromasivo.com.co', 1, 0),
(96, '16680893', 'BOLANOS CARLOS ENRIQUE', 'OPERADOR ALIMENTADOR', 'carlos.bolanos@blancoynegromasivo.com.co', 1, 0),
(97, '94537419', 'BOLANOS GARCIA JORGE ADDINSON', 'OPERADOR PADRON', 'jorge.bolanos@blancoynegromasivo.com.co', 1, 0),
(98, '1118290142', 'BOLANOS MARQUEZ JESUS ANDRES', 'OPERADOR ALIMENTADOR', 'jesus.bolanos@blancoynegromasivo.com.co', 1, 0),
(99, '16925888', 'BOLANOS MUNOZ YONY ALBERTO', 'OPERADOR PADRON', 'jony.bolanos@blancoynegromasivo.com.co', 1, 0),
(100, '1113621118', 'BOLIVAR VASQUEZ EDUARD FELIPE', 'MECANICO C', 'eduard.bolivar@blancoynegromasivo.com.co', 1, 0),
(101, '16598294', 'BONILLA MARCO AURELIO', 'OPERADOR ALIMENTADOR', 'marco.bonilla@blancoynegromasivo.com.co', 1, 0),
(102, '94282030', 'BORJA WILSON', 'OPERADOR PADRON', 'wilson.borja@blancoynegromasivo.com.co', 1, 0),
(103, '16746825', 'BOTERO MUNOZ JAVIER', 'OPERADOR PADRON', 'javier.botero@blancoynegromasivo.com.co', 1, 0),
(104, '94534417', 'BOTERO NARANJO CARLOS ANDRES', 'AUXILIAR DE ALMACEN', 'auxiliares.almacen@blancoynegromasivo.com.c', 1, 0),
(105, '79852657', 'BOTIA LUQUE JOHN JAIRO', 'OPERADOR ARTICULADO', 'john.botia@blancoynegromasivo.com.co', 1, 0),
(106, '76329728', 'BRAVO LOPEZ WILLIAN RICARDO', 'OPERADOR ALIMENTADOR', 'willian.bravo@blancoynegromasivo.com.co', 1, 0),
(107, '94042102', 'BRYON TABA JOHNNATHAN CHRISTIAN', 'OPERADOR ARTICULADO', 'johnnathan.bryon@blancoynegromasivo.com.co', 1, 0),
(108, '15910545', 'BUENO BUENO LUIS ELADIO', 'OPERADOR PADRON', 'luis.bueno@blancoynegromasivo.com.co', 1, 0),
(109, '76190337', 'BUITRAGO BERNAL OLIVER', 'OPERADOR ALIMENTADOR', 'oliver.buitrago@blancoynegromasivo.com.co', 1, 0),
(110, '1130601970', 'BURBANO QUINTERO EDWIN', 'LAVADOR', 'edwin.burbano@blancoynegromasivo.com.co', 1, 0),
(111, '16930748', 'BURGOS EDWIN', 'OPERADOR ARTICULADO', 'edwin.burgos@blancoynegromasivo.com.co', 1, 0),
(112, '6219192', 'BUSTAMANTE CASTANEDA OMER DE JESUS', 'OPERADOR PADRON', 'omer.bustamante@blancoynegromasivo.com.co', 1, 0),
(113, '1114118009', 'BUSTAMANTE GARCIA VICTOR ALFONSO', 'MECANICO C', 'victor.bustamante@blancoynegromasivo.com.co', 1, 0),
(114, '6097242', 'CABEZAS ANGULO HAMILTON MARINO', 'OPERADOR ALIMENTADOR', 'hamilton.cabezas@blancoynegromasivo.com.co', 1, 0),
(115, '1058668448', 'CABEZAS BENAVIDES EINZON FERNANDO', 'OPERADOR ALIMENTADOR', 'einzon.cabezas@blancoynegromasivo.com.co', 1, 0),
(116, '16746560', 'CABEZAS ESPINOSA ALFONSO', 'OPERADOR ARTICULADO', 'alfonso.cabezas@blancoynegromasivo.com.co', 1, 0),
(117, '6098415', 'CABRAL MARTINEZ VLADIMIR', 'OPERADOR PADRON', 'vladimir.cabral@blancoynegromasivo.com.co', 1, 0),
(118, '16272226', 'CABRERA CRUZ JESUS ANTONIO', 'OPERADOR ARTICULADO', 'jesus.cabrera@blancoynegromasivo.com.co', 1, 0),
(119, '6398292', 'CAICEDO CACERES JOSE LIBARDO', 'OPERADOR ARTICULADO', 'jose.caicedo@blancoynegromasivo.com.co', 1, 0),
(120, '94317388', 'CAICEDO CARDONA JOHN JAIRO', 'OPERADOR ARTICULADO', 'john.caicedo@blancoynegromasivo.com.co', 1, 0),
(121, '94470645', 'CAICEDO MONTES WALDIR ARLEY', 'OPERADOR PADRON', 'waldir.caicedo@blancoynegromasivo.com.co', 1, 0),
(122, '10552467', 'CAICEDO MOSQUERA ANGEL YAMIL', 'OPERADOR ARTICULADO', 'angel.caicedo@blancoynegromasivo.com.co', 1, 0),
(123, '6106919', 'CAICEDO ORDONEZ JAIME SAUL', 'OPERADOR ARTICULADO', 'jaime.caicedo@blancoynegromasivo.com.co', 1, 0),
(124, '1113593087', 'CALERO GARCIA JHONATAN ALEJANDRO', 'OPERADOR ARTICULADO', 'jhonatan.calero@blancoynegromasivo.com.co', 1, 0),
(125, '16743482', 'CALVACHE RECALDE CARLOS ERNESTO', 'OPERADOR ARTICULADO', 'carlos.calvache@blancoynegromasivo.com.co', 1, 0),
(126, '16658899', 'CAMACHO FERNANDO', 'OPERADOR ARTICULADO', 'fernando.camacho@blancoynegromasivo.com.co', 1, 0),
(127, '1143826619', 'CAMAYO JANAMEJOY MICHAEL STIVEN', 'AUXILIAR DE LLANTAS Y COMBUSTIBLE', 'michael.camayo@blancoynegromasivo.com.co', 1, 0),
(128, '1130660456', 'CAMILO MORENO GUSTAVO ADOLFO', 'LAVADOR', 'gustavo.camilo@blancoynegromasivo.com.co', 1, 0),
(129, '94452202', 'CAMPO ARTEAGA CARLOS ALBERTO', 'OPERADOR PADRON', 'carlos.campo@blancoynegromasivo.com.co', 1, 0),
(130, '6538209', 'CANIZALES LAGOS JADER ALEXANDER', 'OPERADOR ALIMENTADOR', 'jader.canizales@blancoynegromasivo.com.co', 1, 0),
(131, '16926404', 'CANO CARABALI CHRISTIAN ALBERTO', 'OPERADOR PADRON', 'cristhian.cano@blancoynegromasivo.com.co', 1, 0),
(132, '16638263', 'CANO CORRALES HECTOR', 'OPERADOR PADRON', 'hector.cano@blancoynegromasivo.com.co', 1, 0),
(133, '94282301', 'CANO GUTIERREZ JHON EDER', 'AUXILIAR DE SEGURIDAD', 'jhon.cano@blancoynegromasivo.com.co', 1, 0),
(134, '14635990', 'CANO PENAGOS AHUDI MARLON', 'OPERADOR ARTICULADO', 'ahudi.cano@blancoynegromasivo.com.co', 1, 0),
(135, '14679186', 'CARABALI ABONIA EDWARD', 'LAVADOR', 'edward.carabali@blancoynegromasivo.com.co', 1, 0),
(136, '76042068', 'CARABALI CARABALI HERNAN', 'OPERADOR PADRON', 'hernan.carabali@blancoynegromasivo.com.co', 1, 0),
(137, '16893523', 'CARABALI HURTADO JOSE MAURICIO', 'MECANICO C', 'jose.carabali@blancoynegromasivo.com.co', 1, 0),
(138, '16915992', 'CARABALI LOPEZ DIEGO ARMANDO', 'OPERADOR PADRON', 'diego.carabali@blancoynegromasivo.com.co', 1, 0),
(139, '16830056', 'CARDENAS AGUDELO JOER', 'OPERADOR ARTICULADO', 'joer.cardenas@blancoynegromasivo.com.co', 1, 0),
(140, '16823878', 'CARDENAS AGUDELO LUIS ANGEL', 'OPERADOR ARTICULADO', 'luis.cardenas@blancoynegromasivo.com.co', 1, 0),
(141, '16640599', 'CARDENAS CANO JULIO CESAR', 'OPERADOR PADRON', 'julio.cardenas@blancoynegromasivo.com.co', 1, 0),
(142, '94373585', 'CARDENAS CARVAJAL JORGE ELIECER', 'OPERADOR PADRON', 'jorge.cardenas@blancoynegromasivo.com.co', 1, 0),
(143, '1114481247', 'CARDENAS ROJAS ALEJANDRO', 'PROFESIONAL JUNIOR DE PLANEACION', 'alejandro.cardenas@blancoynegromasivo.com.c', 1, 0),
(144, '1143935417', 'CARDONA CASTRO JHON ALFONSO', 'LAVADOR', 'jhon.cardona@blancoynegromasivo.com.co', 1, 0),
(145, '16785858', 'CARDONA GONGORA HENRY', 'OPERADOR PADRON', 'henry.cardona@blancoynegromasivo.com.co', 1, 0),
(146, '16848005', 'CARDONA GUTIERREZ JAMES', 'OPERADOR PADRON', 'james.cardona@blancoynegromasivo.com.co', 1, 0),
(147, '94073021', 'CARDONA LOPEZ HECTOR FABIO', 'OPERADOR ARTICULADO', 'hector.cardona@blancoynegromasivo.com.co', 1, 0),
(148, '16792395', 'CARDONA VALENCIA HERNEY', 'OPERADOR ALIMENTADOR', 'herney.cardona@blancoynegromasivo.com.co', 1, 0),
(149, '16765821', 'CARRILLO ESCARRAGA JOSE JAVIER', 'OPERADOR ARTICULADO', 'jose.carrillo@blancoynegromasivo.com.co', 1, 0),
(150, '16747573', 'CARVAJAL GOMEZ LUIS EUSTORGIO', 'OPERADOR PADRON', 'luis.carvajal@blancoynegromasivo.com.co', 1, 0),
(151, '79412816', 'CARVAJAL MONTENEGRO VICTOR EDUARDO', 'OPERADOR ARTICULADO', 'eduardo.carvajal@blancoynegromasivo.com.co', 1, 0),
(152, '94380341', 'CARVAJAL ROJAS VICTOR MARIO', 'OPERADOR ARTICULADO', 'victor.carvajal@blancoynegromasivo.com.co', 1, 0),
(153, '1004610330', 'CARVAJAL VALENCIA JORGE WASHINGTON', 'LAVADOR', 'jorge.carvajal@blancoynegromasivo.com.co', 1, 0),
(154, '1062274670', 'CASSO PENA JOSE ROMEIRO', 'LAVADOR', 'jose.casso@blancoynegromasivo.com.co', 1, 0),
(155, '16642860', 'CASTANEDA ESCOBAR JOSE ALBEIRO', 'OPERADOR ALIMENTADOR', 'jose.castaneda@blancoynegromasivo.com.co', 1, 0),
(156, '94524161', 'CASTANEDA TABARES JHON FREDY', 'OPERADOR ARTICULADO', 'jhon.castaneda@blancoynegromasivo.com.co', 1, 0),
(157, '12137110', 'CASTANO CARLOS GILBERTO', 'OPERADOR PADRON', 'carlos.castano@blancoynegromasivo.com.co', 1, 0),
(158, '6135450', 'CASTANO POTES DIEGO FERNANDO', 'OPERADOR ALIMENTADOR', 'diego.castano@blancoynegromasivo.com.co', 1, 0),
(159, '6220439', 'CASTANO RESTREPO HAROLD', 'OPERADOR PADRON', 'harold.castano@blancoynegromasivo.com.co', 1, 0),
(160, '79460400', 'CASTELLANOS AGUIAR GILBERTO', 'COORDINADOR', 'gilberto.castellanos@blancoynegromasivo.com', 1, 0),
(161, '1087184755', 'CASTILLO CARVAJAL EDIER GIOVANY', 'LAVADOR', 'edier.castillo@blancoynegromasivo.com.co', 1, 0),
(162, '94426384', 'CASTILLO CEBALLOS ROSLYN ANDRES', 'OPERADOR ALIMENTADOR', 'roslyn.ceballos@blancoynegromasivo.com.co', 1, 0),
(163, '1118299938', 'CASTILLO IDROBO EDGAR ANDRES', 'LAVADOR', 'edgar.castillo@blancoynegromasivo.com.co', 1, 0),
(164, '16727852', 'CASTILLO MANDINGA ALEXANDER', 'OPERADOR ARTICULADO', 'alexander.castillo@blancoynegromasivo.com.c', 1, 0),
(165, '1151937213', 'CASTILLO MONTERO STIVEN', 'ASISTENTE DE INFORMATICA', 'stiven.castillo@blancoynegromasivo.com.co', 1, 0),
(166, '94427404', 'CASTILLO RICARDO', 'MECANICO B', 'ricardo.castillo@blancoynegromasivo.com.co', 1, 0),
(167, '1130646207', 'CASTILLO TORO JORGE ELIECER', 'OPERADOR ARTICULADO', 'jorge.castillo@blancoynegromasivo.com.co', 1, 0),
(168, '16929727', 'CASTILLO TRUJILLO JOHN JAIRO', 'OPERADOR PADRON', 'john.castillo@blancoynegromasivo.com.co', 1, 0),
(169, '16376035', 'CASTILLO TRUJILLO LUIS CARLOS', 'OPERADOR PADRON', 'luis.castillo@blancoynegromasivo.com.co', 1, 0),
(170, '16658461', 'CASTRO GARCIA DIEGO LUIS', 'FLOTA AUXILIAR', 'diego.castro@blancoynegromasivo.com.co', 1, 0),
(171, '38611169', 'CASTRO GOMEZ NEYDI JOHANNA', 'ASISTENTE CONTABLE', 'neydi.castro@blancoynegromasivo.com.co', 1, 0),
(172, '98627534', 'CASTRO ORTIZ JOHN HARVEY', 'OPERADOR PADRON', 'john.castro@blancoynegromasivo.com.co', 1, 0),
(173, '94425721', 'CASTRO PEREA UBERNEY', 'MECANICO C', 'uberney.castro@blancoynegromasivo.com.co', 1, 0),
(174, '6103120', 'CASTRO VALENCIA JORGE ELIECER', 'OPERADOR PADRON', 'jorge.castro@blancoynegromasivo.com.co', 1, 0),
(175, '16693570', 'CASTRO VIVAS WILLIAM MARTIN', 'OPERADOR ALIMENTADOR', 'william.castro@blancoynegromasivo.com.co', 1, 0),
(176, '16944348', 'CEBALLOS JOHAN SEBASTIAN', 'OPERADOR PADRON', 'johan.ceballos@blancoynegromasivo.com.co', 1, 0),
(177, '16278229', 'CEPERO MILLAN JORGE ENRIQUE', 'OPERADOR PADRON', 'jorge.cepero@blancoynegromasivo.com.co', 1, 0),
(178, '6134660', 'CHACON OSORIO PABLO ANDRES', 'OPERADOR ALIMENTADOR', 'pablo.chacon@blancoynegromasivo.com.co', 1, 0),
(179, '1053770522', 'CHALARCA PUERTAS JONATHAN', 'OPERADOR PADRON', 'jonathan.chalarca@blancoynegromasivo.com.co', 1, 0),
(180, '447323', 'CHAPARRO GERMAN', 'OPERADOR PADRON', 'german.chaparro@blancoynegromasivo.com.co', 1, 0),
(181, '16263845', 'CHARA CARABALI OSCAR', 'OPERADOR PADRON', 'oscar.chara@blancoynegromasivo.com.co', 1, 0),
(182, '1087128370', 'CHARCOPA VILLARREAL JOSE LUIS', 'LAVADOR', 'jose.charcopa@blancoynegromasivo.com.co', 1, 0),
(183, '14801544', 'CHASPUENGAL BERNAL LUIS ALBERTO', 'OPERADOR PADRON', 'luis.chaspuengal@blancoynegromasivo.com.co', 1, 0),
(184, '16889050', 'CHAURRA HERNANDEZ ALBEIRO ANTONIO', 'OPERADOR PADRON', 'albeiro.chaurra@blancoynegromasivo.com.co', 1, 0),
(185, '87574311', 'CHAVES CERON MARIO HEMERSON', 'MECANICO C', 'hemerson.chaves@blancoynegromasivo.com.co', 1, 0),
(186, '3021829', 'CHAVES HERRERA MARIO', 'OPERADOR PADRON', 'mario.chaves@blancoynegromasivo.com.co', 1, 0),
(187, '94467957', 'CHAVES JOHN JAIRO', 'OPERADOR ALIMENTADOR', 'john.chaves@blancoynegromasivo.com.co', 1, 0),
(188, '10302574', 'CHILITO BERMEO ALEXANDER', 'PORTEROS', 'alexander.chilito@blancoynegromasivo.com.co', 1, 0),
(189, '1060987204', 'CHIMUNJA AVENDANO ILDEBRANDO', 'LAVADOR', 'ildebrando.chimunja@blancoynegromasivo.com.', 1, 0),
(190, '1144046019', 'CIFUENTES DAZA LUIS GUILLERMO', 'LAVADOR', 'luis.cifuentes@blancoynegromasivo.com.co', 1, 0),
(191, '1058965807', 'CLAROS ORTEGA GILBERT EDIVAR', 'LAVADOR', 'gilbert.claros@blancoynegromasivo.com.co', 1, 0),
(192, '14882870', 'COLINA SANCHEZ EFRAIN', 'OPERADOR PADRON', 'efrain.colina@blancoynegromasivo.com.co', 1, 0),
(193, '94042402', 'COLLAZOS MENESES FABIO HERNAN', 'AUXILIAR DE ALMACEN', 'auxiliares.almacen@blancoynegromasivo.com.c', 1, 0),
(194, '14999637', 'COMETA TRUJILLO RAMIRO', 'OPERADOR PADRON', 'ramiro.cometa@blancoynegromasivo.com.co', 1, 0),
(195, '1144025533', 'COMETA VALENCIA YONNY JAVIER', 'OPERADOR ALIMENTADOR', 'yonny.cometa@blancoynegromasivo.com.co', 1, 0),
(196, '16378173', 'CONTECHA MARIN JOHN JAIME', 'MECANICO B', 'john.contecha@blancoynegromasivo.com.co', 1, 0),
(197, '1118286029', 'CORDOBA CARDONA ELADIO', 'LAVADOR', 'eladio.cordoba@blancoynegromasivo.com.co', 1, 0),
(198, '14650793', 'CORREA MARIN LUIS EDUARDO', 'OPERADOR PADRON', 'luis.correa@blancoynegromasivo.com.co', 1, 0),
(199, '94516197', 'CORREA MUNOZ JAIRO ANDRES', 'AUXILIAR DE SEGURIDAD', 'jairo.correa@blancoynegromasivo.com.co', 1, 0),
(200, '94257609', 'CORREA OBANDO JORGE MARIO', 'OPERADOR ALIMENTADOR', 'jorge.correa@blancoynegromasivo.com.co', 1, 0),
(201, '6100593', 'CORREA OCORO HERMELIAS', 'OPERADOR PADRON', 'hermelias.correa@blancoynegromasivo.com.co', 1, 0),
(202, '16546388', 'CORREA OSPINA JOSE NORBERTO', 'OPERADOR PADRON', 'norberto.correa@blancoynegromasivo.com.co', 1, 0),
(203, '16687122', 'CORREA SANCHEZ JOSE RODOLFO', 'OPERADOR PADRON', 'jose.correa@blancoynegromasivo.com.co', 1, 0),
(204, '79778047', 'CORREA URIBE SAMUEL ANDRES', 'OPERADOR PADRON', 'samuel.correa@blancoynegromasivo.com.co', 1, 0),
(205, '14677949', 'CORTES BAHAMON JORGE ALIRIO', 'OPERADOR PADRON', 'jorge.cortes@blancoynegromasivo.com.co', 1, 0),
(206, '16760138', 'CORTES CABRERA RENE', 'OPERADOR PADRON', 'rene.cortes@blancoynegromasivo.com.co', 1, 0),
(207, '16647931', 'CORTES OLAYA RUBEN DARIO', 'OPERADOR PADRON', 'ruben.cortes@blancoynegromasivo.com.co', 1, 0),
(208, '13073233', 'CUARAN CUARAN LUIS HUMBERTO', 'OPERADOR ARTICULADO', 'luis.cuaran@blancoynegromasivo.com.co', 1, 0),
(209, '12919910', 'CUENU ESTUPINAN JOSE LIBARDO', 'OPERADOR PADRON', 'jose.cuenu@blancoynegromasivo.com.co', 1, 0),
(210, '14675684', 'DAZA MURCIA JORGE ARMANDO', 'OPERADOR ALIMENTADOR', 'jorge.daza@blancoynegromasivo.com.co', 1, 0),
(211, '16686488', 'DAZA PAZ MIGUEL ANTONIO', 'OPERADOR PADRON', 'miguel.daza@blancoynegromasivo.com.co', 1, 0),
(212, '16928712', 'DE LA PAVA OROZCO RUBEN DARIO', 'OPERADOR PADRON', 'ruben.delapava@blancoynegromasivo.com.co', 1, 0),
(213, '16783718', 'DEL CARMEN CARABALI JOSE FRET', 'OPERADOR PADRON', 'jose.delcarmen@blancoynegromasivo.com.co', 1, 0),
(214, '14635061', 'DELGADO ALEXIS JOANNY', 'OPERADOR ALIMENTADOR', 'alexis.delgado@blancoynegromasivo.com.co', 1, 0),
(215, '14695466', 'DELGADO ARIAS GUSTAVO ADOLFO', 'OPERADOR ALIMENTADOR', 'gustavo.delgado@blancoynegromasivo.com.co', 1, 0),
(216, '16943998', 'DELGADO DELGADO ANDERSON DAVID', 'OPERADOR PADRON', 'anderson.delgado@blancoynegromasivo.com.co', 1, 0),
(217, '16709781', 'DELGADO HERNANDEZ JORGE ELIECER', 'OPERADOR ALIMENTADOR', 'jorge.delgado@blancoynegromasivo.com.co', 1, 0),
(218, '94411087', 'DELGADO MOSQUERA WILTON', 'OPERADOR PADRON', 'wilton.delgado@blancoynegromasivo.com.co', 1, 0),
(219, '94515759', 'DELGADO VINASCO EDWIN ALEXIS', 'OPERADOR ARTICULADO', 'edwin.delgado@blancoynegromasivo.com.co', 1, 0),
(220, '16688155', 'DELGADO WILSON', 'OPERADOR PADRON', 'wilson.delgado@blancoynegromasivo.com.co', 1, 0),
(221, '1118295045', 'DIAZ FIGUEROA GERSON', 'MONTALLANTAS', 'gerson.diaz@blancoynegromasivo.com.co', 1, 0),
(222, '14473597', 'DIAZ LOZANO RODRIGO', 'OPERADOR PADRON', 'rodrigo.diaz@blancoynegromasivo.com.co', 1, 0),
(223, '94270003', 'DIAZ MURILLO MIGUEL ANDRES', 'PORTEROS', 'miguel.diaz@blancoynegromasivo.com.co', 1, 0),
(224, '1130657602', 'DIEZ ECHEVERRI NESTOR JULIAN', 'OPERADOR ALIMENTADOR', 'nestor.diez@blancoynegromasivo.com.co', 1, 0),
(225, '16722771', 'DINAS SANCHEZ FREDDY', 'OPERADOR ARTICULADO', 'freddy.dinas@blancoynegromasivo.com.co', 1, 0),
(226, '1143936864', 'DIOSA ESPINOSA WILLIAM SPENCER', 'LAVADOR', 'william.diosa@blancoynegromasivo.com.co', 1, 0),
(227, '15817022', 'DOMINGUEZ ORDONEZ ALEXANDER', 'LAVADOR', 'alexander.dominguez@blancoynegromasivo.com.', 1, 0),
(228, '76318347', 'DORADO DIAZ OMEL RICARDO', 'OPERADOR PADRON', 'omel.dorado@blancoynegromasivo.com.co', 1, 0),
(229, '16701596', 'DORRONSORO CAMACHO OSVALDO', 'OPERADOR PADRON', 'osvaldo.dorronsoro@blancoynegromasivo.com.c', 1, 0),
(230, '6252204', 'DOSMAN CARLOS ALBERTO', 'OPERADOR ARTICULADO', 'alberto.dosman@blancoynegromasivo.com.co', 1, 0),
(231, '16933135', 'DUARTE MARMOLEJO YIMY JAVIER', 'OPERADOR ALIMENTADOR', 'yimy.duarte@blancoynegromasivo.com.co', 1, 0),
(232, '94499638', 'DUENAS SANCHEZ MIGUEL ANGEL', 'OPERADOR PADRON', 'miguel.duenas@blancoynegromasivo.com.co', 1, 0),
(233, '14638046', 'DUQUE RESTREPO WILMER', 'PROFESIONAL DE INFORMATICA', 'wilmer.duque@blancoynegromasivo.com.co', 1, 0),
(234, '16700402', 'DUQUE ROJAS WILSON EFREN', 'OPERADOR PADRON', 'wilson.duque@blancoynegromasivo.com.co', 1, 0),
(235, '16674641', 'ECHEVERRY GONZALEZ SAUL', 'PORTEROS', 'saul.echeverry@blancoynegromasivo.com.co', 1, 0),
(236, '1151938279', 'ENRIQUEZ NORENA JEFFERSON', 'OPERADOR ALIMENTADOR', 'jefferson.enriquez@blancoynegromasivo.com.c', 1, 0),
(237, '16939241', 'ERAZO RINCON ANDERSON', 'OPERADOR PADRON', 'anderson.erazo@blancoynegromasivo.com.co', 1, 0),
(238, '94521792', 'ERAZO RODRIGUEZ LUIS ANDRES', 'OPERADOR PADRON', 'luis.erazo@blancoynegromasivo.com.co', 1, 0),
(239, '94417334', 'ESCOBAR ALVARADO JOHN EDWARD', 'OPERADOR PADRON', 'john.escobar@blancoynegromasivo.com.co', 1, 0),
(240, '16985137', 'ESCOBAR CACERES LUIS ALBERTO', 'COORDINADOR', 'luis.escobar@blancoynegromasivo.com.co', 1, 0),
(241, '1130663106', 'ESCOBAR CARABALI LIUBER', 'LAVADOR', 'liuber.escobar@blancoynegromasivo.com.co', 1, 0),
(242, '1107073070', 'ESCOBAR ESCUDERO JHON ALEXANDER', 'AUXILIAR DE PINTURA', 'jhon.escobar@blancoynegromasivo.com.co', 1, 0),
(243, '16939360', 'ESCOBAR HURTADO QUEUBRI', 'OPERADOR PADRON', 'queubri.escobar@blancoynegromasivo.com.co', 1, 0),
(244, '16747702', 'ESCOBAR ZAPATA ORLANDO', 'OPERADOR ARTICULADO', 'orlando.escobar@blancoynegromasivo.com.co', 1, 0),
(245, '1143940877', 'ESPADA MONTEZUMA CRISTHIAN FERNANDO', 'LAVADOR', 'cristhian.espada@blancoynegromasivo.com.co', 1, 0),
(246, '16622888', 'ESQUIVEL MORA JAIRO', 'OPERADOR PADRON', 'jairo.esquivel@blancoynegromasivo.com.co', 1, 0),
(247, '76310774', 'FAJARDO JOSE ALBEYRO', 'MECANICO A', 'jose.fajardo@blancoynegromasivo.com.co', 1, 0),
(248, '1090427839', 'FAJARDO TORRES BRIAN', 'MONTALLANTAS', 'brian.fajardo@blancoynegromasivo.com.co', 1, 0),
(249, '16931287', 'FALLA LAMPREA ALEXANDER', 'OPERADOR PADRON', 'alexander.falla@blancoynegromasivo.com.co', 1, 0),
(250, '76041043', 'FERNANDEZ GALINDO ALEXANDER', 'OPERADOR ARTICULADO', 'alexander.fernandez@blancoynegromasivo.com.', 1, 0),
(251, '10479308', 'FERNANDEZ GRIJALBA ALBEIRO GENTIL', 'OPERADOR ARTICULADO', 'gentil.fernandez@blancoynegromasivo.com.co', 1, 0),
(252, '1130667327', 'FERNANDEZ SANCHEZ MICHAEL ANDERSON', 'OPERADOR ARTICULADO', 'michael.fernandez@blancoynegromasivo.com.co', 1, 0),
(253, '94413646', 'FERNANDEZ VALENCIA JOHN FREDY', 'OPERADOR ARTICULADO', 'john.valencia@blancoynegromasivo.com.co', 1, 0),
(254, '1130660538', 'FILIGRANA VASQUEZ ALEXIS DAVID', 'LAVADOR', 'alexis.filigrana@blancoynegromasivo.com.co', 1, 0),
(255, '16631048', 'FISCAL ZUNIGA ROGELIO', 'OPERADOR ARTICULADO', 'rogelio.fiscal@blancoynegromasivo.com.co', 1, 0),
(256, '94371065', 'FLOR FLOR CARLOS OLMEDO', 'OPERADOR PADRON', 'carlos.flor@blancoynegromasivo.com.co', 1, 0),
(257, '6343472', 'FLOREZ ARTEAGA JORGE ALIRIO', 'AUXILIAR DE LLANTAS Y COMBUSTIBLE', 'jorge.florez@blancoynegromasivo.com.co', 1, 0),
(258, '16928427', 'FLOREZ BATIOJA EDUAR ALEXIS', 'OPERADOR ALIMENTADOR', 'eduar.florez@blancoynegromasivo.com.co', 1, 0),
(259, '16938822', 'FLOREZ CALVO JHON BAWER', 'OPERADOR PADRON', 'jhon.florez@blancoynegromasivo.com.co', 1, 0),
(260, '14679543', 'FLOREZ OSPINA JULIAN ANDRES', 'OPERADOR PADRON', 'julian.florez@blancoynegromasivo.com.co', 1, 0),
(261, '1144140995', 'FRANCO MANRIQUE RICHAR ESTIWAR', 'OPERADOR PADRON', 'richar.franco@blancoynegromasivo.com.co', 1, 0),
(262, '16377397', 'GALEANO ALZATE STEVE', 'OPERADOR ALIMENTADOR', 'steve.galeano@blancoynegromasivo.com.co', 1, 0),
(263, '16591634', 'GALEANO MARTINEZ DARIO ANTONIO', 'OPERADOR PADRON', 'dario.galeano@blancoynegromasivo.com.co', 1, 0),
(264, '14639492', 'GALINDEZ GUTIERREZ MILTON JAVIER', 'OPERADOR PADRON', 'milton.galindez@blancoynegromasivo.com.co', 1, 0),
(265, '94429734', 'GALINDEZ ORTIZ MANUEL HENRY', 'MECANICO C', 'manuel.galindez@blancoynegromasivo.com.co', 1, 0),
(266, '16684461', 'GALINDO ARIAS IVAN DARIO', 'OPERADOR PADRON', 'ivan.galindo@blancoynegromasivo.com.co', 1, 0),
(267, '14636885', 'GALINDO ROJAS GERMAN ANDRES', 'OPERADOR ALIMENTADOR', 'german.galindo@blancoynegromasivo.com.co', 1, 0),
(268, '94450691', 'GALINDO SANCHEZ JORGE EDUARDO', 'OPERADOR ALIMENTADOR', 'jorge.galindo@blancoynegromasivo.com.co', 1, 0),
(269, '10755054', 'GALLEGO MILLAN IVAN DARIO', 'SUPERVISOR DE OPERACIONES', 'ivan.gallego@blancoynegromasivo.com.co', 1, 0),
(270, '6105845', 'GAMBOA FRANCO GUILLERMO JAVIER', 'OPERADOR PADRON', 'guillermo.gamboa@blancoynegromasivo.com.co', 1, 0),
(271, '16887213', 'GARCIA ACEVEDO ISMET ALBERI', 'MECANICO A JUNIOR', 'ismet.garcia@blancoynegromasivo.com.co', 1, 0),
(272, '94072415', 'GARCIA CALDAS ANDRES ARLEY', 'OPERADOR PADRON', 'andres.garcia@blancoynegromasivo.com.co', 1, 0),
(273, '1130612742', 'GARCIA CHAVARRIA WILLIAM ANDRES', 'OPERADOR ARTICULADO', 'william.garcia@blancoynegromasivo.com.co', 1, 0),
(274, '14624987', 'GARCIA METAUTE OSCAR FABIAN', 'OPERADOR ARTICULADO', 'oscar.garcia@blancoynegromasivo.com.co', 1, 0),
(275, '16710620', 'GARCIA OLAVE ORLANDO', 'OPERADOR PADRON', 'orlando.garcia@blancoynegromasivo.com.co', 1, 0),
(276, '31954567', 'GARCIA RODRIGUEZ MARTHA CECILIA', 'ASISTENTE DE RECURSO HUMANO', 'martha.garcia@blancoynegromasivo.com.co', 1, 0),
(277, '41936839', 'GARCIA SANCHEZ CLAUDIA LORENA', 'ASISTENTE CONTABLE', 'claudia.garcia@blancoynegromasivo.com.co', 1, 0),
(278, '14898699', 'GARCIA SANCHEZ RUBEN DARIO', 'COORDINADOR', 'ruben.garcia@blancoynegromasivo.com.co', 1, 0),
(279, '16788697', 'GARCIA TAFUR HUMBERTO', 'OPERADOR ARTICULADO', 'humberto.garcia@blancoynegromasivo.com.co', 1, 0),
(280, '94457956', 'GARCIA URBANO JUAN CARLOS', 'OPERADOR ALIMENTADOR', 'juan.garcia@blancoynegromasivo.com.co', 1, 0),
(281, '94369590', 'GARCIA VELASQUEZ GUSTAVO ADOLFO', 'OPERADOR PADRON', 'gustavo.garcia@blancoynegromasivo.com.co', 1, 0),
(282, '1130663987', 'GAVIRIA CARDONA VICTOR ANDRES', 'LAVADOR', 'victor.gaviria@blancoynegromasivo.com.co', 1, 0),
(283, '76335072', 'GAVIRIA DEYRO', 'JARDINERO', 'deyro.gaviria@blancoynegromasivo.com.co', 1, 0),
(284, '1143927341', 'GAVIRIA RAMIREZ CRISTIAN GERMAN', 'MECANICO C', 'cristian.gaviria@blancoynegromasivo.com.co', 1, 0),
(285, '94455814', 'GIL BECERRA HENRY', 'OPERADOR ARTICULADO', 'henry.gil@blancoynegromasivo.com.co', 1, 0),
(286, '16792827', 'GIL FERNANDEZ JIMY FERNEY', 'MECANICO C', 'jimy.gil@blancoynegromasivo.com.co', 1, 0),
(287, '17683564', 'GIL HUACA ARNULFO', 'OPERADOR ARTICULADO', 'arnulfo.gil@blancoynegromasivo.com.co', 1, 0),
(288, '93390106', 'GIL VALENCIA YIMI ALBERTO', 'OPERADOR PADRON', 'yimi.gil@blancoynegromasivo.com.co', 1, 0),
(289, '1143944847', 'GIL VALVERDE SANDRO EULISES', 'MECANICO C', 'sandro.gil@blancoynegromasivo.com.co', 1, 0),
(290, '94499489', 'GIRALDO ACOSTA JANOVER', 'OPERADOR PADRON', 'janover.giraldo@blancoynegromasivo.com.co', 1, 0),
(291, '94229544', 'GIRALDO GIRALDO RAUL ANTONIO', 'OPERADOR ALIMENTADOR', 'raul.giraldo@blancoynegromasivo.com.co', 1, 0),
(292, '16764857', 'GIRALDO GRAJALES OBEIMAR DE JESUS', 'OPERADOR ARTICULADO', 'obeimar.giraldo@blancoynegromasivo.com.co', 1, 0),
(293, '16685890', 'GIRALDO JOSE YURMAN', 'OPERADOR PADRON', 'yurman.giraldo@blancoynegromasivo.com.co', 1, 0),
(294, '93380442', 'GIRALDO MENDOZA JORGE EDUARDO', 'OPERADOR ARTICULADO', 'jorge.giraldo@blancoynegromasivo.com.co', 1, 0),
(295, '16376720', 'GIRALDO REYES JOSE HERNANDO', 'MECANICO C', 'jose.giraldo@blancoynegromasivo.com.co', 1, 0),
(296, '6188930', 'GIRON BOCANEGRA CARLOS ALBERTO', 'OPERADOR PADRON', 'carlos.giron@blancoynegromasivo.com.co', 1, 0),
(297, '11312997', 'GIRON MONROY CESAR AUGUSTO', 'OPERADOR PADRON', 'cesar.giron@blancoynegromasivo.com.co', 1, 0),
(298, '94521239', 'GIRON RIVAS ALEXANDER', 'OPERADOR PADRON', 'alexander.giron@blancoynegromasivo.com.co', 1, 0),
(299, '12798157', 'GODOY HURTADO IVAN OCTAVIO', 'LAVADOR', 'ivan.godoy@blancoynegromasivo.com.co', 1, 0),
(300, '14223218', 'GODOY TRUJILLO ALBERTO', 'OPERADOR PADRON', 'alberto.godoy@blancoynegromasivo.com.co', 1, 0),
(301, '10472400', 'GOMEZ LUCUMI FERNANDO JOSE', 'OPERADOR ARTICULADO', 'fernando.gomez@blancoynegromasivo.com.co', 1, 0),
(302, '1130646569', 'GOMEZ LUFAN RICARDO', 'OPERADOR PADRON', 'ricardo.gomez@blancoynegromasivo.com.co', 1, 0),
(303, '16750664', 'GOMEZ MARTINEZ SAMIR', 'OPERADOR PADRON', 'samir.gomez@blancoynegromasivo.com.co', 1, 0),
(304, '6343589', 'GOMEZ NARANJO ELKIN JOHANNY', 'OPERADOR ALIMENTADOR', 'elkin.gomez@blancoynegromasivo.com.co', 1, 0),
(305, '94460928', 'GOMEZ NINO JOSE LUIS', 'OPERADOR PADRON', 'jose.gomez@blancoynegromasivo.com.co', 1, 0),
(306, '16679704', 'GOMEZ ORDONEZ EVARISTO', 'OPERADOR ARTICULADO', 'evaristo.gomez@blancoynegromasivo.com.co', 1, 0),
(307, '10298577', 'GOMEZ PRIETO JELLER', 'OPERADOR PADRON', 'jeller.gomez@blancoynegromasivo.com.co', 1, 0),
(308, '16623354', 'GOMEZ SAMPEDRO PEDRO ANTONIO', 'OPERADOR PADRON', 'pedro.gomez@blancoynegromasivo.com.co', 1, 0),
(309, '94493594', 'GOMEZ VALENCIA JHANN CHARLYE', 'OPERADOR ALIMENTADOR', 'jhann.gomez@blancoynegromasivo.com.co', 1, 0),
(310, '16287377', 'GOMEZ VALENCIA WILSON HUBEIMAR', 'OPERADOR ALIMENTADOR', 'wilson.valencia@blancoynegromasivo.com.co', 1, 0),
(311, '76223440', 'GOMEZ WILSON ORLANDO', 'OPERADOR ARTICULADO', 'orlando.gomez@blancoynegromasivo.com.co', 1, 0),
(312, '94070788', 'GONZALEZ ACOSTA OSCAR EDUARDO', 'PLANEACION DE MANTENIMIENTO', 'oscar.gonzalez@blancoynegromasivo.com.co', 1, 0),
(313, '16695107', 'GONZALEZ BASTIDAS NELSON DE JESUS', 'OPERADOR PADRON', 'nelson.gonzalez@blancoynegromasivo.com.co', 1, 0),
(314, '1144131311', 'GONZALEZ HERNANDEZ DIEGO FERNANDO', 'OPERADOR ALIMENTADOR', 'diego.gonzalez@blancoynegromasivo.com.co', 1, 0),
(315, '1130629192', 'GONZALEZ JAVIER', 'TECNICO DE SERVICIOS', 'javier.gonzalez@blancoynegromasivo.com.co', 1, 0),
(316, '16737587', 'GONZALEZ LOPEZ FERNEY', 'JEFE DE PREVENCION II', 'ferney.gonzalez@blancoynegromasivo.com.co', 1, 0),
(317, '16757627', 'GONZALEZ MIRANDA NUMAR HUMBERTO', 'OPERADOR PADRON', 'numar.gonzalez@blancoynegromasivo.com.co', 1, 0),
(318, '82381216', 'GONZALEZ PALOMEQUE YEFERSON', 'LAVADOR', 'yeferson.gonzalez@blancoynegromasivo.com.co', 1, 0),
(319, '1144050745', 'GONZALEZ VARON JHONATHAN SMIT', 'AUXILIAR DE LLANTAS Y COMBUSTIBLE', 'jhonathan.gonzalez@blancoynegromasivo.com.c', 1, 0),
(320, '1118282211', 'GORDILLO MEJIA JOSE DARBINSON', 'MECANICO C', 'jose.gordillo@blancoynegromasivo.com.co', 1, 0),
(321, '79400074', 'GORDILLO PINZON GERMAN', 'OPERADOR ARTICULADO', 'german.gordillo@blancoynegromasivo.com.co', 1, 0),
(322, '14697030', 'GORDILLO ZAPATA EDWIN', 'MECANICO A JUNIOR', 'edwin.gordillo@blancoynegromasivo.com.co', 1, 0),
(323, '6097835', 'GRANADA DAGUA JULIO CESAR', 'MECANICO B', 'julio.granada@blancoynegromasivo.com.co', 1, 0),
(324, '16535217', 'GRIJALBA RUIZ CARLOS ANDRES', 'OPERADOR ARTICULADO', 'carlos.grijalba@blancoynegromasivo.com.co', 1, 0),
(325, '94061286', 'GRIJALBA RUIZ EDWIN FELIPE', 'OPERADOR PADRON', 'edwin.grijalba@blancoynegromasivo.com.co', 1, 0),
(326, '1143932099', 'GRIMALDO PENA CARLOS ANDRES', 'OPERADOR PADRON', 'carlos.grimaldo@blancoynegromasivo.com.co', 1, 0),
(327, '1118257768', 'GRISALES GRISALES ROBINSON', 'LAVADOR', 'robinson.grisales@blancoynegromasivo.com.co', 1, 0),
(328, '4628752', 'GUAMANGA NOGUERA OLIBER', 'OPERADOR ALIMENTADOR', 'oliber.guamanga@blancoynegromasivo.com.co', 1, 0),
(329, '1144127532', 'GUARNIZO CRISTIAN ALEXANDER', 'MECANICO B', 'cristian.guarnizo@blancoynegromasivo.com.co', 1, 0),
(330, '10483470', 'GUAZA MIGUEL ENRIQUE', 'OPERADOR ARTICULADO', 'miguel.guaza@blancoynegromasivo.com.co', 1, 0),
(331, '94273815', 'GUERRERO PINO DIEGO MAURICIO', 'OPERADOR PADRON', 'diego.guerrero@blancoynegromasivo.com.co', 1, 0),
(332, '94397486', 'GUEVARA LOPEZ ALEJANDRO', 'OPERADOR PADRON', 'alejandro.guevara@blancoynegromasivo.com.co', 1, 0),
(333, '94398472', 'GUTIERREZ BOLIVAR WALTER', 'OPERADOR PADRON', 'walter.gutierrez@blancoynegromasivo.com.co', 1, 0),
(334, '10540000', 'GUTIERREZ CAICEDO GILDARDO', 'OPERADOR ARTICULADO', 'gildardo.gutierrez@blancoynegromasivo.com.c', 1, 0),
(335, '14607018', 'GUTIERREZ JIMENEZ ADEMIR ENRIQUE', 'OPERADOR ARTICULADO', 'ademir.gutierrez@blancoynegromasivo.com.co', 1, 0),
(336, '16655223', 'GUTIERREZ MURILLO RODRIGO JUNIPERO', 'OPERADOR PADRON', 'rodrigo.gutierrez@blancoynegromasivo.com.co', 1, 0),
(337, '1118291258', 'GUTIERREZ PECHENE OSCAR EDUARDO', 'MONTALLANTAS', 'oscar.gutierrez@blancoynegromasivo.com.co', 1, 0),
(338, '52715449', 'GUTIERREZ VACCA DARY YENITH', 'JEFE DE ALMACEN', 'dary.gutierrez@blancoynegromasivo.com.co', 1, 0),
(339, '16928735', 'GUTIERREZ YEPES JHON FREDDY', 'AUXILIAR PROGRAMACION MANTENIMIENTO', 'freddy.gutierrez@blancoynegromasivo.com.co', 1, 0),
(340, '94453936', 'GUZMAN GOMEZ FABIO', 'OPERADOR ALIMENTADOR', 'fabio.guzman@blancoynegromasivo.com.co', 1, 0),
(341, '2680673', 'HENAO ALZATE HOLMER ANTONIO', 'OPERADOR PADRON', 'holmer.henao@blancoynegromasivo.com.co', 1, 0),
(342, '16675008', 'HENAO JARAMILLO GERMAN', 'OPERADOR ARTICULADO', 'german.henao@blancoynegromasivo.com.co', 1, 0),
(343, '1130627883', 'HENAO MESA CARLOS ANDRES', 'SUPERVISOR DE OPERACIONES', 'carlos.henao@blancoynegromasivo.com.co', 1, 0),
(344, '94535740', 'HERNANDEZ ACEVEDO REINEL ARTURO', 'OPERADOR PADRON', 'reinel.hernandez@blancoynegromasivo.com.co', 1, 0),
(345, '11310735', 'HERNANDEZ CORTES FERNANDO', 'OPERADOR PADRON', 'fernando.hernandez@blancoynegromasivo.com.c', 1, 0),
(346, '14837653', 'HERNANDEZ LAVERDE JOSE LUIS', 'OPERADOR ALIMENTADOR', 'jose.hernandez@blancoynegromasivo.com.co', 1, 0),
(347, '94379169', 'HERNANDEZ MUNOZ VICTOR HUGO', 'OPERADOR ARTICULADO', 'victor.hernandez@blancoynegromasivo.com.co', 1, 0),
(348, '16602179', 'HERNANDEZ RENGIFO DIEGO FERNANDO', 'OPERADOR PADRON', 'diego.hernandez@blancoynegromasivo.com.co', 1, 0),
(349, '1144168973', 'HERNANDEZ VARELA ADOLFO LEON', 'LAVADOR', 'adolfo.hernandez@blancoynegromasivo.com.co', 1, 0),
(350, '94070846', 'HERNANDEZ VELEZ JAVIER ORLANDO', 'OPERADOR PADRON', 'javier.hernandez@blancoynegromasivo.com.co', 1, 0),
(351, '94064730', 'HERNANDEZ ZAMORA GUILLERMO ANDRES', 'OPERADOR ARTICULADO', 'guillermo.hernandez@blancoynegromasivo.com.', 1, 0),
(352, '6212093', 'HERRERA BURITICA EDUARDO', 'OPERADOR PADRON', 'eduardo.herrera@blancoynegromasivo.com.co', 1, 0),
(353, '31984986', 'HERRERA CARVAJAL SANDRA PATRICIA', 'ASISTENTE DE RECURSO HUMANO', 'sandra.herrera@blancoynegromasivo.com.co', 1, 0),
(354, '1130659525', 'HERRERA NOGUERA MARLON CAMILO', 'MECANICO C', 'marlon.herrera@blancoynegromasivo.com.co', 1, 0),
(355, '16731411', 'HIDALGO QUINTERO ALVARO FREDY', 'OPERADOR PADRON', 'alvaro.hidalgo@blancoynegromasivo.com.co', 1, 0),
(356, '16671609', 'HINESTROZA ALOMIA HENRY', 'OPERADOR ALIMENTADOR', 'henry.hinestroza@blancoynegromasivo.com.co', 1, 0),
(357, '10388838', 'HINESTROZA CASTRO WILLIAN', 'LAVADOR', 'william.hinestroza@blancoynegromasivo.com.c', 1, 0),
(358, '6524924', 'HOLGUIN GARCIA MARCO ANTONIO', 'OPERADOR PADRON', 'marco.holguin@blancoynegromasivo.com.co', 1, 0),
(359, '79673778', 'HOYOS CARDENAS JOAQUIN MARINO', 'OPERADOR ALIMENTADOR', 'joaquin.hoyos@blancoynegromasivo.com.co', 1, 0),
(360, '16919714', 'HOYOS GIRALDO EDWIN', 'OPERADOR ALIMENTADOR', 'edwin.hoyos@blancoynegromasivo.com.co', 1, 0),
(361, '94500265', 'HOYOS MAZORRA MIYER ALBERTO', 'OPERADOR PADRON', 'miyer.hoyos@blancoynegromasivo.com.co', 1, 0),
(362, '16762308', 'HOYOS MEJIA VICTOR HUGO', 'OPERADOR PADRON', 'victor.hoyos@blancoynegromasivo.com.co', 1, 0),
(363, '94422065', 'HOYOS MUNOZ MARIO JAVIER', 'OPERADOR ARTICULADO', 'mario.hoyos@blancoynegromasivo.com.co', 1, 0),
(364, '94482755', 'HOYOS PEREZ JHON FREDDY', 'OPERADOR ALIMENTADOR', 'jhon.hoyos@blancoynegromasivo.com.co', 1, 0),
(365, '16887668', 'HOYOS SANCLEMENTE JORGE ENRIQUE', 'OPERADOR ALIMENTADOR', 'jorge.hoyos@blancoynegromasivo.com.co', 1, 0),
(366, '94411928', 'HUILA TABARES ADUAR ALFREDO', 'OPERADOR ALIMENTADOR', 'eduar.huila@blancoynegromasivo.com.co', 1, 0),
(367, '16614495', 'HURTADO MARTINEZ NORBERTO', 'OPERADOR ALIMENTADOR', 'norberto.hurtado@blancoynegromasivo.com.co', 1, 0),
(368, '94418382', 'HURTADO MUNOZ NETZER', 'OPERADOR PADRON', 'netzer.hurtado@blancoynegromasivo.com.co', 1, 0),
(369, '6097225', 'HURTADO PENA FREDDY ANTONIO', 'OPERADOR ALIMENTADOR', 'freddy.hurtado@blancoynegromasivo.com.co', 1, 0),
(370, '94505628', 'HURTADO VARGAS CARLOS ANDRE', 'OPERADOR ARTICULADO', 'carlos.hurtado@blancoynegromasivo.com.co', 1, 0),
(371, '16481761', 'HURTADO VIDAL PABLO ENRIQUE', 'OPERADOR ALIMENTADOR', 'pablo.hurtado@blancoynegromasivo.com.co', 1, 0),
(372, '4666673', 'IDROBO MONTENEGRO RIGOBERTO', 'OPERADOR ARTICULADO', 'rigoberto.idrobo@blancoynegromasivo.com.co', 1, 0),
(373, '16796665', 'IPIALES MAMBUSCAY RAUL ALBEIRO', 'OPERADOR PADRON', 'raul.ipiales@blancoynegromasivo.com.co', 1, 0),
(374, '16784158', 'ISAZA BEDOYA DANIEL ANTONIO', 'OPERADOR PADRON', 'daniel.isaza@blancoynegromasivo.com.co', 1, 0),
(375, '5530592', 'JAIMES ALBA ANTONIO MARIA', 'OPERADOR ALIMENTADOR', 'antonio.jaimes@blancoynegromasivo.com.co', 1, 0),
(376, '76310442', 'JANZASOY NAVARRO JOSE MIGUEL', 'OPERADOR ARTICULADO', 'jose.janzasoy@blancoynegromasivo.com.co', 1, 0),
(377, '9847032', 'JARAMILLO ANGEL JORGE ELIECER', 'LAVADOR', 'jorge.jaramillo@blancoynegromasivo.com.co', 1, 0),
(378, '16726031', 'JARAMILLO ARIAS MANUEL ORLANDO', 'OPERADOR ALIMENTADOR', 'manuel.jaramillo@blancoynegromasivo.com.co', 1, 0),
(379, '1130603369', 'JARAMILLO CASTRO DIEGO ALEJANDRO', 'OPERADOR ALIMENTADOR', 'diego.jaramillo@blancoynegromasivo.com.co', 1, 0),
(380, '94526721', 'JARAMILLO HENAO JULIAN', 'OPERADOR ALIMENTADOR', 'julian.jaramillo@blancoynegromasivo.com.co', 1, 0),
(381, '16287558', 'JARAMILLO MOLINA ALEXANDER', 'OPERADOR PADRON', 'alexander.jaramillo@blancoynegromasivo.com.', 1, 0),
(382, '16647198', 'JARAMILLO VELASQUEZ HERNANDO', 'OPERADOR ALIMENTADOR', 'hernando.jaramillo@blancoynegromasivo.com.c', 1, 0),
(383, '16597684', 'JIMENEZ BOTERO HERIBERTO', 'OPERADOR ARTICULADO', 'heriberto.jimenez@blancoynegromasivo.com.co', 1, 0),
(384, '1114824907', 'JIMENEZ OSSA JAIVER ALONSO', 'LAVADOR', 'jaiver.jimenez@blancoynegromasivo.com.co', 1, 0),
(385, '1060987036', 'JIMENEZ QUINAYAZ EMETERIO', 'LAVADOR', 'emeterio.jimenez@blancoynegromasivo.com.co', 1, 0),
(386, '16401108', 'JIMENEZ TOBON HECTOR ESNEY', 'OPERADOR ALIMENTADOR', 'hector.jimenez@blancoynegromasivo.com.co', 1, 0),
(387, '1084254403', 'JIMENEZ UNI FERNANDO', 'LAVADOR', 'fernando.jimenez@blancoynegromasivo.com.co', 1, 0),
(388, '16942887', 'JOSA SANTOFIMIO JOSE LUIS', 'OPERADOR ARTICULADO', 'jose.josa@blancoynegromasivo.com.co', 1, 0),
(389, '13070840', 'JURADO RUIZ WILMER ARLEY', 'MECANICO B', 'wilmer.jurado@blancoynegromasivo.com.co', 1, 0),
(390, '1061707880', 'JURADO TRUJILLO ALFREDO', 'MECANICO C', 'alfredo.jurado@blancoynegromasivo.com.co', 1, 0),
(391, '16684724', 'LARENAS GOMEZ WILMAR', 'COORDINADOR', 'wilmar.larenas@blancoynegromasivo.com.co', 1, 0),
(392, '16375931', 'LARGACHA MONDRAGON JHONNY ALBERTO', 'PROFESIONAL PROGRAMACION MANTENIMIEN', 'jhonny.largacha@blancoynegromasivo.com.co', 1, 0),
(393, '1143925042', 'LAROTTA MACA PABLO ANDRES', 'MECANICO C', 'pablo.larrota@blancoynegromasivo.com.co', 1, 0),
(394, '16737448', 'LARRAHONDO SANCHEZ JUAN CARLOS', 'OPERADOR PADRON', 'juan.larrahondo@blancoynegromasivo.com.co', 1, 0),
(395, '16638142', 'LASSO CAMPO JORGE ALFONSO', 'OPERADOR PADRON', 'jorge.lasso@blancoynegromasivo.com.co', 1, 0),
(396, '1144024456', 'LASSO LASSO HAROLD FERNANDO', 'MECANICO C', 'harold.lasso@blancoynegromasivo.com.co', 1, 0),
(397, '1118288923', 'LENIS CHALARCA ALDEMAR', 'SUPERVISOR MANTENIMIENTO', 'aldemar.lenis@blancoynegromasivo.com.co', 1, 0),
(398, '16771022', 'LEON MARTINEZ JHONNY', 'OPERADOR ARTICULADO', 'jhonny.leon@blancoynegromasivo.com.co', 1, 0),
(399, '16763255', 'LEON QUESADA CARLOS HERNAN', 'OPERADOR ALIMENTADOR', 'carlos.leon@blancoynegromasivo.com.co', 1, 0),
(400, '94541491', 'LERMA PEDRO NEL', 'AUXILIAR DE LLANTAS Y COMBUSTIBLE', 'pedro.lerma@blancoynegromasivo.com.co', 1, 0),
(401, '1144155073', 'LIBREROS MONTANO LUIS FELIPE', 'MECANICO C', 'luis.libreros@blancoynegromasivo.com.co', 1, 0),
(402, '14399501', 'LIZCANO VELARDE JHON MARLON', 'LAVADOR', 'jhon.lizcano@blancoynegromasivo.com.co', 1, 0),
(403, '18469747', 'LONDONO CASTANO JHON FREDY', 'OPERADOR ALIMENTADOR', 'jhon.londono@blancoynegromasivo.com.co', 1, 0),
(404, '94524901', 'LONDONO HOYOS VICTOR HUGO', 'OPERADOR ALIMENTADOR', 'victor.londono@blancoynegromasivo.com.co', 1, 0),
(405, '94426536', 'LONDONO MATALLANA JAIME ALONSO', 'OPERADOR ARTICULADO', 'jaime.londono@blancoynegromasivo.com.co', 1, 0),
(406, '16759007', 'LONDONO NUNEZ ORLANDO', 'OPERADOR PADRON', 'orlando.londono@blancoynegromasivo.com.co', 1, 0),
(407, '1143826538', 'LONDONO PANIAGUA HARRISON ENRIQUE', 'AUXILIAR DE ALMACEN', 'harrison.londono@blancoynegromasivo.com.co', 1, 0),
(408, '12975610', 'LOPEZ ALFONSO', 'OPERADOR PADRON', 'alfonso.lopez@blancoynegromasivo.com.co', 1, 0),
(409, '16539347', 'LOPEZ BUENDIA ALEJANDRO', 'MECANICO C', 'alejandro.lopez@blancoynegromasivo.com.co', 1, 0),
(410, '94397421', 'LOPEZ FLOREZ LUIS FERNANDO', 'OPERADOR PADRON', 'luis.lopez@blancoynegromasivo.com.co', 1, 0),
(411, '16750743', 'LOPEZ GIRALDO LUIS ALFREDO', 'AUXILIAR DE LLANTAS Y COMBUSTIBLE', 'alfredo.lopez@blancoynegromasivo.com.co', 1, 0),
(412, '1130593449', 'LOPEZ HERNANDEZ CRISTHIAN CAMILO', 'LAVADOR', 'cristhian.lopez@blancoynegromasivo.com.co', 1, 0),
(413, '16692426', 'LOPEZ PALMA JOSE ALIRIO', 'OPERADOR PADRON', 'jose.lopez@blancoynegromasivo.com.co', 1, 0),
(414, '94456916', 'LOPEZ RAMIREZ JUAN CARLOS', 'OPERADOR ARTICULADO', 'juan.ramirez@blancoynegromasivo.com.co', 1, 0),
(415, '16835998', 'LOPEZ ROSERO HECTOR HARVEY', 'OPERADOR PADRON', 'hector.lopez@blancoynegromasivo.com.co', 1, 0),
(416, '16741944', 'LOPEZ RUIZ RUBEN DARIO', 'OPERADOR ALIMENTADOR', 'ruben.lopez@blancoynegromasivo.com.co', 1, 0),
(417, '16676921', 'LORA LEONIDAS', 'OPERADOR ALIMENTADOR', 'leonidas.lora@blancoynegromasivo.com.co', 1, 0),
(418, '16602464', 'LOZANO CARLOS ALBERTO', 'OPERADOR PADRON', 'carlos.lozano@blancoynegromasivo.com.co', 1, 0),
(419, '16452868', 'LOZANO QUINTANA ALEXANDER', 'OPERADOR PADRON', 'alexander.lozano@blancoynegromasivo.com.co', 1, 0),
(420, '16785403', 'LUGO YULY DANIEL', 'OPERADOR PADRON', 'daniel.lugo@blancoynegromasivo.com.co', 1, 0),
(421, '1130595559', 'LULIGO IBARRA HUGO', 'OPERADOR ALIMENTADOR', 'hugo.luligo@blancoynegromasivo.com.co', 1, 0),
(422, '1057589636', 'MACIAS SILVA JUAN CARLOS', 'MECANICO C', 'juan.macias@blancoynegromasivo.com.co', 1, 0),
(423, '94313446', 'MALPUD MALPUD FRANCO IRRAEL', 'OPERADOR ALIMENTADOR', 'franco.malpud@blancoynegromasivo.com.co', 1, 0),
(424, '16931604', 'MAMBUSCAY CASTANEDA JOSIAS BOLIVAR', 'LAVADOR', 'josias.mambuscay@blancoynegromasivo.com.co', 1, 0),
(425, '16617617', 'MAMIAN SANCHEZ ELIECER', 'OPERADOR ARTICULADO', 'eliecer.mamian@blancoynegromasivo.com.co', 1, 0),
(426, '1113305583', 'MANQUILLO CASTRO YON JARO', 'LAVADOR', 'yon.manquillo@blancoynegromasivo.com.co', 1, 0),
(427, '1118292654', 'MANUNGA NOGUERA ERIK YOJAN', 'LAVADOR', 'erik.manunga@blancoynegromasivo.com.co', 1, 0),
(428, '6225909', 'MANZANO PARRA ALVARO', 'OPERADOR PADRON', 'alvaro.manzano@blancoynegromasivo.com.co', 1, 0);
INSERT INTO `atl_correo` (`id`, `cedula`, `nombre`, `cargo`, `correo`, `creado`, `eliminado`) VALUES
(429, '14675655', 'MANZANO VELEZ JOHNATHAN DE JESUS', 'OPERADOR ALIMENTADOR', 'johnathan.manzano@blancoynegromasivo.com.co', 1, 0),
(430, '94489241', 'MARIN CARMONA ALEXANDER', 'OPERADOR PADRON', 'alexander.marin@blancoynegromasivo.com.co', 1, 0),
(431, '94494730', 'MARIN DELGADO JUAN ALEXANDER', 'OPERADOR PADRON', 'juan.marin@blancoynegromasivo.com.co', 1, 0),
(432, '16536825', 'MARIN HINCAPIE DIEGO FERNANDO', 'PORTEROS', 'diego.marin@blancoynegromasivo.com.co', 1, 0),
(433, '14606485', 'MARIN MARTINEZ JAIRO ANDRES', 'OPERADOR ALIMENTADOR', 'jairo.marin@blancoynegromasivo.com.co', 1, 0),
(434, '14622491', 'MARIN OREJUELA JONATAN', 'MECANICO B', 'jonatan.marin@blancoynegromasivo.com.co', 1, 0),
(435, '16939318', 'MARIN RICARDO DUBERNEY', 'OPERADOR ALIMENTADOR', 'duberney.marin@blancoynegromasivo.com.co', 1, 0),
(436, '6138642', 'MARMOLEJO SARRIA ROELFI', 'OPERADOR ALIMENTADOR', 'roelfi.marmolejo@blancoynegromasivo.com.co', 1, 0),
(437, '14396431', 'MARTINEZ ALDANA GERMAN ALFONSO', 'OPERADOR ARTICULADO', 'german.martinez@blancoynegromasivo.com.co', 1, 0),
(438, '9091186', 'MARTINEZ ALTAMIRANO APOLINAR', 'OPERADOR ARTICULADO', 'apolinar.martinez@blancoynegromasivo.com.co', 1, 0),
(439, '1085907967', 'MARTINEZ ALVAREZ RUBEN DARIO', 'OPERADOR PADRON', 'ruben.martinez@blancoynegromasivo.com.co', 1, 0),
(440, '16736952', 'MARTINEZ BEJARANO LUIS EMILIO', 'TECNICO A JUNIOR', 'luis.martinez@blancoynegromasivo.com.co', 1, 0),
(441, '1089541499', 'MARTINEZ ORDONEZ ANGEL RUBEN', 'LAVADOR', 'angel.martinez@blancoynegromasivo.com.co', 1, 0),
(442, '1130662775', 'MARTINEZ RUIZ JUAN DAVID', 'LAVADOR', 'juan.martinez@blancoynegromasivo.com.co', 1, 0),
(443, '16793481', 'MARTINEZ SANDOVAL HOIMER FERNADO', 'OPERADOR PADRON', 'hoimer.martinez@blancoynegromasivo.com.co', 1, 0),
(444, '14637943', 'MARTINEZ VELASQUEZ DAVID', 'LAVADOR', 'david.martinez@blancoynegromasivo.com.co', 1, 0),
(445, '94418375', 'MARULANDA AVILA JUAN CARLOS', 'OPERADOR PADRON', 'juan.marulanda@blancoynegromasivo.com.co', 1, 0),
(446, '16763793', 'MATALLANA CUBILLOS ALFREDO', 'OPERADOR PADRON', 'alfredo.matallana@blancoynegromasivo.com.co', 1, 0),
(447, '1130643380', 'MAYA BARBOSA ALFONSO', 'MECANICO C', 'alfonso.maya@blancoynegromasivo.com.co', 1, 0),
(448, '1144161599', 'MAYA BARBOSA CHRISTIAN DAVID', 'MECANICO C', 'christian.maya@blancoynegromasivo.com.co', 1, 0),
(449, '94383171', 'MEDINA ACOSTA JUAN CARLOS', 'OPERADOR ARTICULADO', 'juan.medina@blancoynegromasivo.com.co', 1, 0),
(450, '16287549', 'MEDINA CARLOS ANDRES', 'LAVADOR', 'carlos.medina@blancoynegromasivo.com.co', 1, 0),
(451, '31573385', 'MEDINA MARTINEZ CAROLINA', 'AUXILIAR DE RRHH', 'carolina.medina@blancoynegromasivo.com.co', 1, 0),
(452, '8016506', 'MEDINA PEREZ JOHN FERNANDO', 'OPERADOR PADRON', 'john.medina@blancoynegromasivo.com.co', 1, 0),
(453, '94526200', 'MEJIA CASTRO EIDER', 'OPERADOR ALIMENTADOR', 'eider.mejia@blancoynegromasivo.com.co', 1, 0),
(454, '94517409', 'MEJIA GONZALEZ SERGIO ALFONSO', 'OPERADOR PADRON', 'sergio.mejia@blancoynegromasivo.com.co', 1, 0),
(455, '94062897', 'MEJIA RAMOS LEON DENIS', 'OPERADOR ALIMENTADOR', 'leon.mejia@blancoynegromasivo.com.co', 1, 0),
(456, '16718528', 'MEJIA VARGAS FRANCISCO JHONY', 'FLOTA AUXILIAR', 'francisco.mejia@blancoynegromasivo.com.co', 1, 0),
(457, '76090136', 'MELENDEZ CAICEDO HENRY ORLANDO', 'OPERADOR ARTICULADO', 'henry.melendez@blancoynegromasivo.com.co', 1, 0),
(458, '87490141', 'MELO CERON SEGUNDO FLORENTINO', 'OPERADOR PADRON', 'segundo.melo@blancoynegromasivo.com.co', 1, 0),
(459, '12131132', 'MENDEZ CAMACHO GABRIEL', 'OPERADOR ARTICULADO', 'gabriel.mendez@blancoynegromasivo.com.co', 1, 0),
(460, '1130670718', 'MENDEZ JAIME ALBERTO', 'OPERADOR PADRON', 'jaime.mendez@blancoynegromasivo.com.co', 1, 0),
(461, '1061018414', 'MENESES ENRIQUEZ EIDER ARLEYO', 'LAVADOR', 'eider.meneses@blancoynegromasivo.com.co', 1, 0),
(462, '94276794', 'MEZA SERNA BEIMAN HERNAN', 'OPERADOR PADRON', 'beiman.meza@blancoynegromasivo.com.co', 1, 0),
(463, '94280309', 'MIRANDA PELAEZ JOSE ARVEY', 'OPERADOR ARTICULADO', 'jose.miranda@blancoynegromasivo.com.co', 1, 0),
(464, '93387893', 'MOLINA ALEXANDER', 'OPERADOR ARTICULADO', 'alexander.molina@blancoynegromasivo.com.co', 1, 0),
(465, '94403554', 'MOLINA ARAGON HECTOR FABIO', 'OPERADOR PADRON', 'hector.molina@blancoynegromasivo.com.co', 1, 0),
(466, '16257083', 'MOLINA BETANCOURTH ABRAHAN', 'OPERADOR ARTICULADO', 'abraham.molina@blancoynegromasivo.com.co', 1, 0),
(467, '6320703', 'MOLINA MOLINA JHON EDILSON', 'PORTEROS', 'jhon.molina@blancoynegromasivo.com.co', 1, 0),
(468, '1144055153', 'MOLINA MORA RUBEN ANTONIO', 'OPERADOR ALIMENTADOR', 'ruben.molina@blancoynegromasivo.com.co', 1, 0),
(469, '17653589', 'MOLINA PENA WLADIMIR', 'OPERADOR PADRON', 'wladimir.molina@blancoynegromasivo.com.co', 1, 0),
(470, '16716700', 'MOLINA RIVERA ALBERTO', 'OPERADOR PADRON', 'alberto.molina@blancoynegromasivo.com.co', 1, 0),
(471, '14606681', 'MONCADA ORTIZ RONALD', 'OPERADOR PADRON', 'ronald.moncada@blancoynegromasivo.com.co', 1, 0),
(472, '16832923', 'MONDRAGON ACUNA JUAN CARLOS', 'OPERADOR ARTICULADO', 'juan.mondragon@blancoynegromasivo.com.co', 1, 0),
(473, '16892102', 'MONTANO CAICEDO ARMANDO', 'OPERADOR PADRON', 'armando.montano@blancoynegromasivo.com.co', 1, 0),
(474, '1059447027', 'MONTANO SANCHEZ ALBERTO FERNANDO', 'LAVADOR', 'alberto.montano@blancoynegromasivo.com.co', 1, 0),
(475, '16744710', 'MONTANO VALENCIA BEHNUR', 'OPERADOR PADRON', 'behnur.montano@blancoynegromasivo.com.co', 1, 0),
(476, '16640521', 'MONTES DE OCA QUIMBAYA LUIS EDUARDO', 'OPERADOR PADRON', 'luis.montes@blancoynegromasivo.com.co', 1, 0),
(477, '94403590', 'MONTES GIRALDO DIEGO MAURICIO', 'OPERADOR PADRON', 'diego.montes@blancoynegromasivo.com.co', 1, 0),
(478, '1143843399', 'MONTES GONZALEZ STEVEN ALEJANDRO', 'LAVADOR', 'steven.montes@blancoynegromasivo.com.co', 1, 0),
(479, '94287386', 'MONTOYA CARDONA INDERMAN', 'OPERADOR ALIMENTADOR', 'inderman.montoya@blancoynegromasivo.com.co', 1, 0),
(480, '16227597', 'MONTOYA GIL VITELIO', 'COORDINADOR DE LAVADO', 'vitelio.montoya@blancoynegromasivo.com.co', 1, 0),
(481, '16733857', 'MONTOYA IGLESIAS JESUS ORLANDO', 'OPERADOR PADRON', 'jesus.montoya@blancoynegromasivo.com.co', 1, 0),
(482, '93371785', 'MONTOYA VANEGAS EDINSON', 'OPERADOR ALIMENTADOR', 'edinson.montoya@blancoynegromasivo.com.co', 1, 0),
(483, '10199560', 'MONTOYA ZAPATA GERMAN DE JESUS', 'OPERADOR PADRON', 'german.montoya@blancoynegromasivo.com.co', 1, 0),
(484, '1107041271', 'MORA LENIS ALEXANDER', 'OPERADOR PADRON', 'alexander.mora@blancoynegromasivo.com.co', 1, 0),
(485, '1107036369', 'MORA ORDONEZ NOHORA JULIETH', 'ASISTENTE DE OPERACIONES', 'nohora.mora@blancoynegromasivo.com.co', 1, 0),
(486, '94531771', 'MORALES AGUILAR NELSON FABIAN', 'OPERADOR PADRON', 'nelson.morales@blancoynegromasivo.com.co', 1, 0),
(487, '4453664', 'MORALES BURITICA HERNAN', 'OPERADOR ARTICULADO', 'hernan.morales@blancoynegromasivo.com.co', 1, 0),
(488, '1130615591', 'MORALES CABRERA MICHAEL STEVENS', 'OPERADOR ALIMENTADOR', 'michael.morales@blancoynegromasivo.com.co', 1, 0),
(489, '94453337', 'MORALES GOMEZ VICTOR MARIO', 'OPERADOR PADRON', 'victor.morales@blancoynegromasivo.com.co', 1, 0),
(490, '38558150', 'MORALES HENAO SILVIA MARIA', 'DIRECTOR FINANCIERO', 'silvia.morales@blancoynegromasivo.com.co', 1, 0),
(491, '16659550', 'MORALES JAQUE FERNANDO', 'OPERADOR ARTICULADO', 'fernando.morales@blancoynegromasivo.com.co', 1, 0),
(492, '16496525', 'MORENO BONILLA JOHN JAIRO', 'OPERADOR ALIMENTADOR', 'john.moreno@blancoynegromasivo.com.co', 1, 0),
(493, '16593595', 'MORENO BRITO EDINSON', 'OPERADOR ALIMENTADOR', 'edinson.brito@blancoynegromasivo.com.co', 1, 0),
(494, '94313672', 'MORENO GARZON GEREMIAS', 'FLOTA AUXILIAR', 'geremias.moreno@blancoynegromasivo.com.co', 1, 0),
(495, '16589057', 'MORENO GUZMAN ALVARO', 'MECANICO B', 'alvaro.moreno@blancoynegromasivo.com.co', 1, 0),
(496, '94415371', 'MORENO LUNA EDINSON FABIAN', 'OPERADOR ALIMENTADOR', 'edinson.moreno@blancoynegromasivo.com.co', 1, 0),
(497, '94432304', 'MOSQUERA BRITO OSCAR EDUARDO', 'OPERADOR PADRON', 'oscar.mosquera@blancoynegromasivo.com.co', 1, 0),
(498, '16665838', 'MOSQUERA FITZGERALD LUIS FERNANDO', 'OPERADOR ARTICULADO', 'luis.mosquera@blancoynegromasivo.com.co', 1, 0),
(499, '93407843', 'MOSQUERA HURTADO LUIS ELIAS', 'OPERADOR ALIMENTADOR', 'luis.hurtado@blancoynegromasivo.com.co', 1, 0),
(500, '1113517798', 'MOSQUERA JEFFERSON', 'LAVADOR', 'jefferson.mosquera@blancoynegromasivo.com.c', 1, 0),
(501, '1130646595', 'MOSQUERA MOSQUERA JORGE OTONIEL', 'MECANICO C', 'otoniel.mosquera@blancoynegromasivo.com.co', 1, 0),
(502, '16286883', 'MOSQUERA NANEZ SANDRO', 'OPERADOR ALIMENTADOR', 'sandro.mosquera@blancoynegromasivo.com.co', 1, 0),
(503, '16737515', 'MOSQUERA RIVAS JOSE ALBIN', 'MECANICO A', 'jose.mosquera@blancoynegromasivo.com.co', 1, 0),
(504, '1143929511', 'MOSQUERA TORRES CRISTHIAN ALEXANDER', 'LAVADOR', 'cristhian.mosquera@blancoynegromasivo.com.c', 1, 0),
(505, '94541886', 'MOSQUERA VALDERRAMA MANUEL ALBERTO', 'LAVADOR', 'alberto.mosquera@blancoynegromasivo.com.co', 1, 0),
(506, '16885891', 'MUNARES CANAS ARBEY', 'OPERADOR ARTICULADO', 'arbey.munares@blancoynegromasivo.com.co', 1, 0),
(507, '94511937', 'MUNOZ ALEXANDER', 'OPERADOR PADRON', 'alexander.munoz@blancoynegromasivo.com.co', 1, 0),
(508, '94421851', 'MUNOZ BERMUDEZ JOHN EYDER', 'OPERADOR ALIMENTADOR', 'jhon.bermudez@blancoynegromasivo.com.co', 1, 0),
(509, '14624934', 'MUNOZ CAICEDO ANDRES HERNANDO', 'OPERADOR PADRON', 'andres.munoz@blancoynegromasivo.com.co', 1, 0),
(510, '16927882', 'MUNOZ DELGADO JULIAN FERNANDO', 'OPERADOR PADRON', 'julian.munoz@blancoynegromasivo.com.co', 1, 0),
(511, '16678822', 'MUNOZ FONSECA MAXIMO ANTONIO', 'OPERADOR ALIMENTADOR', 'maximo.munoz@blancoynegromasivo.com.co', 1, 0),
(512, '1144028094', 'MUNOZ GARCIA JEFFERSON', 'COORDINADOR', 'jefferson.munoz@blancoynegromasivo.com.co', 1, 0),
(513, '94376002', 'MUNOZ GUERRERO MILTON EVELIO', 'OPERADOR PADRON', 'milton.munoz@blancoynegromasivo.com.co', 1, 0),
(514, '1144125516', 'MUNOZ GUTIERREZ HAROLD', 'LAVADOR', 'harold.munoz@blancoynegromasivo.com.co', 1, 0),
(515, '16831680', 'MUNOZ MONTOYA ALEXANDER DE JESUS', 'OPERADOR PADRON', 'alexander.montoya@blancoynegromasivo.com.co', 1, 0),
(516, '83042933', 'MUNOZ MUNOZ DELMAR YOVANY', 'OPERADOR PADRON', 'delmar.munoz@blancoynegromasivo.com.co', 1, 0),
(517, '1143840202', 'MUNOZ RODRIGUEZ ANDRES FELIPE', 'OPERADOR ALIMENTADOR', 'andres.munoz@blancoynegromasivo.com.co', 1, 0),
(518, '94375558', 'MURIEL QUINTERO ALEXANDER', 'OPERADOR ALIMENTADOR', 'alexander.muriel@blancoynegromasivo.com.co', 1, 0),
(519, '16622943', 'NANEZ ARCINIEGAS EUGENIO', 'OPERADOR ALIMENTADOR', 'eugenio.nanez@blancoynegromasivo.com.co', 1, 0),
(520, '10482867', 'NARANJO AGUDELO WILLIAM', 'OPERADOR ALIMENTADOR', 'william.naranjo@blancoynegromasivo.com.co', 1, 0),
(521, '1130657011', 'NARVAEZ ABADIA ANDRES FELIPE', 'MECANICO C', 'andres.narvaez@blancoynegromasivo.com.co', 1, 0),
(522, '16784991', 'NAVARRETE BUITRAGO RODOLFO', 'OPERADOR ARTICULADO', 'rodolfo.navarrete@blancoynegromasivo.com.co', 1, 0),
(523, '1130621648', 'NAVIA CALDAS CARLOS JULIO', 'OPERADOR ALIMENTADOR', 'carlos.navia@blancoynegromasivo.com.co', 1, 0),
(524, '6107777', 'NIETO AGUDELO ARNOL ELIAS', 'OPERADOR ALIMENTADOR', 'arnol.nieto@blancoynegromasivo.com.co', 1, 0),
(525, '6404182', 'NIETO HERNANDEZ JOSE ALVEIRO', 'FLOTA AUXILIAR', 'jose.nieto@blancoynegromasivo.com.co', 1, 0),
(526, '94296437', 'NIETO NIETO JUAN MARIO', 'OPERADOR ARTICULADO', 'juan.nieto@blancoynegromasivo.com.co', 1, 0),
(527, '1061705119', 'NOGUERA BOLANOS JHONY ALEXANDER', 'OPERADOR PADRON', 'jhony.noguera@blancoynegromasivo.com.co', 1, 0),
(528, '14679133', 'NOGUERA CANAVERAL LIZANDRO', 'AUXILIAR DE PINTURA', 'lizandro.noguera@blancoynegromasivo.com.co', 1, 0),
(529, '71750860', 'NORENA SEPULVEDA CARLOS HUMBERTO', 'OPERADOR ARTICULADO', 'carlos.norena@blancoynegromasivo.com.co', 1, 0),
(530, '94507272', 'NORIEGA CALDERON ARMANDO', 'OPERADOR PADRON', 'armando.noriega@blancoynegromasivo.com.co', 1, 0),
(531, '94071993', 'NORIEGA CALDERON FAIVER', 'OPERADOR ARTICULADO', 'faiver.noriega@blancoynegromasivo.com.co', 1, 0),
(532, '94450180', 'NUNEZ BONILLA YIMMI ALBERTO', 'OPERADOR PADRON', 'yimmi.nunez@blancoynegromasivo.com.co', 1, 0),
(533, '14678619', 'NUNEZ GONZALEZ ANDERSON', 'SUPERVISOR MANTENIMIENTO', 'anderson.nunez@blancoynegromasivo.com.co', 1, 0),
(534, '14703641', 'NUNEZ OSPINA OCTAVIO', 'OPERADOR PADRON', 'octavio.nunez@blancoynegromasivo.com.co', 1, 0),
(535, '94460988', 'OCAMPO BEDOYA JOHN JAMES', 'OPERADOR ARTICULADO', 'jhon.ocampo@blancoynegromasivo.com.co', 1, 0),
(536, '79210422', 'OLAVE DIAZ JORGE', 'OPERADOR ARTICULADO', 'jorge.olave@blancoynegromasivo.com.co', 1, 0),
(537, '16985421', 'OLAVE GARCIA GERMAN', 'OPERADOR ARTICULADO', 'german.olave@blancoynegromasivo.com.co', 1, 0),
(538, '1130628392', 'OLAVE LOPEZ EDWIN', 'OPERADOR ARTICULADO', 'edwin.olave@blancoynegromasivo.com.co', 1, 0),
(539, '94497177', 'OLAVE PARRA MAURICIO', 'OPERADOR PADRON', 'mauricio.olave@blancoynegromasivo.com.co', 1, 0),
(540, '16699324', 'OLAYA OLAYA HECTOR FABIO', 'OPERADOR ALIMENTADOR', 'hector.olaya@blancoynegromasivo.com.co', 1, 0),
(541, '16774181', 'ORDONEZ CALERO JOSE FERNANDO', 'OPERADOR ALIMENTADOR', 'jose.ordonez@blancoynegromasivo.com.co', 1, 0),
(542, '1144047283', 'ORDONEZ ORDONEZ MAURICIO EDUARDO', 'LAVADOR', 'mauricio.ordonez@blancoynegromasivo.com.co', 1, 0),
(543, '14622071', 'OREJUELA GOMEZ HERNANDO JUNIOR', 'TECNICO B PATIO', 'hernando.orejuela@blancoynegromasivo.com.co', 1, 0),
(544, '1096032981', 'ORJUELA OCAMPO ANGEL ARIEL', 'OPERADOR PADRON', 'angel.orjuela@blancoynegromasivo.com.co', 1, 0),
(545, '10347125', 'OROZCO ARTUNDUAGA DIDIER MAURICIO', 'COORDINADOR', 'didier.orozco@blancoynegromasivo.com.co', 1, 0),
(546, '94304731', 'OROZCO CARLOS HOMERO', 'COORDINADOR', 'homero.orozco@blancoynegromasivo.com.co', 1, 0),
(547, '10499286', 'OROZCO MOSQUERA JHON LEYMAR', 'MECANICO A JUNIOR', 'jhon.orozco@blancoynegromasivo.com.co', 1, 0),
(548, '1062284485', 'OROZCO MURILLO GERMAN EDUARDO', 'OPERADOR ALIMENTADOR', 'german.orozco@blancoynegromasivo.com.co', 1, 0),
(549, '1062290290', 'OROZCO MURILLO JORGE IVAN', 'OPERADOR ALIMENTADOR', 'jorge.orozco@blancoynegromasivo.com.co', 1, 0),
(550, '94539059', 'ORREGO CARRANZA HOLMAN SMITH', 'OPERADOR ALIMENTADOR', 'holman.orrego@blancoynegromasivo.com.co', 1, 0),
(551, '94533445', 'ORTEGA CASANOVA DEOMIR', 'OPERADOR PADRON', 'deomir.ortega@blancoynegromasivo.com.co', 1, 0),
(552, '16795807', 'ORTEGA ROMERO HECTOR EFRAIN', 'OPERADOR PADRON', 'hector.ortega@blancoynegromasivo.com.co', 1, 0),
(553, '1130602901', 'ORTIZ FLOREZ CRISTIAN DAVID', 'MECANICO C', 'cristian.ortiz@blancoynegromasivo.com..co', 1, 0),
(554, '16655086', 'ORTIZ GARCES JOSE LUIS', 'OPERADOR PADRON', 'jose.ortiz@blancoynegromasivo.com.co', 1, 0),
(555, '1059909949', 'ORTIZ HURTADO EDWIN ANDRES', 'LAVADOR', 'edwin.ortiz@blancoynegromasivo.com.co', 1, 0),
(556, '12230454', 'ORTIZ MARTINEZ CARLOS JULIO', 'OPERADOR ARTICULADO', 'carlos.ortiz@blancoynegromasivo.com.co', 1, 0),
(557, '1114817386', 'ORTIZ MESA ASNETH YUSETH', 'LAVADOR', 'asneth.ortiz@blancoynegromasivo.com.co', 1, 0),
(558, '6254414', 'ORTIZ MESA JULIO CESAR', 'OPERADOR PADRON', 'julio.ortiz@blancoynegromasivo.com.co', 1, 0),
(559, '12237790', 'ORTIZ ORTIZ EIVAR', 'PORTEROS', 'eivar.ortiz@blancoynegromasivo.com.co', 1, 0),
(560, '94419168', 'ORTIZ RENGIFO HERNANDO', 'OPERADOR PADRON', 'hernando.ortiz@blancoynegromasivo.com.co', 1, 0),
(561, '16783923', 'ORTIZ RODRIGUEZ CARLOS ALBERTO', 'OPERADOR ALIMENTADOR', 'carlos.ortiz@blancoynegromasivo.com.co', 1, 0),
(562, '94375044', 'OSORIO PEREZ WALDRIDO', 'OPERADOR ALIMENTADOR', 'waldrido.osorio@blancoynegromasivo.com.co', 1, 0),
(563, '75056092', 'OSORIO ZULUAGA DARIO', 'OPERADOR PADRON', 'dario.osorio@blancoynegromasivo.com.co', 1, 0),
(564, '16794344', 'OSPINA FRESNEDA JHON JAIRO', 'OPERADOR PADRON', 'jhon.ospina@blancoynegromasivo.com.co', 1, 0),
(565, '84033184', 'OSPINA MUNOZ CARLOS ALBERTO', 'OPERADOR PADRON', 'carlos.ospina@blancoynegromasivo.com.co', 1, 0),
(566, '16731343', 'OSPINA SEMANATE JAIME', 'OPERADOR ALIMENTADOR', 'jaime.ospina@blancoynegromasivo.com.co', 1, 0),
(567, '94228619', 'OSPINA TORRES DIEGO HUMBERTO', 'OPERADOR ARTICULADO', 'diego.ospina@blancoynegromasivo.com.co', 1, 0),
(568, '94543748', 'OSUNA LOZANO JULIO CESAR', 'OPERADOR PADRON', 'julio.osuna@blancoynegromasivo.com.co', 1, 0),
(569, '16759274', 'OTALVARO JORGE GERMAN', 'OPERADOR PADRON', 'jorge.otalvaro@blancoynegromasivo.com.co', 1, 0),
(570, '94383325', 'OYOLA OVIEDO HERNAN', 'MECANICO A JUNIOR', 'hernan.oyola@blancoynegromasivo.com.co', 1, 0),
(571, '16376302', 'PACHECO SEPULVEDA FRANCISCO JAVIER', 'OPERADOR PADRON', 'francisco.pacheco@blancoynegromasivo.com.co', 1, 0),
(572, '98352779', 'PAGUAY YAPUD EDGAR HUMBERTO', 'OPERADOR ALIMENTADOR', 'edgar.paguay@blancoynegromasivo.com.co', 1, 0),
(573, '16459611', 'PALACIOS GIRALDO ALVARO', 'OPERADOR ALIMENTADOR', 'alvaro.palacios@blancoynegromasivo.com.co', 1, 0),
(574, '16759799', 'PALTA ZANABRIA JESUS NACIANCENO', 'OPERADOR PADRON', 'jesus.palta@blancoynegromasivo.com.co', 1, 0),
(575, '16940871', 'PANTOJA BAZANTE WILLIAM RICARDO', 'OPERADOR ALIMENTADOR', 'william.pantoja@blancoynegromasivo.com.co', 1, 0),
(576, '94043614', 'PANTOJA CARLOS FERNANDO', 'OPERADOR PADRON', 'carlos.pantoja@blancoynegromasivo.com.co', 1, 0),
(577, '94431478', 'PANTOJA CARLOSAMA ERIBERTO', 'OPERADOR ALIMENTADOR', 'eriberto.pantoja@blacnoynegromasivo.com.co', 1, 0),
(578, '80269732', 'PARRA AGUIRRE JOSE ROBERTO', 'OPERADOR ALIMENTADOR', 'jose.parra@blancoynegromasivo.com.co', 1, 0),
(579, '94493135', 'PARRA IBANEZ DIEGO FERNANDO', 'OPERADOR ARTICULADO', 'diego.parra@blancoynegromasivo.com.co', 1, 0),
(580, '94531335', 'PARRA RICO LUIS MANUEL', 'OPERADOR ALIMENTADOR', 'luis.parra@blancoynegromasivo.com.co', 1, 0),
(581, '16652264', 'PATINO VALENCIA WILSON', 'OPERADOR ARTICULADO', 'wilson.patino@blancoynegromasivo.com.co', 1, 0),
(582, '94295002', 'PAZ MICOLTA JAMES ALBERTO', 'OPERADOR PADRON', 'james.paz@blancoynegromasivo.com.co', 1, 0),
(583, '16654426', 'PENA FRANKY PEDRO JOSE', 'OPERADOR ARTICULADO', 'pedro.pena@blancoynegromasivo.com.co', 1, 0),
(584, '1118300478', 'PENUELA SALAZAR DIEGO ALEXANDER', 'MECANICO C', 'diego.penuela@blancoynegromasivo.com.co', 1, 0),
(585, '16781082', 'PEREZ CARLOS ARTURO', 'OPERADOR PADRON', 'arturo.perez@blancoynegromasivo.com.co', 1, 0),
(586, '16929473', 'PEREZ CASTRO EDWIN JOSE', 'OPERADOR PADRON', 'edwin.perez@blancoynegromasivo.com.co', 1, 0),
(587, '1143954148', 'PEREZ DIAZ ABELARDO ANTONIO', 'LAVADOR', 'abelardo.perez@blancoynegromasivo.com.co', 1, 0),
(588, '16932991', 'PEREZ GUANARITA WILLIAM', 'OPERADOR ALIMENTADOR', 'william.perez@blancoynegromasivo.com.co', 1, 0),
(589, '16648236', 'PEREZ QUINTERO GUSTAVO ADOLFO', 'OPERADOR PADRON', 'gustavo.perez@blancoynegromasivo.com.co', 1, 0),
(590, '16639188', 'PEREZ RIVERA JAIRO', 'OPERADOR PADRON', 'jairo.perez@blancoynegromasivo.com.co', 1, 0),
(591, '16989734', 'PERIANEZ HERNANDEZ VICTOR HUGO', 'OPERADOR PADRON', 'victor.perianez@blancoynegromasivo.com.co', 1, 0),
(592, '1114451580', 'PINO DUQUE CRISTHIAN HERNEY', 'MECANICO C', 'cristhian.pino@blancoynegromasivo.com.co', 1, 0),
(593, '18386632', 'PINZON OSORIO ABSALON', 'OPERADOR ARTICULADO', 'absalon.pinzon@blancoynegromasivo.com.co', 1, 0),
(594, '94071249', 'POLANIA MONTOYA HENRY GUSTAVO', 'JEFE DE TALLER AUXILIAR', 'henry.polania@blancoynegromasivo.com.co', 1, 0),
(595, '16726805', 'POLINDARA POLINDARA JAVIER', 'OPERADOR ARTICULADO', 'javier.polindara@blancoynegromasivo.com.co', 1, 0),
(596, '16682228', 'POSADA TORO HERNAN', 'OPERADOR ARTICULADO', 'hernan.posada@blancoynegromasivo.com.co', 1, 0),
(597, '11297072', 'PRADA VEGA CARLOS ALBERTO', 'OPERADOR ARTICULADO', 'carlos.prada@blancoynegromasivo.com.co', 1, 0),
(598, '16269513', 'PRADA VEGA HAMES', 'OPERADOR ARTICULADO', 'hames.prada@blancoynegromasivo.com.co', 1, 0),
(599, '1144160472', 'PUENTES CASTILLO YEISON FERNANDO', 'AUXILIAR DE PINTURA', 'yeison.puentes@blancoynegromasivo.com.co', 1, 0),
(600, '16718416', 'PUENTES MOSQUERA FELIX ADOLFO', 'OPERADOR ARTICULADO', 'felix.puentes@blancoynegromasivo.com.co', 1, 0),
(601, '16636604', 'QUESADA PIZARRO CARLOS ALBERTO', 'OPERADOR PADRON', 'carlos.quesada@blancoynegromasivo.com.co', 1, 0),
(602, '1130609357', 'QUETAMA RODRIGUEZ JULIAN ANDRES', 'MECANICO B', 'julian.quetama@blancoynegromasivo.com.co', 1, 0),
(603, '6524841', 'QUICENO BUITRAGO MANUEL OCTAVIO', 'OPERADOR ALIMENTADOR', 'manuel.quiceno@blancoynegromasivo.com.co', 1, 0),
(604, '16796899', 'QUIMBAY ARIAS JOSE RAMIRO', 'OPERADOR PADRON', 'jose.quimbay@blancoynegromasivo.com.co', 1, 0),
(605, '1087123056', 'QUINONES CAICEDO LUIS VALERIO', 'LAVADOR', 'luis.quinonez@blancoynegromasivo.com.co', 1, 0),
(606, '1087107567', 'QUINONES CARLOS JADER', 'LAVADOR', 'carlos.quinones@blancoynegromasivo.com.co', 1, 0),
(607, '1143924954', 'QUINONES PALACIOS LUIS JAMINSON', 'LAVADOR', 'luis.palacios@blancoynegromasivo.com.co', 1, 0),
(608, '94499942', 'QUINONEZ DAJOMES JANIER MANUEL', 'MECANICO C', 'janier.quinonez@blancoynegromasivo.com.co', 1, 0),
(609, '94551249', 'QUINONEZ URRUTIA CARLOS ANDRES', 'MECANICO B', 'carlos.quinonez@blancoynegromasivo.com.co', 1, 0),
(610, '94417623', 'QUINONEZ VALENTIERRA FAVER', 'OPERADOR PADRON', 'faver.quinonez@blancoynegromasivo.com.co', 1, 0),
(611, '6013565', 'QUINTANA GIRALDO DANIN', 'OPERADOR ARTICULADO', 'danin.quintana@blancoynegromasivo.com.co', 1, 0),
(612, '1143842995', 'QUINTERO GUTIERREZ LUIS DAVID', 'OPERADOR ALIMENTADOR', 'luis.quintero@blancoynegromasivo.com.co', 1, 0),
(613, '94375272', 'QUINTERO IZQUIERDO VICTOR HUGO', 'OPERADOR PADRON', 'victor.quintero@blancoynegromasivo.com.co', 1, 0),
(614, '94044422', 'QUINTERO MARTINEZ HAMILTON', 'OPERADOR PADRON', 'hamilton.quintero@blancoynegromasivo.com.co', 1, 0),
(615, '16700859', 'QUINTERO PADILLA JAMES', 'OPERADOR ARTICULADO', 'james.quintero@blancoynegromasivo.com.co', 1, 0),
(616, '1130635872', 'QUIROS LONDONO JORGE ARMANDO', 'OPERADOR PADRON', 'jorge.quiros@blancoynegromasivo.com.co', 1, 0),
(617, '94413140', 'QUITIAN HERRERA HECTOR MIGUEL', 'OPERADOR PADRON', 'hector.quitian@blancoynegromasivo.com.co', 1, 0),
(618, '1114877157', 'RAMIREZ ARCE ROBEIRO', 'MECANICO B', 'robeiro.ramirez@blancoynegromasivo.com.co', 1, 0),
(619, '67013524', 'RAMIREZ CASTANO DIANA PATRICIA', 'PROFESIONAL DE SELECCION Y DESARROLL', 'diana.ramirez@blancoynegromasivo.com.co', 1, 0),
(620, '94360702', 'RAMIREZ CHAGUENDO GEISON', 'OPERADOR ARTICULADO', 'geison.ramirez@blancoynegromasivo.com.co', 1, 0),
(621, '4653094', 'RAMIREZ DIAZ EDINSON', 'OPERADOR PADRON', 'edinson.ramirez@blancoynegromasivo.com.co', 1, 0),
(622, '16684081', 'RAMIREZ ESCOBAR WILLIAM', 'OPERADOR PADRON', 'william.ramirez@blancoynegromasivo.com.co', 1, 0),
(623, '16927323', 'RAMIREZ GONZALEZ HECTOR FERNANDO', 'OPERADOR ALIMENTADOR', 'hector.ramirez@blancoynegromasivo.com.co', 1, 0),
(624, '94518291', 'RAMIREZ MONTOYA JULIAN ANDRES', 'OPERADOR ARTICULADO', 'julian.ramirez@blancoynegromasivo.com.co', 1, 0),
(625, '75147460', 'RAMIREZ OTALVARO JOSE ALEJANDRO', 'DIRECTOR DE GESTION INTEGRAL', 'alejandro.ramirez@blancoynegromasivo.com.co', 1, 0),
(626, '16941709', 'RAMIREZ TELLO ISAIAS', 'OPERADOR PADRON', 'isaias.ramirez@blancoynegromasivo.com.co', 1, 0),
(627, '94523919', 'RAMIREZ VILLA JAVIER', 'OPERADOR ALIMENTADOR', 'javier.ramirez@blancoynegromasivo.com.co', 1, 0),
(628, '94452196', 'RAMIREZ VILLADA LUIS FERNANDO', 'OPERADOR PADRON', 'luis.ramirez@blancoynegromasivo.com.co', 1, 0),
(629, '16446123', 'RAMIREZ ZAPATA BERNARDO', 'FLOTA AUXILIAR', 'bernardo.ramirez@blancoynegromasivo.com.co', 1, 0),
(630, '94428903', 'RAMOS MOLINA OLMAR FERNANDO', 'OPERADOR PADRON', 'olmar.ramos@blancoynegromasivo.com.co', 1, 0),
(631, '94371154', 'REALPE CHARRIA CARLOS ALBERTO', 'OPERADOR PADRON', 'carlos.realpe@blancoynegromasivo.com.co', 1, 0),
(632, '80715817', 'REINA MANRIQUE MANUEL ALEJANDRO', 'MENSAJERO', 'manuel.reina@blancoynegromasivo.com.co', 1, 0),
(633, '16767071', 'RENGIFO FAJARDO RODRIGO', 'OPERADOR ARTICULADO', 'rodrigo.rengifo@blancoynegromasivo.com.co', 1, 0),
(634, '31306026', 'RENGIFO LOZADA DYAN JINETH', 'PSICOLOGA', 'dyan.rengifo@blancoynegromasivo.com.co', 1, 0),
(635, '16765907', 'RENGIFO RIOS ALEXANDER', 'OPERADOR PADRON', 'alexander.rengifo@blancoynegromasivo.com.co', 1, 0),
(636, '1118298713', 'RENTERIA CUAJI ALEXANDER', 'LAVADOR', 'alexander.renteria@blancoynegromasivo.com.c', 1, 0),
(637, '16734571', 'RENTERIA VICTOR ALONSO', 'OPERADOR PADRON', 'victor.renteria@blancoynegromasivo.com.co', 1, 0),
(638, '94282563', 'RESTREPO AGUDELO NORBEY', 'OPERADOR ALIMENTADOR', 'norbey.restrepo@blancoynegromasivo.com.co', 1, 0),
(639, '6112192', 'RESTREPO IDARRAGA FERNANDO', 'COORDINADOR', 'fernando.restrepo@blancoynegromasivo.com.co', 1, 0),
(640, '1118285520', 'RESTREPO LOPEZ JHON JAIRO', 'OPERADOR ALIMENTADOR', 'jhon.restrepo@blancoynegromasivo.com.co.', 1, 0),
(641, '6407267', 'RESTREPO RESTREPO CESAR AUGUSTO', 'OPERADOR PADRON', 'cesar.restrepo@blancoynegromasivo.com.co', 1, 0),
(642, '94357465', 'RESTREPO TELLO IVAN', 'OPERADOR ALIMENTADOR', 'ivan.restrepo@blancoynegromasivo.com.co', 1, 0),
(643, '1130599100', 'RESTREPO TORRES JOSE LUIS', 'OPERADOR ALIMENTADOR', 'jose.restrepo@blancoynegromasivo.com.co', 1, 0),
(644, '1114727546', 'REYES EDWIN ANDRES', 'OPERADOR PADRON', 'edwin.reyes@blancoynegromasivo.com.co', 1, 0),
(645, '76350732', 'REYES FLOREZ JESUS ALBEIRO', 'OPERADOR ALIMENTADOR', 'jesus.reyes@blancoynegromasivo.com.co', 1, 0),
(646, '16461505', 'REYES GUEVARA CARLOS ANDRES', 'OPERADOR PADRON', 'carlos.reyes@blancoynegromasivo.com.co', 1, 0),
(647, '94525020', 'RIASCOS CASTILLO ANDRES FERNANDO', 'MECANICO C', 'andres.riascos@blancoynegromasivo.com.co', 1, 0),
(648, '76045324', 'RIASCOS GUALGUAN JOHN ALEXANDER', 'OPERADOR ARTICULADO', 'jhon.riascos@blancoynegromasivo.com.co', 1, 0),
(649, '94532193', 'RIASCOS JEFFERSON', 'OPERADOR PADRON', 'jefferson.riascos@blancoynegromasivo.com.co', 1, 0),
(650, '2677054', 'RIASCOS RAMIREZ JAVIER ANTONIO', 'OPERADOR PADRON', 'javier.riascos@blancoynegromasivo.com.co', 1, 0),
(651, '1107045989', 'RIASCOS RENTERIA AURELIO', 'LAVADOR', 'aurelio.riascos@blancoynegromasivo.com.co', 1, 0),
(652, '4647661', 'RICO RAMOS JESUS EDGAR', 'OPERADOR PADRON', 'jesus.rico@blancoynegromasivo.com.co', 1, 0),
(653, '16845900', 'RIOS LOPEZ GUSTAVO ANDRES', 'PROFESIONAL JUNIOR DE PLANEACION', 'gustavo.rios@blancoynegromasivo.com.co', 1, 0),
(654, '1144067360', 'RIOS LOPEZ JHOAN FELIPE', 'LAVADOR', 'jhoan.rios@blancoynegromasivo.com.co', 1, 0),
(655, '16076978', 'RIOS MEDINA DIEGO FERNANDO', 'OPERADOR PADRON', 'diego.rios@blancoynegromasivo.com.co', 1, 0),
(656, '16493554', 'RIOS MUNOZ GIOVANNI', 'OPERADOR ARTICULADO', 'giovanni.rios@blancoynegromasivo.com.co', 1, 0),
(657, '94295852', 'RIOS VARELA JORGE HUMBERTO', 'OPERADOR PADRON', 'jorge.rios@blancoynegromasivo.com.co', 1, 0),
(658, '16772395', 'RIVERA GARCIA EDISON HUMBERTO', 'OPERADOR PADRON', 'edison.rivera@blancoynegromasivo.com.co', 1, 0),
(659, '1130625921', 'RIVERA MORENO JONATHAN', 'MECANICO A JUNIOR', 'jonathan.rivera@blancoynegromasivo.com.co', 1, 0),
(660, '94403363', 'ROA LONDONO MIGUEL ANGEL', 'OPERADOR PADRON', 'miguel.roa@blancoynegromasivo.com.co', 1, 0),
(661, '1130586602', 'ROA SUAREZ JULIAN EDUARDO', 'OPERADOR ALIMENTADOR', 'julian.roa@blancoynegromasivo.com.co', 1, 0),
(662, '75145972', 'RODAS LLANOS JAVIER', 'OPERADOR ALIMENTADOR', 'javier.rodas@blancoynegromasivo.com.co', 1, 0),
(663, '94456869', 'RODRIGUEZ CATANO HERNEY', 'OPERADOR ARTICULADO', 'herney.rodriguez@blancoynegromasivo.com.co', 1, 0),
(664, '6221746', 'RODRIGUEZ ESPINOSA GUSTAVO', 'OPERADOR ARTICULADO', 'gustavo.rodriguez@blancoynegromasivo.com.co', 1, 0),
(665, '16795311', 'RODRIGUEZ GOMEZ CARLOS ARTURO', 'OPERADOR ARTICULADO', 'carlos.rodriguez@blancoynegromasivo.com.co', 1, 0),
(666, '94520565', 'RODRIGUEZ GOMEZ JAMER', 'COORDINADOR', 'jamer.rodriguez@blancoynegromasivo.com.co', 1, 0),
(667, '16775948', 'RODRIGUEZ HURTADO HECTOR FABIO', 'OPERADOR ALIMENTADOR', 'hector.rodriguez@blancoynegromasivo.com.co', 1, 0),
(668, '94500378', 'RODRIGUEZ LERMA ALEXANDER', 'OPERADOR ALIMENTADOR', 'alexander.rodriguez@blancoynegromasivo.com.', 1, 0),
(669, '79492922', 'RODRIGUEZ MOLANO EDGAR', 'OPERADOR ARTICULADO', 'edgar.rodriguez@blancoynegromasivo.com.co', 1, 0),
(670, '16670903', 'RODRIGUEZ MONTANO ALFREDO JORGE', 'OPERADOR ALIMENTADOR', 'alfredo.rodriguez@blancoynegromasivo.com.co', 1, 0),
(671, '16376548', 'RODRIGUEZ MOSQUERA JHON ANDRES', 'OPERADOR PADRON', 'jhon.rodriguez@blancoynegromasivo.com.co', 1, 0),
(672, '16940720', 'RODRIGUEZ OROZCO JOSE RICARDO', 'OPERADOR PADRON', 'jose.rodriguez@blancoynegromasivo.com.co', 1, 0),
(673, '14465482', 'RODRIGUEZ REY SAMY ALEXANDER', 'OPERADOR ARTICULADO', 'samy.rodriguez@blancoynegromasivo.com.co', 1, 0),
(674, '76321391', 'RODRIGUEZ TORRES LUIS JORGE', 'OPERADOR PADRON', 'luis.rodriguez@blancoynegromasivo.com.co', 1, 0),
(675, '16848002', 'RODRIGUEZ VELASCO ALBEIRO', 'OPERADOR PADRON', 'albeiro.rodriguez@blancoynegromasivo.com.co', 1, 0),
(676, '6391700', 'RODRIGUEZ VELASQUEZ CARLOS ANDRES', 'LAVADOR', 'carlos.rodriguez@blancoynegromasivo.com.co', 1, 0),
(677, '16772738', 'ROJAS BENAVIDEZ FRANCISCO FABIAN', 'OPERADOR ALIMENTADOR', 'francisco.rojas@blancoynegromasivo.com.co', 1, 0),
(678, '16988080', 'ROJAS GOMEZ MANFREDY', 'OPERADOR PADRON', 'manfredy.rojas@blancoynegromasivo.com.co', 1, 0),
(679, '6444191', 'ROJAS MENDEZ CARLOS FERNANDO', 'OPERADOR ALIMENTADOR', 'carlos.rojas@blancoynegromasivo.com.co', 1, 0),
(680, '1144041539', 'ROJAS REINA JOSE JONATAN', 'LAVADOR', 'jonatan.rojas@blancoynegromasivo.com.co', 1, 0),
(681, '94526175', 'ROJAS SANCHEZ JOSE JULIAN', 'OPERADOR PADRON', 'jose.rojas@blancoynegromasivo.com.co', 1, 0),
(682, '94458729', 'ROJAS ZAMBRANO HORACIO', 'OPERADOR PADRON', 'horacio.rojas@blancoynegromasivo.com.co', 1, 0),
(683, '16826253', 'ROLDAN TREJOS JHON EDINSON', 'OPERADOR PADRON', 'jhon.roldan@blancoynegromasivo.com.co', 1, 0),
(684, '18413070', 'ROMAN URIBE CARLOS ALBERTO', 'OPERADOR ALIMENTADOR', 'carlos.roman@blancoynegromasivo.com.co', 1, 0),
(685, '16539148', 'ROMERO BONILLA JOHN ALEJANDRO', 'OPERADOR PADRON', 'alejandro.romero@blancoynegromasivo.com.co', 1, 0),
(686, '16285987', 'ROMERO MONTES JUAN GABRIEL', 'OPERADOR ARTICULADO', 'juan.romero@blancoynegromasivo.com.co', 1, 0),
(687, '1144151962', 'ROSERO GIL HECTOR FABIAN', 'AUXILIAR DE HERRAMIENTAS Y METROLOGI', 'hector.rosero@blancoynegromasivo.com.co', 1, 0),
(688, '16731086', 'ROSERO YATE LUIS EDUARDO', 'OPERADOR ARTICULADO', 'luis.rosero@blancoynegromasivo.com.co', 1, 0),
(689, '16218914', 'RUA CORREA LUIS ALFONSO', 'OPERADOR PADRON', 'luis.rua@blancoynegromasivo.com.co', 1, 0),
(690, '94321648', 'RUALES SAAVEDRA LIBARDO MAURICIO', 'OPERADOR ARTICULADO', 'libardo.ruales@blancoynegromasivo.com.co', 1, 0),
(691, '1118283781', 'RUANO MUNOZ MIGUEL ANGEL', 'LAVADOR', 'miguel.ruano@blancoynegromasivo.com.co', 1, 0),
(692, '97425971', 'RUDAS VAQUIRO JHON GERARDO', 'OPERADOR ARTICULADO', 'jhon.rudas@blancoynegromasivo.com.co', 1, 0),
(693, '14465840', 'RUIZ ARIAS FERSON GUILLERMO', 'OPERADOR PADRON', 'ferson.ruiz@blancoynegromasivo.com.co', 1, 0),
(694, '94495480', 'RUIZ ARIAS JAVIER', 'OPERADOR PADRON', 'javier.ruiz@blancoynegromasivo.com.co', 1, 0),
(695, '94526268', 'RUIZ CAPOTE JOSE EDWIN', 'OPERADOR ALIMENTADOR', 'jose.ruiz@blancoynegromasivo.com.co', 1, 0),
(696, '1144153612', 'RUIZ CORTES JHONATAN', 'LAVADOR', 'jhonatan.ruiz@blancoynegromasivo.com.co', 1, 0),
(697, '16499659', 'RUIZ DAZA YESID', 'OPERADOR PADRON', 'yesid.ruiz@blancoynegromasivo.com.co', 1, 0),
(698, '10559975', 'RUIZ MARTINEZ JESUS EMILIO', 'OPERADOR ARTICULADO', 'jesus.ruiz@blancoynegromasivo.com.co', 1, 0),
(699, '1130635065', 'RUIZ OTERO CRISTIAN CAMILO', 'PROFESIONAL DE DESARROLLO', 'cristian.ruiz@blancoynegromasivo.com.co', 1, 0),
(700, '94498918', 'RUIZ SERNA EDWIN', 'OPERADOR ALIMENTADOR', 'edwin.ruiz@blancoynegromasivo.com.co', 1, 0),
(701, '94074140', 'RUIZ SOLARTE JHON JAIRO', 'OPERADOR ARTICULADO', 'jhon.ruiz@blancoynegromasivo.com.co', 1, 0),
(702, '10050813', 'RUIZ SUAREZ ANDRES FELIPE', 'OPERADOR PADRON', 'andres.ruiz@blancoynegromasivo.com.co', 1, 0),
(703, '98323477', 'RUIZ URBANO SEGUNDO ORLANDO', 'OPERADOR ALIMENTADOR', 'segundo.ruiz@blancoynegromasivo.com.co', 1, 0),
(704, '16271338', 'SAA GARZON EDISON', 'COORDINADOR', 'edison.saa@blancoynegromasivo.com.co', 1, 0),
(705, '94452819', 'SAENZ LOPEZ RODRIGO', 'OPERADOR ARTICULADO', 'rodrigo.saenz@blancoynegromasivo.com.co', 1, 0),
(706, '16747775', 'SALAMANCA MUNOZ LUIS MAURICIO', 'OPERADOR PADRON', 'luis.salamanca@blancoynegromasivo.com.co', 1, 0),
(707, '6107287', 'SALAS OSORIO ANDERSON', 'JEFE DE TALLER', 'anderson.salas@blancoynegromasivo.com.co', 1, 0),
(708, '16657296', 'SALAZAR CHAVARRO FERNANDO', 'OPERADOR PADRON', 'fernando.salazar@blancoynegromasivo.com.co', 1, 0),
(709, '1130648265', 'SALAZAR MARULANDA RICARDO ADOLFO', 'LAVADOR', 'ricardo.salazar@blancoynegromasivo.com.co', 1, 0),
(710, '1144164398', 'SALGADO RIOS LUIS EVER', 'OPERADOR ALIMENTADOR', 'luis.salgado@blancoynegromasivo.com.co', 1, 0),
(711, '16744629', 'SANABRIA DUARTE EFRAIN', 'OPERADOR PADRON', 'efrain.sanabria@blancoynegromasivo.com.co', 1, 0),
(712, '16932984', 'SANCHEZ CIFUENTES JAMES', 'OPERADOR ALIMENTADOR', 'james.sanchez@blancoynegromasivo.com.co', 1, 0),
(713, '15961533', 'SANCHEZ MURILLO SANDRO JAIR', 'OPERADOR ARTICULADO', 'sandro.sanchez@blancoynegromasivo.com.co', 1, 0),
(714, '1130638039', 'SANCHEZ OCAMPO JHON ALEJANDRO', 'OPERADOR ALIMENTADOR', 'jhona.sanchez@blancoynegromasivo.com.co', 1, 0),
(715, '7556718', 'SANCHEZ QUINTERO HONORIO', 'OPERADOR PADRON', 'honorio.sanchez@blancoynegromasivo.com.co', 1, 0),
(716, '18493950', 'SANCHEZ RENDON ORIVEL', 'OPERADOR PADRON', 'orivel.sanchez@blancoynegromasivo.com.co', 1, 0),
(717, '10632616', 'SANDOVAL VALENCIA VICTOR MANUEL', 'OPERADOR PADRON', 'victor.sandoval@blancoynegromasivo.com.co', 1, 0),
(718, '94508016', 'SANTA AGUIRRE GUSTAVO ADOLFO', 'JEFE DE ACCIDENTES', 'gustavo.santa@blancoynegromasivo.com.co', 1, 0),
(719, '12230634', 'SAPUYES SAMBONI LUIS EDUARDO', 'OPERADOR PADRON', 'luis.sapuyes@blancoynegromasivo.com.co', 1, 0),
(720, '16378382', 'SARMIENTO IVAN MAURICIO', 'OPERADOR ALIMENTADOR', 'ivan.sarmiento@blancoynegromasivo.com.co', 1, 0),
(721, '94071839', 'SARRIA ERAZO JOSE ANDRES', 'OPERADOR ALIMENTADOR', 'jose.sarria@blancoynegromasivo.com.co', 1, 0),
(722, '16792502', 'SEGURA QUINONEZ LUIS ENRIQUE', 'OPERADOR PADRON', 'luis.segura@blancoynegromasivo.com.co', 1, 0),
(723, '87948771', 'SEIDEL MORCILLO WALTHER ARMANDO', 'TECNICO CONTROL VEHICULOS 3', 'walther.seidel@blancoynegromasivo.com.co', 1, 0),
(724, '16539228', 'SEPULVEDA MUNOZ NORVEY', 'OPERADOR ALIMENTADOR', 'norvey.sepulveda@blancoynegromasivo.com.co', 1, 0),
(725, '16931380', 'SEPULVEDA RAMIREZ ANDRES FERNANDO', 'OPERADOR PADRON', 'andres.sepulveda@blancoynegromasivo.com.co', 1, 0),
(726, '16917718', 'SERNA PRADO GUILLERMO', 'OPERADOR ARTICULADO', 'guillermo.serna@blancoynegromasivo.com.co', 1, 0),
(727, '76357164', 'SEVILLA QUINTERO WILSON', 'OPERADOR ALIMENTADOR', 'wilson.sevilla@blancoynegromasivo.com.co', 1, 0),
(728, '1130662832', 'SILVA CUNDUMI DIEGO FERNANDO', 'MECANICO C', 'diego.silva@blancoynegromasivo.com.co', 1, 0),
(729, '16280160', 'SILVA MINA NELSON', 'OPERADOR PADRON', 'nelson.mina@blancoynegromasivo.com.co', 1, 0),
(730, '1061694611', 'SILVA ZUNIGA NELSON', 'LAVADOR', 'nelson.zuniga@blancoynegromasivo.com.co', 1, 0),
(731, '94533791', 'SINISTERRA GALLEGO HAROLD ALFONSO', 'OPERADOR PADRON', 'harold.sinisterra@blancoynegromasivo.com.co', 1, 0),
(732, '94432852', 'SINISTERRA SOLIS ESTEBAN', 'OPERADOR PADRON', 'esteban.sinisterra@blancoynegromasivo.com.c', 1, 0),
(733, '16763613', 'SOLARTE MARTINEZ DIEGO LEON', 'OPERADOR ARTICULADO', 'diego.solarte@blancoynegromasivo.com.co', 1, 0),
(734, '94510312', 'SOTO CUENCA JORGE ARMANDO', 'DIRECTOR DE MANTENIMIENTO', 'jorge.soto@blancoynegromasivo.com.co', 1, 0),
(735, '6361850', 'SUAREZ OCAMPO MANUEL ALBERTO', 'OPERADOR PADRON', 'manuel.suarez@blancoynegromasivo.com.co', 1, 0),
(736, '16867069', 'TABARES SANCHEZ JOSE ERIK', 'OPERADOR PADRON', 'jose.tabares@blancoynegromasivo.com.co', 1, 0),
(737, '10235101', 'TABORDA ATEHORTUA HERNANDO', 'OPERADOR ALIMENTADOR', 'hernando.taborda@blancoynegromasivo.com.co', 1, 0),
(738, '16753360', 'TAMAYO GARZON GARRIK', 'OPERADOR ALIMENTADOR', 'garrik.tamayo@blancoynegromasivo.com.co', 1, 0),
(739, '16743682', 'TAYAKEE OCAMPO EDINSON', 'SUPERVISOR MANTENIMIENTO', 'edinson.tayakee@blancoynegromasivo.com.co', 1, 0),
(740, '16263372', 'TELLO JAIRO', 'OPERADOR PADRON', 'jairo.tello@blancoynegromasivo.com.co', 1, 0),
(741, '16728133', 'TIGREROS GRANOBLES GERMAN FREDY', 'OPERADOR ARTICULADO', 'german.tigreros@blancoynegromasivo.com.co', 1, 0),
(742, '87068289', 'TITISTAR DIEGO ANDRES', 'OPERADOR ALIMENTADOR', 'diego.titistar@blancoynegromasivo.com.co', 1, 0),
(743, '94427715', 'TITISTAR JESUS EDGAR', 'OPERADOR ARTICULADO', 'edgar.titistar@blancoynegromasivo.com.co', 1, 0),
(744, '10751587', 'TOBAR CARLOS EDUVI', 'OPERADOR PADRON', 'carlos.tobar@blancoynegromasivo.com.co', 1, 0),
(745, '16453848', 'TORO APOLINDAR LUIS OLMES', 'MECANICO C', 'luis.toro@blancoynegromasivo.com.co', 1, 0),
(746, '16676414', 'TORO GIRALDO LUIS FERNANDO', 'OPERADOR PADRON', 'luis.toro@blancoynegromasivo.com.co', 1, 0),
(747, '80005386', 'TORRES BOHORQUEZ JOSE ALEXANDER', 'OPERADOR PADRON', 'jose.torres@blancoynegromasivo.com.co', 1, 0),
(748, '16497023', 'TORRES JOSE', 'OPERADOR PADRON', 'jose.torres@blancoynegromasivo.com.co', 1, 0),
(749, '16379955', 'TORRES MEDINA ORLANDO', 'OPERADOR PADRON', 'orlando.torres@blancoynegromasivo.com.co', 1, 0),
(750, '1112475780', 'TORRES MOLINA BRIAN ARLEX', 'OPERADOR ALIMENTADOR', 'brian.torres@blancoynegromasivo.com.co', 1, 0),
(751, '88244593', 'TOVAR DONEYS SANTIAGO', 'COORDINADOR', 'santiago.tovar@blancoynegromasivo.com.co', 1, 0),
(752, '1151935395', 'TRIBINO CORAL JOSE DAVID', 'LAVADOR', 'jorge.gaitan@blancoynegromasivo.com.co', 1, 0),
(753, '94480678', 'TRIVINO PARRA JULIAN AUGUSTO', 'PROFESIONAL DE PLANEACION', 'julian.trivino@blancoynegromasivo.com.co', 1, 0),
(754, '16275048', 'TRUJILLO HECTOR ANTONIO', 'OPERADOR ARTICULADO', 'antonio.trujillo@blancoynegromasivo.com.co', 1, 0),
(755, '10496335', 'TRUJILLO JORGE EDUARDO', 'OPERADOR PADRON', 'jorge.trujillo@blancoynegromasivo.com.co', 1, 0),
(756, '1061729711', 'TRUJILLO JURADO VICTOR ALFONSO', 'MECANICO C', 'victor.trujillo@blancoynegromasivo.com.co', 1, 0),
(757, '94524540', 'TRUJILLO PEREA JOHIMER AMILCAR', 'OPERADOR ARTICULADO', 'johimer.trujillo@blancoynegromasivo.com.co', 1, 0),
(758, '94449847', 'TRUJILLO PEREZ JHONN WILLIAM', 'OPERADOR PADRON', 'jhonn.trujillo@blancoynegromasivo.com.co', 1, 0),
(759, '16593284', 'TRUJILLO SERRATO JOSE EISENHOOVER', 'OPERADOR ALIMENTADOR', 'jose.trujillo@blancoynegromasivo.com.co', 1, 0),
(760, '16773461', 'TRUJILLO USECHE JHON JAIRO', 'TECNICO DE PATIO', 'jhon.trujillo@blancoynegromasivo.com.co', 1, 0),
(761, '79617200', 'UNIBIO BUITRAGO CESAR AUGUSTO', 'OPERADOR PADRON', 'cesar.unibio@blancoynegromasivo.com.co', 1, 0),
(762, '7562875', 'UPEGUI ARCINIEGAS LUIS ENRIQUE', 'OPERADOR ARTICULADO', 'luis.upegui@blancoynegromasivo.com.co', 1, 0),
(763, '16640826', 'URBANO RAMIREZ LUIS FERNANDO', 'OPERADOR PADRON', 'luis.urbano@blancoynegromasivo.com.co', 1, 0),
(764, '1111772009', 'URBANO SUAREZ JORGE IVAN', 'MECANICO C', 'jorge.urbano@blancoynegromasivo.com.co', 1, 0),
(765, '16657699', 'URREGO AGUDELO FABIO', 'OPERADOR PADRON', 'fabio.urrego@blancoynegromasivo.com.co', 1, 0),
(766, '16848125', 'URREGO LOZANO CESAR AUGUSTO', 'OPERADOR PADRON', 'cesar.urrego@blancoynegromasivo.com.co', 1, 0),
(767, '16915124', 'URUENA CANIZALES JHON JAVER', 'OPERADOR ALIMENTADOR', 'jhon.uruena@blancoynegromasivo.com.co', 1, 0),
(768, '98618503', 'USUGA ORTIZ EDUYN ARNED', 'OPERADOR ARTICULADO', 'eduyn.usuga@blancoynegromasivo.com.co', 1, 0),
(769, '14889254', 'VACCA GONZALEZ GIOVANNI', 'OPERADOR PADRON', 'giovanni.vacca@blancoynegromasivo.com.co', 1, 0),
(770, '16672159', 'VALDERRAMA ALVAREZ AURELIO', 'MECANICO A JUNIOR', 'aurelio.valderrama@blancoynegromasivo.com.c', 1, 0),
(771, '1130676823', 'VALDERRAMA ZAPATA RUBEN', 'ANALISTA DE  INFORMACION', 'ruben.valderrama@blancoynegromasivo.com.co', 1, 0),
(772, '94489538', 'VALDEZ OROZCO ALEXANDER', 'OPERADOR PADRON', 'alexander.valdez@blancoynegromasivo.com.co', 1, 0),
(773, '66810057', 'VALENCIA ARISTIZABAL ALEXANDRA MARIA', 'JEFE DE CONTABILIDAD', 'alexandra.valencia@blancoynegromasivo.com.c', 1, 0),
(774, '93404386', 'VALENCIA CASTIBLANCO WILBER', 'JEFE DE OPERACIONES', 'wilber.valencia@blancoynegromasivo.com.co', 1, 0),
(775, '16760179', 'VALENCIA CASTRILLON HECTOR JAIRO', 'OPERADOR ARTICULADO', 'hector.valencia@blancoynegromasivo.com.co', 1, 0),
(776, '16750190', 'VALENCIA CORRALES LUIS ARNOLDO', 'OPERADOR PADRON', 'arnoldo.valencia@blancoynegromasivo.com.co', 1, 0),
(777, '1061598412', 'VALENCIA CRIOLLO EIDER ARMANDO', 'OPERADOR ALIMENTADOR', 'eider.valencia@blancoynegromasivo.com.co', 1, 0),
(778, '4661851', 'VALENCIA LARRAHONDO JAIR', 'OPERADOR PADRON', 'jair.valencia@blancoynegromasivo.com.co', 1, 0),
(779, '1143925656', 'VALENCIA LLANO YEINER', 'OPERADOR PADRON', 'yeiner.valencia@blancoynegromasivo.com.co', 1, 0),
(780, '16848201', 'VALENCIA RODALLEGA HECTOR MARINO', 'OFICIOS VARIOS', 'hector.rodallega@blancoynegromasivo.com.co', 1, 0),
(781, '16829343', 'VALLE HOYOS NORBERTO ANCIZAR', 'OPERADOR PADRON', 'norberto.valle@blancoynegromasivo.com.co', 1, 0),
(782, '66978007', 'VANEGAS MACHADO ANA ISABEL', 'ASISTENTE CONTABLE', 'ana.vanegas@blancoynegromasivo.com.co', 1, 0),
(783, '16447568', 'VANEGAS SALAZAR MARINO', 'OPERADOR PADRON', 'marino.vanegas@blancoynegromasivo.com.co', 1, 0),
(784, '16279466', 'VARELA GARCIA DORIAN ABDUL', 'OPERADOR PADRON', 'dorian.varela@blancoynegromasivo.com.co', 1, 0),
(785, '19440445', 'VARGAS ARIAS JOHN JAIRO', 'OPERADOR PADRON', 'john.vargas@blancoynegromasivo.com.co', 1, 0),
(786, '94520540', 'VARGAS CAMPO HAROL ANDRES', 'OPERADOR ARTICULADO', 'harold.vargas@blancoynegromasivo.com.co', 1, 0),
(787, '1130603781', 'VARGAS CHAVEZ GUSTAVO ADOLFO', 'OPERADOR ALIMENTADOR', 'gustavo.vargas@blancoynegromasivo.com.co', 1, 0),
(788, '16454717', 'VARGAS MURCIA ARIEL', 'COORDINADOR', 'ariel.vargas@blancoynegromasivo.com.co', 1, 0),
(789, '16457494', 'VARGAS RIVERA CARLOS JULIO', 'OPERADOR PADRON', 'carlos.vargas@blancoynegromasivo.com.co', 1, 0),
(790, '98542689', 'VASCO LONDONO JUAN CARLOS', 'LAVADOR', 'juan.vasco@blancoynegromasivo.com.co', 1, 0),
(791, '16637494', 'VASQUEZ GUZMAN IVAN', 'OPERADOR PADRON', 'ivan.vasquez@blancoynegromasivo.com.co', 1, 0),
(792, '16758978', 'VASQUEZ LONDONO DIEGO DUVAN', 'OPERADOR PADRON', 'diego.vasquez@blancoynegromasivo.com.co', 1, 0),
(793, '94412396', 'VASQUEZ PAREDES JOSE ENRIQUE', 'OPERADOR PADRON', 'jose.vasquez@blancoynegromasivo.com.co', 1, 0),
(794, '16378049', 'VASQUEZ RESTREPO JORGE ANTONIO', 'MECANICO B', 'jorge.vasquez@blancoynegromasivo.com.co', 1, 0),
(795, '94295128', 'VASQUEZ VARGAS OLVEIN', 'OPERADOR PADRON', 'olvein.vasquez@blancoynegromasivo.com.co', 1, 0),
(796, '10753501', 'VEGA MERA JOSE ALVEIRO', 'OPERADOR PADRON', 'jose.vega@blancoynegromasivo.com.co', 1, 0),
(797, '10197295', 'VELARDE GRAJALES VICTOR DE JESUS', 'OPERADOR ALIMENTADOR', 'victor.velarde@blancoynegromasivo.com.co', 1, 0),
(798, '16720590', 'VELASCO BURBANO NESTOR ARMANDO', 'OPERADOR PADRON', 'nestor.velasco@blancoynegromasivo.com.co', 1, 0),
(799, '76090070', 'VELASCO CAICEDO ALEJANDRO', 'FLOTA AUXILIAR', 'alejandro.velasco@blancoynegromasivo.com.co', 1, 0),
(800, '16286025', 'VELASCO CASTILLO OMAR HENRY', 'OPERADOR ARTICULADO', 'omar.velasco@blancoynegromasivo.com.co', 1, 0),
(801, '94505894', 'VELASCO CEBALLOS SAMUEL', 'OPERADOR ARTICULADO', 'samuel.velasco@blancoynegromasivo.com.co', 1, 0),
(802, '10753106', 'VELASCO MOSQUERA ALEXANDER', 'OPERADOR PADRON', 'alexander.velasco@blancoynegromasivo.com.co', 1, 0),
(803, '16864158', 'VELEZ ALVAREZ JOHN HENRY', 'MECANICO B', 'john.velez@blancoynegromasivo.com.co', 1, 0),
(804, '94399853', 'VELEZ BENITEZ RICARDO', 'OPERADOR PADRON', 'ricardo.velez@blancoynegromasivo.com.co', 1, 0),
(805, '16768853', 'VELEZ CORONADO DIEGO ALFARO', 'OPERADOR PADRON', 'diego.velez@blancoynegromasivo.com.co', 1, 0),
(806, '16717771', 'VELEZ GUTIERREZ DIEGO DE JESUS', 'MECANICO B', 'diegodj.velez@blancoynegromasivo.com.co', 1, 0),
(807, '94541697', 'VELEZ MORALES ALEXANDER', 'MECANICO C', 'alexander.velez@blancoynegromasivo.com.co', 1, 0),
(808, '94396820', 'VELEZ ORTIZ JOSE LUIS', 'OPERADOR ARTICULADO', 'jose.velez@blancoynegromasivo.com.co', 1, 0),
(809, '1114089637', 'VELEZ PEREZ ROSA NIDIA', 'AUXILIAR DE RRHH', 'rosa.velez@blancoynegromasivo.com.co', 1, 0),
(810, '16644777', 'VICTORIA ESCOBAR ALVARO', 'OPERADOR PADRON', 'alvaro.victoria@blancoynegromasivo.com.co', 1, 0),
(811, '16638203', 'VICTORIA PIEDRAHITA CARLOS ALBERTO', 'OPERADOR ALIMENTADOR', 'carlos.victoria@blancoynegromasivo.com.co', 1, 0),
(812, '16742586', 'VICTORIA SAA BERNARDO LUIS', 'COORDINADOR', 'bernardo.victoria@blancoynegromasivo.com.co', 1, 0),
(813, '94374767', 'VILLA HENAO OMAR DE JESUS', 'OPERADOR PADRON', 'omar.villa@blancoynegromasivo.com.co', 1, 0),
(814, '94456716', 'VILLA TABORDA JOHN FERNANDO', 'OPERADOR ALIMENTADOR', 'jhon.villa@blancoynegromasivo.com.co', 1, 0),
(815, '66906802', 'VILLADA LAGOS MARIA FRANCINED', 'OFICIOS VARIOS', 'francined.villada@blancoynegromasivo.com.co', 1, 0),
(816, '16692733', 'VILLADA RIOS JOSE SALVADOR', 'OPERADOR ARTICULADO', 'jose.villada@blancoynegromasivo.com.co', 1, 0),
(817, '91263231', 'VILLAMIZAR ORDONEZ JORGE ELIECER', 'OPERADOR PADRON', 'jorge.villamizar@blancoynegromasivo.com.co', 1, 0),
(818, '16937679', 'VILLANUEVA ARIAS JADER ADEL', 'OPERADOR PADRON', 'jader.villanueva@blancoynegromasivo.com.co', 1, 0),
(819, '16744868', 'VILLAQUIRAN ESPINOSA JUAN CARLOS', 'OPERADOR PADRON', 'juan.villaquiran@blancoynegromasivo.com.co', 1, 0),
(820, '94380417', 'VILLARREAL PAEZ FERNANDO', 'OPERADOR ARTICULADO', 'fernando.villarreal@blancoynegromasivo.com.', 1, 0),
(821, '31859792', 'VILLEGAS RAMIREZ MARIA CRISTINA', 'DIRECTOR DE RECURSO HUMANO', 'cristina.villegas@blancoynegromasivo.com.co', 1, 0),
(822, '94523287', 'VILLOTA OLIVEROS JORGE ALEXANDER', 'AUXILIAR PROGRAMACION MANTENIMIENTO', 'alexander.villota@blancoynegromasivo.com.co', 1, 0),
(823, '16750604', 'VILLOTA REALPE HAROLD', 'OPERADOR PADRON', 'harold.villota@blancoynegromasivo.com.co', 1, 0),
(824, '10199565', 'VINASCO VINASCO ADALIER DE JESUS', 'OPERADOR PADRON', 'adalier.vinasco@blancoynegromasivo.com.co', 1, 0),
(825, '16636923', 'VIVAS HERNANDEZ HAROLD', 'FLOTA AUXILIAR', 'harold.vivas@blancoynegromasivo.com.co', 1, 0),
(826, '1113521572', 'VIVAS MONTOYA ARNALDO', 'OPERADOR PADRON', 'arnaldo.vivas@blancoynegromasivo.com.co', 1, 0),
(827, '4759139', 'VIVEROS RODOLFO', 'OPERADOR PADRON', 'rodolfo.viveros@blancoynegromasivo.com.co', 1, 0),
(828, '10481472', 'VIVEROS SANCHEZ ARMANDO', 'OPERADOR PADRON', 'armando.viveros@blancoynegromasivo.com.co', 1, 0),
(829, '14465577', 'YANGUAS CEBALLOS MAURICIO', 'OPERADOR ARTICULADO', 'mauricio.yanguas@blancoynegromasivo.com.co', 1, 0),
(830, '52084221', 'YANQUEN MURCIA ANA YANNETH', 'ASISTENTE DE GERENCIA', 'yanneth.yanquen@blancoynegromasivo.com.co', 1, 0),
(831, '18505362', 'YEPES FRANCO FERNANDO', 'OPERADOR PADRON', 'fernando.yepes@blancoynegromasivo.com.co', 1, 0),
(832, '14624106', 'ZAMORA VALENCIA ISMAEL', 'OPERADOR PADRON', 'ismael.zamora@blancoynegromasivo.com.co', 1, 0),
(833, '66994838', 'ZAPATA ARROYAVE PAOLA ANDREA', 'ASISTENTE CONTABLE DE COMPRAS', 'paola.zapata@blancoynegromasivo.com.co', 1, 0),
(834, '16631096', 'ZAPATA CARABALI EDGAR ELI', 'OPERADOR PADRON', 'edgar.zapata@blancoynegromasivo.com.co', 1, 0),
(835, '94452253', 'ZAPATA CARABALI RODOLFO', 'OPERADOR PADRON', 'rodolfo.zapata@blancoynegromasivo.com.co', 1, 0),
(836, '31578244', 'ZAPATA ESCOBAR MARCELLY', 'ASISTENTE CONTABLE DE COMPRAS', 'marcelly.zapata@blancoynegromasivo.com.co', 1, 0),
(837, '14679303', 'ZAPATA GARCIA JHON EDWIN', 'OPERADOR ALIMENTADOR', 'jhon.zapata@blancoynegromasivo.com.co', 1, 0),
(838, '94451380', 'ZAPATA HENAO JOSE JOAQUIN', 'OPERADOR ARTICULADO', 'jose.zapata@blancoynegromasivo.com.co', 1, 0),
(839, '16636096', 'ZAPATA OSPINA JUSTO NOEL', 'OPERADOR PADRON', 'justo.zapata@blancoynegromasivo.com.co', 1, 0),
(840, '94371369', 'ZAPATA RAMOS EDWARD', 'OPERADOR PADRON', 'edward.zapata@blancoynegromasivo.com.co', 1, 0),
(841, '94265392', 'ZULUAGA ARROYAVE WILFREDY', 'OPERADOR ALIMENTADOR', 'wilfredy.zuluaga@blancoynegromasivo.com.co', 1, 0),
(842, '94523332', 'ZULUAGA GIRALDO CARLOS', 'OPERADOR ARTICULADO', 'carlos.zuluaga@blancoynegromasivo.com.co', 1, 0),
(843, '87949177', 'ZULUAGA RINCON IVAN ARTURO', 'SUPERVISOR MANTENIMIENTO', 'ivan.zuluaga@blancoynegromasivo.com.co', 1, 0),
(844, '1144047871', 'ZUNIGA ALVARADO RICARDO ALBERTO', 'OPERADOR ALIMENTADOR', 'ricardo.zuniga@blancoynegromasivo.com.co', 1, 0),
(845, '6405646', 'ZUNIGA JAIR', 'OPERADOR PADRON', 'jair.zuniga@blancoynegromasivo.com.co', 1, 0),
(846, '16711122', 'ZUNIGA LERMA JOSE MARIA', 'OPERADOR PADRON', 'jose.zuniga@blancoynegromasivo.com.co', 1, 0),
(847, '16848030', 'ZUNIGA ORTIZ JUAN MIGUEL', 'LAVADOR', 'juan.zuniga@blancoynegromasivo.com.co', 1, 0),
(848, '123456789', 'CORREO CORREO1 PRUEBA PRUEBA1', 'NINGUNO', 'prueba.correo@blancoynegromasivo.com.co', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_departamento`
--

CREATE TABLE IF NOT EXISTS `atl_departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `atl_departamento`
--

INSERT INTO `atl_departamento` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Gerencia', 'Departamento de Gerencia'),
(2, 'Financiero', 'Departamento de financiero'),
(3, 'Informática', 'Departamento de Informática'),
(4, 'Gestión Humana', 'Departamento de Gestion Humana'),
(5, 'Mantenimiento', 'Departamento de Mantenimiento'),
(6, 'Operaciones', 'Departamento de Operaciones'),
(8, 'Blanco y Negro S.A.', 'Empresa Blanco y Negro'),
(9, 'Servicios Generales', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_dispositivo`
--

CREATE TABLE IF NOT EXISTS `atl_dispositivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_ubicacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `n_serie` varchar(100) NOT NULL,
  `n_activo` varchar(100) NOT NULL,
  `prestable` set('si','no') NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `comentario` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_dominio`
--

CREATE TABLE IF NOT EXISTS `atl_dominio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `ip_server` varchar(20) NOT NULL,
  `ip_server_opcional` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `atl_dominio`
--

INSERT INTO `atl_dominio` (`id`, `nombre`, `ip_server`, `ip_server_opcional`, `descripcion`) VALUES
(1, 'corp.blancoynegro.com', '192.168.1.2', '192.168.1.4', 'Dominio por defecto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_equipo_red`
--

CREATE TABLE IF NOT EXISTS `atl_equipo_red` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_ubicacion` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `n_serie` varchar(100) NOT NULL,
  `n_activo` varchar(100) NOT NULL,
  `id_dominio` int(11) NOT NULL,
  `id_red` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `mac` varchar(100) NOT NULL,
  `comentarios` text NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_estado_componente`
--

CREATE TABLE IF NOT EXISTS `atl_estado_componente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `atl_estado_componente`
--

INSERT INTO `atl_estado_componente` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Propio', 'Equipo propio.'),
(2, 'Alquilado', 'Equipo Alquilado'),
(3, 'Dañado', 'Equipo Dañado'),
(4, 'En bodega', 'Equipo en la bodega de informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_historial`
--

CREATE TABLE IF NOT EXISTS `atl_historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_componente` int(11) NOT NULL,
  `componente` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `ant_valor` text,
  `new_valor` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_impresora`
--

CREATE TABLE IF NOT EXISTS `atl_impresora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `id_ubicacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_tipo_impresora` int(11) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `n_serie` varchar(100) NOT NULL,
  `n_activo` varchar(100) NOT NULL,
  `id_dominio` int(11) NOT NULL,
  `id_red` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `comentarios` text NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_impresora_tipo`
--

CREATE TABLE IF NOT EXISTS `atl_impresora_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `atl_impresora_tipo`
--

INSERT INTO `atl_impresora_tipo` (`id`, `nombre`, `descripcion`) VALUES
(1, 'USB', ''),
(2, 'Red', ''),
(3, 'Paralelo', ''),
(4, 'Serial', ''),
(5, 'Wifi', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_log`
--

CREATE TABLE IF NOT EXISTS `atl_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(80) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `direccion_ip` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_monitor`
--

CREATE TABLE IF NOT EXISTS `atl_monitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_ubicacion` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_tipo_monitor` int(11) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `n_serie` varchar(100) NOT NULL,
  `n_activo` varchar(100) NOT NULL,
  `tamano` int(11) NOT NULL,
  `id_interfaz_monitor` int(11) NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_monitor_interfaz`
--

CREATE TABLE IF NOT EXISTS `atl_monitor_interfaz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `atl_monitor_interfaz`
--

INSERT INTO `atl_monitor_interfaz` (`id`, `nombre`, `descripcion`) VALUES
(1, 'VGA', ''),
(2, 'HDMI', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_monitor_tipo`
--

CREATE TABLE IF NOT EXISTS `atl_monitor_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `atl_monitor_tipo`
--

INSERT INTO `atl_monitor_tipo` (`id`, `nombre`, `descripcion`) VALUES
(1, 'LED', ''),
(2, 'PLASMA', ''),
(3, 'CRT', ''),
(4, 'LCD', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_red`
--

CREATE TABLE IF NOT EXISTS `atl_red` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `atl_red`
--

INSERT INTO `atl_red` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Blanco y Negro Masivo', 'Red por defecto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_rol`
--

CREATE TABLE IF NOT EXISTS `atl_rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `inventario` int(11) NOT NULL DEFAULT '0',
  `ticket_admin` int(11) NOT NULL DEFAULT '0',
  `ticket_user` int(11) NOT NULL DEFAULT '0',
  `tareas` int(11) NOT NULL DEFAULT '0',
  `financiero` int(11) NOT NULL DEFAULT '0',
  `administracion` int(11) NOT NULL DEFAULT '0',
  `reportes` int(11) NOT NULL DEFAULT '0',
  `configuraciones` int(11) NOT NULL DEFAULT '0',
  `admin_correos` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `atl_rol`
--

INSERT INTO `atl_rol` (`id`, `nombre`, `inventario`, `ticket_admin`, `ticket_user`, `tareas`, `financiero`, `administracion`, `reportes`, `configuraciones`, `admin_correos`) VALUES
(1, 'Administrador', 1, 1, 0, 1, 1, 1, 1, 1, 1),
(2, 'Usuario', 0, 0, 1, 0, 0, 0, 0, 0, 0),
(3, 'Adminitrador Correo', 0, 0, 1, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_sistema_operativo`
--

CREATE TABLE IF NOT EXISTS `atl_sistema_operativo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_tipo_sistema` int(11) NOT NULL,
  `version` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `atl_sistema_operativo`
--

INSERT INTO `atl_sistema_operativo` (`id`, `nombre`, `id_tipo_sistema`, `version`, `descripcion`) VALUES
(1, 'Windows', 1, '7 Ultimate', 'Sistema operativo windows 7 ultimate'),
(2, 'Windows', 2, '7 Ultimate', 'Sistema operativo windows 7 ultimate'),
(3, 'Windows', 1, 'Home basic', ''),
(4, 'Windows', 1, 'Starter', ''),
(5, 'Windows', 1, 'Professional', ''),
(6, 'Windows', 1, 'Vista Bussiness', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_sistema_tipo`
--

CREATE TABLE IF NOT EXISTS `atl_sistema_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `atl_sistema_tipo`
--

INSERT INTO `atl_sistema_tipo` (`id`, `nombre`, `descripcion`) VALUES
(1, '32 bit', 'Sistema operativo a 32bits'),
(2, '64 bit', 'Sistema operativo a 64bits');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_software`
--

CREATE TABLE IF NOT EXISTS `atl_software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `version` varchar(100) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `n_licencias` int(11) NOT NULL,
  `n_licencias_restantes` int(11) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `id_software_tipo` int(11) NOT NULL,
  `a_ticket` set('si','no') NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_software_tipo`
--

CREATE TABLE IF NOT EXISTS `atl_software_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `atl_software_tipo`
--

INSERT INTO `atl_software_tipo` (`id`, `nombre`, `descripcion`) VALUES
(2, 'Ofimatica', 'Ofimatica'),
(3, 'Control Remoto', ''),
(4, 'Compresor', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_tarea`
--

CREATE TABLE IF NOT EXISTS `atl_tarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(80) NOT NULL,
  `descripcion` text NOT NULL,
  `nota` text,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `duracion` varchar(150) DEFAULT NULL COMMENT 'en minutos',
  `id_usuario_asignado` int(11) NOT NULL,
  `id_usuario_asignador` int(11) NOT NULL,
  `estado` int(11) NOT NULL COMMENT '1:terminado, 0:en espera',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Volcado de datos para la tabla `atl_tarea`
--

INSERT INTO `atl_tarea` (`id`, `titulo`, `descripcion`, `nota`, `fecha_inicio`, `fecha_fin`, `fecha_creado`, `duracion`, `id_usuario_asignado`, `id_usuario_asignador`, `estado`) VALUES
(3, 'Teclado aranda', 'Daño en el teclado de aranda por parte de un coordinador', 'Se cambia el teclado por uno que habia en bodega', '2013-07-09 11:00:00', '2013-07-09 11:10:00', '2013-07-09 11:00:00', '10', 1, 0, 1),
(4, 'Impresora carolina', 'La impresora de punto de gestión humana no estaba conectada al pc de carolina', 'Se vuelve y se conecta la impresora', '2013-07-09 15:00:00', '2013-07-09 15:15:00', '2013-07-09 15:00:00', '15', 1, 0, 1),
(5, 'Formatear equipo de Walther', 'Formatear equipo de walther seidel.', 'Quedo formateado el equipo. tuve problemas con los cds de recuperacion, no me cargaban el idioma.', '2013-07-10 08:40:00', '2013-07-10 15:00:00', '2013-07-10 08:40:00', '380', 1, 0, 1),
(7, 'Problema con acceso a exxon, neydi', 'Neydi no podia ingresar a la plataforma de exxon.', 'Internet explorer bloqueaba esta conexion, se baja la seguridad de IE.', '2013-07-10 10:30:51', '2013-07-10 10:40:03', '2013-07-10 10:30:51', '10', 1, 0, 1),
(8, 'Formatear equipo de nany', 'Formatear equipo de nany vargas', 'Se entrega el equipo a nany.', '2013-07-11 08:00:00', '2013-07-11 10:10:00', '2013-07-11 08:00:00', '130', 1, 0, 1),
(9, 'Exposicion a operadores', 'Explicarle a los nuevos operadores el proceso de la tarjeta de control de acceso y el correo corporativo', '', '2013-07-10 10:30:00', '2013-07-11 11:00:00', '2013-07-10 10:30:00', '630', 1, 0, 1),
(10, 'Creacion de correos', 'Crear correos de personal nuevo', 'Se crea correos de la lista que envio rosa velez', '2013-07-11 14:45:00', '2013-07-11 15:00:00', '2013-07-11 14:45:00', '15', 1, 0, 1),
(11, 'Clave alarma yaneth', 'Asignar nueva clave de alarma', 'Yaneth queda con el usuario No 048 de la clave de alarma.', '2013-07-12 08:40:26', '2013-07-12 08:47:26', '2013-07-12 08:40:26', '7', 1, 0, 1),
(12, 'Instalacion Antivirus ESET', 'Buenos dias Stiven, Favor realizar Instalacion de Antivirus ESET en las estaciones de trabajo de los usuarios:\nAna Vanegas, Paola Zapata, Neydi Castro, Alexandra Valencia, estos con la configuracion entregada (Caja 1)', 'Antivirus instalado en los anteriores equipos.', '2013-07-12 08:27:58', '2013-07-12 12:00:00', '2013-07-12 08:27:58', '213', 1, 0, 1),
(14, 'Computador freddy', 'Analizar por que esta tan lento el computador', 'Se desinstalan programas de descargas y se hace una limpieza', '2013-07-12 15:00:00', '2013-07-12 15:20:00', '2013-07-12 15:00:00', '20', 1, 0, 1),
(15, 'Creacion Manuales de Configuracion', 'amablemente solicito el favor de realizar los manuales de configuración de usuarios en el control de acceso y en la administración de las alarmas.  a tu correo se envía el documento con un ejemplo de la creación del manual.  Gracias.', 'Creado y enviado', '2013-07-15 10:36:11', '2013-07-15 16:12:11', '2013-07-15 10:36:11', '336', 1, 0, 1),
(16, 'Instalacion Antivirus Eset', 'Instalar antivirus en operaciones, en los equipos de: Nohora, Gustavo santa, walther seidel, aranda, coordinadores', 'Se instala en todos los equipos menos en el portatil de walther, pues dice el que no lo tiene en la empresa.', '2013-07-15 09:00:46', '2013-07-15 11:00:46', '2013-07-15 09:00:46', '120', 1, 0, 1),
(17, 'Creacion de correos', 'Crear correos pendientes de la lista que envio martha al correo', 'Se crean los correos, y hay inconvenientes frente a los correos existentes y a quien pertenecen.', '2013-07-16 14:20:00', '2013-07-16 15:04:04', '2013-07-16 14:20:00', '44', 1, 0, 1),
(18, 'Creacion de lista de correos operadores', 'Crear lista de correos de solo operadores', 'se crea la lista con los correos de los operadores, ya que la lista que habia involucraba personal de patio', '2013-07-16 17:00:00', '2013-07-16 17:45:00', '2013-07-16 17:00:00', '45', 1, 0, 1),
(19, 'Revision equipo de rosa', 'Equipo de rosa se bloquea inesperadamente', 'Se limpian las memorias y se desinstala cobian. Hay que hacer un sistema de backup para los equipos', '2013-07-17 08:40:00', '2013-07-17 09:10:00', '2013-07-17 08:40:00', '30', 1, 0, 1),
(20, 'Instalacion Antivirus Eset', 'Instalar en quipos de Aranda, portatil Walther, Dary y Alexander', 'Antivirus instaladas, licencias caja 2 agotadas', '2013-07-17 09:46:37', '2013-07-23 12:46:37', '2013-07-17 09:46:37', '3780', 1, 0, 1),
(21, 'Revision Impresion Alejandro Ramirez', 'favor realizar revision de configuracion de impresora de Alejandro Ramirez ya que le aparece un error,  reinstalar el driver.', 'No es problema de driver, es la cola impresion del area de mantenimiento, se demora en imprimir varias hojas.', '2013-07-18 09:21:36', '2013-07-18 09:36:00', '2013-07-18 09:21:36', '15', 1, 0, 1),
(22, 'Error en carnet de coordinadores', 'Carnet de didier orozco muestra foto de oscar chara.', 'Se cambia la foto del carnet en el sistema y se activa el carnet de oscar chara que estaba desactivado', '2013-07-18 08:50:05', '2013-07-18 09:00:05', '2013-07-18 08:50:05', '10', 1, 0, 1),
(23, 'Mouse operaciones', 'Mouse de equipo de aranda presenta fallas. ', 'Se cambia el mouse. Anteriormente se habia cambiado el teclado por daño.', '2013-07-18 09:06:11', '2013-07-18 09:15:12', '2013-07-18 09:06:11', '9', 1, 0, 1),
(24, 'Cambiar telefono operaciones', 'Carbiar telefono de operaciones (403) a la oficina donde estaba Git', 'Se hace el respectivo cambio', '2013-07-22 16:25:04', '2013-07-22 16:36:00', '2013-07-22 16:25:04', '11', 1, 0, 1),
(25, 'Cambiar PC de Wilber Valencia', 'Cambiar computador de wilber por el portatil que hay en informatica (de milenio) para llevar el que el tiene a garantia', 'Se hace el cambio, y el portatil esta en informatica', '2013-07-22 15:30:00', '2013-07-22 17:15:28', '2013-07-22 15:30:00', '105', 1, 0, 1),
(26, 'Impresora Financiero', 'No se puede imprimir desde un equipo diferente de neydi, desde el servidor.', 'Se reinicia el servidor. El servidor muestra un mensaje de error y posteriormente un pantallazo azul. Lo reinicie de modo forzoso y funcionó', '2013-07-23 08:50:43', '2013-07-23 09:20:43', '2013-07-23 08:50:43', '30', 1, 0, 1),
(27, 'Cable para Portatil walther', 'No llega la señal al portatil que maneja didier orozco', 'Se le coloca un cable de red', '2013-07-23 09:40:41', '2013-07-23 09:45:41', '2013-07-23 09:40:41', '5', 1, 0, 1),
(28, 'Correo Jorge soto', 'Jorge dice que cuando le mandaba un correo que llegaba de metrocali a ruben valderrama se le devolvia con el remitente de Carlos perez', 'El problema era que la cuenta de metrocali configurada en el outlook de jorge soto tenia el nombre de carlos perez, ya esta solucionado', '2013-07-23 10:00:02', '2013-07-23 10:30:02', '2013-07-23 10:00:02', '30', 1, 0, 1),
(29, 'No hay internet en el pc de wilber', 'No hay internet', 'La ip de la tarjeta de red estaba mal configurada. solucionado, tambien pidio que se le habilite youtube', '2013-07-23 11:20:00', '2013-07-23 11:40:19', '2013-07-23 11:20:00', '20', 1, 0, 1),
(30, 'Gestion Amplicacion memoria RAM Operaciones', 'Se solicita la ampliación de la memoria RAM del equipo de los coordinadores de operaciones ya que después de formateo equipo mejora pero es necesario mas rendimiento.', 'Se realiza gestión de compra e instalación de memoria RAM en equipo de usuario.', '2013-07-19 12:58:01', '2013-07-19 16:58:01', '2013-07-19 12:58:01', '240', 48, 0, 1),
(31, 'Yanneth No puede entrar al pc', 'Yanneth no puede ingresar al usuario en el pc', 'Intente ingresar con el usuario administrador pero tampoco dejó, por el modo seguro si entre pero aparecia que no habia red, entonces lo inicie con la ultima configuracion correcta conocida. y listo', '2013-07-23 13:35:24', '2013-07-23 13:50:24', '2013-07-23 13:35:24', '15', 1, 0, 1),
(32, 'Configuracion de impresora Gerencia', 'Configurar impresora nueva en gerencia.', 'Se configura la impresora, ademas de eso el pc de yanneth tenia problemas de sistema operativo. lo solucione restaurando el sistema a un punto anterior.', '2013-07-23 16:00:41', '2013-07-23 17:10:41', '2013-07-23 16:00:41', '70', 1, 0, 1),
(33, 'Configuracion correo henry polania', 'Configurar correo corporativo en el portatil asignado', 'Se configura dicho correo', '2013-07-24 09:30:00', '2013-07-24 09:36:00', '2013-07-24 09:30:00', '6', 1, 0, 1),
(34, 'Configuracion impresora Wilber V.', 'Configurar la impresora de operaciones a wilber valencia, no estaba instalada', 'Completada', '2013-07-24 10:51:38', '2013-07-24 11:00:38', '2013-07-24 10:51:38', '9', 1, 0, 1),
(35, 'Configurar perfil de correo coordinadores', 'Configurar cuentas de correo en el usuario de coordinadores en el pc de walther seidel. (aranda, buses, alistamiento)', 'Se crea nuevo perfil para este usuario', '2013-07-24 11:00:53', '2013-07-24 11:11:53', '2013-07-24 11:00:53', '11', 1, 0, 1),
(36, 'Entrega Documentación de proyectos', 'Favor realizar entrega de la documentación de los proyectos en los cuales se encuentra trabajando hasta el momento que son, la creación del Software de Administración del Área de TI y La creación de la pagina Web tal cual se explica en correo previamente enviado..\n\n\n\n\n', 'Se envia la documentacion que se pidio', '2013-07-29 22:52:35', '2013-08-01 09:30:35', '2013-07-29 22:52:35', '1290', 1, 0, 1),
(37, 'Configuracion PC henry polania', 'Configurar y entregar pc alquilado de henry polania', 'Se configura, y pasa toda la informacion y se entrega a henry.', '2013-07-29 11:00:08', '2013-07-29 15:17:08', '2013-07-29 11:00:08', '257', 1, 0, 1),
(38, 'Activar youtube a wilber valencia', 'Activar youtube a wilber para ver videos de quejas de operadores', 'Adicioné la ip de wilber al control de acceso del router', '2013-07-29 02:00:06', '2013-07-29 14:15:06', '2013-07-29 02:00:06', '375', 1, 0, 1),
(39, 'Configurar PC de bernardo', 'Pasar informacion del pc que tenia bernardo al portatil', 'Se configuro toda la informacion de bernardo en el portatil', '2013-07-29 14:00:45', '2013-07-29 14:00:45', '2013-07-29 14:00:45', '0', 1, 0, 1),
(40, 'Instalar ecolife', 'Instalar ecolife en pc de anderson salas. cambiar idioma y permitir los reportes en pdf', 'Se configura el software, en la parte de reportes se cambia el idioma y se guarda en pdf', '2013-07-30 10:24:11', '2013-07-30 11:00:12', '2013-07-30 10:24:11', '36', 1, 0, 1),
(41, 'Mover impresora mtto', 'Cambiar de ubicacion impresora de mantenimiento por peticion de Claudia garcia', 'Se hace el cambio, tambien se configura el correo corporativo de claudia en el pc asignado en mantenimiento.', '2013-07-30 11:06:13', '2013-07-30 11:24:00', '2013-07-30 11:06:13', '18', 1, 0, 1),
(42, 'Traslado de Equipo de Escritorio', 'Contactar a usuario encargado de equipo de prevención Vial y cuadrar el traslado de equipo de Computo en Área de operaciones "Por favor me podrías indicar cuando se podría llevar a cabo el traslado del equipo de computo de los jefes de prevención vial" Wilber Valencia.  ', 'Listo, ya esta.', '2013-08-01 08:49:19', '2013-08-01 15:09:19', '2013-08-01 08:49:19', '380', 1, 0, 1),
(43, 'Instalar Publisher', 'Instalar publisher en equipo de monica perez para hacer un folleto', 'Queda instalado', '2013-08-01 10:00:49', '2013-08-01 10:10:49', '2013-08-01 10:00:49', '10', 1, 0, 1),
(44, 'Problema con conferencia online', 'Problema con conferencia con siesa por medio de una pagina que ellos enviaron.', 'Lo que no dejaba conectar era el firewall del antivirus, lo desactive por 4 horas', '2013-08-01 09:48:00', '2013-08-01 10:00:59', '2013-08-01 09:48:00', '12', 1, 0, 1),
(45, 'Mover equipo de prevencion vial', 'Mover equipo de prevencion vial al cuarto donde estaba git masivo. y mover a nohora mora al puesto donde estaba dicho equipo', 'Se mueve el equipo al escritorio donde se necesita.', '2013-08-01 14:03:39', '2013-08-01 15:09:39', '2013-08-01 14:03:39', '66', 1, 0, 1),
(46, 'Clave Alarma', 'Otorgar clave ce Alarma y brindar inducción a Escolta de Dra.  Giovanna Bellini (andres) a petición de Dra. Silvia Morales.', 'Se asigna clave para desarmar zona 1 (Gerencia). Queda con el numero 049 en la hoja de claves y alarmas', '2013-08-02 10:24:09', '2013-08-15 13:00:09', '2013-08-02 10:24:09', '7956', 1, 0, 1),
(47, 'Desinstalación Software Blanco y Negro', 'Favor realizar la desinstalación de software de toma remota en las maquinas de Blanco y Negro, alexander, paola y los 3 equipos ubicados en el edificio de Almacén.  Realizar la instalación de Real VNC. a petición de la Gerencia.', 'Desinstalado el teamviewer de los equipos mencionados. Alexander lombo dice que con eso se comunica con sistemas de informacion.', '2013-08-02 12:01:09', '2013-08-06 14:42:09', '2013-08-02 12:01:09', '2561', 1, 0, 1),
(48, 'Configurar impresora de gerencia', 'Configurar la impresora de gerencia en el equipo del doctor eduardo', 'Queda configurada', '2013-08-02 14:18:22', '2013-08-02 14:30:22', '2013-08-02 14:18:22', '12', 1, 0, 1),
(49, 'Verificacion Lista Desechos Electronicos', 'Se solicita amablemente la verificación y actualización de la lista de desechos Electrónicos para ser retirados antes del día miércoles.  ', 'La lista se realiza y se envia por correo electronico.', '2013-08-05 07:44:21', '2013-08-06 08:06:21', '2013-08-05 07:44:21', '606', 1, 0, 1),
(50, 'Verificacion Scanner Gestion Humana', 'Favor verificar y certificar el correcto funcionamiento del scanner en el área de Recursos Humanos.  algunos usuarios dicen que el dia de hoy no han podido escanear.', 'No tiene notas/solucion', '2013-08-05 13:49:50', '2013-08-06 08:09:54', '2013-08-05 13:49:50', '260', 1, 0, 1),
(51, 'Configuracion Impresora', 'Configurar impresora de gestion humana en el servidor', 'Se configura impresora y ademas se arregla la conexion de la impresora de punto en gestion humana', '2013-08-06 09:24:07', '2013-08-06 09:39:07', '2013-08-06 09:24:07', '15', 1, 0, 1),
(52, 'Impresora financiero', 'Impresora de financiero no queria imprimir desde los computadores en la que esta configurada', 'Queda funcionando. Lo que impedia imprimir en ella es un error comun en impresoras HP, solo hay que desconectar el cable cuando esta prendida, esperar 15s y reconectar.', '2013-08-08 09:30:22', '2013-08-08 10:03:00', '2013-08-08 09:30:22', '33', 1, 0, 1),
(53, 'Configurar PC de recepcion', 'Configurar computador de recepcion a la nueva persona que ocupara ese puesto.', 'Se configura el pc de recepcion con el usuario de Heidy Castro que se creó en el dominio. Posteriormente se procede a pasar informacion como los correos y documentos de la anterior persona. Se desinstala software y controladores de impresoras anteriores.', '2013-08-08 10:06:00', '2013-08-08 11:30:42', '2013-08-08 10:06:00', '84', 1, 0, 1),
(54, 'Impresora gestion humana', 'Impresora de gestion humana no imprime desde ningun computador', 'El mismo problema que tenia la impresora de financiero', '2013-08-08 17:25:01', '2013-08-08 17:38:01', '2013-08-08 17:25:01', '13', 1, 0, 1),
(55, 'Revision Buzon', 'Favor realizar revision de buzón de correo aranda, la configuración debe quedar eliminando a 1 mes y se debe hacer depuración en servidor, se debe explicar que solo quedara back up de 1 mes en el servidor.\n\nel mismo proceso realizarlo en buzón de usuario ivan.gallego, ambas cuentas están superando limites de buzón.', 'Se cambia el tipo de sincronizacion de correo de IMAP a POP3 junto con el backup de correos y carpetas. Tambien se deja borrando los correos del servidor cada 30 dias', '2013-08-09 07:48:39', '2013-08-20 13:00:00', '2013-08-09 07:48:39', '6900', 1, 0, 1),
(56, 'Configurar Impresora de operaciones', 'Configurar impresora de operaciones en equipo de julian beltran.', 'Queda configurada la impresora de operaciones en ese equipo. ademas de permitir acceso a youtube por medio de wifi y cable. iba a instalar el antivirus pero al reiniciar el pc tenia contraseña.', '2013-08-09 10:12:26', '2013-08-09 11:00:26', '2013-08-09 10:12:26', '48', 1, 0, 1),
(57, 'Trasladar equipos de computo', 'Trasladar 2 equipos en operaciones. El pc de aranda a escritorio donde estaba nohora y el pc de coordinadores de servicios a donde estaba aranda.', 'Se traslada los dos equipos exitosamente.', '2013-08-13 10:00:36', '2013-08-13 11:00:03', '2013-08-13 10:00:36', '60', 1, 0, 1),
(58, 'Equipo de recepcion con problemas', 'El equipo de recepcion tiene problemas, en ocasiones se queda trabado ', 'se destapa y se limpian las memorias.', '2013-08-13 11:09:03', '2013-08-13 11:24:00', '2013-08-13 11:09:03', '15', 1, 0, 1),
(59, 'Quemar 2 CDS a alexandra', 'Quemar una informacion en CDS a alexandra', 'Se quema dicha informacion, pues ellas habian intentado hacerlo sin exito.', '2013-08-13 11:45:38', '2013-08-13 12:00:38', '2013-08-13 11:45:38', '15', 1, 0, 1),
(60, 'Creacion de correos', 'Crear correos de personal nuevo.', 'Se crean los correos de la lista del personal nuevo enviada por correo electronico', '2013-08-13 14:06:00', '2013-08-13 14:39:37', '2013-08-13 14:06:00', '33', 1, 0, 1),
(61, 'Archivo PST wilber', 'Archivo presenta fallas', 'Se repara el archivo PST con la herramienta que trae microsoft outlook', '2013-08-13 15:06:49', '2013-08-13 15:39:00', '2013-08-13 15:06:49', '33', 1, 0, 1),
(62, 'Carolina no puede escanear', 'Carolina no puede escanear en la impresora de gestion humana', 'El acceso directo al software para escanear en esa impresora no era el correcto. Se reemplaza por el correcto.', '2013-08-13 15:45:06', '2013-08-13 15:54:06', '2013-08-13 15:45:06', '9', 1, 0, 1),
(63, 'Desactivar correo y acceso', 'desactivar correo y acceso de:\nvictor hugo peñariez\ncarlos enrique bolaños\ngeremias moreno\nwilliam paladines\nvictor alvarez ', 'Se desactiva correo y acceso al personal retirado. tambien se elimina de la lista de correos', '2013-08-15 15:00:03', '2013-08-15 15:11:03', '2013-08-15 15:00:03', '11', 1, 0, 1),
(64, 'Cambio equipo Wilber', 'Favor realizar traslado de informacion y cambio de equipo al Sr. Wilber Valencia, favor usar checklist para estar seguro de entrega de configuracion completa y para verificacion de back up con el usuario ya que la otra maquina se debe formatear de inmediato.  Gracias.', 'Se hace el respectivo cambio, ademas de instalar el ofice y configurar todo. el quipo no se puede ingresar al dominio pues la version del sistema operativo no lo deja.', '2013-08-20 17:33:35', '2013-08-21 17:00:00', '2013-08-20 17:33:35', '567', 1, 0, 1),
(65, 'Traslado PC nany vargas', 'Trasladar equipo de nany a la oficina en el 2do piso.', 'Se traslada el equipo de nany vargas al puesto asignado. el puesto asignado tiene conexion a red por medio de un switch y de energia por medio de una extensión', '2013-08-23 15:00:40', '2013-08-23 16:03:00', '2013-08-23 15:00:40', '63', 1, 0, 1),
(66, 'Telefono de nohora', 'Telefono de nohora presenta fallas', 'Hago cambio temporal de ese telefono por uno que estaba en bodega. Ese telefono era de los auxiliares de almacen.', '2013-08-23 11:00:13', '2013-08-23 11:33:13', '2013-08-23 11:00:13', '33', 1, 0, 1),
(67, 'Tarjetas de control', 'Entregar tarjetas de control a gestion humana', 'Se entregan 11 tarjetas de control a carolina medina.', '2013-08-23 14:14:19', '2013-08-23 14:30:19', '2013-08-23 14:14:19', '16', 1, 0, 1),
(68, 'Configurar PC de diana pratt', 'Configurar PC de diana pratt', 'Queda configurado el PC de diana pratt en la oficina de m. cristina.', '2013-08-26 09:30:00', '2013-08-26 10:15:01', '2013-08-26 09:30:00', '45', 1, 0, 1),
(69, 'Telefono Douglas', 'Telefono de servicios especiales no funciona', 'Se verifica y se hace prueba con otro telefono. Al parecer estaba mal conectado', '2013-08-26 11:42:09', '2013-08-26 13:00:09', '2013-08-26 11:42:09', '78', 1, 0, 1),
(70, 'Instalacion de dropbox en equipos', 'Instalar dropbox en equipos de neydi y alexander lombo', 'Se instala y se les configura una cuenta en dropbox con el correo corporativo. se da leve capacitacion', '2013-08-26 02:00:23', '2013-08-26 14:36:00', '2013-08-26 02:00:23', '396', 1, 0, 1),
(71, 'Configurar telefonos ', 'Configurar telefonos nuevos en los puestos de Claudia y Alejandro ramirez.', 'Se hace dicha configuracion en los puestos de claudia y alejandro. tambien se pasa el telefono de marcelly al puesto de ella.', '2013-08-26 15:09:18', '2013-08-26 16:00:18', '2013-08-26 15:09:18', '51', 1, 0, 1),
(72, 'Configurar WINPAK en equipo de Eidy', 'Configurar winpak en equipo de eidy para la apertura de la puerta de gestion humana.', 'Se le da un usuario y contraseña a eidy para que ingrese al winpak y se explica como es el procedimiento', '2013-08-26 16:30:43', '2013-08-26 17:00:00', '2013-08-26 16:30:43', '30', 1, 0, 1),
(73, 'Impresora mantenimiento', 'La impresora no funciona', 'El cable de red estaba mal conectado. Se conecta y empieza a imprimir de inmediato', '2013-08-30 10:00:02', '2013-08-30 10:30:00', '2013-08-30 10:00:02', '30', 1, 0, 1),
(74, 'Teclado porteria', 'El teclado de porteria esta en mal estado', 'Se hace cambio de teclado por el teclado del Dr Eduardo', '2013-08-30 15:27:53', '2013-08-30 16:00:00', '2013-08-30 15:27:53', '33', 1, 0, 1),
(75, 'Acceso a alarma financiero Nany', 'Por cambio de oficina Nany solitica acceso a clave para financiero.', 'Se cambia acceso de gestion humana a financiero. No usuario nany 044', '2013-08-30 17:42:57', '2013-09-03 17:54:57', '2013-08-30 17:42:57', '2412', 1, 0, 1),
(76, 'Sonido sala de capacitacion', 'No funcionan algunos parlantes de la sala de capacitacion.', 'Se cambian los conectores de posicion hasta que suenen los parlantes que faltan.', '2013-09-04 16:30:13', '2013-09-16 16:45:13', '2013-09-05 08:09:54', '7215', 1, 1, 1),
(77, 'Impresora financiero no imprime', 'No se puede imprimir en la impresora laser desde cualquier equipo a excepcion de neydi.', 'La impresora de red aparece como desconectada en los equipos. Se le pide a neydi que reinicie el equipo de ella.', '2013-09-05 08:18:00', '2013-09-05 08:42:31', '2013-09-05 09:06:13', '24', 1, 1, 1),
(78, 'Equipo Almacen', 'favor realizar instalacion de equipo de computo en el almacén, firmar el acta de entrega por el responsable y dejar el cableado organizado.', 'Se instala equipo en el almacen. El acta de entrega se coloca en la carpeta de Claudia Garcia.', '2013-09-05 14:19:26', '2013-09-05 15:30:26', '2013-09-05 14:48:45', '71', 1, 48, 1),
(79, 'Camara de lavado', 'No funciona la camara de lavado', 'Una falla electrica provocó que el switch se apagara. ', '2013-09-05 16:00:44', '2013-09-05 16:15:44', '2013-09-10 10:16:01', '15', 1, 1, 1),
(80, 'Outlook claudia garcia', 'Complemento de outlook lo bloquea y no permite trabajar.', 'Se deshabilita el complemento del outlook', '2013-09-06 14:30:20', '2013-09-06 14:54:20', '2013-09-10 10:14:03', '24', 1, 1, 1),
(81, 'Falla en los lectores de las puertas', 'La puerta de gestión humana presentó fallas en el lector y pulsador.', 'Se deshabilita la seguridad en las puertas mientras se reinicia los paneles que las controlan.', '2013-09-06 09:04:16', '2013-09-06 11:24:00', '2013-09-10 10:31:20', '140', 1, 1, 1),
(82, 'Internet oscar gonzales', 'El equipo esta sin red', 'En el administrador de equipo aparecen unos dispositivos que no son reconocidos por el sistema. Se deshabilitan esos dispositivos de red. Con eso ya hay internet.', '2013-09-10 10:05:48', '2013-09-10 10:20:00', '2013-09-10 10:00:25', '15', 1, 1, 1),
(83, 'Ayuda con macro de stefany', 'No puede abrir un archivo que contiene macros', 'Se habilita la apertura de macros en excel', '2013-09-11 11:00:05', '2013-09-11 11:18:05', '2013-09-12 16:07:32', '18', 1, 1, 1),
(84, 'Solucion a tickeet #565 Nany vargas', 'Configurar el correo servi.generales@blancoynegro.com.co en el equipo del nuevo directo de servicios especiales', 'Se configura el correo en dicho equipo', '2013-09-12 14:00:46', '2013-09-12 14:30:46', '2013-09-12 17:18:40', '30', 1, 1, 1),
(85, 'Excel en equipo de jhonny largacha', 'Se demora mucho en abrir excel.', 'Se hace una limpieza del inicio de windows y se reinicia el sistema. Se desinstalan algunos programas que no son necesarios.', '2013-09-12 15:06:59', '2013-09-12 15:50:59', '2013-09-12 17:38:51', '44', 1, 1, 1),
(86, 'Impresora en equipo de Freddy', 'No imprime desde el equipo de freddy en la impresora de mantenimiento, sale error de cola de impresion', 'Se reinicia la cola de impresion', '2013-09-13 10:30:51', '2013-09-13 10:51:51', '2013-09-17 08:59:14', '21', 1, 1, 1),
(87, 'Reproductor de musica equipo de Diana', 'El reproductor de windows no abre', 'Se instala VLC como reproductor', '2013-09-13 14:16:15', '2013-09-13 15:06:15', '2013-09-17 08:18:23', '50', 1, 1, 1),
(88, 'Raton de equipo de freddy', 'El scroll del raton no funciona', 'Se cambia el raton. Los dos ratones son de milenio pc.', '2013-09-13 15:12:13', '2013-09-13 15:30:13', '2013-09-17 08:13:26', '18', 1, 1, 1),
(89, 'Reinicio de servidor de blanco y negro', 'En servimenga no pueden ingresar al servidor linux', 'Se reinicia el servidor ', '2013-09-13 08:00:28', '2013-09-13 08:20:28', '2013-09-17 08:36:27', '20', 1, 1, 1),
(90, 'Equipos de operadores no prendes', 'Los equipos no tenian energia, al parecer una falla electrica.', 'Se conectar a una regleta que esta conectada en un toma de energia regulada', '2013-09-13 08:36:49', '2013-09-13 09:28:49', '2013-09-17 08:19:29', '52', 1, 1, 1),
(91, 'Scanner en equipo de wilber', 'Instalar la opcion de scanner de la impresora de operaciones en el equipo de wilber ', 'Se instala el controlador correspondiente al scanner de la impresora. Tambien aproveche para desinstalar software inecesario.', '2013-09-16 10:00:00', '2013-09-16 10:36:12', '2013-09-17 10:19:03', '36', 1, 1, 1),
(92, 'Teclado de claudia presenta falla', 'La tecla ''C'' no funciona', 'Para solucionarlo lo cambie de puerto usb y actualice el controlador.', '2013-09-16 11:03:07', '2013-09-16 11:33:07', '2013-09-17 10:41:10', '30', 1, 1, 1),
(93, 'Sale mala las impresiones', 'Cuando envia a imprimir cierto documento este sale mal impreso.', 'El problema es del archivo que estaba imprimiento', '2013-09-16 14:33:35', '2013-09-16 14:59:35', '2013-09-17 11:15:30', '26', 1, 1, 1),
(94, 'configuración usuario', 'Configuración usuario Dyan en dominio, estandarizacion de maquina con nombre BYNM-DYAREN', 'Se configura el usuario de dyan en el PC asignado, pasando todos los documentos y carpetas, incluyendo los archivos de correo a este nuevo perfil', '2013-09-19 17:53:04', '2013-09-23 09:30:01', '2013-09-18 17:09:53', '697', 1, 48, 1),
(95, 'Pantallazos equipo de julian', 'Equipo presenta pantallazos azules en varias ocaciones', 'Se limpian las memoras, se limpia el inicio de windows. pero al parecer es problema de discoduro, quedamos en hacer backup y luego hacerle pruebas al disco.', '2013-09-18 16:00:22', '2013-09-18 16:42:22', '2013-09-20 16:00:23', '42', 1, 1, 1),
(96, 'Publisher wilber valencia', 'Wilber solicita que se le sea instalado publisher para un asunto con rutas de metrocali', 'Se instala solo el publisher. Pero al instalarlo se desactivan los otros programas de office. Se reinstala office con todos los componentes. ', '2013-09-19 11:09:00', '2013-09-19 12:00:00', '2013-09-20 16:18:42', '51', 1, 1, 1),
(97, 'Correo y impresora de ivan gallego', 'Ivan informa de que no puede enviar correos y que no tiene configurada la impresora', 'Habia un correo en la bandeja de salida que pesaba 90mb, se elimina ese correo de la bandeja de salida. La impresora no estaba como predeterminada.', '2013-09-19 13:30:35', '2013-09-19 13:42:35', '2013-09-20 16:51:49', '12', 1, 1, 1),
(98, 'Formateo equipo neidy castro', 'El equipo presenta fallas de red y de sistema operativo', 'Se realiza el respestivo proceso para el formateo de equipos de computo y se porcede con la restauracion del sistema.', '2013-09-19 09:30:06', '2013-09-19 17:30:06', '2013-09-20 16:15:52', '480', 1, 1, 1),
(99, 'Configuracion de impresosa de financiero', 'Configurar en los equipos de contabilidad la impresora de financiero', 'Quedan configurada la impresora en los equipos de Paola, silvia y ana.', '2013-09-20 09:53:31', '2013-09-20 10:15:31', '2013-09-20 16:55:53', '22', 1, 1, 1),
(100, 'Maquinas en Dominio Blanco Y NEgro', 'Estandarizar maquinas en el Dominio:  Dyan Rengifo, Claudia Garcia,  una vez estandarizadas enviar por correo los nombres antiguos para darles de baja en el DA.', 'Quedan con el nuevo formato BYNM-CLAGAR\nBYNM-DYAREN\n y se envian los antiguos nombres por correo para darles de baja en el dominio', '2013-09-26 15:18:06', '2013-10-03 11:40:35', '2013-09-26 10:06:22', '2782', 1, 48, 1),
(101, 'Correo mio.com.co carolina', 'Se presenta problemas al recibir correos desde byn.personal@mio.com.co ', 'Se configura para todos los que reciben mensajes desde este correo: recent:byn.personal@mio.com.co', '2013-09-24 16:40:17', '2013-09-25 15:15:17', '2013-09-27 16:47:42', '515', 1, 1, 1),
(102, 'Impresora GH', 'Cuando se quiere escanear, la impresora no arrastra el papel', 'La compuesta que arrastra al papel estaba desajustada', '2013-09-24 14:00:40', '2013-09-24 14:30:40', '2013-09-27 16:51:58', '30', 1, 1, 1),
(103, 'Toner de impresora mtto', 'Se agotó el toner de mtto', 'Se hace el cambio por el toner recargado que está en el gabinete de gerencia', '2013-09-24 17:01:31', '2013-09-24 17:42:31', '2013-09-27 17:25:01', '41', 1, 1, 1),
(104, 'Formateo equipo yanneth', 'Formatear equipo de yanneth (asistente de gerencia)', 'Se formatea el equipo y se deja el perfil de yanneth mientras llega la nueva asistente', '2013-09-25 09:30:54', '2013-09-25 14:00:54', '2013-09-27 17:58:09', '270', 1, 1, 1),
(105, 'Instalar adobe reader a neydi', 'Pide que se le instale adobe reader para la lectura de pdf', 'Se le instala adobe reader X', '2013-09-25 10:00:34', '2013-09-25 10:15:34', '2013-09-27 17:36:14', '15', 1, 1, 1),
(106, 'Correo mio.com.co santiago', 'No recibe correo de la cuenta byn.personal@mio.com.co', 'Se realiza el mismo proceso que a carolina', '2013-09-27 13:52:18', '2013-09-27 14:12:18', '2013-10-01 13:23:52', '20', 1, 1, 1),
(107, 'Impresora en equipo de freddy', 'No puede imprimir, y no envia ni entra correos.', 'Se habia desconectado el telefono, el cual provee de red al equipo de freddy. Se conecta y queda funcionando perfectamente', '2013-09-27 14:00:03', '2013-10-01 14:30:03', '2013-10-01 13:29:59', '1230', 1, 1, 1),
(108, 'Impresora de heydi no funciona', 'Cuando heydi manda a imprimir la impresora no responde. En la cola de impresion aparece 18600 documentos.', 'Los documentos que aparecian en la cola de impresion son enviandos desde el servidor, desde el usuario de paola zapata. Se reinicia la cola de impresion desde el servidor.', '2013-09-30 09:00:00', '2013-09-30 09:48:00', '2013-10-01 16:55:11', '48', 1, 1, 1),
(109, 'Internet Paola (byn)', 'Paola informa de que no tiene internet ni sistema ni telefono', 'El swicth que provee de red a paola se encontraba apagado, pues este está conectado a un multitoma de alexander lombo y este lo apagó cuando salió.', '2013-09-30 14:12:37', '2013-09-30 14:54:37', '2013-10-01 16:23:22', '42', 1, 1, 1),
(110, 'Toner de mantenimiento', 'El toner de mantenimiento se acabó', 'Se cambia el toner por el que esta en genrencia.', '2013-09-30 15:00:06', '2013-09-30 15:12:06', '2013-10-01 16:46:34', '12', 1, 1, 1),
(111, 'No pueden ingresar al equipo de juegos', 'Operadores informan que no se puede ingresar al juego de uno de los equipos de recepcion.', 'El problema estaba en que no cierran sesion y queda la informacion en los datos de sesion del navegador (cookies). Se borran las cookies del navegador y listo.', '2013-09-30 16:37:51', '2013-09-30 16:57:51', '2013-10-01 16:38:38', '20', 1, 1, 1),
(112, 'Equipo de marcelly no arranca', 'Marcelly informa de que se apaga mal el equipo, y que no inicia despues de eso', 'Se hace el analisis del discoduro y se inicia de modo seguro. Se coloca nuevamente en el equipo de marcelly, e inicia sin problemas.', '2013-09-30 11:54:18', '2013-09-30 14:00:18', '2013-10-01 16:41:43', '126', 1, 1, 1),
(113, 'Equipo de monica', 'Monica informa que el equipo no prende', 'Estaba apagada la fuente de poder. Monica informa de que alguien esta entrando a su oficina sin permiso alguno', '2013-10-01 10:00:23', '2013-10-01 10:27:23', '2013-10-01 16:32:46', '27', 1, 1, 1),
(114, 'Open Office - thunderbird', 'Favor realizar la instalacion de Open Office y de Thunderbird en el equipo de la portería, una vez instalados notificar a coordinador de informática mediante coreo electronico', 'Se instala open office y thunderbird en el equipo de porteria. Se configura la cuenta de porteria@blancoynegromasivo.com.co y se importan los correos de outlook. No se desinstala Office.', '2013-10-02 15:59:11', '2013-10-03 09:42:25', '2013-10-02 16:33:07', '223', 1, 48, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_telefono`
--

CREATE TABLE IF NOT EXISTS `atl_telefono` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_ubicacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_telefono_tipo` int(11) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `n_serie` varchar(100) NOT NULL,
  `n_activo` varchar(100) NOT NULL,
  `firmware` varchar(150) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_telefono_tipo`
--

CREATE TABLE IF NOT EXISTS `atl_telefono_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `atl_telefono_tipo`
--

INSERT INTO `atl_telefono_tipo` (`id`, `nombre`, `descripcion`) VALUES
(1, 'IP', 'Telefono ip'),
(2, 'Analogo', 'Telefono analogo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_ticket`
--

CREATE TABLE IF NOT EXISTS `atl_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(150) NOT NULL,
  `mensaje` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `computador_relacionado` int(11) NOT NULL DEFAULT '0',
  `id_usuario_asignado` int(11) DEFAULT NULL,
  `id_origen` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_prioridad` int(11) DEFAULT NULL,
  `fecha_creado` datetime NOT NULL,
  `fecha_solucion` datetime DEFAULT NULL,
  `duracion` varchar(150) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `calificado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_ticket_archivo`
--

CREATE TABLE IF NOT EXISTS `atl_ticket_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `url` varchar(150) NOT NULL,
  `mime` text NOT NULL,
  `extension` varchar(20) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_ticket_calificacion`
--

CREATE TABLE IF NOT EXISTS `atl_ticket_calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) NOT NULL,
  `solucion` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_ticket_estado`
--

CREATE TABLE IF NOT EXISTS `atl_ticket_estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `atl_ticket_estado`
--

INSERT INTO `atl_ticket_estado` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Respondido', ''),
(2, 'Solucionado', ''),
(3, 'Sin Solución', 'Nuevo'),
(4, 'Vencido', ''),
(5, 'En Espera', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_ticket_mensaje`
--

CREATE TABLE IF NOT EXISTS `atl_ticket_mensaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `mensaje` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ticket` (`id_ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_ticket_origen`
--

CREATE TABLE IF NOT EXISTS `atl_ticket_origen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `atl_ticket_origen`
--

INSERT INTO `atl_ticket_origen` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Web', ''),
(2, 'Correo', ''),
(3, 'Teléfono', ''),
(4, 'Otro', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_ticket_prioridad`
--

CREATE TABLE IF NOT EXISTS `atl_ticket_prioridad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `atl_ticket_prioridad`
--

INSERT INTO `atl_ticket_prioridad` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Baja', ''),
(2, 'Normal', ''),
(3, 'Alta', ''),
(4, 'Urgente', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_ubicacion`
--

CREATE TABLE IF NOT EXISTS `atl_ubicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `descripcion` text NOT NULL,
  `id_padre` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `piso` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `atl_ubicacion`
--

INSERT INTO `atl_ubicacion` (`id`, `nombre`, `descripcion`, `id_padre`, `nivel`, `piso`) VALUES
(1, 'Edificio Administrativo', 'Edificio principal administrativo', 0, 1, 1),
(2, 'Cuarto de datos', 'Data center', 1, 2, 1),
(3, 'Financiero', 'Oficinas segundo piso', 1, 2, 2),
(4, 'Informática', 'Area de informatica', 3, 3, 1),
(5, 'Gerencia', '', 1, 2, 2),
(6, 'Gestión Humana', '', 1, 2, 1),
(7, 'Sala de Capacitacón', '', 6, 3, 1),
(8, 'Recepción', '', 1, 2, 1),
(9, 'Edificio Almacen', 'Edificio de almacen y mantenimiento', 0, 1, 1),
(10, 'Bodega', '', 9, 2, 1),
(11, 'Mantenimiento Piso 1', '', 9, 2, 1),
(12, 'Mantenimiento Piso 2', '', 9, 2, 2),
(13, 'Edificio Latoneria y Pintura', '', 0, 1, 1),
(14, 'Porteria 1', '', 0, 1, 1),
(15, 'Operaciones piso 1', '', 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atl_usuario`
--

CREATE TABLE IF NOT EXISTS `atl_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `ultimo_ingreso` datetime NOT NULL,
  `fecha_actualizado` datetime NOT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_lugar` int(11) NOT NULL,
  `nota_interna` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cargo` (`id_cargo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Volcado de datos para la tabla `atl_usuario`
--

INSERT INTO `atl_usuario` (`id`, `nombre`, `apellido`, `telefono`, `email`, `usuario`, `pass`, `id_rol`, `activo`, `ultimo_ingreso`, `fecha_actualizado`, `id_cargo`, `id_departamento`, `id_lugar`, `nota_interna`) VALUES
(1, 'Stiven', 'Castillo', '701', 'stiven.castillo@blancoynegromasivo.com.co', 'stiven.castillo', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, '2013-10-04 11:17:30', '2013-09-27 14:46:46', 1, 3, 1, 'Usuario administrador'),
(2, 'Paola', 'Zapata', '203', 'paola.zapata@blancoynegromasivo.com.co', 'paola.zapata', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-09-03 15:39:25', 3, 2, 1, 'Sin nota'),
(3, 'Alexandra', 'Valencia', '201', 'alexandra.valencia@blancoynegromasivo.com.co', 'alexandra.valencia', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-09-03 15:41:44', 22, 2, 1, 'Sin nota'),
(4, 'Claudia', 'Garcia', '501', 'claudia.garcia@blancoynegromasivo.com.co', 'claudia.garcia', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-09-10 23:55:16', '2013-09-03 15:44:26', 21, 5, 11, 'Sin nota'),
(5, 'Stefany', 'Angola', '308', 'stefany.angola@blancoynegromasivo.com.co', 'stefany.angola', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-09-03 15:47:28', 8, 4, 6, 'Sin nota'),
(6, 'Yanquen', 'Yanneth', '102', 'yanneth.yanquen@blancoynegromasivo.com.co', 'yanneth.yanquen', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-09-10 23:37:34', '2013-09-03 15:47:59', 5, 1, 1, 'Sin nota'),
(7, 'Walther', 'Seidel', '403', 'stiven.castillo@blancoynegromasivo.com.co', 'walther.seidel', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-09-30 15:28:03', '2013-09-03 15:50:16', 30, 6, 15, 'Sin nota'),
(9, 'Silvia', 'Morales', '200', 'silvia.morales@blancoynegromasivo.com.co', 'silvia.morales', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-09-11 23:15:31', '2013-09-03 15:51:21', 18, 2, 3, 'Sin nota'),
(10, 'Diana', 'Ramirez', '302', 'pruebas@blancoynegromasivo.com.co', 'diana.ramirez', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-09-03 16:03:38', 31, 4, 6, 'Sin nota'),
(11, 'Carolina', 'Medina', '304', 'carolina.medina@blancoynegromasivo.com.co', 'carolina.medina', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-09-03 16:04:19', 10, 4, 6, 'Sin nota'),
(12, 'Porteria', '1', '601', 'porteria@blancoynegromasivo.com.co', 'porteria1', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-09-03 16:05:44', 27, 9, 1, 'Sin nota'),
(14, 'Gustavo', 'Rios', '505', 'gustavo.rios@blancoynegromasivo.com.co', 'gustavo.rios', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(15, 'Julian', 'Triviño', '402', 'julian.trivino@blancoynegromasivo.com.co', 'julian.trivino', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(16, 'Martha', 'Garcia', '303', 'martha.garcia@blancoynegromasivo.com.co', 'martha.garcia', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(17, 'Maria Cristina', 'Villegas', '300', 'cristina.villegas@blancoynegromasivo.com.co', 'cristina.villegas', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(18, 'Alejandro', 'Ramirez', '600', 'alejandro.ramirez@blancoynegromasivo.com.co', 'alejandro.ramirez', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(19, 'Wilber', 'Valencia', '305', 'wilber.valencia@blancoynegromasivo.com.co', 'wilber.valencia', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(21, 'Heidy', 'Castro', '310', 'heidy.castro@blancoynegromasivo.com.co', 'heidy.castro', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-09-03 15:38:44', 10, 1, 1, 'Sin nota'),
(22, 'Porteria', '2', '602', 'porteria@blancoynegromasivo.com.co', 'porteria2', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(23, 'Porteria', '3', '603', 'porteria@blancoynegromasivo.com.co', 'porteria3', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(24, 'Neydi', 'Castro', '204', 'neydi.castro@blancoynegromasivo.com.co', 'neydi.castro', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(25, 'Gustavo', 'Santa', '406', 'gustavo.santa@blancoynegromasivo.com.co', 'gustavo.santa', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(27, 'Julian', 'Beltran', '400', 'julian.beltran@blancoynegromasivo.com.co', 'julian.beltran', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(28, 'Anderson', 'Salas', '504', 'anderson.salas@blancoynegromasivo.com.co', 'anderson.salas', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(30, 'Dyan', 'Rengifo', '309', 'dyan.rengifo@blancoynegromasivo.com.co', 'dyan.rengifo', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(31, 'Jorge', 'Soto', '502', 'jorge.soto@blancoynegromasivo.com.co', 'jorge.soto', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(32, 'Alejandro', 'Cardenas', '', 'alejandro.cardenas@blancoynegromasivo.com.co', 'alejandro.cardenas', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(33, 'Hector', 'Orrego', '407', 'hector.orrego@blancoynegromasivo.com.co', 'hector.orrego', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(34, 'Jhonny', 'Largacha', '506', 'jhonny.largacha@blancoynegromasivo.com.co', 'jhonny.largacha', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(35, 'Coordinadores', 'Control', '404', 'operaciones@blancoynegromasivo.com.co', 'coordinadores.control', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(36, 'Oscar', 'Gonzales', '', 'oscar.gonzales@blancoynegromasivo.com.co', 'oscar.gonzales', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(37, 'Nohora', 'Mora', '', 'nohora.mora@blancoynegromasivo.com.co', 'nohora.mora', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(38, 'Ana Isabel', 'Vanegas', '', 'ana.vanegas@blancoynegromasivo.com.co', 'ana.vanegas', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(39, 'Marcelly', 'Zapata', '', 'marcelly.zapata@blancoynegromasivo.com.co', 'marcelly.zapata', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(40, 'Cristian', 'Ruiz', '', 'cristian.ruiz@blancoynegromasivo.com.co', 'cristian.ruiz', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(41, 'Alexander', 'Lombo', '', 'alexander.lombo@blancoynegro.com.co', 'alexander.lombo', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(42, 'Elizabeth', 'Gonzales', '', 'elizabeth.gonzales@blancoynegro.com.co', 'elizabeth.gonzales', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(43, 'Aurelio', 'Valderrama', '', 'aurelio.valderrama@blancoynegromasivo.com.co', 'aurelio.valderrama', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(44, 'Freddy', 'Gutierrez', '', 'freddy.gutierrez@blancoynegromasivo.com.co', 'freddy.gutierrez', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(45, 'Alexander', 'Villota', '505', 'alexander.villota@blancoynegromasivo.com.co', 'alexander.villota', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(46, 'Dado de', 'Baja', '', 'debaja@blancoynegromasivo.com.co', 'debaja', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(47, 'Sandra', 'Herrera', '', 'sandra.herrera@blancoynegromasivo.com.co', 'sandra.herrera', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(48, 'Wilmer', 'Duque', '', 'wilmer.duque@blancoynegromasivo.com.co', 'wilmer.duque', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, '2013-09-26 10:41:11', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(49, 'Ruben', 'Valderrama', '506', 'ruben.valderrama@blancoynegromasivo.com.co', 'ruben.valderrama', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(50, 'Monica', 'Perez', '', 'monica.perez@blancoynegromasivo.com.co', 'monica.perez', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-07-03 00:00:00', '2013-07-03 00:00:00', 1, 1, 1, 'Sin nota'),
(51, 'Usuario', 'ejemplo', '123123', 'informatica@blancoynegromasivo.com.co', 'usuario', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, '2013-10-03 15:14:55', '2013-10-03 15:10:47', 13, 3, 4, '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `atl_computador_discoduro`
--
ALTER TABLE `atl_computador_discoduro`
  ADD CONSTRAINT `atl_computador_discoduro_ibfk_4` FOREIGN KEY (`id_componente`) REFERENCES `atl_componente_discoduro` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `atl_computador_discoduro_ibfk_3` FOREIGN KEY (`id_computador`) REFERENCES `atl_computador` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `atl_computador_dispositivo`
--
ALTER TABLE `atl_computador_dispositivo`
  ADD CONSTRAINT `atl_computador_dispositivo_ibfk_2` FOREIGN KEY (`id_dispositivo`) REFERENCES `atl_dispositivo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `atl_computador_dispositivo_ibfk_1` FOREIGN KEY (`id_computador`) REFERENCES `atl_computador` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `atl_computador_impresora`
--
ALTER TABLE `atl_computador_impresora`
  ADD CONSTRAINT `atl_computador_impresora_ibfk_2` FOREIGN KEY (`id_impresora`) REFERENCES `atl_impresora` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `atl_computador_impresora_ibfk_1` FOREIGN KEY (`id_computador`) REFERENCES `atl_computador` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `atl_computador_memoria`
--
ALTER TABLE `atl_computador_memoria`
  ADD CONSTRAINT `atl_computador_memoria_ibfk_2` FOREIGN KEY (`id_componente`) REFERENCES `atl_componente_memoria` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `atl_computador_memoria_ibfk_1` FOREIGN KEY (`id_computador`) REFERENCES `atl_computador` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `atl_computador_monitor`
--
ALTER TABLE `atl_computador_monitor`
  ADD CONSTRAINT `atl_computador_monitor_ibfk_2` FOREIGN KEY (`id_monitor`) REFERENCES `atl_monitor` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `atl_computador_monitor_ibfk_1` FOREIGN KEY (`id_computador`) REFERENCES `atl_computador` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `atl_computador_procesador`
--
ALTER TABLE `atl_computador_procesador`
  ADD CONSTRAINT `atl_computador_procesador_ibfk_2` FOREIGN KEY (`id_componente`) REFERENCES `atl_componente_procesador` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `atl_computador_procesador_ibfk_1` FOREIGN KEY (`id_computador`) REFERENCES `atl_computador` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `atl_computador_software`
--
ALTER TABLE `atl_computador_software`
  ADD CONSTRAINT `atl_computador_software_ibfk_2` FOREIGN KEY (`id_software`) REFERENCES `atl_software` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `atl_computador_software_ibfk_1` FOREIGN KEY (`id_computador`) REFERENCES `atl_computador` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `atl_computador_tvideo`
--
ALTER TABLE `atl_computador_tvideo`
  ADD CONSTRAINT `atl_computador_tvideo_ibfk_2` FOREIGN KEY (`id_componente`) REFERENCES `atl_componente_tvideo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `atl_computador_tvideo_ibfk_1` FOREIGN KEY (`id_computador`) REFERENCES `atl_computador` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `atl_ticket_mensaje`
--
ALTER TABLE `atl_ticket_mensaje`
  ADD CONSTRAINT `atl_ticket_mensaje_ibfk_1` FOREIGN KEY (`id_ticket`) REFERENCES `atl_ticket` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `atl_usuario`
--
ALTER TABLE `atl_usuario`
  ADD CONSTRAINT `atl_usuario_ibfk_3` FOREIGN KEY (`id_cargo`) REFERENCES `atl_cargo` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
