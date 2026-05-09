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
    fecha_nacimiento DATE NOT NULL,
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

-----------------------------------------
-- Procedimientos y vistar para ALIMENTOS
-----------------------------------------

CREATE VIEW listarAlimentos AS
SELECT * FROM alimentos ORDER BY nombre ASC;

-- CREAR
DELIMITER //

CREATE PROCEDURE crearAlimento (
    IN p_nombre VARCHAR(100),
    IN p_tipo VARCHAR(50),
    IN p_marca VARCHAR(255),
    IN p_stock DECIMAL(10,2),
    IN p_unidad VARCHAR(20),
    IN p_fecha DATE
)
BEGIN
    INSERT INTO alimentos (nombre, tipo, marca_proveedor, stock_actual, unidad_medida, fecha_vencimiento)
    VALUES (p_nombre, p_tipo, p_marca, p_stock, p_unidad, p_fecha);
END //

DELIMITER ;


-- ACTUALIZAR 
DELIMITER //

CREATE PROCEDURE actualizarAlimento (
    IN p_id INT,
    IN p_nombre VARCHAR(100),
    IN p_tipo VARCHAR(50),
    IN p_marca VARCHAR(255),
    IN p_stock DECIMAL(10,2),
    IN p_unidad VARCHAR(20),
    IN p_fecha DATE
)
BEGIN
    UPDATE alimentos SET
        nombre = p_nombre,
        tipo = p_tipo,
        marca_proveedor = p_marca,
        stock_actual = p_stock,
        unidad_medida = p_unidad,
        fecha_vencimiento = p_fecha
    WHERE id = p_id;
END //

DELIMITER ;

-- ELIMINAR

DELIMITER //

CREATE PROCEDURE eliminarAlimento (
    IN p_id INT
)
BEGIN
    DELETE FROM alimentos WHERE id = p_id;
END //

DELIMITER ;

-- CONSULTAR UNO

DELIMITER //

CREATE PROCEDURE consultarAlimento (
    IN p_id INT
)
BEGIN
    SELECT * FROM alimentos WHERE id = p_id;
END //

DELIMITER ;

-- CONSULTAR VARIOS 

DELIMITER //

CREATE PROCEDURE consultarAlimentos (
    IN p_consulta VARCHAR(100)
)
BEGIN
    SELECT * FROM alimentos
    WHERE nombre LIKE CONCAT('%', p_consulta, '%')
    ORDER BY nombre ASC;
END //

DELIMITER ;

-- --------------------------
-- MEDICAMENTOS
-- ---------------------------

CREATE VIEW listarMedicamentos AS
SELECT * FROM medicamentos ORDER BY nombre ASC;

-- CREAR

DELIMITER //

CREATE PROCEDURE crearMedicamento (
    IN p_nombre VARCHAR(100),
    IN p_tipo VARCHAR(50),
    IN p_marca VARCHAR(255),
    IN p_stock DECIMAL(10,2),
    IN p_unidad VARCHAR(20),
    IN p_fecha DATE
)
BEGIN
    INSERT INTO medicamentos (nombre, tipo, marca_proveedor, stock_actual, unidad_medida, fecha_vencimiento)
    VALUES (p_nombre, p_tipo, p_marca, p_stock, p_unidad, p_fecha);
END //

DELIMITER ;

-- ACTUALIZAR
 
 DELIMITER //

CREATE PROCEDURE actualizarMedicamento (
    IN p_id INT,
    IN p_nombre VARCHAR(100),
    IN p_tipo VARCHAR(50),
    IN p_marca VARCHAR(255),
    IN p_stock DECIMAL(10,2),
    IN p_unidad VARCHAR(20),
    IN p_fecha DATE
)
BEGIN
    UPDATE medicamentos SET
        nombre = p_nombre,
        tipo = p_tipo,
        marca_proveedor = p_marca,
        stock_actual = p_stock,
        unidad_medida = p_unidad,
        fecha_vencimiento = p_fecha
    WHERE id = p_id;
END //

DELIMITER ;

-- ELIMINAR

DELIMITER //

CREATE PROCEDURE eliminarMedicamento (
    IN p_id INT
)
BEGIN
    DELETE FROM medicamentos WHERE id = p_id;
