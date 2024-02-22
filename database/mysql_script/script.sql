create database sistema_experiencia_usuario;

use sistema_experiencia_usuario;

create table usuario (
    id_usuario int primary key auto_increment not null,
    nome_usuario varchar(60),
    genero_usuario enum("M", "F"),
    email_usuario varchar(70),
    senha_usuario varchar(30)
);

create table dispositivo (
    id_dispositivo int primary key auto_increment not null,
    nome_dispositivo varchar(20),
    hora_conexao time,
    data_conexao date,
    navegador varchar(20),
    plataforma varchar(20),
    localizacao varchar(20),
    id_usuario int,
    foreign key (id_usuario) references usuario(id_usuario) on delete cascade
);

create table ataque ( 
    id_ataque int primary key auto_increment not null,
    nome_dispositivo varchar(20),
    navegador varchar(20),
    plataforma varchar(20),
    localizacao varchar(20),
    hora_ataque time,
    data_ataque date,
    descricao_ataque text
);

