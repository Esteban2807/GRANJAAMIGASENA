-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2026 a las 02:02:29
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
-- Base de datos: `granjaamiga`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentaciones`
--

CREATE TABLE `alimentaciones` (
  `id` int(11) NOT NULL,
  `id_animal` varchar(10) NOT NULL,
  `documento_alimentador` varchar(20) NOT NULL,
  `id_alimento` int(11) NOT NULL,
  `cantidad_dada` decimal(10,2) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentos`
--

CREATE TABLE `alimentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` enum('Grano','Forraje','Concentrado','Suplemento','Sales') NOT NULL,
  `marca_proveedor` varchar(255) NOT NULL,
  `stock_actual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unidad_medida` enum('kg','g','lb','paca','litro') NOT NULL,
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alimentos`
--

INSERT INTO `alimentos` (`id`, `nombre`, `tipo`, `marca_proveedor`, `stock_actual`, `unidad_medida`, `fecha_vencimiento`) VALUES
(1, 'Concentrado para cerdos', 'Concentrado', 'solla', 0.21, 'paca', '2026-04-05'),
(2, 'Delta Leche', 'Suplemento', 'Colanta ', 0.04, 'litro', '2026-04-06'),
(3, 'Contrilac', 'Concentrado', 'Contegral', 0.13, 'kg', '2026-04-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

CREATE TABLE `animales` (
  `id` int(11) NOT NULL,
  `chapeta` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` enum('Macho','Hembra') NOT NULL,
  `id_especie` int(11) NOT NULL,
  `id_raza` int(11) NOT NULL,
  `id_padre` varchar(10) DEFAULT NULL,
  `id_madre` varchar(10) DEFAULT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `animales`
--

