create database Controle;
use Controle;
#drop database Controle;


create table usuario(
	id int primary key auto_increment not null,
    nome varchar(20) not null,
    email varchar(110) not null,
    senha varchar(20) not null,
    cidade varchar(45) not null,
    nome_imagem varchar(100),
    caminho_imagem varchar(50)
);



create table produto(
	id int primary key auto_increment not null,
    nome varchar(50),
    tipo varchar(20),
    categoria varchar(20),
    quantidade int default 0,
    preco float,
    fornecedor varchar(45),
    marca varchar(50),
    data_validade date,
    status_cadastro datetime,
    id_usuario int,
    foreign key (id_usuario) references Usuario(id)
);

create table perecivel(
	id_produto int primary key,
    foreign key (id_produto) references Produto(id),
    quantidade int default 0,
    data_entrada date,
    data_validade date,
    id_usuario int
    
    
);

create table variado(
	id_produto int primary key,
    data_entrada date,
    quantidade int default 0,
    id_usuario int 
    
);

create table administrador(
	id int primary key auto_increment not null,
    nome varchar(20) not null,
    email varchar(100) not null,
    senha varchar(20) not null
    
);

create table categoria(
	id int primary key auto_increment,
    tipo varchar(50)
);

create TABLE imagens(
   	id int AUTO_INCREMENT,
    nome varchar(100),
    caminho varchar(50),
    id_usuario int,
    id_produto int,
    PRIMARY KEY(id, id_usuario, id_produto)
    
    );
    
    
    
create table vendas(
	id int primary key auto_increment,
    id_usuario int,
    id_produto int,
    nome_produto varchar(50),
    quantidade int default 0,
    valor float,    
    data_saida datetime   
    
);

create table deletado(
	id int PRIMARY key AUTO_INCREMENT,
    id_produto int,
    id_usuario int,
    nome_produto varchar(50),
    data_delete datetime
    );

insert into categoria(tipo)
values("ELETRONICOS");


insert into Usuario(nome,email,senha,cidade)
values("Fabio","fabiofelipe788@gmail.com","12345678","Centro");

insert into Usuario(nome,email,senha,cidade)
values("Joao","joao@gmail.com","10203040","Centro");

insert into Usuario(nome,email,senha,cidade)
values("Maria","maria@gmail.com","1020304050","Centro");

select * from usuario;

insert into produto(nome,tipo,quantidade,preco,marca,id_usuario,status_cadastro)
values("Sal","Perecivel",50,"5.99", "Salita", 1,now());

insert into produto(nome,tipo,quantidade,preco,marca,id_usuario,status_cadastro)
values("Lapis","Nao_Perecivel",110,"0.70", "Faber", 3,now());

select * from Produto;



insert into administrador values(Null,"Administrador", "adm@gmail.com", "12345678" );


create view tabela_venda as
SELECT produto.nome as nome, produto.preco as preco, imagens.caminho , produto.id_usuario as id_usuario, produto.id as id_produto
FROM produto join imagens on produto.id = imagens.id_produto where produto.quantidade > 0  ;

#drop view tabela_venda;

create view produtos_cadastrados as 
select produto.id as ID_Produto , produto.nome as nome, produto.quantidade as quantidade,
 produto.preco, produto.marca ,produto.tipo , usuario.nome as Usuario, sum(produto.preco * produto.quantidade) as  Preco_Total 
 from produto join usuario on 
usuario.id = produto.id_usuario group by produto.preco order by ID_Produto asc  ;
select *  from produtos_cadastrados;

create view carrinho as
select produto.id as id, produto.nome as nome, produto.categoria as categoria, 
produto.preco as preco,produto.quantidade as quantidade, imagens.caminho as caminho,
imagens.id_produto as id_produto  
from produto join imagens on produto.id = id_produto ;


create view produtos_usuario  as 
SELECT usuario.nome AS nome_usuario, count(produto.nome) AS quantidade
FROM usuario join produto on usuario.id = produto.id_usuario GROUP BY usuario.id;

 create view ultimos_cadastros as
 select produto.id_usuario as id_usuario, produto.nome as nome, produto.preco as preco, produto.status_cadastro AS status_cadastro
 FROM produto ;

CREATE VIEW itens_perto_de_vencer AS
SELECT id, nome, tipo, categoria, data_validade
FROM produto
WHERE data_validade BETWEEN CURDATE() AND CURDATE() + INTERVAL 7 DAY;

#Trigger

DELIMITER !
CREATE TRIGGER atualizar_valor
AFTER INSERT ON vendas
FOR EACH ROW
BEGIN
  UPDATE produto SET quantidade = quantidade - NEW.quantidade where id = new.id_produto;
END !


CREATE TRIGGER deletado
AFTER DELETE ON produto
FOR EACH ROW
BEGIN
    INSERT INTO deletado (id_produto, id_usuario, nome_produto, data_delete)
    VALUES (OLD.id, OLD.id_usuario, OLD.nome, NOW());
END!


CREATE TRIGGER tipo
AFTER INSERT ON produto
FOR EACH ROW
BEGIN
    IF NEW.tipo = 'VARIADO' THEN
	INSERT INTO variado(id_produto, data_entrada, quantidade, id_usuario) 
       VALUES (NEW.id , NOW(), NEW.quantidade, NEW.id_usuario);
   ELSE
       INSERT INTO perecivel(id_produto, data_validade, data_entrada, quantidade, id_usuario) 
       VALUES (NEW.id, NEW.data_validade, NOW(), NEW.quantidade, NEW.id_usuario);
    END IF;
END!
DELIMITER;



#Procedure

DELIMITER $
CREATE PROCEDURE adicionar(
id_produto int,
data_entrada datetime,
data_validade date,
quantidade int,
id_usuario int
)
BEGIN
	IF (SELECT tipo FROM produto WHERE id = id_produto) = 'VARIADO' THEN
		INSERT INTO variado(id_produto, data_entrada, quantidade, id_usuario) VALUES
		(id_produto, data_entrada, quantidade, id_usuario);
	ELSE
		INSERT INTO perecivel(id_produto, quantidade, data_entrada, data_validade, id_usuario) VALUES
		(id_produto, quantidade, data_entrada, data_validade, id_usuario);
	END IF;
END$
DELIMITER ;


#Function

delimiter $

DELIMITER $

CREATE FUNCTION itens_perto_de_vencer(data_item DATE, dia DATE)
RETURNS INT
BEGIN
    DECLARE total INT;
    
    SELECT COUNT(*)
    INTO total
    FROM produto
    WHERE data_validade BETWEEN data_item AND data_item + INTERVAL dia DAY;

    RETURN total;
END$
delimiter ;

SELECT itens_perto_de_vencer('2024-06-06',7 ) AS total_itens_perto_de_vencer;















