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
  agent_address varchar(255) not null
  -- 決まったら追記していく
);

drop table if exists admin_agent_list;

create table admin_agent_list (
  agent_id int AUTO_INCREMENT not null primary key,
  agent_name varchar(255) not null,
  apply_amount int not null,
  featured_article_bool boolean not null default false,
  bool_updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- 管理者画面のエージェント一覧
-- 上から企業ID、企業名、問い合わせ数、特集記事ステータス、特集記事掲載ステータス定期更新用の時間(phpで管理者画面アクセス時に時間取得して一年？半年？たってたらboolをupdateする)

insert into admin_agent_list 
(agent_name,apply_amount) 
values
('エージェント1',0),
('エージェント2',0),
('エージェント3',0);
-- 問い合わせ来たらupdate admin_agent_list set apply_amount=apply_amount+1 where agent_id=?で問い合わせ数を増やせる

drop table if exists apply_list;

create table apply_list(
  apply_id int auto_increment not null primary key,
  agent_id int not null,
  agent_name varchar(255) not null,
  apply_time DATETIME default CURRENT_TIMESTAMP,
  applicant_email_address varchar(255) not null,
  applicant_name_kanji varchar(255) not null,
  applicant_name_furigana varchar(255) not null,
  applicant_phone_number varchar(255) not null,
  applicant_university varchar(255) not null,
  applicant_gakubu varchar(255) not null,
  applicant_gakka varchar(255) not null,
  applicant_graduation_year int not null,
  applicant_postal_code varchar(255) not null,
  applicant_address varchar(255) not null,
  applicant_consultation varchar(255) not null,
  applicant_other_agents varchar(255) not null,
  applicant_report_status boolean default false
);
-- 申込一覧テーブル上から申込ID、企業ID、企業名、申込日時、申込者の=>メールアドレス、漢字の名前、フリガナ、電話番号、大学、学部、学科、何年卒、郵便番号、住所、相談内容、同時応募エージェント、通報ステータス
insert into apply_list
(agent_id,agent_name,applicant_email_address,applicant_name_kanji,applicant_name_furigana,applicant_phone_number,applicant_university,applicant_gakubu,applicant_gakka,applicant_graduation_year,applicant_postal_code,applicant_address,applicant_consultation,applicant_other_agents)
values
(1,'エージェント1','サンプルメアド1','就活1','シュウカツ1','サンプル電話番号1','サンプル大学1','サンプル学部1','サンプル学科1',2024,'サンプル郵便番号1','サンプル住所1','サンプル相談1','エージェント2,エージェント3'),
(1,'エージェント1','サンプルメアド2','就活2','シュウカツ2','サンプル電話番号2','サンプル大学2','サンプル学部2','サンプル学科2',2024,'サンプル郵便番号2','サンプル住所2','サンプル相談2','エージェント4,エージェント5'),
(1,'エージェント1','サンプルメアド3','就活3','シュウカツ3','サンプル電話番号3','サンプル大学3','サンプル学部3','サンプル学科3',2024,'サンプル郵便番号3','サンプル住所3','サンプル相談3','エージェント6,エージェント7');

drop table if exists featured_article;

create table featured_article (
  featured_article_id int AUTO_INCREMENT not null primary key,
  agent_id int not null,
  agent_name varchar(255) not null,
  questions_answers varchar(255) not null,
  last_comment varchar(255) not null,
  publish_date DATETIME default current_timestamp
);
-- 特集記事一覧テーブル上から特集記事ID、企業ID、企業名、質疑応答一覧、最後に一言、掲載日
-- 下のようにphpで書くことで質問の数が増えても対応できる
-- $test='質問1,回答1;質問2,回答2';
-- $question_answer_sets=explode(';',$test);
-- var_dump($question_answer_sets);
-- $index=0;
-- foreach($question_answer_sets as $question_answer_set){
--     ${"question_answer".$index}=explode(',',$question_answer_set);
--     echo ${"question_answer".$index}[0];
--     echo ${"question_answer".$index}[1];
--     $index++;
-- }

insert into featured_article
(agent_id,agent_name,questions_answers,last_comment)
values
(1,'エージェント1','質問1,回答1;質問2,回答2','最後に一言サンプル1'),
(2,'エージェント2','質問1,回答1;質問2,回答2;質問3,回答3','最後に一言サンプル2'),
(3,'エージェント3','質問1,回答1;質問2,回答2;質問3,回答3;質問4,回答4','最後に一言サンプル3');
