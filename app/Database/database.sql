CREATE DATABASE PHPtest;

CREATE TABLE dadosCep (
  id INT NOT NULL AUTO_INCREMENT,
  cep VARCHAR(15) NULL,
  longradouro VARCHAR(100) NULL ,
  complemento VARCHAR(100) NULL ,
  bairro VARCHAR(100) NULL  ,
  localidade VARCHAR(100) NULL  ,
  uf VARCHAR(2) NULL ,
  ibge INT NULL,
  gia INT NULL  ,
  ddd INT NULL,
  siafi INT NULL , 
  PRIMARY KEY (`id`)
);