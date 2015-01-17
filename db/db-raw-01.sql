CREATE TABLE admin(
	aid int primary key auto_increment,
	email varchar(50),
	username varchar(50),
	password varchar(50)
)

CREATE TABLE university(
	uid int primary key auto_increment,
	name varchar(50),
	website varchar(50)
);

CREATE TABLE cu(
	cuid int primary key auto_increment,
	name varchar(50),
	website varchar(50),
	uid int,
	foreign key(uid) references university(uid)
);

CREATE TABLE affiliation_type(
	atid int primary key auto_increment,
	name varchar(100)
);

CREATE TABLE champion(
	cid int primary key auto_increment,
	cuid int,
	atid int,
	name varchar(50),
	gender varchar(10),
	email varchar(50),
	phone varchar(20),
	phone_alt varchar(20),
	location varchar(50),
	url varchar(100),
	url_fb varchar(100),
	url_tw varchar(100),
	foreign key (cuid) references cu(cuid),
	foreign key (atid) references affiliation_type(atid)
);

CREATE TABLE organization(
	oid int primary key auto_increment,
	name varchar(100),
	url varchar(100),
	designation varchar(50),
	date_from date,
	date_to date,
	cid int,
	foreign key (cid) references champion(cid)
);

CREATE TABLE commitment_type(
	ctid int,
	name varchar(20),
	description text
);

CREATE TABLE commitment(
	cmid int primary key auto_increment,
	cid int,
	ctid int,
	date_from date,
	date_to date,
	lifetime int
);

CREATE TABLE invite(
	iid int primary key auto_increment,
	cid_from int,
	cid_to int,
	email varchar(50),
	phone varchar(20),
	name varchar(50),
	date_time datetime,
	responded int,
	foreign key (cid_from) references champion(cid)
);

CREATE TABLE other_contribution_cat(
	occid int primary key auto_increment,
	name varchar(50),
	description text
);

CREATE TABLE other_contribution(
	ocid int primary key auto_increment,
	cid int,
	occid int,
	description text,
	foreign key(occid) references other_contribution_cat(occid),
	foreign key(cid) references champion (cid)
);

CREATE TABLE feedback(
	fid int primary key auto_increment,
	cid int,
	first_name varchar(50),
	last_name varchar(50),
	email varchar(50),
	feedback text,
	date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE `commitment_type` ADD PRIMARY KEY ( `ctid` );
ALTER TABLE `commitment_type` CHANGE `ctid` `ctid` INT( 11 ) NOT NULL AUTO_INCREMENT ;

ALTER TABLE `commitment` ADD `amount` DECIMAL NOT NULL;

ALTER TABLE `commitment` ADD `current_supporter` INT NOT NULL;

ALTER TABLE `commitment`
  ADD CONSTRAINT `commit_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `champion` (`cid`);

ALTER TABLE `champion` ADD `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `commitment` ADD `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

CREATE TABLE champion_log(
	clid int primary key auto_increment,
	type varchar(20),
	value_int int,
	value_text varchar(200),
	date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	cid int,
	foreign key(cid) references champion(cid)
);

ALTER TABLE `organization` ADD `current` INT NOT NULL ;

ALTER TABLE  `invite` ADD  `first_name` VARCHAR( 50 ) NOT NULL AFTER  `name`;

ALTER TABLE  `invite` ADD  `last_name` VARCHAR( 50 ) NOT NULL AFTER  `first_name`;

ALTER TABLE  `invite` DROP  `name` ;

ALTER TABLE  `champion` ADD  `in_cu` INT NOT NULL DEFAULT  '1';

CREATE TABLE commit_later(
	clid int primary key auto_increment,
	cid int,
	reminder_date date,
	reminded int,
	date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	foreign key(cid) references champion(cid)
);

ALTER TABLE  `focuschamps`.`commit_later` DROP INDEX  `cid` ,
ADD UNIQUE  `cid` (  `cid` );

ALTER TABLE  `focuschamps`.`commitment` DROP INDEX  `commit_ibfk_1` ,
ADD UNIQUE  `commit_ibfk_1` (  `cid` );

ALTER TABLE  `champion` ADD  `title` VARCHAR( 20 ) NOT NULL AFTER  `grad_year`;

ALTER TABLE  `champion` ADD  `marital_status` VARCHAR( 20 ) NOT NULL AFTER  `gender`;

ALTER TABLE  `commitment` ADD  `payment_mode` VARCHAR( 30 ) NOT NULL;

CREATE TABLE email_template(
	etid int primary key auto_increment,
	name varchar(20),
	html text,
	datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE email_message(
	emid int primary key auto_increment,
	name varchar(20),
	html text,
	datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE `email_message` ADD UNIQUE(`name`);

ALTER TABLE `invite` ADD `check` VARCHAR( 50 ) NOT NULL ;

ALTER TABLE `invite` ADD `cstrong` BOOLEAN NOT NULL ;

ALTER TABLE `invite` CHANGE `responded` `response_datetime` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `invite` CHANGE `date_time` `date_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `email_message` ADD `subject` VARCHAR( 200 ) NOT NULL DEFAULT 'FOCUS Champions' AFTER `name` ;

CREATE TABLE password_reset(
	prid int primary key auto_increment,
	cid int,
	date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	reset_datetime datetime,
	`check` varchar(50),
	cstrong BOOLEAN,
	foreign key(cid) references champion(cid)
);

