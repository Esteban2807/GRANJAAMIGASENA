-- ==============================================
-- CREACIÓN DE BASE DE DATOS
-- ==============================================
DROP DATABASE IF EXISTS granjaamiga;
CREATE DATABASE granjaamiga;
USE granjaamiga;

-- ==============================================
-- 1. TABLAS DE CONFIGURACIÓN Y USUARIOS
-- ==============================================

CREATE TABLE IF NOT EXISTS cargos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tipos_documento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    siglas VARCHAR(10) NOT NULL,
    estado ENUM('Activo', 'Inactivo') NOT NULL DEFAULT 'Activo'
);

CREATE TABLE IF NOT EXISTS usuarios (
    tipo_documento ENUM('CC', 'TI', 'CE', 'PAS') NOT NULL, -- Uso de ENUM para estandariza
    documento VARCHAR(20) NOT NULL PRIMARY KEY,
    correo VARCHAR(200) UNIQUE NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    id_cargo INT NOT NULL,
    FOREIGN KEY(id_cargo) REFERENCES cargos(id)
) ENGINE=InnoDB;

-- ==============================================
-- 2. TABLAS DE BIOLOGÍA Y ESPECIES
-- ==============================================

CREATE TABLE IF NOT EXISTS especies(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS razas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_especie INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    FOREIGN KEY(id_especie) REFERENCES especies(id)
) ENGINE=InnoDB;

-- ==============================================
-- 3. TABLA ANIMALES (Con Genealogía Recursiva)
-- ==============================================

CREATE TABLE IF NOT EXISTS animales (
    id VARCHAR(10) NOT NULL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    fecha_de_nacimiento DATE NOT NULL,
    sexo ENUM('Macho', 'Hembra') NOT NULL, -- Uso de ENUM
    id_especie INT NOT NULL,
    id_raza INT NOT NULL,
    -- Genealogía: Apuntan al ID de esta misma tabla
    id_padre VARCHAR(10),
    id_madre VARCHAR(10),
    observaciones TEXT,
    FOREIGN KEY(id_especie) REFERENCES especies(id),
    FOREIGN KEY(id_raza) REFERENCES razas(id),
    -- Constraints de Genealogía
    FOREIGN KEY(id_padre) REFERENCES animales(id) ON DELETE SET NULL,
    FOREIGN KEY(id_madre) REFERENCES animales(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ==============================================
-- 4. CONTROL DE REPRODUCCIÓN Y NACIMIENTOS
-- ==============================================

CREATE TABLE IF NOT EXISTS partos (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY, 
    fecha DATETIME NOT NULL ,
    facilidad ENUM('Normal', 'Asistido', 'Cesárea', 'Difícil') NOT NULL, -- ENUM para reportes claros
    madre_id VARCHAR(10) NOT NULL,
    secuencia INT NOT NULL COMMENT 'Número de parto de esta madre',
    documento_usuario VARCHAR(20) NOT NULL,
    documento_veterinario VARCHAR(20) NOT NULL,
    duracion_minutos INT NOT NULL,
    FOREIGN KEY(documento_usuario) REFERENCES usuarios(documento),
    FOREIGN KEY(documento_veterinario) REFERENCES usuarios(documento),
    FOREIGN KEY(madre_id) REFERENCES animales(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS nacimientos (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fecha DATETIME NOT NULL ,
    parto_id INT NOT NULL,
    documento_usuario VARCHAR(20) NOT NULL,
    peso_kg DECIMAL(5,2) NOT NULL,
    sexo ENUM('Macho', 'Hembra') NOT NULL,
    vigor ENUM('Excelente', 'Bueno', 'Débil', 'Crítico') NOT NULL, -- ENUM
    observaciones VARCHAR(255),
    FOREIGN KEY(documento_usuario) REFERENCES usuarios(documento),
    FOREIGN KEY(parto_id) REFERENCES partos(id)
) ENGINE=InnoDB;

-- ==============================================
-- 5. CONTROL DE INVENTARIO Y ALIMENTACIÓN
-- ==============================================
-- Tabla de alimentos
CREATE TABLE IF NOT EXISTS alimentos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    tipo ENUM('Grano', 'Forraje', 'Concentrado', 'Suplemento', 'Sales') NOT NULL,
    marca_proveedor VARCHAR(255) NOT NULL,
    stock_actual DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    unidad_medida ENUM('kg', 'g', 'lb', 'paca', 'litro') NOT NULL,
    fecha_vencimiento DATE NOT NULL
) ENGINE=InnoDB;

-- Tabla de alimentaciones 
CREATE TABLE IF NOT EXISTS alimentaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_animal VARCHAR(10) NOT NULL,
    documento_alimentador VARCHAR(20) NOT NULL,
    id_alimento INT NOT NULL,
    cantidad_dada DECIMAL(10,2) NOT NULL,
    fecha_hora DATETIME NOT NULL ,
    FOREIGN KEY(id_animal) REFERENCES animales(id),
    FOREIGN KEY(id_alimento) REFERENCES alimentos(id),
    FOREIGN KEY(documento_alimentador) REFERENCES usuarios(documento)
) ENGINE=InnoDB;

-- Tabla de medicamentos
CREATE TABLE IF NOT EXISTS medicamentos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    tipo ENUM('Desinflamatorio', 'Analgesico','Antifungico','Antibiotico') NOT NULL,
    marca_proveedor VARCHAR(255) NOT NULL,
    stock_actual DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    unidad_medida ENUM('mg', 'g', 'ml', 'cm^3') NOT NULL,
    fecha_vencimiento DATE NOT NULL
);

-- Tabla de medicaciones
CREATE TABLE IF NOT EXISTS medicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_animal VARCHAR(10) NOT NULL,
    documento_veterinario VARCHAR(20) NOT NULL,
    id_medicamento INT NOT NULL,
    cantidad_dada DECIMAL(10,2) NOT NULL,
    fecha_hora DATETIME NOT NULL ,
    FOREIGN KEY(id_animal) REFERENCES animales(id),
    FOREIGN KEY(id_medicamento) REFERENCES medicamentos(id),
    FOREIGN KEY(documento_veterinario) REFERENCES usuarios(documento)
) ENGINE=InnoDB;