END //

DELIMITER ;

-- CONSULTAR UNO 

DELIMITER //

CREATE PROCEDURE consultarMedicamento (
    IN p_id INT
)
BEGIN
    SELECT * FROM medicamentos WHERE id = p_id;
END //

DELIMITER ;

-- CONSULTAR VARIOS

DELIMITER //

CREATE PROCEDURE consultarMedicamentos (
    IN p_consulta VARCHAR(100)
)
BEGIN
    SELECT * FROM medicamentos
    WHERE nombre LIKE CONCAT('%', p_consulta, '%')
    ORDER BY nombre ASC;
END //

DELIMITER ;

-- ---------------------------------
-- VACUNAS -------------------------
-- ---------------------------------

CREATE VIEW listarVacunas AS
SELECT * FROM vacunas ORDER BY nombre ASC;

-- CREAR

DELIMITER //

CREATE PROCEDURE crearVacuna (
    IN p_nombre VARCHAR(100),
    IN p_marca VARCHAR(255),
    IN p_stock DECIMAL(10,2),
    IN p_unidad VARCHAR(20),
    IN p_fecha DATE
)
BEGIN
    INSERT INTO vacunas (nombre, marca_proveedor, stock_actual, unidad_medida, fecha_vencimiento)
    VALUES (p_nombre, p_marca, p_stock, p_unidad, p_fecha);
END //

DELIMITER ;

-- ACTUALIZAR

DELIMITER //

CREATE PROCEDURE actualizarVacuna (
    IN p_id INT,
    IN p_nombre VARCHAR(100),
    IN p_marca VARCHAR(255),
    IN p_stock DECIMAL(10,2),
    IN p_unidad VARCHAR(20),
    IN p_fecha DATE
)
BEGIN
    UPDATE vacunas SET
        nombre = p_nombre,
        marca_proveedor = p_marca,
        stock_actual = p_stock,
        unidad_medida = p_unidad,
        fecha_vencimiento = p_fecha
    WHERE id = p_id;
END //

DELIMITER ;

-- ELIMINAR

DELIMITER //

CREATE PROCEDURE eliminarVacuna (
    IN p_id INT
)
BEGIN
    DELETE FROM vacunas WHERE id = p_id;
END //

DELIMITER ;

-- CONSULTAR UNO

DELIMITER //

CREATE PROCEDURE consultarVacuna (
    IN p_id INT
)
BEGIN
    SELECT * FROM vacunas WHERE id = p_id;
END //

DELIMITER ;

-- CONSULTAR VARIOS

DELIMITER //

CREATE PROCEDURE consultarVacunas (
    IN p_consulta VARCHAR(100)
)
BEGIN
    SELECT * FROM vacunas
    WHERE nombre LIKE CONCAT('%', p_consulta, '%')
    ORDER BY nombre ASC;
END //

DELIMITER ;


-------------------------------------------------------------------------------
----------------------------REGISTRAR VACUNACIÓN-------------------------------
-------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE registrarVacunacion (
    IN p_id_animal INT,
    IN p_documento_veterinario VARCHAR(20),
    IN p_id_vacuna INT,
    IN p_cantidad_dada DECIMAL(10,2),
    IN p_fecha_hora DATETIME
)
BEGIN
    DECLARE v_stock_actual DECIMAL(10,2);

    START TRANSACTION;

    SELECT stock_actual
      INTO v_stock_actual
      FROM vacunas
     WHERE id = p_id_vacuna
     FOR UPDATE;

    IF v_stock_actual IS NULL THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vacuna no existe';
    END IF;

    IF p_cantidad_dada IS NULL OR p_cantidad_dada <= 0 THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cantidad dada inválida';
    END IF;

    IF v_stock_actual < p_cantidad_dada THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente para la vacuna';
    END IF;

    UPDATE vacunas
       SET stock_actual = stock_actual - p_cantidad_dada
     WHERE id = p_id_vacuna;

    INSERT INTO vacunaciones (id_animal, documento_veterinario, id_vacuna, cantidad_dada, fecha_hora)
    VALUES (p_id_animal, p_documento_veterinario, p_id_vacuna, p_cantidad_dada, p_fecha_hora);

    COMMIT;
