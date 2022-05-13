set character_set_results='utf8';
DROP SCHEMA IF EXISTS shukatsu;

CREATE SCHEMA shukatsu;

USE shukatsu;

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

INSERT INTO admin_users SET user_email = 'test@posse-ap.com', user_password = AES_ENCRYPT('root_password','ENCRYPT-KEY');
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
-- 担当者追加

DROP TABLE IF EXISTS agent_contract_information;

CREATE TABLE agent_contract_information (
  agent_branch_id int auto_increment not null primary key,
  agent_id int not null,
  agent_name varchar(255) not null,
  agent_branch varchar(255) not null,
  contract_date date not null,
  start_contract_date date not null,
  end_contract_date date not null,
  agent_phone_number varchar(255) not null,
  apply_email_address varchar(255) not null,
  agent_representative varchar(255) not null
);
-- エージェント契約情報テーブル上から企業ID、企業名、支店名、契約締結日、契約開始日、契約終了日、企業電話番号、問い合わせ通知先メールアドレス、企業代表者氏名

INSERT INTO agent_contract_information 
(agent_id,agent_name,agent_branch,contract_date,start_contract_date,end_contract_date,agent_phone_number,apply_email_address,agent_representative) 
values 
(1,'エージェント1','支店名1','2022-03-10','2022-04-30','2023-04-29','000-0000-0000','問い合わせ通知先メールアドレス1','代表者サンプル1'),
(2,'エージェント2','支店名1','2022-03-10','2022-04-30','2023-04-29','000-0000-0000','問い合わせ通知先メールアドレス2','代表者サンプル2'),
(3,'エージェント3','支店名1','2022-03-10','2022-04-30','2023-04-29','000-0000-0000','問い合わせ通知先メールアドレス3','代表者サンプル3');

drop table if exists agent_assignee_information;

create table agent_assignee_information (
  agent_branch_id int not null,
  assignee_id int not null AUTO_INCREMENT primary key,
  assignee_email_address varchar(255) not null,
  assignee_department varchar(255) not null,
  assignee_name varchar(255) not null
);
-- 担当者テーブル上から企業ID、企業名、担当者ID、担当者メールアドレス、担当者部署、担当者氏名

insert into agent_assignee_information 
(agent_branch_id,assignee_email_address,assignee_department,assignee_name) 
VALUES
(1,'担当者メールアドレス1','担当者部署1','担当者氏名1'),
(1,'担当者メールアドレス2','担当者部署2','担当者氏名2'),
(2,'担当者メールアドレス1','担当者部署1','担当者氏名1'),
(2,'担当者メールアドレス2','担当者部署2','担当者氏名2'),
(2,'担当者メールアドレス3','担当者部署3','担当者氏名3'),
(3,'担当者メールアドレス1','担当者部署1','担当者氏名1'),
(3,'担当者メールアドレス2','担当者部署2','担当者氏名2'),
(3,'担当者メールアドレス3','担当者部署3','担当者氏名3'),
(3,'担当者メールアドレス4','担当者部署4','担当者氏名4');

drop table if exists agent_public_information;

create table agent_public_information (
  agent_branch_id int AUTO_INCREMENT not null primary key,
  agent_id int not null,
  agent_name varchar(255) not null,
  agent_branch varchar(255) not null,
  agent_meeting_type int not null,
  agent_main_corporate_size int not null,
  agent_corporate_type int not null,
  agent_job_offer_rate float not null,
  agent_shortest_period int not null
);
-- 掲載情報テーブル上から企業ID、企業名、面談方式(int)phpの方で文字列に変換(対面のみ、オンライン可、オンラインのみ)、メインの企業規模(int)phpの方で文字列に変換（大手、中小、ベンチャー、総合）、外資系含むか否か(int)phpの方で文字列に変換(0,1)、内定率、内定までの最短期間（週単位)
-- 企業規模は大手中心、中小中心、ベンチャー中心、総合の4パターン


insert into agent_public_information
(agent_id,agent_name,agent_branch,agent_meeting_type,agent_main_corporate_size,agent_corporate_type,agent_job_offer_rate,agent_shortest_period)
VALUES
(3,(select agent_name from agent_contract_information where agent_branch_id=1),(select agent_branch from agent_contract_information where agent_branch_id=1),0,1,0,20.7,3),
(3,(select agent_name from agent_contract_information where agent_branch_id=2),(select agent_branch from agent_contract_information where agent_branch_id=2),1,2,1,45.8,7),
(3,(select agent_name from agent_contract_information where agent_branch_id=3),(select agent_branch from agent_contract_information where agent_branch_id=3),2,3,0,73.5,4)
;

drop table if exists agent_recommend_student_type;

