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
    id  INT AUTO_INCREMENT PRIMARY KEY,
    chapeta VARCHAR(10) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    fecha_de_nacimiento DATE NOT NULL,
    sexo ENUM('Macho', 'Hembra') NOT NULL, -- Uso de ENUM
    id_especie INT NOT NULL,
    id_raza INT NOT NULL,
    -- Genealogía: Apuntan al ID de esta misma tabla
    id_padre INT,
    id_madre INT,
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
    madre_id INT NOT NULL,
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
    id_animal INT NOT NULL,
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
    id_animal INT NOT NULL,
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
    id_animal INT NOT NULL,
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
    id_animal INT NOT NULL,
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


---------------------------------
----PROCEDIMIENTOS Y VISTAS
---------------------------------

---------------
----ANIMALES
---------------


-- Vista listar animales

CREATE VIEW listarAnimales AS
SELECT a.id, a.chapeta, a.nombre, a.sexo, a.fecha_nacimiento,
                e.nombre AS especie, r.nombre AS raza,
                a.id_padre, a.id_madre, a.observaciones
                FROM animales AS a
                INNER JOIN especies AS e ON a.id_especie = e.id
                INNER JOIN razas AS r ON a.id_raza = r.id
                ORDER BY a.nombre ASC;


-- Procedimiento crear animal

DELIMITER //

CREATE PROCEDURE crearAnimal (
    IN p_chapeta VARCHAR(20),
    IN p_nombre VARCHAR(100),
    IN p_sexo VARCHAR(10),
    IN p_fecha_nacimiento DATE,
    IN p_id_especie INT,
    IN p_id_raza INT,
    IN p_id_padre INT,
    IN p_id_madre INT,
    IN p_observaciones TEXT
)
BEGIN
    -- Lógica del procedimiento
    INSERT INTO animales (chapeta, nombre, sexo, fecha_nacimiento, id_especie, id_raza, id_padre, id_madre, observaciones) VALUES (p_chapeta, p_nombre, p_sexo, p_fecha_nacimiento, p_id_especie, p_id_raza, p_id_padre, p_id_madre, p_observaciones);

END //

DELIMITER ;

-- Procedimiento actualizar animal
DELIMITER //

CREATE PROCEDURE actualizarAnimal (
    IN p_chapeta VARCHAR(20),
    IN p_nombre VARCHAR(100),
    IN p_sexo VARCHAR(10),
    IN p_fecha_nacimiento DATE,
    IN p_id_especie INT,
    IN p_id_raza INT,
    IN p_id_padre INT,
    IN p_id_madre INT,
    IN p_observaciones TEXT,
    IN p_id INT
)
BEGIN
    UPDATE animales SET 
        chapeta = p_chapeta,
        nombre = p_nombre,
        sexo = p_sexo,
        fecha_nacimiento = p_fecha_nacimiento,
        id_especie = p_id_especie,
        id_raza = p_id_raza,
        id_padre = p_id_padre,
        id_madre = p_id_madre,
        observaciones = p_observaciones
    WHERE 
        id = p_id;

END //

DELIMITER ;

-- Procedimiento eliminar animal

DELIMITER //

CREATE PROCEDURE eliminarAnimal (
    IN p_id INT
)
BEGIN
    DELETE FROM animales
    WHERE 
        id = p_id;

END //

DELIMITER ;

-- Procedimiento listar animal
DELIMITER //

CREATE PROCEDURE listarAnimal (
    IN p_id INT
)
BEGIN
    SELECT * FROM animales WHERE id = p_id;
END //

DELIMITER ;

-- Procedimiento consultar animales 

DELIMITER //

CREATE PROCEDURE consultarAnimales (
    IN p_consulta VARCHAR(100)
)
BEGIN
    SELECT * FROM animales WHERE nombre LIKE CONCAT('%', p_consulta, '%') OR chapeta LIKE CONCAT('%', p_consulta, '%') ORDER BY nombre ASC;
END //

DELIMITER ;

---------------------------
----  TIPOS DE DOCUMENTO
---------------------------

-- Vista listar tipos de documento

CREATE VIEW listarTiposDocumento AS
SELECT * FROM tipos_documento;

-- Procedimiento crear tipo de documento
DELIMITER // 

CREATE PROCEDURE crearTipoDocumento (
    IN p_nombre VARCHAR(50),
    IN p_siglas VARCHAR(10),
    IN p_estado VARCHAR(20)
)
BEGIN
    -- Lógica del procedimiento
    INSERT INTO tipos_documento (nombre, siglas, estado) VALUES (p_nombre, p_siglas, p_estado);
END //

DELIMITER ;

-- Procedimiento actualizar tipo de documento
DELIMITER // 

