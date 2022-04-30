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

insert into agent_users set user_email = 'assignee1@posse-ap.com',user_password = sha1('assignee_password1');
insert into agent_users set user_email = 'assignee2@posse-ap.com',user_password = sha1('assignee_password2');
insert into agent_users set user_email = 'assignee3@posse-ap.com',user_password = sha1('assignee_password3');
insert into agent_users set user_email = 'assignee4@posse-ap.com',user_password = sha1('assignee_password4');
insert into agent_users set user_email = 'assignee5@posse-ap.com',user_password = sha1('assignee_password5');
insert into agent_users set user_email = 'assignee6@posse-ap.com',user_password = sha1('assignee_password6');
-- 担当者追加

DROP TABLE IF EXISTS agent_contract;

CREATE TABLE agent_contract (
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
-- 上から企業ID、企業名、契約開始日、契約終了日
INSERT INTO agent_contract (agent_name,contract_date,start_contract_date,end_contract_date,agent_phone_number,apply_email_address,agent_address,agent_representative) values 
('エージェント1','2022-03-10','2022-04-30','2023-04-29','000-0000-0000','問い合わせ通知先メールアドレス','住所サンプル1','代表者サンプル1'),
('エージェント1','2022-03-10','2022-04-30','2023-04-29','000-0000-0000','問い合わせ通知先メールアドレス','住所サンプル1','代表者サンプル1'),
('エージェント1','2022-03-10','2022-04-30','2023-04-29','000-0000-0000','問い合わせ通知先メールアドレス','住所サンプル1','代表者サンプル1');

INSERT INTO
  events
SET
  title = 'イベント2';