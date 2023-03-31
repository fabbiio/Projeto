create database Controle;
use Controle;
#drop database Controle;


create table Usuario(
	id int primary key auto_increment not null,
    nome varchar(20) not null,
    email varchar(110) not null,
    senha varchar(20) not null,
    cidade varchar(45) not null,
	telefone varchar (20) not null
);



create table Produto(
	id int primary key auto_increment not null,
    nome varchar(20),
    tipo varchar(20),
    quantidade int,
    preco float,
    marca varchar(20),
    id_usuario int,
    foreign key (id_usuario) references Usuario(id)
);

create table Perecivel(
	id_produto int primary key,
    foreign key (id_produto) references Produto(id),
    data_fabricacao date,
    data_validade date
);

create table Nao_perecivel(
	id_produto int primary key,
    foreign key (id_produto) references Produto(id),
    data_entrada date
);

create table Administrador(
	id int primary key auto_increment not null,
    nome varchar(20) not null,
    email varchar(110) not null,
    senha varchar(20) not null
    
);

insert into Usuario(nome,email,senha,cidade,telefone)
values("Fabio","fabiofelipe788@gmail.com","12345678","Centro", "35984039274");

insert into Usuario(nome,email,senha,cidade,telefone)
values("Joao","joao@gmail.com","10203040","Centro", "3595645121");

insert into Usuario(nome,email,senha,cidade,telefone)
values("Maria","maria@gmail.com","1020304050","Centro", "34515454");

select * from usuario;

insert into produto(nome,tipo,quantidade,preco,marca,id_usuario )
values("Sal","Perecivel",50,"5.99", "Salita", 1);

insert into produto(nome,tipo,quantidade,preco,marca,id_usuario )
values("Lapis","Nao_Perecivel",110,"0.70", "Faber", 3);

select * from Produto;

insert into Perecivel(id_produto,data_fabricacao,data_validade)
values(1,"2023-02-15", "2024-02-15");

insert into administrador values(Null,"Controle Estoque", "estoque@gmail.com", "12345678" );


create view Produtos_Cadastrados as
select produto.id as ID_Produto , produto.nome as nome, produto.quantidade as quantidade,
 produto.preco, produto.marca ,produto.tipo , usuario.nome as Usuario, sum(produto.preco * produto.quantidade) as  Preco_Total 
 from produto join usuario on 
usuario.id = produto.id_usuario group by produto.preco ;
select *  from produtos_cadastrados;


create view cadastro_usuarios AS
select usuario.nome as nome_usuario, produto.nome as nome_produto, produto.quantidade
from usuario JOIN produto ON 
usuario.id = produto.id_usuario;
select * from cadastro_usuarios;

create view valor_estoque_produtos as
select  usuario.nome as nome_usuario, produto.nome as nome_produto, produto.quantidade, produto.preco, quantidade * preco as valor_total
from produto join usuario on 
produto.id_usuario = usuario.id order by usuario.nome asc;
select * from valor_estoque_produtos;


create view  Valor_Total_Estoque as
select sum(valor_total) as Valor_Estoque from valor_estoque_produtos;
select * from Valor_Total_Estoque ;

create view Itens_Cadastrados as
select usuario.id as ID_Usuario, produto.nome as Nome_produto , produto.quantidade 
from usuario join produto on
produto.id_usuario = usuario.id 
order by id_usuario asc;
select * from Itens_Cadastrados ;



#criar permissoes
create user 'controle_estoque'@'localhost' ;

#Selecionando usuarios cadastrados
select * from mysql.user;

#criando privilegios
grant select on produto.* to 'controle_estoque'@'localhost' ;
show grants for 'controle_estoque'@'localhost' ;

grant select on cadastro_usuarios to 'controle_estoque'@'localhost' ;