INSERT INTO `animales` (`id`, `chapeta`, `nombre`, `fecha_nacimiento`, `sexo`, `id_especie`, `id_raza`, `id_padre`, `id_madre`, `observaciones`) VALUES
(1, 'A001', 'Toro1', '2023-01-15', 'Macho', 1, 1, NULL, NULL, 'Animal de pruebaa'),
(3, '1111', 'oveja', '2026-04-07', 'Hembra', 1, 3, '1', NULL, 'Esta enfermaa'),
(5, 'A002', 'cerdo', '2026-04-08', 'Macho', 1, 8, NULL, NULL, 'Todo bien ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atenciones_veterinarias`
--

CREATE TABLE `atenciones_veterinarias` (
  `id` int(11) NOT NULL,
  `id_animal` varchar(10) NOT NULL,
  `documento_veterinario` varchar(20) NOT NULL,
  `fecha_atencion` datetime DEFAULT NULL,
  `motivo` enum('Chequeo General','Vacunación','Enfermedad','Herida/Trauma','Seguimiento') NOT NULL,
  `diagnostico` text NOT NULL,
  `tratamiento` text DEFAULT NULL,
  `medicamento_id` int(11) DEFAULT NULL,
  `dosis` varchar(50) DEFAULT NULL,
  `via_administracion` enum('Oral','Intramuscular','Subcutánea','Intravenosa','Tópica') DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `costo_total` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Veterinarioo'),
(3, 'Aprendiz'),
(4, 'Gestor de Inventario'),
(5, 'Encargado de Granja'),
(6, 'Visitantee');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

CREATE TABLE `especies` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especies`
--

INSERT INTO `especies` (`id`, `nombre`) VALUES
(1, 'Bovino'),
(2, 'Porcino'),
(3, 'Ovino'),
(4, 'Caprino'),
(5, 'Equino'),
(6, 'Ave');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicaciones`
--

CREATE TABLE `medicaciones` (
  `id` int(11) NOT NULL,
  `id_animal` varchar(10) NOT NULL,
  `documento_veterinario` varchar(20) NOT NULL,
  `id_medicamento` int(11) NOT NULL,
  `cantidad_dada` decimal(10,2) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` enum('Desinflamatorio','Analgesico','Antifungico','Antibiotico') NOT NULL,
  `marca_proveedor` varchar(255) NOT NULL,
  `stock_actual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unidad_medida` enum('mg','g','ml','cm^3') NOT NULL,
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `nombre`, `tipo`, `marca_proveedor`, `stock_actual`, `unidad_medida`, `fecha_vencimiento`) VALUES
(1, 'antipulgas', 'Antibiotico', 'zoetis', 0.07, 'g', '2026-04-06'),
(3, 'Bravecto', 'Desinflamatorio', 'Virbac', 0.02, 'ml', '2026-04-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacimientos`
--

CREATE TABLE `nacimientos` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `parto_id` int(11) NOT NULL,
  `documento_usuario` varchar(20) NOT NULL,
  `peso_kg` decimal(5,2) NOT NULL,
  `sexo` enum('Macho','Hembra') NOT NULL,
  `vigor` enum('Excelente','Bueno','Débil','Crítico') NOT NULL,
  `observaciones` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partos`
--

CREATE TABLE `partos` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `facilidad` enum('Normal','Asistido','Cesárea','Difícil') NOT NULL,
  `madre_id` varchar(10) NOT NULL,
  `secuencia` int(11) NOT NULL COMMENT 'Número de parto de esta madre',
  `documento_usuario` varchar(20) NOT NULL,
  `documento_veterinario` varchar(20) NOT NULL,
  `duracion_minutos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razas`
--

CREATE TABLE `razas` (
  `id` int(11) NOT NULL,
  `id_especie` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `razas`
--

INSERT INTO `razas` (`id`, `id_especie`, `nombre`) VALUES
(1, 1, 'Holstein'),
(2, 1, 'Jersey'),
(3, 1, 'Angus'),
(4, 1, 'Brahman'),
(5, 1, 'Simmental'),
(6, 2, 'Yorkshire'),
(7, 2, 'Landrace'),
(8, 2, 'Duroc'),
(9, 2, 'Pietrain'),
(10, 2, 'Hampshire'),
(11, 3, 'Merino'),
(12, 3, 'Suffolk'),
(13, 3, 'Dorper'),
(14, 3, 'Hampshire Down'),
(15, 3, 'Katahdin'),
(16, 4, 'Saanen'),
(17, 4, 'Alpina'),
(18, 4, 'Boer'),
(19, 4, 'Toggenburg'),
(20, 4, 'LaMancha'),
(21, 5, 'Árabe'),
(22, 5, 'Pura Sangre'),
(23, 5, 'Cuarto de Milla'),
(24, 5, 'Appaloosa'),
(25, 5, 'Percherón'),
(26, 6, 'Leghorn'),
(27, 6, 'Rhode Island Red'),
(28, 6, 'Plymouth Rock'),
(29, 6, 'Sussex'),
(30, 6, 'Cobb 500');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documento`
--

CREATE TABLE `tipos_documento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `siglas` varchar(10) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `tipo_documento` enum('CC','TI','CE','PAS') NOT NULL,
  `documento` varchar(20) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`tipo_documento`, `documento`, `correo`, `nombres`, `apellidos`, `contrasena`, `id_cargo`) VALUES
('CC', '1054864249', 'juanmua2007@gmail.com', 'Juan Esteban', 'Muñoz Giraldo', '827ccb0eea8a706c4c34a16891f84e7b', 1),
('CC', '1055359547', 'valeriaromangarcia941@gmail.com', 'valeria', 'Roman Garcia', '7902b7c0be5cedb6fbada8d4c7fc42a0', 1),
('CC', '1089099514', 'marinmishell164@gmail.com', 'Mishell', 'Marin', 'b664415f7ff0bbdfdd527231f5799131', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunaciones`
--

CREATE TABLE `vacunaciones` (
  `id` int(11) NOT NULL,
  `id_animal` varchar(10) NOT NULL,
  `documento_veterinario` varchar(20) NOT NULL,
  `id_vacuna` int(11) NOT NULL,
  `cantidad_dada` decimal(10,2) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas`
--

CREATE TABLE `vacunas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `marca_proveedor` varchar(255) NOT NULL,
  `stock_actual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unidad_medida` enum('ml','cm^3') NOT NULL,
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacunas`
--

INSERT INTO `vacunas` (`id`, `nombre`, `marca_proveedor`, `stock_actual`, `unidad_medida`, `fecha_vencimiento`) VALUES
(1, 'Aftosa', 'Vecol', 0.10, 'ml', '2026-04-06'),
(2, 'Brucelosis RB51', 'Zoetis', 0.08, 'ml', '2026-04-08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alimentaciones`
--
ALTER TABLE `alimentaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_animal` (`id_animal`),
  ADD KEY `id_alimento` (`id_alimento`),
  ADD KEY `documento_alimentador` (`documento_alimentador`);

--
-- Indices de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `animales`
--
ALTER TABLE `animales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_especie` (`id_especie`),
  ADD KEY `id_raza` (`id_raza`),
  ADD KEY `id_padre` (`id_padre`),
  ADD KEY `id_madre` (`id_madre`);

--
-- Indices de la tabla `atenciones_veterinarias`
--
ALTER TABLE `atenciones_veterinarias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_animal` (`id_animal`),
  ADD KEY `documento_veterinario` (`documento_veterinario`),
  ADD KEY `medicamento_id` (`medicamento_id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicaciones`
--
ALTER TABLE `medicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_animal` (`id_animal`),
  ADD KEY `id_medicamento` (`id_medicamento`),
  ADD KEY `documento_veterinario` (`documento_veterinario`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nacimientos`
--
ALTER TABLE `nacimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documento_usuario` (`documento_usuario`),
  ADD KEY `parto_id` (`parto_id`);

--
-- Indices de la tabla `partos`
--
ALTER TABLE `partos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documento_usuario` (`documento_usuario`),
  ADD KEY `documento_veterinario` (`documento_veterinario`),
  ADD KEY `madre_id` (`madre_id`);

--
-- Indices de la tabla `razas`
--
ALTER TABLE `razas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_especie` (`id_especie`);

--
-- Indices de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`documento`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indices de la tabla `vacunaciones`
--
ALTER TABLE `vacunaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_animal` (`id_animal`),
  ADD KEY `id_vacuna` (`id_vacuna`),
  ADD KEY `documento_veterinario` (`documento_veterinario`);

--
-- Indices de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alimentaciones`
--
ALTER TABLE `alimentaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `animales`
--
ALTER TABLE `animales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `atenciones_veterinarias`
--
ALTER TABLE `atenciones_veterinarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `especies`
--
ALTER TABLE `especies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `medicaciones`
--
ALTER TABLE `medicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `nacimientos`
--
ALTER TABLE `nacimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `partos`
--
ALTER TABLE `partos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `razas`
--
ALTER TABLE `razas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vacunaciones`
--
ALTER TABLE `vacunaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alimentaciones`
--
ALTER TABLE `alimentaciones`
  ADD CONSTRAINT `alimentaciones_ibfk_2` FOREIGN KEY (`id_alimento`) REFERENCES `alimentos` (`id`),
  ADD CONSTRAINT `alimentaciones_ibfk_3` FOREIGN KEY (`documento_alimentador`) REFERENCES `usuarios` (`documento`);

--
-- Filtros para la tabla `animales`
--
ALTER TABLE `animales`
  ADD CONSTRAINT `animales_ibfk_1` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id`),
  ADD CONSTRAINT `animales_ibfk_2` FOREIGN KEY (`id_raza`) REFERENCES `razas` (`id`);

--
-- Filtros para la tabla `atenciones_veterinarias`
--
ALTER TABLE `atenciones_veterinarias`
  ADD CONSTRAINT `atenciones_veterinarias_ibfk_2` FOREIGN KEY (`documento_veterinario`) REFERENCES `usuarios` (`documento`),
  ADD CONSTRAINT `atenciones_veterinarias_ibfk_3` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamentos` (`id`);

--
-- Filtros para la tabla `medicaciones`
--
ALTER TABLE `medicaciones`
  ADD CONSTRAINT `medicaciones_ibfk_2` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id`),
  ADD CONSTRAINT `medicaciones_ibfk_3` FOREIGN KEY (`documento_veterinario`) REFERENCES `usuarios` (`documento`);

--
-- Filtros para la tabla `nacimientos`
--
ALTER TABLE `nacimientos`
  ADD CONSTRAINT `nacimientos_ibfk_1` FOREIGN KEY (`documento_usuario`) REFERENCES `usuarios` (`documento`),
  ADD CONSTRAINT `nacimientos_ibfk_2` FOREIGN KEY (`parto_id`) REFERENCES `partos` (`id`);

--
-- Filtros para la tabla `partos`
--
ALTER TABLE `partos`
  ADD CONSTRAINT `partos_ibfk_1` FOREIGN KEY (`documento_usuario`) REFERENCES `usuarios` (`documento`),
  ADD CONSTRAINT `partos_ibfk_2` FOREIGN KEY (`documento_veterinario`) REFERENCES `usuarios` (`documento`);

--
-- Filtros para la tabla `razas`
--
ALTER TABLE `razas`
  ADD CONSTRAINT `razas_ibfk_1` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`);

--
-- Filtros para la tabla `vacunaciones`
--
ALTER TABLE `vacunaciones`
  ADD CONSTRAINT `vacunaciones_ibfk_2` FOREIGN KEY (`id_vacuna`) REFERENCES `vacunas` (`id`),
  ADD CONSTRAINT `vacunaciones_ibfk_3` FOREIGN KEY (`documento_veterinario`) REFERENCES `usuarios` (`documento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
