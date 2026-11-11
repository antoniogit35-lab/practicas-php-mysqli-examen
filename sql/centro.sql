-- Base de datos de trabajo del Tema 9 (DWES)
-- Ejecutar UNA vez en una base nueva. Si se repite, las claves duplicadas darán error.

CREATE DATABASE IF NOT EXISTS centro CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE centro;

CREATE TABLE alumnos (
  dni CHAR(9) PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  edad TINYINT UNSIGNED NOT NULL,
  CHECK (edad BETWEEN 0 AND 120)
) ENGINE=InnoDB;

CREATE TABLE asignaturas (
  codigo INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  creditos SMALLINT UNSIGNED NOT NULL,
  trimestre TINYINT UNSIGNED NOT NULL,
  CHECK (trimestre BETWEEN 1 AND 3)
) ENGINE=InnoDB;

CREATE TABLE matriculas (
  dni CHAR(9) NOT NULL,
  codigo INT UNSIGNED NOT NULL,
  anio SMALLINT UNSIGNED NOT NULL,
  nota DECIMAL(4,2) NULL,
  PRIMARY KEY (dni, codigo, anio),
  FOREIGN KEY (dni) REFERENCES alumnos(dni),
  FOREIGN KEY (codigo) REFERENCES asignaturas(codigo),
  CHECK (nota BETWEEN 0 AND 10)
) ENGINE=InnoDB;

-- Datos de prueba: 4 alumnos, 3 asignaturas, 5 matrículas
INSERT INTO alumnos (dni, nombre, edad) VALUES
('55555555Z', 'Ramón Torres', 19),
('22222222B', 'María López', 21),
('33333333C', 'Paloma Ruiz', 24),
('44444444R', 'Isabel Perea', 25);

INSERT INTO asignaturas (codigo, nombre, creditos, trimestre) VALUES
(1, 'Bases de datos', 15, 1),
(2, 'Programación', 18, 2),
(3, 'Lenguajes de marcas', 23, 1);

INSERT INTO matriculas (dni, codigo, anio, nota) VALUES
('55555555Z', 1, 2026, 8),
('55555555Z', 2, 2026, 4),
('22222222B', 1, 2025, 4),
('22222222B', 1, 2026, 6),
('33333333C', 2, 2025, 7);

-- Cuenta de la aplicación (cambia la clave y ejecútalo con tu usuario administrador):
-- CREATE USER 'dwes_app'@'localhost' IDENTIFIED BY 'CAMBIA_ESTA_CLAVE';
-- GRANT SELECT, INSERT, UPDATE, DELETE ON centro.* TO 'dwes_app'@'localhost';

-- Comprobación rápida: debe devolver 4, 3 y 5
-- SELECT (SELECT COUNT(*) FROM alumnos) AS alumnos,
--        (SELECT COUNT(*) FROM asignaturas) AS asignaturas,
--        (SELECT COUNT(*) FROM matriculas) AS matriculas;
