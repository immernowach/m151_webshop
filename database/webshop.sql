create database 151_webshop;
use 151_webshop;

create table users (
    id int(11) not null auto_increment,
    username varchar(255) not null,
    password varchar(255)
    email varchar(255),
    phone varchar(255),

    lastname varchar(255),
    firstname varchar(255),
    address varchar(255),
    city varchar(255),
    zip varchar(255),
    country varchar(255),
    primary key (id)
);

create table orders (
    id int(11) not null auto_increment,
    user_id int(11) not null,
    order_date datetime not null,
    prize int(11) not null,
    primary key (id)
);