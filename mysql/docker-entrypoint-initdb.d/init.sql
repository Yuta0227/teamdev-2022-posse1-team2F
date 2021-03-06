set character_set_results='utf8';
DROP SCHEMA IF EXISTS shukatsu;

CREATE SCHEMA shukatsu;

USE shukatsu;

drop table if exists help_email;

create table help_email(
  email_id int AUTO_INCREMENT primary KEY,
  email varchar(255)
);

insert into help_email (email)
values 
('help@gmail.com');

drop table if exists send_notice_mail;

create table send_notice_mail(
  email_id int AUTO_INCREMENT primary key,
  email_address varchar(255)
);

insert into send_notice_mail(email_address)
VALUES
('send_notice_mail@gmail.com');

DROP TABLE IF EXISTS admin_users;

CREATE TABLE admin_users (
  user_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  user_email VARCHAR(255) UNIQUE NOT NULL,
  user_password varbinary(200) NOT NULL,
  user_login_bool boolean not null default false,
  user_created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  user_logged_in_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- 管理者のログイン情報テーブル上からユーザーID、ユーザーメールアドレス、ユーザーパスワード、ユーザー作成時刻、ユーザー最終ログイン時刻

INSERT INTO admin_users SET user_email = 'test1@posse-ap.com', user_password = AES_ENCRYPT('root_password1','ENCRYPT-KEY');
INSERT INTO admin_users SET user_email = 'test2@posse-ap.com', user_password = AES_ENCRYPT('root_password2','ENCRYPT-KEY');
-- 管理者追加

drop table if exists agent_users;

CREATE TABLE agent_users (
  user_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  user_email VARCHAR(255) UNIQUE NOT NULL,
  user_password varbinary(200) NOT NULL,
  user_login_bool boolean not null default false,
  user_created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  user_logged_in_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- エージェント担当者のログイン情報テーブル上からユーザーID、ユーザーメールアドレス、ユーザーパスワード、ユーザー作成時刻、ユーザー最終ログイン時刻

insert into agent_users set user_email = 'assignee1@posse-ap.com',user_password = AES_ENCRYPT('assignee_password1','ENCRYPT-KEY');
insert into agent_users set user_email = 'assignee2@posse-ap.com',user_password = AES_ENCRYPT('assignee_password2','ENCRYPT-KEY');
insert into agent_users set user_email = 'assignee3@posse-ap.com',user_password = AES_ENCRYPT('assignee_password3','ENCRYPT-KEY');
insert into agent_users set user_email = 'assignee4@posse-ap.com',user_password = AES_ENCRYPT('assignee_password4','ENCRYPT-KEY');
insert into agent_users set user_email = 'assignee5@posse-ap.com',user_password = AES_ENCRYPT('assignee_password5','ENCRYPT-KEY');
insert into agent_users set user_email = 'assignee6@posse-ap.com',user_password = AES_ENCRYPT('assignee_password6','ENCRYPT-KEY');
insert into agent_users set user_email = 'assignee7@posse-ap.com',user_password = AES_ENCRYPT('assignee_password7','ENCRYPT-KEY');
insert into agent_users set user_email = 'assignee8@posse-ap.com',user_password = AES_ENCRYPT('assignee_password8','ENCRYPT-KEY');
insert into agent_users set user_email = 'assignee9@posse-ap.com',user_password = AES_ENCRYPT('assignee_password9','ENCRYPT-KEY');
-- 担当者追加

DROP TABLE IF EXISTS agent_contract_information;

CREATE TABLE agent_contract_information (
  agent_id int not null auto_increment primary key,
  agent_name varchar(255) not null,
  contract_date date not null,
  start_contract_date date not null,
  end_contract_date date not null,
  contract_address varchar(255) not null,
  agent_phone_number varchar(255) not null,
  apply_email_address varchar(255) not null,
  agent_representative varchar(255) not null
);
-- エージェント契約情報テーブル上から企業ID、企業名、支店名、契約締結日、契約開始日、契約終了日、企業電話番号、問い合わせ通知先メールアドレス、企業代表者氏名

INSERT INTO agent_contract_information 
(agent_name,contract_date,start_contract_date,end_contract_date,contract_address,agent_phone_number,apply_email_address,agent_representative) 
values 
('エージェント1','2022-03-10','2022-04-30','2023-04-29','本社住所1','000-0001-0000','問い合わせ通知先メールアドレス1','代表者サンプル1'),
('エージェント2','2022-03-10','2022-04-30','2023-04-29','本社住所2','000-0002-0000','問い合わせ通知先メールアドレス2','代表者サンプル2'),
('エージェント3','2022-03-10','2022-04-30','2023-04-29','本社住所3','000-0003-0000','問い合わせ通知先メールアドレス3','代表者サンプル3'),
('エージェント4','2022-03-10','2022-04-30','2023-04-29','本社住所4','000-0004-0000','問い合わせ通知先メールアドレス4','代表者サンプル4'),
('エージェント5','2022-03-10','2022-04-30','2023-04-29','本社住所5','000-0005-0000','問い合わせ通知先メールアドレス5','代表者サンプル5');

drop table if exists agent_corporate_amount;

create table agent_corporate_amount(
  agent_id int AUTO_INCREMENT not null primary key,
  manufacturer int unsigned,
  retail int unsigned,
  service int unsigned,
  software_transmission int unsigned,
  trading int unsigned,
  finance int unsigned,
  media int unsigned,
  government int unsigned
);
-- 業界8種類メーカー、小売り、サービス、ソフトウェア・通信、商社、金融、マスコミ、官公庁・公社・団体の英訳をカラムにする全部int
-- 同じエージェント内で共有
insert into agent_corporate_amount 
(manufacturer,retail,service,software_transmission,trading,finance,media,government)
values
(1,2,3,4,0,6,7,8),
(2,3,0,5,6,7,8,9),
(3,4,5,0,7,8,9,10),
(0,0,0,0,0,32,0,0),
(34,11,22,0,34,42,48,10)
;

drop table if exists agent_explanation;

create table agent_explanation(
  agent_id int AUTO_INCREMENT not null primary key,
  agent_explanation text not null
);

insert into agent_explanation
(agent_explanation)
values
('<space>エージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータ\n<space>エージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータ\n<space>エージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータエージェント1説明文ダミーデータ'),
('<space>エージェント2説明文ダミーデータエージェント2説明文ダミーデータエージェント2説明文ダミーデータエージェント2説明文ダミーデータエージェント2説明文ダミーデータエージェント2説明文ダミーデータ\n<space>エージェント2説明文ダミーデータ\n<space>エージェント2説明文ダミーデータ'),
('<space>エージェント3説明文ダミーデータ\n<space>エージェント3説明文ダミーデータエージェント3説明文ダミーデータエージェント3説明文ダミーデータ\n<space>エージェント3説明文ダミーデータ'),
('<space>エージェント4説明文ダミーデータ\n<space>エージェント4説明文ダミーデータエージェント4説明文ダミーデータエージェント4説明文ダミーデータエージェント4説明文ダミーデータ\n<space>エージェント4説明文ダミーデータ'),
('<space>エージェント5説明文ダミーデータ\n<space>エージェント5説明文ダミーデータエージェント5説明文ダミーデータエージェント5説明文ダミーデータエージェント5説明文ダミーデータ\n<space>エージェント5説明文ダミーデータ');





drop table if exists apply_list;

create table apply_list(
  apply_id int auto_increment not null primary key,
  agent_id int not null,
  agent_name varchar(255) not null,
  apply_time DATETIME,
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
  apply_report_status boolean default false,
  apply_new_status boolean default true,
  apply_report_deadline datetime
);
-- 申込一覧テーブル上から申込ID、企業ID、企業名、申込日時、申込者の=>メールアドレス、漢字の名前、フリガナ、電話番号、大学、学部、学科、何年卒、郵便番号、住所、相談内容、同時応募エージェント、通報ステータス
insert into apply_list
(agent_id,agent_name,apply_time,applicant_email_address,applicant_name_kanji,applicant_name_furigana,applicant_phone_number,applicant_university,applicant_gakubu,applicant_gakka,applicant_graduation_year,applicant_postal_code,applicant_address,applicant_consultation,applicant_other_agents,apply_report_deadline)
values
(1,'エージェント1','2022-04-13 01:00:12','user1@gmail.com','就活1','シュウカツ1','00000000001','サンプル大学1','サンプル学部1','サンプル学科1',2024,'サンプル郵便番号1','サンプル住所1','サンプル相談1','エージェント1,エージェント2,エージェント3','2022-05-01 23:59:59'),
(2,'エージェント2','2022-05-13 01:00:12','user1@gmail.com','就活1','シュウカツ1','00000000001','サンプル大学1','サンプル学部1','サンプル学科1',2024,'サンプル郵便番号1','サンプル住所1','サンプル相談2','エージェント1,エージェント2,エージェント3','2022-06-01 23:59:59'),
(3,'エージェント3','2022-05-13 01:00:12','user1@gmail.com','就活1','シュウカツ1','00000000001','サンプル大学1','サンプル学部1','サンプル学科1',2024,'サンプル郵便番号1','サンプル住所1','サンプル相談3','エージェント1,エージェント2,エージェント3','2022-06-01 23:59:59'),
(4,'エージェント4','2022-05-14 01:00:12','user2@gmail.com','就活2','シュウカツ2','00000000002','サンプル大学2','サンプル学部2','サンプル学科2',2024,'サンプル郵便番号2','サンプル住所2','サンプル相談4','エージェント4,エージェント5','2022-06-01 23:59:59'),
(5,'エージェント5','2022-05-14 01:00:12','user2@gmail.com','就活2','シュウカツ2','00000000002','サンプル大学2','サンプル学部2','サンプル学科2',2024,'サンプル郵便番号2','サンプル住所2','サンプル相談5','エージェント4,エージェント5','2022-06-01 23:59:59'),
(3,'エージェント3','2022-05-14 01:00:12','user3@gmail.com','就活3','シュウカツ3','00000000003','サンプル大学3','サンプル学部3','サンプル学科3',2024,'サンプル郵便番号3','サンプル住所3','サンプル相談3','エージェント3,エージェント4','2022-06-01 23:59:59'),
(4,'エージェント4','2022-05-14 01:00:12','user3@gmail.com','就活3','シュウカツ3','00000000003','サンプル大学3','サンプル学部3','サンプル学科3',2024,'サンプル郵便番号3','サンプル住所3','サンプル相談4','エージェント3,エージェント4','2022-06-01 23:59:59'),
(2,'エージェント2','2022-05-15 01:00:12','user4@gmail.com','就活4','シュウカツ4','00000000004','サンプル大学4','サンプル学部4','サンプル学科4',2024,'サンプル郵便番号4','サンプル住所4','','エージェント2,エージェント4','2022-06-01 23:59:59'),
(4,'エージェント4','2022-05-15 01:00:12','user4@gmail.com','就活4','シュウカツ4','00000000004','サンプル大学4','サンプル学部4','サンプル学科4',2024,'サンプル郵便番号4','サンプル住所4','','エージェント2,エージェント4','2022-06-01 23:59:59'),
(1,'エージェント1','2022-05-16 01:00:12','user5@gmail.com','就活5','シュウカツ5','00000000005','サンプル大学5','サンプル学部5','サンプル学科5',2024,'サンプル郵便番号5','サンプル住所5','サンプル相談1','エージェント1,エージェント5','2022-06-01 23:59:59'),
(5,'エージェント5','2022-05-16 01:00:12','user5@gmail.com','就活5','シュウカツ5','00000000005','サンプル大学5','サンプル学部5','サンプル学科5',2024,'サンプル郵便番号5','サンプル住所5','サンプル相談5','エージェント1,エージェント5','2022-06-01 23:59:59'),
(2,'エージェント2','2022-05-15 01:00:12','user6@gmail.com','就活6','シュウカツ6','00000000006','サンプル大学6','サンプル学部6','サンプル学科6',2024,'サンプル郵便番号6','サンプル住所6','サンプル相談2','エージェント2,エージェント3','2022-06-01 23:59:59'),
(3,'エージェント3','2022-05-15 01:00:12','user6@gmail.com','就活6','シュウカツ6','00000000006','サンプル大学6','サンプル学部6','サンプル学科6',2024,'サンプル郵便番号6','サンプル住所6','サンプル相談3','エージェント2,エージェント3','2022-06-01 23:59:59'),
(2,'エージェント2','2022-06-01 01:00:12','user7@gmail.com','就活7','シュウカツ7','00000000007','サンプル大学7','サンプル学部7','サンプル学科7',2024,'サンプル郵便番号7','サンプル住所7','','エージェント2,エージェント5','2022-07-01 23:59:59'),
(5,'エージェント5','2022-06-01 01:00:12','user7@gmail.com','就活7','シュウカツ7','00000000007','サンプル大学7','サンプル学部7','サンプル学科7',2024,'サンプル郵便番号7','サンプル住所7','','エージェント2,エージェント5','2022-07-01 23:59:59');

drop table if exists admin_agent_list;

create table admin_agent_list (
  agent_id int AUTO_INCREMENT not null primary key,
  agent_name varchar(255) not null,
  start_contract date not null,
  apply_amount int not null default 0,
  featured_article_bool boolean not null default false,
  bool_updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- 管理者画面のエージェント一覧
-- 上から企業ID、企業名、問い合わせ数、特集記事ステータス、特集記事掲載ステータス定期更新用の時間(phpで管理者画面アクセス時に時間取得して一年？半年？たってたらboolをupdateする)

insert into admin_agent_list 
(agent_name,start_contract,apply_amount,featured_article_bool) 
VALUES
((select agent_name from agent_contract_information where agent_id=1),(select start_contract_date from agent_contract_information where agent_id=1),(select count(apply_id) from apply_list where agent_id=1),true),
((select agent_name from agent_contract_information where agent_id=2),(select start_contract_date from agent_contract_information where agent_id=2),(select count(apply_id) from apply_list where agent_id=2),true),
((select agent_name from agent_contract_information where agent_id=3),(select start_contract_date from agent_contract_information where agent_id=3),(select count(apply_id) from apply_list where agent_id=3),true),
((select agent_name from agent_contract_information where agent_id=4),(select start_contract_date from agent_contract_information where agent_id=4),(select count(apply_id) from apply_list where agent_id=4),false),
((select agent_name from agent_contract_information where agent_id=5),(select start_contract_date from agent_contract_information where agent_id=5),(select count(apply_id) from apply_list where agent_id=5),false);
-- 問い合わせ来たらupdate admin_agent_list set apply_amount=apply_amount+1 where agent_id=?で問い合わせ数を増やせる

drop table if exists featured_article;

create table featured_article (
  featured_article_id int AUTO_INCREMENT not null primary key,
  picture varchar(255),
  title varchar(255),
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
(picture,title,agent_id,agent_name,questions_answers,last_comment,publish_date)
values
('picture1.png','エージェント1の魅力を担当者に聞いてみた',1,(select agent_name from agent_contract_information where agent_id=1),'Q1:あなたのエージェントの一番の特徴はなんですか？,私たちのエージェントの一番の特徴は学生との距離が近いということです。就活生の皆さんの不安に寄り添い、担当者と一緒に就活を進めていくことができます。;Q2:就活生にはどのようなサポートが行われますか？,私たちのエージェントでは主に企業のあっせん、面接のアポイントメント、面接練習等を行っています。就活生からの要望があれば他にも様々なサービスを提供することができます。','私たちのエージェントは学生の皆さんに寄り添った就活をできることが一番の魅力になっています。ぜひ私たちのエージェントと一緒に就活を進め、納得のいく内定を勝ち取りましょう！！ダミーデータ1','2022-05-23 10:23:46'),
('picture2.png','エージェント2の魅力を担当者に聞いてみた',2,(select agent_name from agent_contract_information where agent_id=2),'Q1:あなたのエージェントの一番の特徴はなんですか？,回答ダミーデータ2;質問ダミーデータ2,回答ダミーデータ2;質問ダミーデータ3,回答ダミーデータ3','最後に一言ダミーデータ2','2022-07-23 10:23:46'),
('picture3.png','エージェント3の魅力を担当者に聞いてみた',3,(select agent_name from agent_contract_information where agent_id=3),'Q1:あなたのエージェントの一番の特徴はなんですか？,回答ダミーデータ3;質問ダミーデータ2,回答ダミーデータ2;質問ダミーデータ3,回答ダミーデータ3;質問ダミーデータ4,回答ダミーデータ4','最後に一言ダミーデータ3','2022-09-23 10:23:46');



drop table if exists agent_assignee_information;

create table agent_assignee_information (
  user_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_id int not null,
  agent_name varchar(255) not null,
  agent_branch varchar(255) not null,    
  assignee_email_address varchar(255) not null,
  assignee_name varchar(255) not null
);
-- 担当者テーブル上から企業ID、企業名、担当者ID、担当者メールアドレス、担当者支店、担当者氏名

insert into agent_assignee_information 
(agent_id,agent_name,agent_branch,assignee_email_address,assignee_name) 
VALUES
(1,(select agent_name from agent_contract_information where agent_id=1),'支店1',(select user_email from agent_users where user_id=1),'氏名1'),
(1,(select agent_name from agent_contract_information where agent_id=1),'支店2',(select user_email from agent_users where user_id=2),'氏名2'),
(2,(select agent_name from agent_contract_information where agent_id=2),'支店1',(select user_email from agent_users where user_id=3),'氏名3'),
(2,(select agent_name from agent_contract_information where agent_id=2),'支店2',(select user_email from agent_users where user_id=4),'氏名4'),
(2,(select agent_name from agent_contract_information where agent_id=2),'支店3',(select user_email from agent_users where user_id=5),'氏名5'),
(3,(select agent_name from agent_contract_information where agent_id=3),'支店1',(select user_email from agent_users where user_id=6),'氏名6'),
(3,(select agent_name from agent_contract_information where agent_id=3),'支店2',(select user_email from agent_users where user_id=7),'氏名7'),
(4,(select agent_name from agent_contract_information where agent_id=4),'支店1',(select user_email from agent_users where user_id=8),'氏名8'),
(5,(select agent_name from agent_contract_information where agent_id=5),'支店1',(select user_email from agent_users where user_id=9),'氏名9');


drop table if exists filter_prefecture;

create table filter_prefecture(
  prefecture_id int AUTO_INCREMENT not null primary key,
  prefecture_name varchar(255) not null,
  area_id int not null,
  area_name varchar(255) not null
);

insert into filter_prefecture (prefecture_name,area_id,area_name)
VALUES
('北海道',1,'北海道'),('青森県',2,'東北'),('岩手県',2,'東北'),('宮城県',2,'東北'),('秋田県',2,'東北'),('山形県',2,'東北'),('福島県',2,'東北'),('茨城県',3,'関東'),('栃木県',3,'関東'),('群馬県',3,'関東'),('埼玉県',3,'関東'),('千葉県',3,'関東'),('東京都',3,'関東'),('神奈川県',3,'関東'),('新潟県',4,'中部'),('富山県',4,'中部'),('石川県',4,'中部'),('福井県',4,'中部'),('山梨県',4,'中部'),('長野県',4,'中部'),('岐阜県',4,'中部'),('静岡県',4,'中部'),('愛知県',4,'中部'),('三重県',5,'近畿'),('滋賀県',5,'近畿'),('京都府',5,'近畿'),('大阪府',5,'近畿'),('兵庫県',5,'近畿'),('奈良県',5,'近畿'),('和歌山県',5,'近畿'),('鳥取県',6,'中国'),('島根県',6,'中国'),('岡山県',6,'中国'),('広島県',6,'中国'),('山口県',6,'中国'),('徳島県',7,'四国'),('香川県',7,'四国'),('愛媛県',7,'四国'),('高知県',7,'四国'),('福岡県',8,'九州沖縄'),('佐賀県',8,'九州沖縄'),('長崎県',8,'九州沖縄'),('熊本県',8,'九州沖縄'),('大分県',8,'九州沖縄'),('宮崎県',8,'九州沖縄'),('鹿児島県',8,'九州沖縄'),('沖縄県',8,'九州沖縄');

drop table if exists filter_meeting;

create table filter_meeting(
  meeting_id int AUTO_INCREMENT not null primary key,
  meeting_type varchar(255) not null
);

insert into filter_meeting(meeting_type)
VALUES
('対面のみ'),('オンライン可'),('オンラインのみ');

drop table if exists filter_corporate_size;

create table filter_corporate_size(
  corporate_size_id int AUTO_INCREMENT primary key not null,
  corporate_size varchar(255) not null
);

insert into filter_corporate_size(corporate_size)
VALUES
('大手'),('中小'),('ベンチャー'),('総合');

drop table if exists filter_student_type;

create table filter_student_type(
  student_type_id int AUTO_INCREMENT not null primary key,
  student_type varchar(255) not null 
);

insert into filter_student_type (student_type)
VALUES
('理系'),('文系');

drop table if exists filter_corporate_type;

create table filter_corporate_type(
  corporate_type_id int AUTO_INCREMENT not null primary key,
  corporate_type varchar(255) not null
);

insert into filter_corporate_type(corporate_type)
VALUES
('外資系含む'),('外資系含まない');

drop table if exists picture;

create table picture(
  picture_url varchar(255),
  agent_id int AUTO_INCREMENT primary key,
  agent_name varchar(255)
);

insert into picture(picture_url,agent_name)
VALUES
('picture1.png',(select agent_name from agent_contract_information where agent_id=1)),
('picture2.png',(select agent_name from agent_contract_information where agent_id=2)),
('picture3.png',(select agent_name from agent_contract_information where agent_id=3)),
('picture4.png',(select agent_name from agent_contract_information where agent_id=4)),
('picture5.png',(select agent_name from agent_contract_information where agent_id=5));

drop table if exists agent_address;

create table agent_address(
  branch_id int AUTO_INCREMENT primary key,
  prefecture_id int not null,
  agent_id int not null,
  agent_area varchar(255) not null,
  agent_prefecture varchar(255) not null
);
-- エージェント住所テーブル上から企業ID、企業名、企業地方、企業都道府県、企業郵便番号、企業住所 

insert into agent_address (prefecture_id,agent_id,agent_area,agent_prefecture) values 
(30,1,(select area_name from filter_prefecture where prefecture_id=30),(select prefecture_name from filter_prefecture where prefecture_id=30)),
(44,1,(select area_name from filter_prefecture where prefecture_id=44),(select prefecture_name from filter_prefecture where prefecture_id=44)),
(1,1,(select area_name from filter_prefecture where prefecture_id=1),(select prefecture_name from filter_prefecture where prefecture_id=1)),
(2,1,(select area_name from filter_prefecture where prefecture_id=2),(select prefecture_name from filter_prefecture where prefecture_id=2)),
(4,1,(select area_name from filter_prefecture where prefecture_id=4),(select prefecture_name from filter_prefecture where prefecture_id=4)),
(5,1,(select area_name from filter_prefecture where prefecture_id=5),(select prefecture_name from filter_prefecture where prefecture_id=5)),
(6,1,(select area_name from filter_prefecture where prefecture_id=6),(select prefecture_name from filter_prefecture where prefecture_id=6)),
(7,1,(select area_name from filter_prefecture where prefecture_id=7),(select prefecture_name from filter_prefecture where prefecture_id=7)),
(8,1,(select area_name from filter_prefecture where prefecture_id=8),(select prefecture_name from filter_prefecture where prefecture_id=8)),
(3,2,(select area_name from filter_prefecture where prefecture_id=3),(select prefecture_name from filter_prefecture where prefecture_id=3)),
(26,2,(select area_name from filter_prefecture where prefecture_id=26),(select prefecture_name from filter_prefecture where prefecture_id=26)),
(46,2,(select area_name from filter_prefecture where prefecture_id=46),(select prefecture_name from filter_prefecture where prefecture_id=46)),
(33,2,(select area_name from filter_prefecture where prefecture_id=33),(select prefecture_name from filter_prefecture where prefecture_id=33)),
(16,2,(select area_name from filter_prefecture where prefecture_id=16),(select prefecture_name from filter_prefecture where prefecture_id=16)),
(24,2,(select area_name from filter_prefecture where prefecture_id=24),(select prefecture_name from filter_prefecture where prefecture_id=24)),
(18,2,(select area_name from filter_prefecture where prefecture_id=18),(select prefecture_name from filter_prefecture where prefecture_id=18)),
(41,2,(select area_name from filter_prefecture where prefecture_id=41),(select prefecture_name from filter_prefecture where prefecture_id=41)),
(11,2,(select area_name from filter_prefecture where prefecture_id=11),(select prefecture_name from filter_prefecture where prefecture_id=11)),
(13,2,(select area_name from filter_prefecture where prefecture_id=13),(select prefecture_name from filter_prefecture where prefecture_id=13)),
(29,2,(select area_name from filter_prefecture where prefecture_id=29),(select prefecture_name from filter_prefecture where prefecture_id=29)),
(30,2,(select area_name from filter_prefecture where prefecture_id=30),(select prefecture_name from filter_prefecture where prefecture_id=30)),
(23,3,(select area_name from filter_prefecture where prefecture_id=23),(select prefecture_name from filter_prefecture where prefecture_id=23)),
(42,4,(select area_name from filter_prefecture where prefecture_id=42),(select prefecture_name from filter_prefecture where prefecture_id=42)),
(13,5,(select area_name from filter_prefecture where prefecture_id=13),(select prefecture_name from filter_prefecture where prefecture_id=13))
;

drop table if exists delete_request;

create table delete_request(
  apply_id int primary key,
  apply_email varchar(255),
  agent_id int,
  request_reason text,
  assignee_email varchar(255),
  approve_status boolean default false,
  check_status boolean default false
);

drop table if exists header;

create table sales_copy(
  agent_id int primary key auto_increment,
  sales_copy varchar(255)
);

insert into sales_copy(sales_copy)
VALUES
('プロの情報で着実な一歩を'),
('さよなら、やみくも就活'),
('プロと始める「逆転就活」'),
('就活は専任アドバイザーと。\n一緒に見つけよう、働きたい会社を'),
('あなたの可能性は\nあなたが思うよりもずっと大きい');


drop table if exists agent_public_information;

create table agent_public_information (
  agent_id int not null auto_increment primary key,
  agent_name varchar(255) not null,
  agent_meeting_type int not null,
  agent_main_corporate_size int not null,
  agent_corporate_type int not null,
  agent_job_offer_rate float not null,
  agent_shortest_period int not null,
  agent_recommend_student_type int not null
);
-- 掲載情報テーブル上から企業ID、企業名、面談方式(int)phpの方で文字列に変換(対面のみ、オンライン可、オンラインのみ)、メインの企業規模(int)phpの方で文字列に変換（大手、中小、ベンチャー、総合）、外資系含むか否か(int)phpの方で文字列に変換(0,1)、内定率、内定までの最短期間（週単位)
-- 企業規模は大手中心、中小中心、ベンチャー中心、総合の4パターン


insert into agent_public_information
(agent_name,agent_meeting_type,agent_main_corporate_size,agent_corporate_type,agent_job_offer_rate,agent_shortest_period,agent_recommend_student_type)
VALUES
((select agent_name from agent_contract_information where agent_id=1),0,1,0,20.7,3,0),
((select agent_name from agent_contract_information where agent_id=2),1,2,1,45.8,7,1),
((select agent_name from agent_contract_information where agent_id=3),2,3,0,73.5,4,0),
((select agent_name from agent_contract_information where agent_id=4),1,0,1,92.5,5,0),
((select agent_name from agent_contract_information where agent_id=5),2,2,0,50.4,6,1);

drop table if exists apply_notice_email;

create table apply_notice_email(
  agent_id int AUTO_INCREMENT primary key,
  email_address varchar(255)
);

insert into apply_notice_email(email_address)
VALUES
('apply1@gmail.com'),
('apply2@gmail.com'),
('apply3@gmail.com'),
('apply4@gmail.com'),
('apply5@gmail.com');