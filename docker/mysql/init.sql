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
    type VARCHAR(255) ,
    size VARCHAR(255) ,
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


INTO user (id, content, image, supplement) VALUES
INSERT INTO user (id,user_id,email,passwords) VALUES
    (1,1,'aaa@gmail.com','aaa'),
    (2,2,'bbb@gmail.com','bbb'),
    (3,3,'ccc@gmail.com','ccc'),
    (4,4,'ddd@gmail.com','ddd'),
    (5,5,'eee@gmail.com','eee'),
    (6,6,'fff@gmail.com','fff');

INSERT INTO info (id,agent_id,site_name,agent_name,logo,explanation,type,size,area,amounts,category,url,email) VALUES
    (1,1,'doda','パーソルキャリア株式会社','aaa','aaaaaaaaaaaaaaaaaaaaaaaa','総合','大手','全国','1000万','','https://aaaa','aaa@gmail.com'),
    (2,2,'リクナビ就活エージェント','リクルート株式会社','bbb','bbbbbbbbbbbbbbbbbbbb','総合','中小','東京','','500万','https://bbbb','bbb@gmail.com'),
    (3,3,'doda','パーソルキャリア株式会社','ccc','cccccccccccccccccccc','総合','中小','全国','','2000万','https://cccc','ccc@gmail.com'),
    (4,4,'リクナビ就活エージェント','リクルート株式会社','ddd','dddddddddddddddddddd','総合','大手','東京','','500万','https://dddd','ddd@gmail.com'),
    (5,5,'doda','パーソルキャリア株式会社','eee','eeeeeeeeeeeeeeeeeeeee','特化','','東京','女性','500万','https://eeee','eee@gmail.com'),
    (6,6,'リクナビ就活エージェント','リクルート株式会社','fff','fffffffffffffffffffff','特化','','全国','IT','500万','https://ffff','fff@gmail.com'),
    (7,7,'doda','パーソルキャリア株式会社','ggg','ggggggggggggggggggggg','特化','','大阪','税理士','1000万','https://gggg','ggg@gmail.com'),
    (8,8,'リクナビ就活エージェント','リクルート株式会社','hhh','hhhhhhhhhhhhhhhhhhhh','特化','','全国','外資系','200万','https://hhhh','hhh@gmail.com');

INSERT INTO student(id,user_id,name,sub_name,sex,school,tel_num,mail,graduation,division,desire)VALUES
    (1,1,'倉富戸','クラフト','男','蔵大学','000-0000-0000','aaa@gmail.com','2025','文系','商社'),
    (2,2,'B田','べーだ','女','蔵大学','000-0000-0000','bbb@gmail.com','2025','工学系','IT'),
    (3,3,'C木','ちぇき','女','蔵大学','000-0000-0000','ccc@gmail.com','2026','文学系','メーカー'),
    (4,4,'D川','でがわ','男','蔵大学','000-0000-0000','ddd@gmail.com','2027','心理学系','マスコミ');

INSERT INTO choice(id,agent_id,user_id)VALUES
    (1,1,3),
    (2,4,3),
    (3,6,3),
    (4,2,1),
    (5,3,1),
    (6,8,2),
    (7,6,2);

INSERT INTO craft(id,mail,password)VALUES
    (1,'aaa@gmail.com','aaaaaa'),
    (2,'bbb@gmail.com','bbbbbb'),
    (3,'ccc@gmail.com','cccccc');

INSERT INTO agent(id, mail,password,agent_id)VALUES
    (1,'aaa@gmail.com','aaa@gmail.com',1),
    (2,'bbb@gmail.com','bbb@gmail.com',2),
    (3,'ccc@gmail.com','ccc@gmail.com',3),
    (4,'ddd@gmail.com','ddd@gmail.com',4),
    (5,'eee@gmail.com','eee@gmail.com',5),
    (6,'fff@gmail.com','fff@gmail.com',6),
    (7,'ggg@gmail.com','ggg@gmail.com',7),
    (8,'hhh@gmail.com','hhh@gmail.com',8);







-- docker compose exec db bash
-- cd docker-entrypoint-initdb.d
-- mysql -u root -p < init.sql
-- root
-- mysql -u root -p
-- root
-- use posse
-- show tables;
-- select*from テーブル名;
