CREATE DATABASE IF NOT EXISTS biblioteca CHARACTER SET utf8mb4;
USE biblioteca;

CREATE TABLE rol (
  id_rol INT AUTO_INCREMENT PRIMARY KEY,
  nombre_rol VARCHAR(30) NOT NULL
);

CREATE TABLE usuario (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  contrasenia VARCHAR(255) NOT NULL,
  id_rol INT NOT NULL,
  FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
);

CREATE TABLE formato (
  id_formato INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

CREATE TABLE genero (
  id_genero INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

CREATE TABLE autor (
  id_autor INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);

CREATE TABLE editorial (
  id_editorial INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);

CREATE TABLE producto (
  id_producto INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(150) NOT NULL,
  descripcion TEXT,
  fecha_publicacion DATE,
  precio DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL,
  id_formato INT NOT NULL,
  id_autor INT NOT NULL,
  id_editorial INT NULL,
  id_genero INT NOT NULL,
  FOREIGN KEY (id_formato) REFERENCES formato(id_formato),
  FOREIGN KEY (id_autor) REFERENCES autor(id_autor),
  FOREIGN KEY (id_editorial) REFERENCES editorial(id_editorial),
  FOREIGN KEY (id_genero) REFERENCES genero(id_genero)
);

CREATE TABLE compra (
  id_usuario INT NOT NULL,
  id_producto INT NOT NULL,
  fecha DATE NOT NULL,
  cantidad INT NOT NULL,
  PRIMARY KEY (id_usuario, id_producto, fecha),
  FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
  FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);

INSERT INTO rol (nombre_rol) VALUES ('Administrador'), ('Usuario');
INSERT INTO formato (nombre) VALUES ('Libro'), ('Revista'), ('Audiolibro');
INSERT INTO genero (nombre) VALUES ('Ciencia Ficción'), ('Cómics');

INSERT INTO usuario (nombre, apellido, email, contrasenia, id_rol) VALUES
('Admin', 'Principal', 'admin@biblioteca.com',
 '$2y$10$abcdefghijklmnopqrstuuwlDZ3uF4mEzK4WQDG4arnn1xTv1J226',
 (SELECT id_rol FROM rol WHERE nombre_rol = 'Administrador')),
('Usuario', 'Prueba', 'usuario@biblioteca.com',
 '$2y$10$abcdefghijklmnopqrstuuwlDZ3uF4mEzK4WQDG4arnn1xTv1J226',
 (SELECT id_rol FROM rol WHERE nombre_rol = 'Usuario'));