END //

DELIMITER ;


-------------------------------------------------------------------------------
----------------------------REGISTRAR ALIMENTACIÓN-----------------------------
-------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE registrarAlimentacion (
    IN p_id_animal INT,
    IN p_documento_alimentador VARCHAR(20),
    IN p_id_alimento INT,
    IN p_cantidad_dada DECIMAL(10,2),
    IN p_fecha_hora DATETIME
)
BEGIN
    DECLARE v_stock_actual DECIMAL(10,2);

    START TRANSACTION;

    SELECT stock_actual
      INTO v_stock_actual
      FROM alimentos
     WHERE id = p_id_alimento
     FOR UPDATE;

    IF v_stock_actual IS NULL THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Alimento no existe';
    END IF;

    IF p_cantidad_dada IS NULL OR p_cantidad_dada <= 0 THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cantidad dada inválida';
    END IF;

    IF v_stock_actual < p_cantidad_dada THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente para el alimento';
    END IF;

    UPDATE alimentos
       SET stock_actual = stock_actual - p_cantidad_dada
     WHERE id = p_id_alimento;

    INSERT INTO alimentaciones (id_animal, documento_alimentador, id_alimento, cantidad_dada, fecha_hora)
    VALUES (p_id_animal, p_documento_alimentador, p_id_alimento, p_cantidad_dada, p_fecha_hora);

    COMMIT;
END //

DELIMITER ;


---------------------------------------------------------------------------------
-----------------------ELIMINAR ALIMENTACIÓN -- DEVUELVE STOCK-------------------
---------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE eliminarAlimentacion (
    IN p_id_alimentacion INT
)
BEGIN
    DECLARE v_id_alimento INT;
    DECLARE v_cantidad DECIMAL(10,2);

    START TRANSACTION;

    SELECT id_alimento, cantidad_dada
      INTO v_id_alimento, v_cantidad
      FROM alimentaciones
     WHERE id = p_id_alimentacion
     FOR UPDATE;

    IF v_id_alimento IS NULL THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Alimentación no existe';
    END IF;

    SELECT id
      FROM alimentos
     WHERE id = v_id_alimento
     FOR UPDATE;

    UPDATE alimentos
       SET stock_actual = stock_actual + v_cantidad
     WHERE id = v_id_alimento;

    DELETE FROM alimentaciones
     WHERE id = p_id_alimentacion;

    COMMIT;
END //

DELIMITER ;


---------------------------------------------------------------------------------------------
---------------ACTUALIZAR ALIMENTACIONES -- DEVUELVE STOCK Y VUELVE A QUITAR-----------------
---------------------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE actualizarAlimentacion (
    IN p_id_alimentacion INT,
    IN p_id_animal INT,
    IN p_documento_alimentador VARCHAR(20),
    IN p_id_alimento_nuevo INT,
    IN p_cantidad_nueva DECIMAL(10,2),
    IN p_fecha_hora DATETIME
)
BEGIN
    DECLARE v_id_alimento_old INT;
    DECLARE v_cantidad_old DECIMAL(10,2);
    DECLARE v_stock_nuevo DECIMAL(10,2);

    START TRANSACTION;

    SELECT id_alimento, cantidad_dada
      INTO v_id_alimento_old, v_cantidad_old
      FROM alimentaciones
     WHERE id = p_id_alimentacion
     FOR UPDATE;

    IF v_id_alimento_old IS NULL THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Alimentación no existe';
    END IF;

    IF p_cantidad_nueva IS NULL OR p_cantidad_nueva <= 0 THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cantidad nueva inválida';
    END IF;

    IF p_id_alimento_nuevo = v_id_alimento_old THEN
        SELECT stock_actual
          INTO v_stock_nuevo
          FROM alimentos
         WHERE id = p_id_alimento_nuevo
         FOR UPDATE;

        IF v_stock_nuevo IS NULL THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Alimento no existe';
        END IF;

        IF p_cantidad_nueva > v_cantidad_old AND v_stock_nuevo < (p_cantidad_nueva - v_cantidad_old) THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente para aumentar la cantidad';
        END IF;

        UPDATE alimentos
           SET stock_actual = stock_actual + v_cantidad_old - p_cantidad_nueva
         WHERE id = p_id_alimento_nuevo;

    ELSE
        SELECT id FROM alimentos WHERE id = v_id_alimento_old FOR UPDATE;
        UPDATE alimentos
           SET stock_actual = stock_actual + v_cantidad_old
         WHERE id = v_id_alimento_old;

        SELECT stock_actual
          INTO v_stock_nuevo
          FROM alimentos
         WHERE id = p_id_alimento_nuevo
         FOR UPDATE;

        IF v_stock_nuevo IS NULL THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Alimento nuevo no existe';
        END IF;

        IF v_stock_nuevo < p_cantidad_nueva THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente en el alimento nuevo';
        END IF;

        UPDATE alimentos
           SET stock_actual = stock_actual - p_cantidad_nueva
         WHERE id = p_id_alimento_nuevo;
    END IF;

    UPDATE alimentaciones
       SET id_animal = p_id_animal,
           documento_alimentador = p_documento_alimentador,
           id_alimento = p_id_alimento_nuevo,
           cantidad_dada = p_cantidad_nueva,
           fecha_hora = p_fecha_hora
     WHERE id = p_id_alimentacion;

    COMMIT;