CREATE PROCEDURE actualizarTipoDocumento (
    IN p_id INT,
    IN p_nombre VARCHAR(50),
    IN p_siglas VARCHAR(10),
    IN p_estado VARCHAR(20)
)
BEGIN
    -- Lógica del procedimiento
    UPDATE tipos_documento SET 
        nombre = p_nombre,
        siglas = p_siglas,
        estado = p_estado
    WHERE 
        id = p_id;
END //

DELIMITER ;

-- Procedimiento eliminar tipo de documento
DELIMITER // 

CREATE PROCEDURE eliminarTipoDocumento (
    IN p_id INT
)
BEGIN
    DELETE FROM tipos_documento
    WHERE 
        id = p_id;
END //

DELIMITER ;

-- Procedimiento listar tipo de documento
DELIMITER // 

CREATE PROCEDURE listarTipoDocumento (
    IN p_id INT
)
BEGIN
    SELECT * FROM tipos_documento WHERE id = p_id;
END //

DELIMITER ;

-- Procedimiento consultar tipos de documento

DELIMITER // 

CREATE PROCEDURE consultarTiposDocumento (
    IN p_consulta VARCHAR(100)
)
BEGIN
    SELECT * FROM tipos_documento WHERE nombre LIKE CONCAT('%', p_consulta, '%') OR siglas LIKE CONCAT('%', p_consulta, '%') ORDER BY nombre ASC;
END //

DELIMITER ;


----------------------
---- CARGOS
----------------------

-- Vista listar cargos

CREATE VIEW listarCargos AS
SELECT * FROM cargos ORDER BY id ASC;

-- Procedimiento crear

DELIMITER //

CREATE PROCEDURE crearCargo (
    IN p_nombre VARCHAR(50)
)
BEGIN
    -- Lógica del procedimiento
    INSERT INTO cargos (nombre) VALUES (p_nombre);
END //

DELIMITER ;

-- Procedimiento para actualizar

DELIMITER //

CREATE PROCEDURE actualizarCargo (
    IN p_id INT,
    IN p_nombre VARCHAR(50)
)
BEGIN
    -- Lógica del procedimiento
    UPDATE cargos SET nombre = p_nombre WHERE id = p_id;
END //

DELIMITER ;

-- Procedimiento para eliminar

DELIMITER //

CREATE PROCEDURE eliminarCargo (
    IN p_id INT
)
BEGIN
    -- Lógica del procedimiento
    DELETE FROM cargos WHERE id = p_id;
END //

-- Procedimiento para consultar uno

DELIMITER //

CREATE PROCEDURE consultarCargo (
    IN p_id INT
)
BEGIN
    -- Lógica del procedimiento
    SELECT * FROM cargos WHERE id = p_id;
END //

DELIMITER ;

-- Procedimiento para consultar varios

DELIMITER //

CREATE PROCEDURE consultarCargos (
    IN p_consulta VARCHAR(100)
)
BEGIN
    -- Lógica del procedimiento
    SELECT * FROM cargos WHERE nombre LIKE CONCAT('%', p_consulta, '%') ORDER BY nombre ASC;
END //

DELIMITER ;

----------------------
---- ESPECIES
----------------------

-- Vista listar especies

CREATE VIEW listarEspecies AS
SELECT * FROM especies ORDER BY nombre ASC;

-- Procedimiento crear especie

DELIMITER //

CREATE PROCEDURE crearEspecie (
    IN p_nombre VARCHAR(50)
)
BEGIN
    -- Lógica del procedimiento
    INSERT INTO especies (nombre) VALUES (p_nombre);
END //

DELIMITER ;

-- Procedimiento actualizar especie

DELIMITER //

CREATE PROCEDURE actualizarEspecie (
    IN p_id INT,
    IN p_nombre VARCHAR(50)
)
BEGIN
    -- Lógica del procedimiento
    UPDATE especies SET nombre = p_nombre WHERE id = p_id;
END //

DELIMITER ;

-- Procedimiento eliminar especie

DELIMITER //

CREATE PROCEDURE eliminarEspecie (
    IN p_id INT
)
BEGIN
    -- Lógica del procedimiento
    DELETE FROM especies WHERE id = p_id;
END //

DELIMITER ;

-- Procedimiento consultar especie por id
DELIMITER //

CREATE PROCEDURE consultarEspecie (
    IN p_id INT
)
BEGIN
    -- Lógica del procedimiento
    SELECT * FROM especies WHERE id = p_id;
END //

DELIMITER ;

-- Procedimiento consultar especies por nombre
DELIMITER //

CREATE PROCEDURE consultarEspecies (
    IN p_consulta VARCHAR(100)
)
BEGIN
    SELECT * FROM especies WHERE nombre LIKE CONCAT('%', p_consulta, '%') ORDER BY nombre ASC;
END //

DELIMITER ;
