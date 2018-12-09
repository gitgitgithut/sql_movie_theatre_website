/*
	create database 332project;
*/


create table theatre_complex(
	name			varchar(25)	not null,
	street_name		varchar(25)	not null,
	street_number	varchar(25)	not null,
	postal_code		char(6)		not null,
	phone_number	int			not null,
	
	primary key (name)
	);
	
create table theatre(
	theatre_complex	varchar(50)		not null,
	theatre_number	int				not null,
	total_seat		int				not null,
	screen_size		varchar(7)		not null,
	
	primary key (theatre_number),
	foreign key (theatre_complex) references theatre_complex(name)
	);
	
create table supplier(
	company_name	varchar(50)			not null,
	street_name		varchar(25)			not null,
	street_number	varchar(25)			not null,
	postal_code		char(6)				not null,
	phone_number	int					not null,
	contact_name	varchar(50)			not null,
	
	primary key(company_name)
	);

create table movie(
	title				varchar(100)	not null,
	run_time			int				not null,
	rating				varchar(4)		not null,
	plot				varchar(200)	not null,
	director			varchar(50)		not null,
	production_company	varchar(50)		not null,
	supplier			varchar(50)		not null,
	
	primary key(title),
	foreign key(supplier) references supplier(company_name)
	);
	
create table actor(
	name				varchar(50)		not null,
	title				varchar(100)	not null,
	
	primary key(name),
	foreign key(title) references movie(title)
	);
	
create table showing(
	title					varchar(50)	not null,
	theatre_complex			varchar(50)	not null,
	theatre_number			int			not null,
	start_time_and_date		datetime	not null,
	available_seats			int			not null,
	
	primary key(title,theatre_complex,theatre_number, start_time_and_date),
	foreign key(title) references movie(title),
	foreign key(theatre_complex) references theatre_complex(name),
	foreign key(theatre_number) references theatre(theatre_number)
	);
	
create table customer(
	account_number	int			not null,
	password		char(8)		not null,
	fname			varchar(25)	not null,
	lname			varchar(25)	not null,
	street_name		varchar(25) not null,
	street_number	varchar(25)	not null,
	postal_code		char(6)		not	null,
	phone_number	int			not null,
	email			varchar(25)	not null,
	cc_number		int			not null,
	cc_expiry_date	date		not null,
	cc_security_num	int			not null,			
	
	primary key(account_number)
	);
	
create table reservation(
	account_number	int			not null,
	theatre_complex	varchar(50) not null,
	theatre_num		int			not null,
	title			varchar(50)	not null,
	num_tickets		int			not null,
	
	primary key(account_number,theatre_complex,theatre_num,title),
	foreign key(account_number) references customer(account_number),
	foreign key(theatre_complex) references theatre_complex(name),
	foreign key(theatre_num) references theatre(theatre_number),
	foreign key(title) references movie(title)
	);

create table review(
	title			varchar(200)	not null,
	account_number	int				not null,
	stars			int				not null,
	review_text		varchar(200),
	
	primary key(account_number,title),
	foreign key(title) references movie(title),
	foreign key(account_number) references customer(account_number)
	);	



insert into theatre_complex values
	#('name','street_name', 'street_number','postal_code',phone_number),
	('Kingston Theatre', 'Princess Street', '123', 'K7K1C5', 1234567890),
	('Theatre Of Kingston', 'King Street', '13', 'K7K1C6', 1234567891),
	('Best Theatre', 'Prince Avenue', '12873', 'K7K1B4', 1234567892);

insert into theatre values
	#('theatre_complex', theatre_number, total_seat, 'screen_size'),
	('Kingston Theatre', 1, 124, 'small'),
	('Theatre Of Kingston', 12, 1243, 'medium'),
	('Best Theatre', 7, 1124, 'large');

insert into supplier values
	#('company_name', 'street_name','street_number', 'postal_code', phone_number, 'contact_name'),
	('The best movie company', 'Bagot Street', '12', 'K8K1A2', 1233252357, 'Heather'),
	('The worst company', 'Clarington Street', '1122', 'K8U1A2', 2233252357, 'John'),
	('The movie company', 'Wellington Street', '1243', 'K8Q1A2', 3233252357, 'William');

insert into movie values
	#('title', run_time, 'rating', 'plot', 'director', 'production_company', 'supplier'),
	('The best movie', 180, "PG", 'This is a movie about the best movie.', 'John Smith', 'The first production','The worst company'),
	('The worst movie', 169, "G", 'This is a movie about the worst movie.', 'John Smith II', 'The second production','The best movie company'),
	('The alright movie', 112, "R", 'This is a movie about the average movie.', 'John Smith III', 'The last production','The movie company');

insert into actor values
	#('name', 'title');
	('John Smith', 'The best movie'),
	('John Smith I', 'The worst movie'),
	('Kobe Bryant', 'The alright movie');

insert into showing values
	#('title','theatre_complex', theatre_number, 'start_time_and_date', available_seats),
	('The best movie', 'Kingston Theatre', 1, '2018-01-01 20:01:00', 12),
	('The alright movie', 'Theatre Of Kingston', 12, '2018-01-02 20:11:00', 1241),
	('The worst movie', 'Best Theatre', 7, '2018-01-02 20:01:00', 14);

insert into customer values
	#(account_number,'password', 'fname','lname', 'street_name', 'street_number','postal_code', phone_number, 'email', cc_number, 'cc_expiry_date', cc_security_num),
	(1234567, 'badpass', 'Heath', 'John', 'Qwerty', '1', 'K9K1U1', 1233211234, 'fake@email.com', 12312324354, '2018-12-12', 123),
	(1234568, 'badpass1', 'Him', 'Women', 'Keyboard', '21', 'K0K1U1', 123345678, 'fake1@email.com', 22312324354, '2018-12-11', 223),
	(1234569, 'badpass2', 'Her', 'Man', 'Qwerty', '2', 'K9K1U1', 123356789, 'fake2@email.com', 32312324354, '2018-12-10', 323);

insert into reservation values
	#(account_number, 'theatre_complex', theatre_num, 'title', num_tickets),
	(1234567, 'Kingston Theatre', 1, 'The best movie', 2),
	(1234568, 'Theatre Of Kingston', 12, 'The alright movie', 1),
	(1234569, 'Best Theatre', 7, 'The worst movie', 3);

insert into review values
	#('title', account_number, stars, 'review_text'),
	('The best movie', 1234567, 5, 'The title says it all.'),
	('The alright movie', 1234568, 3, null),
	('The worst movie', 1234569, 5, 'This was the worst and best movie ever!');
