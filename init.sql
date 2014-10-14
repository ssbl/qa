CREATE DATABASE qa;
USE qa;
/* copy-pasta */
create table category ( name CHAR(50) NOT NULL, likes INT DEFAULT 0, views INT DEFAULT 0, PRIMARY KEY (name) );
create table user ( UserId INT NOT NULL auto_increment, Password CHAR(20), Email char(20), primary key(UserId) );
create table questions ( 
	qid int not null auto_increment primary key,
	name char(50) not null,
	qtext char(100) not null,
	qdescription text,
	UserId int not null,
	upvotes int default 0,
	foreign key category_name (name) references category (name),
	foreign key userID (UserId) references user (UserId)
);
create table answers (
       answer_id int not null auto_increment primary key,
       answer_text text,
       name char(50) not null,
       qtext char(100) not null,
       UserId int not null,
       foreign key category_name (name) references category (name),
       qid int, foreign key question_id (qid) references questions (qid),
       foreign key userID (UserId) references user (UserId)
);
/* now run populate.sql */
