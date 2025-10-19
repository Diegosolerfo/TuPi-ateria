#DROP DATABASE proyecto_pi;
CREATE DATABASE proyecto_pi;
USE proyecto_pi;
CREATE TABLE tipos (
  id tinyint(3) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(20) NOT NULL,
  evento varchar(40) NOT NULL,
  descripcion varchar(100) NOT NULL
);
CREATE TABLE productos (
  id tinyint(3) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(30) NOT NULL,
  descripcion varchar(100) NOT NULL,
  precio mediumint(8) UNSIGNED NOT NULL,
  especificaciones varchar(100) NOT NULL,
  tipo_producto tinyint(3) UNSIGNED NOT NULL,
  foreign key (tipo_producto) references tipos(id)
);