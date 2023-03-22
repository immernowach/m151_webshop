CREATE DATABASE IF NOT EXISTS webshop;

GRANT ALL PRIVILEGES ON webshop.* TO 'webshop'@'%';

USE webshop;

CREATE TABLE users (
    firstname varchar(100),
    lastname varchar(100),
    email varchar(255) not null,
    password varchar(255),

    primary key (email)
);

CREATE TABLE locations (
    id int(11) not null auto_increment,
    address varchar(255),
    city_name varchar(255),
    zip varchar(255),
    country varchar(255),
    fk_email varchar(255) not null,

    primary key (id),
    foreign key (fk_email) references users(email)
);

CREATE TABLE products (
    id int(11) not null auto_increment,
    name varchar(255) not null,
    description varchar(255),
    price decimal(10,2),

    primary key (id)
);

CREATE TABLE orders (
    id int(11) not null auto_increment,
    user_email varchar(255) not null,
    product_id int(11) not null,
    quantity int(11) not null,
    primary key (id),
    foreign key (user_email) references users(email),
    foreign key (product_id) references products(id)
);