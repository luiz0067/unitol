create table usuario (
	codigo int auto_increment not null primary key, 
	usuario varchar (50) not null,
	senha varchar (50) not null
);
create table categoria (
	codigo int auto_increment not null primary key, 
	nome varchar (50) not null
);
create table produtos (
	codigo int auto_increment not null primary key, 
	nome varchar (50) not null,
	categoria int not null,
	descricao varchar (50) not null
);
create table fotos (
	codigo int auto_increment not null primary key,
	produto int not null,
	nome varchar (50) not null,
	imagem varchar (50) not null,
	link varchar (50) not null
);
create table servicos (
	codigo int auto_increment not null primary key,
	descricao blob,
	titulo varchar (50) not null,
	imagem blob
);
create table servicos_prestados(
	codigo int auto_increment not null primary key,
	descricao blob,
	titulo varchar (50) not null,
	imagem blob
);

ALTER TABLE produtos 
ADD CONSTRAINT FK_produtos_categoria 
FOREIGN KEY FK_produtos_categoria (categoria)
REFERENCES categoria (codigo);

ALTER TABLE fotos
ADD CONSTRAINT fk_fotos_produtos
FOREIGN KEY (produto)
REFERENCES produtos(codigo);
