use viagens
create table usuarios( 
    nome nvarchar(100) not null,
    email nvarchar(250) not null,
    senha nvarchar(32) not null,
    nivel int not null,
    fk_cliente nvarchar(15),
    primary key (email,senha)
);

insert into usuarios (nome,     email,              senha,      nivel,  fk_cliente) values 
                     ("admin",  "admin@adm.com",    MD5("123"), 0,      null);


create table fornecedores(cnpj nvarchar(18) not null, rasao nvarchar(200) not null, fantasia nvarchar(100) not null, primary key (cnpj));


DELIMITER //
create procedure salva_fornecedores(in cn nvarchar(18), ras nvarchar(200), fant nvarchar(100))

    BEGIN 
        IF (SELECT COUNT(*) FROM fornecedores WHERE cnpj=cn) = 0 THEN
            insert into fornecedores values(cn,ras,fant);
        ELSE
            UPDATE fornecedores SET rasao = ras, fantasia = fant where cnpj = cn ;
        END IF;
    END; //

create table categorias(id int not null AUTO_INCREMENT, nome nvarchar(100) not null, descricao nvarchar(200) not null , primary key (id));

DELIMITER //
create procedure salva_categorias(in i int, nm nvarchar(100), descr nvarchar(200))

    BEGIN 
        IF (SELECT COUNT(*) FROM categorias WHERE nome=nm) = 0 THEN
            insert into categorias (nome,descricao) values(nm,descr);
        ELSE
            UPDATE categorias SET nome = nm, descricao = descr where id = i ;
        END IF;
    END; // DELIMITER;

create table produtos(id int not null AUTO_INCREMENT,
                      nome nvarchar(100) not null,
                      hospedagem nvarchar(100),
                      trasport nvarchar(200) not null,
                      destino nvarchar(100),
                      pk_fornecedor nvarchar(18) not null,
                      pessoas int not null,
                      dias int not null,
                      qtd int not null,
                      pk_categoria int not null,
                      preco float not null,
                      descricao nvarchar(200),
                      is_promotion int ,
                      primary key (id),
                      foreign key (pk_fornecedor) references fornecedores(cnpj),
                      foreign key(pk_categoria) references categorias(id));

select a.id as id, a.nome, destino, hospedagem, qtd, c.nome as categoria, is_promotion, preco, b.fantasia as fornecedor
    from produtos as a 
    inner join fornecedores as b on a.pk_fornecedor = b.cnpj 
    inner join categorias as c on a.pk_categoria = c.id;

insert into produtos(nome,
                      hospedagem ,
                      trasport ,
                      destino ,
                      pk_fornecedor,
                      pessoas ,
                      dias ,
                      qtd ,
                      pk_categoria ,
                      preco ,
                      descricao ,
                      is_promotion) 

                      values (:nome,
                      :hospedagem ,
                      :trasport ,
                      :destino ,
                      :pk_fornecedor,
                      :pessoas ,
                      :dias ,
                      :qtd ,
                      :pk_categoria ,
                      :preco ,
                      :descricao ,
                      :is_promotion);

create table clientes(cpf nvarchar(14) not null,
                        nome nvarchar(100) not null,
                        sobrenome nvarchar(100) not null,
                        celular nvarchar(15),
                        primary key (cpf));

insert into clientes (cpf,nome,sobrenome,celular) values (:cpf,:nome,:sobrenome,:celular);

insert into usuarios (nome,     email,              senha,      nivel,  fk_cliente) values 
                     (:nome,    :email,    MD5(:senha),         1,      :cpf); 

create table cards (numero nvarchar(20) not null,
                    cpf nvarchar(14) not null,
                    ccv int not null,
                    venc nvarchar(7) not null,
                    primary key (cpf),
                    foreign key (cpf) references clientes(cpf));