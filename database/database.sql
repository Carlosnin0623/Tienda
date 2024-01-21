CREATE DATABASE tienda_master charset = utf8mb4 collate = utf8mb4_spanish2_ci;
Use tienda_master;

/* Creación de la tabla Usuario */


CREATE TABLE IF NOT exists Usuarios(
Id int not null auto_increment,
Nombre varchar(100) not null,
Apellidos varchar(255),
Email  varchar(255) not null,
Password varchar(255) not null,
Rol varchar(30),
Imagen  varchar(255),
FechaCreacion datetime default current_timestamp,
constraint Pk_Usuarios primary key(Id),
constraint Uq_email unique(Email)
)engine = InnoDB;

INSERT INTO Usuarios (Nombre,Apellidos,Email,Password,Rol,Imagen) Values ('Carlos Alberto', 'Nin Queliz', 'carlosnin23@hotmail.com','dsfrewrer','admin',null);

/* Creación de tabla Categorias */

Create table if not exists Categorias(
Id int not null auto_increment,
Nombre varchar(100) not null,
FechaCreacion datetime default current_timestamp,
constraint Pk_Categorias primary key(Id),
constraint Uq_Nombre UNIQUE (Nombre)
)engine=InnoDB;

insert into Categorias (Nombre) Values ('Manga Corta');
insert into Categorias (Nombre) Values ('Tirantes');
insert into Categorias (Nombre) Values ('Manga Larga');
insert into Categorias (Nombre) Values ('Sudaderas');


/* Creacion tabla productos */

create table if not exists Productos(
Id int not null auto_increment,
Categoria_Id int not null,
Nombre Varchar(100) not null,
Descripcion text,
Precio float(100,2) not null,
Stock int not null,
Oferta Varchar(2),
Imagen Varchar(255),
Fecha_Entrada datetime default current_timestamp,
constraint Pk_Producto primary key(Id),
constraint Fk_Productos_Categoria foreign key (Categoria_Id) references Categorias (Id)
)engine=InnoDB;


/* Creacion tabla pedidos */

CREATE table if not exists Pedidos(
Id int not null auto_increment,
Usuario_Id int not null,
Provincia varchar(100) not null,
Localidad varchar(100) not null,
Direccion varchar(255) not null,
Coste float(100,2) not null,
Estado varchar(20) not null,
Fecha_Envio datetime default current_timestamp,
constraint Pk_Pedidos primary key(Id),
constraint Fk_pedido_usuario Foreign key (Usuario_Id) references Usuarios(Id)
)engine = InnoDB;


Create table if not exists Lineas_Pedidos(
Id int not null auto_increment,
Pedido_Id int not null,
Producto_Id int not null,
Unidades int not null,
Fecha_Envio datetime default current_timestamp,
constraint Pk_Lineas_pedidos primary key(Id),
constraint Fk_Lineas_pedidos_Pedido foreign key (Pedido_Id) references Pedidos(Id),
constraint Fk_Lineas_pedidos_Producto foreign key (Producto_Id) references Productos (Id)
)engine=InnoDB;