create table agent_recommend_student_type(
  student_type_id int AUTO_INCREMENT primary key,
  agent_id int not null,
  student_type varchar(255) not null
);
-- ００な人におすすめ

insert into agent_recommend_student_type (agent_id,student_type)
VALUES
(1,'性格1'),
(1,'性格2'),
(1,'性格3'),
(2,'性格4'),
(2,'性格5'),
(2,'性格6'),
(2,'性格7'),
(2,'性格8'),
(3,'性格9'),
(3,'性格10'),
(3,'性格11'),
(3,'性格12');

drop table if exists agent_corporate_amount;

create table agent_corporate_amount(
  agent_id int AUTO_INCREMENT not null primary key,
  manufacturer int,
  retail int,
  service int,
  software_transmission int,
  trading int,
  finance int,
  media int,
  government int
);
-- 業界8種類メーカー、小売り、サービス、ソフトウェア・通信、商社、金融、マスコミ、官公庁・公社・団体の英訳をカラムにする全部int
-- 同じエージェント内で共有
insert into agent_corporate_amount 
(manufacturer,retail,service,software_transmission,trading,finance,media,government)
values
(1,2,3,4,5,6,7,8),
(2,3,4,5,6,7,8,9),
(3,4,5,6,7,8,9,10)
;

drop table if exists agent_explanation;

create table agent_explanation(
  agent_branch_id int AUTO_INCREMENT not null primary key,
  agent_explanation text not null
);

insert into agent_explanation
(agent_explanation)
values
('gしょいあgsはｇしゅｇｒしゅｇさはｇｒそぐぁｒふｇらふｇらふぐぁ'),
('あｆふふぁひうあｈふぁｈ'),
('あｆふふぁひうあｈふぁｈあふぇはいうえひうｆ」'),
('あｆふふぁひうあｈふぁｈふぇふふぁおひあうひぐえｇ'),
('あｆふふぁひうあｈふぁｈふぇあえふいあっひうｒふいはういｈふぇあういｈふぅｈ');


drop table if exists agent_address;

create table agent_address(
  agent_branch_id int not null primary key auto_increment,
  agent_name varchar(255) not null,
  agent_branch varchar(255) not null,
  agent_area varchar(255) not null,
  agent_prefecture varchar(255) not null,
  agent_postal_code varchar(255) not null,
  agent_address varchar(255) not null
);
-- エージェント住所テーブル上から企業ID、企業名、企業地方、企業都道府県、企業郵便番号、企業住所 

insert into agent_address (agent_name,agent_branch,agent_area,agent_prefecture,agent_postal_code,agent_address) values 
((select agent_name from agent_contract_information where agent_branch_id=1),(select agent_branch from agent_contract_information where agent_branch_id=1),'関東','神奈川','郵便番号サンプル1','住所サンプル1'),
((select agent_name from agent_contract_information where agent_branch_id=2),(select agent_branch from agent_contract_information where agent_branch_id=2),'関東','群馬','郵便番号サンプル2','住所サンプル2'),
((select agent_name from agent_contract_information where agent_branch_id=3),(select agent_branch from agent_contract_information where agent_branch_id=3),'北海道','北海道','郵便番号サンプル3','住所サンプル3')
;
drop table if exists admin_agent_list;

