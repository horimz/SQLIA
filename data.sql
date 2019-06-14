mysql -u root -p

CREATE DATABASE information_security_project;

USE information_security_project;

CREATE TABLE users ( id smallint not null auto_increment, username varchar(20) not null, hashed_password varchar(255) not null, constraint pk_users primary key (id) );
INSERT INTO users ( id, username, hashed_password ) VALUES ( 1, 'horimz', '1120' );

-- Attack
DROP TABLE users;
DROP DATABASE information_security_project;

CREATE TABLE users ( id smallint not null auto_increment, username varchar(20) not null, hashed_password varchar(255) not null, constraint pk_users primary key (id) );



