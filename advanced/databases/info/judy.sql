set names utf8;

create database `judy`;

use `judy`;

drop table if exists `class`;
create table `class1`(
	`id` int(11) unsigned not null auto_increment primary key,
	`name` varchar(255) not null,
	`pid` int(3) not null default 0,
	`orderid` int(11) not null default 0
)engine=myisam default charset=utf8 collate=utf8_general_ci;

drop table if exists `content`;
create table `content`(
	`id` int(11) unsigned not null auto_increment primary key,
	`name` varchar(255) not null,
	`content` text,
	`pid` int(3) not null default 0,
	`orderid` int(11) not null default 0
)engine=myisam default charset=utf8 collate=utf8_general_ci;