DROP DATABASE IF EXISTS posse;
CREATE DATABASE posse;
USE posse;

CREATE TABLE if not exists user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    passwords VARCHAR(255)
);

CREATE TABLE if not exists info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    agent_id VARCHAR(255) NOT NULL,
    site_name VARCHAR(255) NOT NULL,
    agent_name VARCHAR(255) NOT NULL,
    logo VARCHAR(255) NOT NULL,
    explanation VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    size VARCHAR(255) NOT NULL,
    area VARCHAR(255) NOT NULL,
    amounts VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    url VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE if not exists student (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    sub_name VARCHAR(255) NOT NULL,
    sex VARCHAR(255) NOT NULL,
    school VARCHAR(255) NOT NULL,
    tel_num VARCHAR(255) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    graduation VARCHAR(255) NOT NULL,
    division VARCHAR(255) NOT NULL,
    desire VARCHAR(255) NOT NULL
);

CREATE TABLE if not exists choice (
    id INT PRIMARY KEY AUTO_INCREMENT,
    agent_id VARCHAR(255) NOT NULL,
    user_id VARCHAR(255) NOT NULL
);

CREATE TABLE if not exists  craft(
    id INT PRIMARY KEY AUTO_INCREMENT,
    mail VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE if not exists  agent(
    id INT PRIMARY KEY AUTO_INCREMENT,
    mail VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    agent_id VARCHAR(255) NOT NULL
);


INSERT INTO user (id, content, image, supplement) VALUES





-- docker compose exec db bash
-- ls
-- cd docker-entrypoint-initdb.d
-- ls
-- mysql -u root -p < init.sql
-- root
