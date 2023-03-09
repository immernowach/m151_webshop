create table users (
    id int(11) not null auto_increment,
    email varchar(255),
    password varchar(255),

    primary key (id)
);

create table locations (
    id int(11) not null auto_increment,
    address varchar(255),
    city_name varchar(255),
    zip varchar(255),
    country varchar(255),

    primary key (id),
    foreign key (id) references users(id)
);

create table products (
    id int(11) not null auto_increment,
    name varchar(255) not null,
    description varchar(255),
    price decimal(10,2),

    primary key (id)
);

create table orders (
    id int(11) not null auto_increment,
    user_id int(11) not null,
    product_id int(11) not null,
    quantity int(11) not null,
    primary key (id),
    foreign key (user_id) references users(id),
    foreign key (product_id) references products(id)
);