CREATE DATABASE haccsec;

use haccsec;

CREATE TABLE sponsor (
        id INT not null AUTO_INCREMENT,
        sfirstname VARCHAR(30) NOT NULL,
        slastname VARCHAR(30) NOT NULL,
        sponsorroom INT(4) NOT NULL,
	primary key (id)
);

CREATE TABLE visitor (
        id INT not null AUTO_INCREMENT,
        vfirstname VARCHAR(30) NOT NULL,
        vlastname VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        meetinglocation VARCHAR(50),
        meetingtime TIME,
	sponsorid INT(11),
	Foreign key (sponsorid) REFERENCES sponsor (id),
	primary key (id)
);

CREATE TABLE badge (
        id INT not null AUTO_INCREMENT,
        badgenumber INT(2) NOT NULL,
        issuedtime TIME,
        returnedtime TIME,
	issuedto INT(11),
        foreign key (issuedto) REFERENCES visitor (id),
	primary key (id)
);

commit;