END //

DELIMITER ;


---------------------------------------------------------------------------------
-----------------------ELIMINAR VACUNACIÓN -- DEVUELVE STOCK---------------------
---------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE eliminarVacunacion (
    IN p_id_vacunacion INT
)
BEGIN
    DECLARE v_id_vacuna INT;
    DECLARE v_cantidad DECIMAL(10,2);

    START TRANSACTION;

    SELECT id_vacuna, cantidad_dada
      INTO v_id_vacuna, v_cantidad
      FROM vacunaciones
     WHERE id = p_id_vacunacion
     FOR UPDATE;

    IF v_id_vacuna IS NULL THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vacunación no existe';
    END IF;

    SELECT id
      FROM vacunas
     WHERE id = v_id_vacuna
     FOR UPDATE;

    UPDATE vacunas
       SET stock_actual = stock_actual + v_cantidad
     WHERE id = v_id_vacuna;

    DELETE FROM vacunaciones
     WHERE id = p_id_vacunacion;

    COMMIT;
END //

DELIMITER ;


---------------------------------------------------------------------------------------------
---------------ACTUALIZAR VACUNACIONES -- DEVUELVE STOCK Y VUELVE A QUITAR-------------------
---------------------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE actualizarVacunacion (
    IN p_id_vacunacion INT,
    IN p_id_animal INT,
    IN p_documento_veterinario VARCHAR(20),
    IN p_id_vacuna_nueva INT,
    IN p_cantidad_nueva DECIMAL(10,2),
    IN p_fecha_hora DATETIME
)
BEGIN
    DECLARE v_id_vacuna_old INT;
    DECLARE v_cantidad_old DECIMAL(10,2);
    DECLARE v_stock_nuevo DECIMAL(10,2);

    START TRANSACTION;

    SELECT id_vacuna, cantidad_dada
      INTO v_id_vacuna_old, v_cantidad_old
      FROM vacunaciones
     WHERE id = p_id_vacunacion
     FOR UPDATE;

    IF v_id_vacuna_old IS NULL THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vacunación no existe';
    END IF;

    IF p_cantidad_nueva IS NULL OR p_cantidad_nueva <= 0 THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cantidad nueva inválida';
    END IF;

    IF p_id_vacuna_nueva = v_id_vacuna_old THEN
        -- Misma vacuna: ajustar por delta (old - new)
        SELECT stock_actual
          INTO v_stock_nuevo
          FROM vacunas
         WHERE id = p_id_vacuna_nueva
         FOR UPDATE;

        IF v_stock_nuevo IS NULL THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vacuna no existe';
        END IF;

        -- Si aumenta consumo, necesitas stock adicional
        IF p_cantidad_nueva > v_cantidad_old AND v_stock_nuevo < (p_cantidad_nueva - v_cantidad_old) THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente para aumentar la cantidad';
        END IF;

        UPDATE vacunas
           SET stock_actual = stock_actual + v_cantidad_old - p_cantidad_nueva
         WHERE id = p_id_vacuna_nueva;

    ELSE
        -- Cambia de vacuna: devolver a la vieja y descontar de la nueva
        SELECT id FROM vacunas WHERE id = v_id_vacuna_old FOR UPDATE;
        UPDATE vacunas
           SET stock_actual = stock_actual + v_cantidad_old
         WHERE id = v_id_vacuna_old;

        SELECT stock_actual
          INTO v_stock_nuevo
          FROM vacunas
         WHERE id = p_id_vacuna_nueva
         FOR UPDATE;

        IF v_stock_nuevo IS NULL THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vacuna nueva no existe';
        END IF;

        IF v_stock_nuevo < p_cantidad_nueva THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente en la vacuna nueva';
        END IF;

        UPDATE vacunas
           SET stock_actual = stock_actual - p_cantidad_nueva
         WHERE id = p_id_vacuna_nueva;
    END IF;

    UPDATE vacunaciones
       SET id_animal = p_id_animal,
           documento_veterinario = p_documento_veterinario,
           id_vacuna = p_id_vacuna_nueva,
           cantidad_dada = p_cantidad_nueva,
           fecha_hora = p_fecha_hora
     WHERE id = p_id_vacunacion;

    COMMIT;
