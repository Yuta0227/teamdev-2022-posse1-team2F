drop user if exists boozer;
create user 'boozer'@'%' identified by 'password';
grant all privileges on * . * to 'boozer'@'%';
