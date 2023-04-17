DROP DATABASE IF EXISTS webshop;
CREATE DATABASE IF NOT EXISTS webshop;

CREATE USER 'webshop'@'localhost' IDENTIFIED BY 'webshop';
GRANT ALL PRIVILEGES ON webshop.* TO 'webshop'@'localhost';

USE webshop;

CREATE TABLE users (
    firstname varchar(100),
    lastname varchar(100),
    email varchar(255) not null,
    password varchar(255),

    primary key (email)
);

CREATE TABLE products (
    id int(11) not null auto_increment,
    name varchar(255) not null,
    description varchar(255),
    price decimal(10,2),
    imagename varchar(255),

    primary key (id)
);