END //

DELIMITER ;


-------------------------------------------------------------------------------
----------------------------REGISTRAR MEDICACIÓN-------------------------------
-------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE registrarMedicacion (
    IN p_id_animal INT,
    IN p_documento_veterinario VARCHAR(20),
    IN p_id_medicamento INT,
    IN p_cantidad_dada DECIMAL(10,2),
    IN p_fecha_hora DATETIME
)
BEGIN
    DECLARE v_stock_actual DECIMAL(10,2);

    START TRANSACTION;

    SELECT stock_actual
      INTO v_stock_actual
      FROM medicamentos
     WHERE id = p_id_medicamento
     FOR UPDATE;

    IF v_stock_actual IS NULL THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Medicamento no existe';
    END IF;

    IF p_cantidad_dada IS NULL OR p_cantidad_dada <= 0 THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cantidad dada inválida';
    END IF;

    IF v_stock_actual < p_cantidad_dada THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente para el medicamento';
    END IF;

    UPDATE medicamentos
       SET stock_actual = stock_actual - p_cantidad_dada
     WHERE id = p_id_medicamento;

    INSERT INTO medicaciones (id_animal, documento_veterinario, id_medicamento, cantidad_dada, fecha_hora)
    VALUES (p_id_animal, p_documento_veterinario, p_id_medicamento, p_cantidad_dada, p_fecha_hora);

    COMMIT;
END //

DELIMITER ;


---------------------------------------------------------------------------------
-----------------------ELIMINAR MEDICACIÓN -- DEVUELVE STOCK---------------------
---------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE eliminarMedicacion (
    IN p_id_medicacion INT
)
BEGIN
    DECLARE v_id_medicamento INT;
    DECLARE v_cantidad DECIMAL(10,2);

    START TRANSACTION;

    SELECT id_medicamento, cantidad_dada
      INTO v_id_medicamento, v_cantidad
      FROM medicaciones
     WHERE id = p_id_medicacion
     FOR UPDATE;

    IF v_id_medicamento IS NULL THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Medicación no existe';
    END IF;

    SELECT id
      FROM medicamentos
     WHERE id = v_id_medicamento
     FOR UPDATE;

    UPDATE medicamentos
       SET stock_actual = stock_actual + v_cantidad
     WHERE id = v_id_medicamento;

    DELETE FROM medicaciones
     WHERE id = p_id_medicacion;

    COMMIT;
END //

DELIMITER ;


