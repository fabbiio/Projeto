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
    quantidade int,
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
    quantidade int,
    data_entrada date,
    data_validade date,
    id_usuario int,
    foreign key (id_usuario) references usuario(id)
    
);

create table variado(
	id_produto int primary key,
    data_entrada date,
    quantidade int,
    id_usuario int ,
    foreign key (id_produto) references produto(id),
    foreign key (id_usuario) references usuario(id)
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
    PRIMARY KEY(id, id_usuario, id_produto),
    FOREIGN key (id_usuario) REFERENCES usuario(id),
    FOREIGN key (id_produto) REFERENCES produto(id)
    );
    
    
    
create table vendas(
	id int primary key,
    quatidade int,
    data_saida date,
    id_usuario int,
    id_produto int,
    FOREIGN key (id_usuario) REFERENCES usuario(id),
    FOREIGN key (id_produto) REFERENCES produto(id)
);

insert into Usuario(nome,email,senha,cidade,telefone)
values("Fabio","fabiofelipe788@gmail.com","12345678","Centro", "35984039274");

insert into Usuario(nome,email,senha,cidade,telefone)
values("Joao","joao@gmail.com","10203040","Centro", "3595645121");

insert into Usuario(nome,email,senha,cidade,telefone)
values("Maria","maria@gmail.com","1020304050","Centro", "34515454");

select * from usuario;

insert into produto(nome,tipo,quantidade,preco,marca,id_usuario,status_cadastro)
values("Sal","Perecivel",50,"5.99", "Salita", 1,now());

insert into produto(nome,tipo,quantidade,preco,marca,id_usuario,status_cadastro)
values("Lapis","Nao_Perecivel",110,"0.70", "Faber", 3,now());

select * from Produto;

insert into Perecivel(id_produto,data_fabricacao,data_validade)
values(1,"2023-02-15", "2024-02-15");

insert into administrador values(Null,"Controle Estoque", "estoque@gmail.com", "12345678" );


create view tabela_venda as
SELECT produto.nome as nome, produto.preco as preco, imagens.caminho , produto.id_usuario as id_usuario, produto.id as id_produto
FROM produto join imagens on produto.id = imagens.id_produto  ;


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

select * from produto; 


delimiter$
CREATE TRIGGER AdicionarItemPerecivelVariado
AFTER INSERT ON produto
FOR EACH ROW
BEGIN
    IF NEW.tipo = 'perecivel' THEN
        INSERT INTO perecivel (id_produto, quantidade, data_entrada, data_validade, id_usuario)
        VALUES (NEW.id, NEW.quantidade, CURDATE(), NEW.data_validade, NEW.id_usuario)$
    ELSEIF NEW.tipo = 'variado' THEN
        INSERT INTO variado (id_produto, data_entrada, quantidade, id_usuario)
        VALUES (NEW.id, CURDATE(), NEW.quantidade, NEW.id_usuario)$
    END IF$
END$
delimiter ; 



DELIMITER $
CREATE PROCEDURE ArmazenarProduto (
    id_produto int ,
    id_usuario int ,
    tipo VARCHAR(20),
    data_validade DATE,
    quantidade int
	
)
AS
BEGIN
    IF tipo = 'PERECIVEL'
    BEGIN
        INSERT INTO perecivel (id_produto,quantidade, data_validade, data_entrada, id_usuario)
        VALUES (id_produto, quantidade, data_validade, sum(), id_usuario)
    END;
    ELSE IF tipoProduto = 'nao_perecivel'
    BEGIN
        INSERT INTO variado (id_produto, data_entrada, quantidade, id_usuario)
        VALUES (id_produto, sum(),quantidade, id_usuario)
    END$
END$
DELIMITER;


CREATE FUNCTION TotalProdutosPorUsuario (idusuario INT)
RETURNS INT
AS
BEGIN
    DECLARE totalProdutos INT

    SELECT totalProdutos = COUNT(*) FROM produto WHERE id_usuario = idUsuario

    RETURN totalProdutos
END