create table admin_agent_list (
  agent_branch_id int AUTO_INCREMENT not null primary key,
  agent_name varchar(255) not null,
  agent_branch varchar(255) not null,
  start_contract date not null,
  apply_amount int not null default 0,
  featured_article_bool boolean not null default false,
  bool_updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- 管理者画面のエージェント一覧
-- 上から企業ID、企業名、問い合わせ数、特集記事ステータス、特集記事掲載ステータス定期更新用の時間(phpで管理者画面アクセス時に時間取得して一年？半年？たってたらboolをupdateする)

insert into admin_agent_list 
(agent_name,agent_branch,start_contract) 
VALUES
((select agent_name from agent_contract_information where agent_branch_id=1),(select agent_branch from agent_contract_information where agent_branch_id=1),(select start_contract_date from agent_contract_information where agent_branch_id=1)),
((select agent_name from agent_contract_information where agent_branch_id=2),(select agent_branch from agent_contract_information where agent_branch_id=2),(select start_contract_date from agent_contract_information where agent_branch_id=2)),
((select agent_name from agent_contract_information where agent_branch_id=3),(select agent_branch from agent_contract_information where agent_branch_id=3),(select start_contract_date from agent_contract_information where agent_branch_id=3));
-- 問い合わせ来たらupdate admin_agent_list set apply_amount=apply_amount+1 where agent_branch_id=?で問い合わせ数を増やせる

drop table if exists apply_list;

create table apply_list(
  apply_id int auto_increment not null primary key,
  agent_branch_id int not null,
  agent_name varchar(255) not null,
  agent_branch varchar(255) not null,
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
  applicant_report_status boolean default false
);
-- 申込一覧テーブル上から申込ID、企業ID、企業名、申込日時、申込者の=>メールアドレス、漢字の名前、フリガナ、電話番号、大学、学部、学科、何年卒、郵便番号、住所、相談内容、同時応募エージェント、通報ステータス
insert into apply_list
(agent_branch_id,agent_name,agent_branch,apply_time,applicant_email_address,applicant_name_kanji,applicant_name_furigana,applicant_phone_number,applicant_university,applicant_gakubu,applicant_gakka,applicant_graduation_year,applicant_postal_code,applicant_address,applicant_consultation,applicant_other_agents)
values
(1,'エージェント1','支店名1','2022-05-13 01:00:12','サンプルメアド1','就活1','シュウカツ1','サンプル電話番号1','サンプル大学1','サンプル学部1','サンプル学科1',2024,'サンプル郵便番号1','サンプル住所1','サンプル相談1','エージェント2,エージェント3'),
(2,'エージェント1','支店名2','2022-05-14 01:00:12','サンプルメアド2','就活2','シュウカツ2','サンプル電話番号2','サンプル大学2','サンプル学部2','サンプル学科2',2024,'サンプル郵便番号2','サンプル住所2','サンプル相談2','エージェント4,エージェント5'),
(3,'エージェント1','支店名3','2022-05-14 01:00:12','サンプルメアド3','就活3','シュウカツ3','サンプル電話番号3','サンプル大学3','サンプル学部3','サンプル学科3',2024,'サンプル郵便番号3','サンプル住所3','サンプル相談3','エージェント6,エージェント7'),
(3,'エージェント1','支店名3','2022-05-15 01:00:12','サンプルメアド4','就活4','シュウカツ4','サンプル電話番号4','サンプル大学4','サンプル学部4','サンプル学科4',2024,'サンプル郵便番号4','サンプル住所4','','エージェント6,エージェント7'),
(3,'エージェント1','支店名3','2022-05-16 01:00:12','サンプルメアド5','就活5','シュウカツ5','サンプル電話番号5','サンプル大学5','サンプル学部5','サンプル学科5',2024,'サンプル郵便番号5','サンプル住所5','サンプル相談5','エージェント6,エージェント7'),
(3,'エージェント1','支店名3','2022-05-15 01:00:12','サンプルメアド6','就活6','シュウカツ6','サンプル電話番号6','サンプル大学6','サンプル学部6','サンプル学科6',2024,'サンプル郵便番号6','サンプル住所6','サンプル相談6','エージェント6,エージェント7'),
(3,'エージェント1','支店名3','2022-06-01 01:00:12','サンプルメアド7','就活7','シュウカツ7','サンプル電話番号7','サンプル大学7','サンプル学部7','サンプル学科7',2024,'サンプル郵便番号7','サンプル住所7','','エージェント6,エージェント7')
;

drop table if exists featured_article;

create table featured_article (
  featured_article_id int AUTO_INCREMENT not null primary key,
  agent_branch_id int not null,
  agent_name varchar(255) not null,
  agent_branch varchar(255) not null,
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
(agent_branch_id,agent_name,agent_branch,questions_answers,last_comment)
values
(1,(select agent_name from agent_contract_information where agent_branch_id=1),(select agent_branch from agent_contract_information where agent_branch_id=1),'質問1,回答1;質問2,回答2','最後に一言サンプル1'),
(2,(select agent_name from agent_contract_information where agent_branch_id=2),(select agent_branch from agent_contract_information where agent_branch_id=2),'質問1,回答1;質問2,回答2;質問3,回答3','最後に一言サンプル2'),
(3,(select agent_name from agent_contract_information where agent_branch_id=3),(select agent_branch from agent_contract_information where agent_branch_id=3),'質問1,回答1;質問2,回答2;質問3,回答3;質問4,回答4','最後に一言サンプル3');

drop table if exists mailing_list;

create table mailing_list(
  mail_id int not null AUTO_INCREMENT primary key,
  agent_branch_id int not null,
  agent_name varchar(255) not null,
  agent_branch varchar(255) not null,
  mail_address VARCHAR(255) not null 
);
-- メールID、エージェントID、エージェント名、特殊記事招待通知先メールアドレス

insert into mailing_list
(agent_branch_id,agent_name,agent_branch,mail_address)
values 
(1,'エージェント1','支店名1','サンプルメアド1'),
(1,'エージェント1','支店名2','サンプルメアド2'),
(2,'エージェント2','支店名1','サンプルメアド3');