---------------------------------------------------------------------------------------------
---------------ACTUALIZAR MEDICACIONES -- DEVUELVE STOCK Y VUELVE A QUITAR--------------------
---------------------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE actualizarMedicacion (
    IN p_id_medicacion INT,
    IN p_id_animal INT,
    IN p_documento_veterinario VARCHAR(20),
    IN p_id_medicamento_nuevo INT,
    IN p_cantidad_nueva DECIMAL(10,2),
    IN p_fecha_hora DATETIME
)
BEGIN
    DECLARE v_id_medicamento_old INT;
    DECLARE v_cantidad_old DECIMAL(10,2);
    DECLARE v_stock_nuevo DECIMAL(10,2);

    START TRANSACTION;

    SELECT id_medicamento, cantidad_dada
      INTO v_id_medicamento_old, v_cantidad_old
      FROM medicaciones
     WHERE id = p_id_medicacion
     FOR UPDATE;

    IF v_id_medicamento_old IS NULL THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Medicación no existe';
    END IF;

    IF p_cantidad_nueva IS NULL OR p_cantidad_nueva <= 0 THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cantidad nueva inválida';
    END IF;

    IF p_id_medicamento_nuevo = v_id_medicamento_old THEN
        SELECT stock_actual
          INTO v_stock_nuevo
          FROM medicamentos
         WHERE id = p_id_medicamento_nuevo
         FOR UPDATE;

        IF v_stock_nuevo IS NULL THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Medicamento no existe';
        END IF;

        IF p_cantidad_nueva > v_cantidad_old AND v_stock_nuevo < (p_cantidad_nueva - v_cantidad_old) THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente para aumentar la cantidad';
        END IF;

        UPDATE medicamentos
           SET stock_actual = stock_actual + v_cantidad_old - p_cantidad_nueva
         WHERE id = p_id_medicamento_nuevo;

    ELSE
        SELECT id FROM medicamentos WHERE id = v_id_medicamento_old FOR UPDATE;
        UPDATE medicamentos
           SET stock_actual = stock_actual + v_cantidad_old
         WHERE id = v_id_medicamento_old;

        SELECT stock_actual
          INTO v_stock_nuevo
          FROM medicamentos
         WHERE id = p_id_medicamento_nuevo
         FOR UPDATE;

        IF v_stock_nuevo IS NULL THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Medicamento nuevo no existe';
        END IF;

        IF v_stock_nuevo < p_cantidad_nueva THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente en el medicamento nuevo';
        END IF;

        UPDATE medicamentos
           SET stock_actual = stock_actual - p_cantidad_nueva
         WHERE id = p_id_medicamento_nuevo;
    END IF;

    UPDATE medicaciones
       SET id_animal = p_id_animal,
           documento_veterinario = p_documento_veterinario,
           id_medicamento = p_id_medicamento_nuevo,
           cantidad_dada = p_cantidad_nueva,
           fecha_hora = p_fecha_hora
     WHERE id = p_id_medicacion;

    COMMIT;
END //

DELIMITER ;


INSERT INTO `cargos` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Veterinarioo'),
(3, 'Aprendiz'),
(4, 'Gestor de Inventario'),
(5, 'Encargado de Granja'),
(6, 'Visitante');

INSERT INTO `tipos_documento` (`id`, `nombre`, `siglas`, `estado`) VALUES
(1, 'Cedula de Ciudadanía', 'CC', 'Activo'),
(2, 'Tarjeta de Identidad', 'TI', 'Activo'),
(3, 'Cedula de Extranjería', 'CE', 'Activo'),
(5, 'Pasaporte', 'PAS', 'Activo');

INSERT INTO `usuarios` (`tipo_documento`, `documento`, `correo`, `nombres`, `apellidos`, `contrasena`, `id_cargo`) VALUES
('CC', '1053784333', 'elingejose@gmail.com', 'José Germán ', 'Estrada Clavijo', '827ccb0eea8a706c4c34a16891f84e7b', 5),
('CC', '1054864249', 'juanmua2007@gmail.com', 'Juan Esteban', 'Muñoz Giraldo', '827ccb0eea8a706c4c34a16891f84e7b', 1),
('CC', '1055359547', 'valeriaromangarcia941@gmail.com', 'valeria', 'Roman Garcia', '7902b7c0be5cedb6fbada8d4c7fc42a0', 1);

INSERT INTO `especies` (`id`, `nombre`) VALUES
(1, 'Bovino'),
(2, 'Porcino'),
(3, 'Ovino'),
(4, 'Caprino'),
(5, 'Equino'),
(6, 'Ave');

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
(29, 6, 'Sussex');
