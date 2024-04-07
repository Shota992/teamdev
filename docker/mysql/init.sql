DROP DATABASE IF EXISTS posse;
CREATE DATABASE posse;
USE posse;

CREATE TABLE if not exists user (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    passwords VARCHAR(255)
);



CREATE TABLE if not exists info (
    agent_id INT PRIMARY KEY AUTO_INCREMENT,
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
    user_id INT PRIMARY KEY AUTO_INCREMENT,
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
    user_id VARCHAR(255) NOT NULL,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE if not exists choice_ing(
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


INSERT INTO user (user_id,email,passwords) VALUES
    (1,'aaa@gmail.com','$2y$10$urwQ6DNl73feFkbn7udUB.pD.QJvZ52gpHs5EOYmw44t0wMZievpi'),
    (2,'bbb@gmail.com','$2y$10$JJ7XwCUQuk6QucSQp..ReOiOugVIfXGbpp.T5jAQksjxt4zeBqnpK'),
    (3,'ccc@gmail.com','$2y$10$4fMuI1M1AhM7RwJWxogNPO9D9Un6J3ICw3JaBIoehbaeBkSQI4Dl2'),
    (4,'ddd@gmail.com','$2y$10$puth9gaybzQVNE2zo2nlsOWbNocCjSMa3jhC6BbDmT3eXerv2vYWa'),
    (5,'eee@gmail.com','$2y$10$puth9gaybzQVNE2zo2nlsOWbNocCjSMa3jhC6BbDmT3eXerv2vYWa'),
    (6,'fff@gmail.com','$2y$10$.uvyB7bkfWNda4Kw1zv14ucnOzSedULx4cqs76ZPVKcir1JZ2hmue');

INSERT INTO info (agent_id,site_name,agent_name,logo,explanation,type,size,area,amounts,category,url,email) VALUES
    (1,'doda','パーソルキャリア株式会社','top_doda_ikon.png','aaaaaaaaaaaaaaaaaaaaaaaa','総合型','大手','全国','100万','','https://aaaa','aaa@gmail.com'),
    (2,'リクナビ就活エージェント','リクルート株式会社','top_rikunabi_ikon.png','bbbbbbbbbbbbbbbbbbbb','総合型','中小','東京','200万','','https://bbbb','bbb@gmail.com'),
    (3,'doda','パーソルキャリア株式会社','top_doda_ikon.png','cccccccccccccccccccc','総合型','中小','全国','300万','','https://cccc','ccc@gmail.com'),
    (4,'リクナビ就活エージェント','リクルート株式会社','top_rikunabi_ikon.png','dddddddddddddddddddd','総合型','大手','東京','400万','','https://dddd','ddd@gmail.com'),
    (5,'doda','パーソルキャリア株式会社','top_doda_ikon.png','eeeeeeeeeeeeeeeeeeeee','特化型','','東京','500万','女性','https://eeee','eee@gmail.com'),
    (6,'リクナビ就活エージェント','リクルート株式会社','top_rikunabi_ikon.png','fffffffffffffffffffff','特化型','','全国','600万','IT','https://ffff','fff@gmail.com'),
    (7,'doda','パーソルキャリア株式会社','top_doda_ikon.png','ggggggggggggggggggggg','特化型','','大阪','700万','税理士','https://gggg','ggg@gmail.com'),
    (8,'リクナビ就活エージェント','リクルート株式会社','top_rikunabi_ikon.png','hhhhhhhhhhhhhhhhhhhh','特化型','','全国','800万','外資系','https://hhhh','hhh@gmail.com');

-- INSERT INTO student(user_id,name,sub_name,sex,school,tel_num,mail,graduation,division,desire)VALUES
--     -- (1,'倉富戸','クラフト','男','蔵大学','000-0000-0000','aaa@gmail.com','2025','文系','商社'),
--     -- (2,'B田','べーだ','女','蔵大学','000-0000-0000','bbb@gmail.com','2025','工学系','IT'),
--     -- (3,'C木','ちぇき','女','蔵大学','000-0000-0000','ccc@gmail.com','2026','文学系','メーカー'),
--     -- (4,'D川','でがわ','男','蔵大学','000-0000-0000','ddd@gmail.com','2027','心理学系','マスコミ');

INSERT INTO choice(id,agent_id,user_id,time)VALUES
    (1,1,3,4/7),
    (2,4,3,4/7),
    (3,6,3,4/7),
    (4,2,1,4/7),
    (5,3,1,4/7),
    (6,8,2,4/7),
    (7,6,2,4/7);

-- INSERT INTO choice_ing(id,agent_id,user_id)VALUES
--     (1,1,3),
--     (2,4,3),
--     (3,6,3),
--     (4,2,1),
--     (5,3,1),
--     (6,8,2),
--     (7,6,2);

INSERT INTO craft(id,mail,password)VALUES
    (1,'aaa@gmail.com','$2y$10$9lerfYbP.TR2uvxqq9OQ3uA/B92S9lt14qJbB9gekRtdihfCgw0SW'),
    (2,'bbb@gmail.com','$2y$10$vUANQL4WKzHdfAET5nhQ8O/cs7FWJpxCHoK2CvHlY9G9RLSUWz/Qq'),
    (3,'ccc@gmail.com','$2y$10$5SskWiIVhVn2jUNjxy/KbekxG.9xBSd8T5unbMMY.zWlj5pmyYWeC'),
    (4,'negi0141017323@gmail.com','$2y$10$z6l1PUjdsFpIvCEdDJkpl.3Qvj5S28oXu8h8KQKlZcYemC04b8h8G');

INSERT INTO agent(id, mail,password,agent_id)VALUES
    (1,'aaa@gmail.com','$2y$10$MIppQ6qiusgTDUfOx39IteL5sm3jpHLdRxOQPxCKeKvPhMsPxMzVa',1), 
    (2,'bbb@gmail.com','$2y$10$.02LLvqLgkR8zcmaDKKKVu0fy4CEg72UPS.6bp4Ct.PKeLaAN6yqO',2), 
    (3,'ccc@gmail.com','$2y$10$sOym37XFbxi2yq93.aStMuqouYSL8wckVXwZPDcPtSGLg0gbi5eWG',3),
    (4,'ddd@gmail.com','$2y$10$QcDw483anG12/fuNOWzBTessGImN3XKhFMn1ZAA0hmmCG7jWNeDdS',4),
    (5,'eee@gmail.com','$2y$10$KmKL.K5wGkeu.ROeGJvM.erPucYfF.p8UnuU0sOFG3YZNf3x3jWx2',5),
    (6,'fff@gmail.com','$2y$10$7ou8OKXmYYrBQJ5qyuFcLe.gGVbVrDMMx4N7TiWgmQbDmNszf0w2W',6),
    (7,'ggg@gmail.com','$2y$10$1jgr8p.Njj2rY9iQ/EsRGOlfJfLfzX4gcN7I1BDufFVyJk4mDrJPW',7),
    (8,'hhh@gmail.com','$2y$10$0YxjUv6o5z8zEbrT97Oex.u.E3w03drNNEa.AeoJvs7/zSVuBRZ3i',8);




-- docker compose exec db bash

-- ここからがsqlの更新（つまり、web上で色々テーブル内容変えても、sqlに書かれている通りのテーブルに作り直される）
-- cd docker-entrypoint-initdb.d
-- mysql -u root -p < init.sql
-- root
-- ここまで

-- （web上でテーブル操作した時はここから）
-- mysql -u root -p
-- root
-- use posse
-- show tables;
-- select*from テーブル名;
