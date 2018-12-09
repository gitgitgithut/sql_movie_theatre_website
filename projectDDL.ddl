/*
	create database 332project;
*/


create table theatre_complex(
	name			varchar(25)	not null,
	street_name		varchar(25)	not null,
	street_number	varchar(25)	not null,
	postal_code		char(6)		not null,
	phone_number	varchar(25)	not null,
	
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
	phone_number	varchar(25)			not null,
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
	showing_id				int 		not null,
	title					varchar(50)	not null,
	theatre_complex			varchar(50)	not null,
	theatre_number			int			not null,
	start_time_and_date		datetime	not null,
	available_seats			int			not null,
	
	primary key(showing_id),
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
	phone_number	varchar(25)	not null,
	email			varchar(25)	not null,
	cc_number		int			not null,
	cc_expiry_date	date		not null,
	cc_security_num	int			not null,			
	
	primary key(account_number)
	);
	
create table reservation(
	account_number	int			not null,
	showing_id      int         not null,
	num_tickets		int			not null,
	
	primary key(account_number,showing_id),
	foreign key(account_number) references customer(account_number),
	foreign key(showing_id) references showing(showing_id)
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
	#('name','street_name', 'street_number','postal_code','phone_number'),
	('Kingston Theatre', 'Princess Street', '123', 'K7K1C1', '1234567890'),
	('Theatre Of Kingston', '1st Street', '1323', 'K7K1C2', '1234567891'),
	('Theatre Of Queens', '2nd Street', '1321', 'K7K1C3', '1234322131'),
	('Theatre For You', '3rd Street', '1312', 'K7K1C4', '1234567234591'),
	('Theatre', '4th Street', '1335', 'K7K1C5', '1234514236781'),
	('The Theatre Of Kingston', '5th Street', '1543', 'K7K1C6', '1243234567891'),
	('The Theatre', '6th Street', '13216', 'K7K1C7', '1233424567891'),
	('The Theatre Of Queens', '7th Street', '123', 'K7K1C8', '1231244567891'),
	('Queens Theatre', '8th Street', '1343', 'K7K1C6', '1231244567891'),
	('The Theatre For You', '9th Street', '1673', 'K8K1C6', '1234567813491'),
	('The Best Theatre', '10th Street', '11323', 'K9K1C6', '1212334567891'),
	('Best Theatre', 'Prince Avenue', '12873', 'K1K1B4', '1275634567892');

insert into theatre values
	#('theatre_complex', theatre_number, total_seat, 'screen_size'),
	('Kingston Theatre', 1, 20, 'small'),
	('Theatre Of Kingston', 13, 122, 'medium'),
	('Theatre Of Queens', 2, 463, 'large'),
	('Theatre For You', 12, 15, 'small'),
	('Theatre', 5, 111, 'medium'),
	('The Theatre Of Kingston', 6, 324, 'large'),
	('The Theatre', 17, 19, 'small'),
	('The Theatre Of Queens', 12, 123, 'medium'),
	('Queens Theatre', 11, 1243, 'large'),
	('The Best Theatre', 13, 30, 'small'),
	('Best Theatre', 7, 1124, 'large');

insert into supplier values
	#('company_name', 'street_name','street_number', 'postal_code', 'phone_number', 'contact_name'),
	('The best movie company', 'Bagot Street', '1221', 'K8K1A1', '1233252357', 'Heather'),
	('The best company', 'Clarington Street', '112212', 'K8U1A2', '2235683252357', 'John'),
	('Best company', 'Clarington St.', '2', 'K8U1A3', '2233252357', 'John I'),
	('The worst company', 'Clarington Street', '12122', 'K8U1A4', '223325452357', 'John IIII'),
	('The worst movie company', 'Bagot St.', '112562', 'K8U1A5', '223325223357', 'John Smith'),
	('Worst company', 'Clarington St.', '112342', 'K8U1A6', '2233252375657', 'John Smith III'),
	('The only company', 'Clarington St.', '11272', 'K8U1A7', '22332523357', 'John Smith I'),
	('The only movie company', 'Clarington Street', '1217822', 'K8U1A8', '2232433252357', 'Jane'),
	('Only company', 'Bagot St.', '12892', 'K8U1A9', '223325542357', 'Janice'),
	('Movie company', 'Clarington St.', '220', 'K1U1A2', '223357252357', 'Joe'),
	('The movie movie company', 'Clarington Street', '108122', 'K2U1A2', '278233252357', 'Han'),
	('The movie company', 'Wellington Street', '1243', 'K8Q1A2', '323325290357', 'William');

insert into movie values
	#('title', run_time, 'rating', 'plot', 'director', 'production_company', 'supplier'),
	('The best movie', 180, "G", 'This is a movie about the best movie.', 'Zack Snyder', 'The First Production','The best movie company'),
	('The worst movie', 169, "PG", 'This is a movie about the worst movie.', 'Eric Chau', 'The Second Production','The best company'),
	('The only movie', 180, "AA", 'This is the only movie to watch.', 'Gatorade', 'The Green Production','Best company'),
	('Must Watch Movie', 169, "14A", 'You must watch this movie', 'LeBron Jame', 'The King James Production','The worst company'),
	('Do Not Watch Movie', 180, "R", 'You definitely should not watch this movie', 'Dwyane Wade', 'The Flash Production','The worst movie company'),
	('Sausage Party', 169, "18+", 'Its about food in a supermarket, wanting to be taken home.', 'Seth Rogan', 'The dirty production', 'Worst company'),
	('Do Watch', 180, "G", 'If you want to watch this movie watch it', 'Kevin Durant', 'The Snake Production','The only company'),
	('Troys Movie', 169, "PG", 'This is a god like movie about HTML coding', 'Troy Wolters', 'Charles Production','The only movie company'),
	('Lins Movie', 180, "AA", 'This is a god like movie about math', 'Xiaofeng Lin', 'FengFeng productions','Only company'),
	('Wendys Movie', 169, "14A", 'This movie is about puppies', 'Wendy Powley', 'Database company','Movie company'),
	('The alright movie', 112, "R", 'This is a movie about the average movie.', 'John Smith III', 'The last production','The movie movie company');

insert into actor values
	#('name', 'title');
	('Charles Troy Movie', 'The best movie'),
	('XiaofengFeng Lin', 'The worst movie'),
	('Charles Xavier', 'The only movie'),
	('Eric Chau', 'Must Watch Movie'),
	('Rony Besp', 'Do Not Watch Movie'),
	('Ben Affleck', 'Sausage Party'),
	('Matt Damon', 'Do Watch'),
	('Tom Brady', 'Troys Movie'),
	('LeBron James', 'Lins Movie'),
	('Kyle Korver', 'Wendy Movie'),
	('Antonio Brown', 'The alright movie'),
	('Christan Bale', 'The best movie'),
	('Steph Curry', 'The worst movie'),
	('Logic', 'The only movie'),
	('Kendrick Lamar', 'Must Watch Movie'),
	('J. Cole', 'Do Not Watch Movie'),
	('Apollo Brown', 'Sausage Party'),
	('Bob Marley', 'Do Watch'),
	('Ab-Soul', 'Troys Movie'),
	('K.A.A.N', 'Lins Movie'),
	('Mick Jenkins', 'Wendys Movie'),
	('Nas', 'The alright movie'),
	('Oddisee', 'The best movie'),
	('Wu-Tang Clan', 'The worst movie'),
	('Kobe Bryant', 'The only movie');

insert into showing values
	#('title','theatre_complex', theatre_number, 'start_time_and_date', available_seats),
	(984327, 'The best movie', 'Kingston Theatre', 1, '2018-01-01 20:01:00', 20),
	(483217, 'The worst movie', 'Theatre Of Kingston', 13, '2018-01-02 20:11:00', 122),
	(984327, 'The only movie', 'Theatre Of Queens', 2, '2018-01-01 20:01:00', 463),
	(4832172, 'Must Watch Movie', 'Theatre For You', 12, '2018-01-02 20:11:00', 15),
	(98432712, 'Do Not Watch Movie', 'Theatre', 5, '2018-01-01 20:01:00', 111),
	(48321217, 'Sausage Party', 'The Theatre Of Kingston', 6, '2018-01-02 20:11:00', 324),
	(984345327, 'Do Watch', 'The Theatre', 17, '2018-01-01 20:01:00', 19),
	(48322117, 'Troys Movie', 'The Theatre Of Queens', 12, '2018-01-02 20:11:00', 123),
	(9843527, 'Lins Movie', 'Queens Theatre', 11, '2018-01-01 20:01:00', 1243),
	(48321217, 'Wendys Movie', 'The Best Theatre', 13, '2018-01-02 20:11:00', 30),
	(9684327, 'The alright movie', 'Best Theatre', 7, '2018-01-01 20:01:00', 1124),
	(4324813217, 'The best movie', 'Kingston Theatre', 1, '2018-01-02 20:11:00', 20),
	(984322137, 'The worst movie', 'Theatre Of Kingston', 13, '2018-01-01 20:01:00', 122),
	(483324217, 'The only movie', 'Theatre Of Queens', 2, '2018-01-02 20:11:00', 463),
	(9843227, 'Must Watch Movie', 'Theatre For You', 12, '2018-01-01 20:01:00', 15),
	(48321217, 'Do Not Watch Movie', 'Theatre', 5, '2018-01-02 20:11:00', 111),
	(9843267, 'Sausage Party', 'The Theatre Of Kingston', 6, '2018-01-01 20:01:00', 324),
	(48321767, 'Do Watch', 'The Theatre', 17, '2018-01-02 20:11:00', 19),
	(984324537, 'Troys Movie', 'The Theatre Of Queens', 12, '2018-01-01 20:01:00', 123),
	(483289717, 'Lins Movie', 'Queens Theatre', 11, '2018-01-02 20:11:00', 1243),
	(98432237, 'Wendys Movie', 'The Best Theatre', 13, '2018-01-01 20:01:00', 30),
	(483298717, 'The alright movie', 'Best Kingston', 7, '2018-01-02 20:11:00', 1124);

insert into customer values
	#(account_number,'password', 'fname','lname', 'street_name', 'street_number','postal_code', 'phone_number', 'email', cc_number, 'cc_expiry_date', cc_security_num),
	(1234567, 'badpass', 'Heath', 'John', 'Qwerty', '1', 'K9K1U1', 1233211234, 'fake@email.com', '12312324354', '2018-12-12', 123),
	(1234568, 'badpass1', 'Him', 'Women', 'Keyboard', '21', 'K0K1U1', 123345678, 'fake1@email.com', '22312324354', '2018-12-11', 223),
	(1234569, 'badpass2', 'Her', 'Man', 'Qwerty', '2', 'K9K1U1', 123356789, 'fake2@email.com', '32312324354', '2018-12-10', 323),
	(1234570, 'badpass2', 'The', 'Man', 'Qwerty', '2', 'K9K1U1', 123356789, 'fake2@email.com', '32312324354', '2018-12-10', 323);

insert into reservation values
	#(account_number, showing_id, num_tickets),
	(1234567, 984327, 1),
	(1234568, 4832172, 17),
	(1234568, 483217, 38),
	(1234569, 984327, 5);

insert into review values
	#('title', account_number, stars, 'review_text'),
	('The best movie', 1234567, 5, 'The title says it all.'),
	('The worst movie', 1234568, 4, null),
	('The only movie', 1234568, 3, 'This is the only movie you should ever need to watch!')
	('Must Watch Movie', 1234569, 2, 'Movie title convinced me, not worth.'),
	('Do Not Watch Movie', 1234569, 1, null),
	('Sausage Party', 1234569, 5, 'THE FUNNIEST MOVIE OF ALL TIME!')
	('Do Watch', 1234567, 5, '5/5 would recommend.'),
	('The best movie', 1234567, 4, null),
	('The worst movie', 1234568, 4, '4/5 worth every penny')
	('The only movie', 1234569, 5, '5/5 would watch again.'),
	('Must Watch Movie', 1234568, 3, null),
	('Do Not Watch Movie', 1234569, 1, 'Created an account just to say that this is a shitty movie.');



