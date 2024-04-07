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
    (1,'madoka@gmail.com','$2y$10$OWlvj5tdJFCsuZeARQ1ceufRf5yAB3c61nBNeXnewJAP8ik1PvDbm');
-- password = 1007Madoka

INSERT INTO info (agent_id,site_name,agent_name,logo,explanation,type,size,area,amounts,category,url,email) VALUES
    (1,'doda','パーソルキャリア株式会社','top_doda_ikon.png','経験者採用や即戦力人材の採用に強みを持っている、中途採用のための求人情報サービスです','総合型','大手','全国','500万','','https://doda.jp/','doda@gmail.com'),
    (2,'リクナビ就活エージェント','リクルート株式会社','top_rikunabi_ikon.png','人材業界最大手のリクルートグループが運営する、社会人向けの転職サイトです','総合型','中小','東京','200万','','https://job.rikunabi.com/2026/contents/article/edit~slp~brand02~index/u/?original=1&gclid=Cj0KCQjwiMmwBhDmARIsABeQ7xRfIJL-UBcdqNREIu3p8BQkbUH9WU73_6KB07QQgEmGJ1b9pOhHH-8aAtzYEALw_wcB&gad_source=1&vos=ev26prapadg12x0022325','rikunabi@gmail.com'),
    (3,'MASSMEDIAN','株式会社マスメディアン','massmedian.png','「宣伝会議」「販促会議」「ブレーン」「広報会議」などマーケティング・クリエイティブ関連の専門誌を発行する宣伝会議のグループ会社です','特化型','大手','名古屋','300万','営業','https://www.massmedian.co.jp/?a8=wfYj.fKNb8t7u29mO_tmGHMbZ_Xk_YLwRkL9N8JDvhJtWkXD-kJF3kL6sQvkMGYDvfP2blYOjlnCxs00000016542001&cats_not_organic=true&cats_direct=true','massmedian@gmail.com'),
    (4,'LiBzPARTNERS','株式会社リブ','LiBzPARTNERS.png','2014年に創立して以来、一貫して女性のキャリア支援を事業として行ってきたサービスです','特化型','大手','東京','400万','女性','https://www.libinc.co.jp/','LiBzPARTNERS@gmail.com'),
    (5,'KOTORA','株式会社コトラ','logo-kotora-pc.png','金融業界・コンサルタントの転職に強みを持つ転職エージェントです','特化型','中小','東京','200万','会計士','https://www.kotora.jp/','kotora@gmail.com'),
    (6,'マイナビエージェント','株式会社マイナビ','mainabi.png','20〜30代前半を中心とした若手人材の転職支援を得意とし、幅広い業種・職種の転職サポートを行っています','総合型','大手','東京','800万','','https://mynavi-agent.jp/entry/?utm_source=cpa_011_general_oth&utm_medium=affiliate&utm_campaign=cpa_011_general_oth&nst=0&cid=c01htw2eeaq1rtv7arbrhvsfrcm&p=pgcww0wbn1ym','mainabi@gmail.com'),
    (7,'BIZREACH','株式会社ビズリーチ','BizReach-02.png','227万人以上（2024年2月末時点）の優秀な人材が登録する国内最大級のデータベースから「欲しい」人材を自ら探して直接スカウトできるサービスです','総合型','中小','大阪','20万','','https://www.bizreach.jp/','bizreach@gmail.com'),
    (8,'WILLOF TECH','株式会社ウィルオブ・ワーク','willoftech.png','IT業界を専門とした転職エージェントです','特化型','中小','全国','10万','IT','https://willof.jp/techcareer/lp/form-only-1/?utm_source=accesstrade&utm_medium=affiliate&utm_campaign=suberanai_tenshoku&atss=0100p9ii00h9s7-a64b0ff509b7ef2e9c4c208be0842c30&atnct=techcareer_0100p9ii00h9s7-a64b0ff509b7ef2e9c4c208be0842c30','willoftech@gmail.com');

-- INSERT INTO student(user_id,name,sub_name,sex,school,tel_num,mail,graduation,division,desire)VALUES
--     -- (1,'倉富戸','クラフト','男','蔵大学','000-0000-0000','aaa@gmail.com','2025','文系','商社'),
--     -- (2,'B田','べーだ','女','蔵大学','000-0000-0000','bbb@gmail.com','2025','工学系','IT'),
--     -- (3,'C木','ちぇき','女','蔵大学','000-0000-0000','ccc@gmail.com','2026','文学系','メーカー'),
--     -- (4,'D川','でがわ','男','蔵大学','000-0000-0000','ddd@gmail.com','2027','心理学系','マスコミ');

-- INSERT INTO choice(id,agent_id,user_id,time)VALUES
--     (1,1,3,'2024-04-07 11:03:22'),
--     (2,4,3,'2024-04-07 11:03:22'),
--     (3,6,3,'2024-04-07 11:03:22'),
--     (4,2,1,'2024-04-07 11:03:22'),
--     (5,3,1,'2024-04-07 11:03:22'),
--     (6,8,2,'2024-04-07 11:03:22'),
--     (7,6,2,'2024-04-07 11:03:22');

-- INSERT INTO choice_ing(id,agent_id,user_id)VALUES
--     (1,1,3),
--     (2,4,3),
--     (3,6,3),
--     (4,2,1),
--     (5,3,1),
--     (6,8,2),
--     (7,6,2);

INSERT INTO craft(id,mail,password)VALUES
    (1,'craft@gmail.com','$2y$10$2LdXAYO1XnoGJy4dUUyO/.eO0NCSFHI9NLiMLT.2cV7JDs5MGCdZK');
-- password = craft

INSERT INTO agent(id, mail,password,agent_id)VALUES
    (1,'doda@gmail.com','$2y$10$QZCaqh1mYGs0QNUeFMRaVuGDWxqMOeXZOYngN3eCA9GWPd9644WK.',1), 
    (2,'rikunabi@gmail.com','$2y$10$WpUclACATCtgA1XRSQ/eBOAzPxwQ8hPDutDoHZ6iThhz4qLtDddY.',2), 
    (3,'massmedian@gmail.com','$2y$10$QMwPbkUq4/WuCc7RETUKR.qSe1Oku/LL3bCc8WM9uVg9gDWh.YNdO',3),
    (4,'LiBzPARTNERS@gmail.com','$2y$10$0nCuKsB7G7EI.r.1.3CEHOFAERDWuQ270MG313/RyqGls3AMU.1GG',4),
    (5,'kotora@gmail.com','$2y$10$vY.QlTzDymZieixlAZIHgOKIYKu9tn.huzQ3ejMwPa50TxrnZOAXS',5),
    (6,'mainabi@gmail.com','$2y$10$xk3sql4lAqYf2Dq9IcELtO2LKZthKkB37fTkNryeGecu3c1z3S1Xm',6),
    (7,'bizreach@gmail.com','$2y$10$gkIf79XMv1vEIg5iKmMPFObJ/HavJfnih8Q.Su52RmnlrToKCco/C',7),
    (8,'willoftech@gmail.com','$2y$10$P9CRgPIzxIlM/5RMVTvq4uh0B6AZyPiFGV9en92EFAH3TQZ0ESpZK',8);
-- 初期ログインの際はパスワード＝メールアドレス




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
