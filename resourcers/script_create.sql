drop schema if exists `cinepop`;

create schema if not exists `cinepop` default character set utf8mb4 collate utf8mb4_0900_ai_ci;

use `cinepop`;

create table users (
	id int unsigned auto_increment primary key,
    name varchar(100),
    lastname varchar(100),
    email varchar(200),
    password varchar(200),
    image varchar(200),
    token varchar(200),
    bio text
);

create table movies (
	id int unsigned auto_increment primary key,
    title varchar(100),
    description text,
    image varchar(200),
    trailer varchar(200),
    category varchar(200),
    length varchar(200),
    users_id int(11) unsigned,
    foreign key(users_id) references users(id)
);

create table reviews (
	id int unsigned auto_increment primary key,
    rating int,
    review text,
    users_id int(11) unsigned,
    movies_id int(11) unsigned,
    foreign key(users_id) references users(id),
    foreign key(movies_id) references movies(id)
);