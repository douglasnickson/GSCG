CREATE DATABASE gscg_db DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE gscg_db;

CREATE TABLE tb_endereco (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_empresa VARCHAR (14) NOT NULL UNIQUE,
	rua VARCHAR (100) NOT NULL,
    nr INT NOT NULL,
    cidade VARCHAR (50) NOT NULL,
    estado VARCHAR(2) NOT NULL,
    pais VARCHAR (50) NOT NULL,
    FOREIGN KEY (id_empresa) REFERENCES tb_empresa (cnpj)
);

CREATE TABLE tb_empresa (
	cnpj VARCHAR (14) NOT NULL UNIQUE PRIMARY KEY,
    nome VARCHAR (100) NOT NULL,
    nome_fantasia VARCHAR (50),
    tel_fixo VARCHAR (20),
    tel_celular VARCHAR (20)
);

CREATE TABLE tb_usuario (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR (100) NOT NULL,
    senha VARCHAR (100) NOT NULL
);