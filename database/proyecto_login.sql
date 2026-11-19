CREATE DATABASE IF NOT EXISTS proyecto_login
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE proyecto_login;

CREATE TABLE IF NOT EXISTS usuarios (
  id_usuario     INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre         VARCHAR(50)  NOT NULL,
  apellido       VARCHAR(50)  NOT NULL,
  correo         VARCHAR(100) NOT NULL,
  password_hash  VARCHAR(255) NOT NULL,
  fecha_registro DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_usuario),
  UNIQUE KEY uq_usuarios_correo (correo)
) ENGINE=InnoDB;
