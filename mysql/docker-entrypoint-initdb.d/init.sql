DROP SCHEMA IF EXISTS shukatsu;

CREATE SCHEMA shukatsu;

USE shukatsu;

DROP TABLE IF EXISTS admin_users;

CREATE TABLE admin_users (
  user_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  user_email VARCHAR(255) UNIQUE NOT NULL,
  user_password VARCHAR(255) NOT NULL,
  user_created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  user_logged_in_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- 管理者のログイン情報テーブル上からユーザーID、ユーザーメールアドレス、ユーザーパスワード、ユーザー作成時刻、ユーザー最終ログイン時刻

INSERT INTO admin_users SET user_email = 'test@posse-ap.com', user_password = sha1('root_password');
-- 管理者追加

drop table if exists agent_users;

CREATE TABLE agent_users (
  user_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  user_email VARCHAR(255) UNIQUE NOT NULL,
  user_password VARCHAR(255) NOT NULL,
  user_created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  user_logged_in_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- エージェント担当者のログイン情報テーブル上からユーザーID、ユーザーメールアドレス、ユーザーパスワード、ユーザー作成時刻、ユーザー最終ログイン時刻

insert into agent_users set user_email = 'assignee1@posse-ap.com',user_password = sha1('assignee_password1');
insert into agent_users set user_email = 'assignee2@posse-ap.com',user_password = sha1('assignee_password2');
insert into agent_users set user_email = 'assignee3@posse-ap.com',user_password = sha1('assignee_password3');
insert into agent_users set user_email = 'assignee4@posse-ap.com',user_password = sha1('assignee_password4');
insert into agent_users set user_email = 'assignee5@posse-ap.com',user_password = sha1('assignee_password5');
insert into agent_users set user_email = 'assignee6@posse-ap.com',user_password = sha1('assignee_password6');
-- 担当者追加

DROP TABLE IF EXISTS agent_contract_information;

CREATE TABLE agent_contract_information (
  agent_id int auto_increment not null primary key,
  agent_name varchar(255) not null,
  contract_date date not null,
  start_contract_date date not null,
  end_contract_date date not null,
  agent_phone_number varchar(255) not null,
  apply_email_address varchar(255) not null,
  agent_address varchar(255) not null,
  agent_representative varchar(255) not null
);
-- エージェント契約情報テーブル上から企業ID、企業名、契約締結日、契約開始日、契約終了日、企業電話番号、問い合わせ通知先メールアドレス、企業住所、企業代表者氏名

INSERT INTO agent_contract_information 
(agent_name,contract_date,start_contract_date,end_contract_date,agent_phone_number,apply_email_address,agent_address,agent_representative) 
values 
('エージェント1','2022-03-10','2022-04-30','2023-04-29','000-0000-0000','問い合わせ通知先メールアドレス1','住所サンプル1','代表者サンプル1'),
('エージェント2','2022-03-10','2022-04-30','2023-04-29','000-0000-0000','問い合わせ通知先メールアドレス2','住所サンプル2','代表者サンプル2'),
('エージェント3','2022-03-10','2022-04-30','2023-04-29','000-0000-0000','問い合わせ通知先メールアドレス3','住所サンプル3','代表者サンプル3');

drop table if exists agent_assignee_information;

create table agent_assignee_information (
  agent_id int not null,
  agent_name varchar(255) not null,
  assignee_id int not null AUTO_INCREMENT primary key,
  assignee_email_address varchar(255) not null,
  assignee_department varchar(255) not null,
  assignee_name varchar(255) not null
);
-- 担当者テーブル上から企業ID、企業名、担当者ID、担当者メールアドレス、担当者部署、担当者氏名

insert into agent_assignee_information 
(agent_id,agent_name,assignee_email_address,assignee_department,assignee_name) 
VALUES
(1,'エージェント1','担当者メールアドレス1','担当者部署1','担当者氏名1'),
(1,'エージェント1','担当者メールアドレス2','担当者部署2','担当者氏名2'),
(2,'エージェント2','担当者メールアドレス1','担当者部署1','担当者氏名1'),
(2,'エージェント2','担当者メールアドレス2','担当者部署2','担当者氏名2'),
(2,'エージェント2','担当者メールアドレス3','担当者部署3','担当者氏名3'),
(3,'エージェント3','担当者メールアドレス1','担当者部署1','担当者氏名1'),
(3,'エージェント3','担当者メールアドレス2','担当者部署2','担当者氏名2'),
(3,'エージェント3','担当者メールアドレス3','担当者部署3','担当者氏名3'),
(3,'エージェント3','担当者メールアドレス4','担当者部署4','担当者氏名4');

drop table if exists agent_public_information;

create table agent_public_information (
  agent_id int AUTO_INCREMENT not null primary key,
  agent_name varchar(255) not null,
  corporate_amount int not null,
  agent_address varchar(255) not null,
  
)