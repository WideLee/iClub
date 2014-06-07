DROP DATABASE iclub;
CREATE DATABASE iclub;
use iclub;

CREATE TABLE Users(
	uid int(11) unsigned NOT NULL auto_increment,
	username varchar(11) NOT NULL default '',
	password int(6) NOT NULL default 0,
	login_id varchar(11) NOT NULL default '',

	PRIMARY KEY(uid),
    UNIQUE KEY (login_id)
) DEFAULT CHARSET='UTF8';

CREATE TABLE Students(
	uid int(11)unsigned NOT NULL,
	phone varchar(11) NOT NULL default '',
	email varchar(80) NOT NULL default '',
	
	PRIMARY KEY (uid),
	FOREIGN KEY (uid) REFERENCES Users(uid)
) DEFAULT CHARSET='UTF8';

CREATE TABLE Clubs(
	uid int(11)unsigned NOT NULL,
	contact varchar(80) NOT NULL default'',

	PRIMARY KEY(uid),
	FOREIGN KEY(uid) REFERENCES Users(uid)
) DEFAULT CHARSET='UTF8';

CREATE TABLE Activities(
	aid int(11) unsigned NOT NULL auto_increment,
	title varchar(80) NOT NULL default '',
	attribute int(10) unsigned NOT NULL default 0,
	categories varchar(11) NOT NULL default '',
	stamped_number int(10) unsigned NOT NULL default 0,
	volunteer_hour int(10) unsigned NOT NULL default 0,
	credit float unsigned,
	deadline datetime NOT NULL,
	date datetime NOT NULL,
	begin_time datetime NOT NULL,
	end_time datetime NOT NULL,
	location varchar(100),
	posturl varchar(100),
	other_info text,
	phone int(11) unsigned NOT NULL default 0,
	PRIMARY KEY(aid)
) DEFAULT CHARSET='UTF8';

CREATE TABLE Concern(
	uid_s int(11)unsigned NOT NULL,
	uid_c int(11)unsigned NOT NULL,

	PRIMARY KEY(uid_s,uid_c),
	FOREIGN KEY(uid_s)REFERENCES Students(uid),
	FOREIGN KEY(uid_c)REFERENCES Clubs(uid)

) DEFAULT CHARSET='UTF8';

CREATE TABLE Belong_to(
	uid_s int(11)unsigned NOT NULL,
	uid_c int(11)unsigned NOT NULL,

	PRIMARY KEY(uid_s,uid_c),	
	FOREIGN KEY(uid_s)REFERENCES Students(uid),
	FOREIGN KEY(uid_c)REFERENCES Clubs(uid)
) DEFAULT CHARSET='UTF8';

CREATE TABLE Collect(
	uid int(11) unsigned not null,
	aid int(11) unsigned not null,

	primary KEY(uid, aid),
	FOREIGN KEY(uid)REFERENCES Students(uid),
	foreign KEY(aid) REFERENCES Activities(aid)
) DEFAULT CHARSET='UTF8';

CREATE TABLE Participate(
	uid int(11)unsigned not null,
	aid int(11)unsigned not null,
	isParticipate boolean NOT NULL default false,

	KEY(uid, aid),
	FOREIGN KEY(uid) REFERENCES Students(uid),
	FOREIGN KEY(aid) REFERENCES Activities(aid)
) DEFAULT CHARSET='UTF8';

CREATE TABLE Launch(
	uid int(11) unsigned not null,
	aid int(11) unsigned not null,

	primary KEY(uid, aid),
	FOREIGN KEY(uid) REFERENCES Clubs(uid),
	FOREIGN KEY(aid) REFERENCES Activities(aid)
) DEFAULT CHARSET='UTF8';