-- Tabla de vacunas
CREATE TABLE IF NOT EXISTS vacunas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    marca_proveedor VARCHAR(255) NOT NULL,
    stock_actual DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    unidad_medida ENUM('ml', 'cm^3') NOT NULL,
    fecha_vencimiento DATE NOT NULL
);

-- Tabla de vacunaciones

CREATE TABLE IF NOT EXISTS vacunaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_animal VARCHAR(10) NOT NULL,
    documento_veterinario VARCHAR(20) NOT NULL,
    id_vacuna INT NOT NULL,
    cantidad_dada DECIMAL(10,2) NOT NULL,
    fecha_hora DATETIME NOT NULL ,
    FOREIGN KEY(id_animal) REFERENCES animales(id),
    FOREIGN KEY(id_vacuna) REFERENCES vacunas(id),
    FOREIGN KEY(documento_veterinario) REFERENCES usuarios(documento)
);


CREATE TABLE IF NOT EXISTS atenciones_veterinarias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_animal VARCHAR(10) NOT NULL,
    documento_veterinario VARCHAR(20) NOT NULL,
    fecha_atencion DATETIME ,
    motivo ENUM('Chequeo General', 'Vacunación', 'Enfermedad', 'Herida/Trauma', 'Seguimiento') NOT NULL,
    diagnostico TEXT NOT NULL,
    tratamiento TEXT,
    medicamento_id INT,
    dosis VARCHAR(50),
    via_administracion ENUM('Oral', 'Intramuscular', 'Subcutánea', 'Intravenosa', 'Tópica'),
    observaciones TEXT,
    costo_total DECIMAL(12,2) DEFAULT 0.00,
    FOREIGN KEY (id_animal) REFERENCES animales(id),
    FOREIGN KEY (documento_veterinario) REFERENCES usuarios(documento),
    FOREIGN KEY (medicamento_id) REFERENCES medicamentos(id)
) ENGINE=InnoDB;