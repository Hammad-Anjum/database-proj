create table Hospital(
HospitalID int primary key,
HospitalName varchar(255),
Location varchar(255)
);


select * from Hospital


create table Users(
UserID int identity(1,1) primary key,
UserName varchar(255) not null,
UserEmail varchar(255) not null unique,
UserCity varchar(255) not null,
UserDOB varchar(255),
UserPhone varchar(255) not null,
UserPass varchar(255) not null,
UserCNIC varchar(255) not null unique
);

create table Doctors(
DoctorID int identity(1,1) primary key,
DoctorName varchar(255) not null,
DoctorEmail varchar(255) not null unique,
DoctorCity varchar(255) not null,
DoctorPhone varchar(255) not null,
DoctorPass varchar(255) not null,
DoctorCNIC varchar(255) not null unique,
StartWorkHours time,
EndWorkHours time,
HospitalID int foreign key references Hospital(HospitalID) on update cascade on delete cascade
);


create table DoctorType(
DoctorEmail varchar(255) foreign key references Doctors(DoctorEmail)on update cascade on delete cascade,
Specialization varchar(255),
YearsOfExperience int
);

create table DocRating(
DoctorEmail varchar(255) foreign key references Doctors(DoctorEmail) on update cascade on delete cascade,
rating int
);

create table Appointment(
DoctorEmail varchar(255) foreign key references Doctors(DoctorEmail) on update cascade on delete cascade,
UserEmail varchar(255) foreign key references Users(UserEmail)on update cascade on delete cascade,
StartTime varchar(255) not null,
EndTime varchar(255) not null,
UserPaymentMethod varchar(255)
);


create table DoctorsFee(
DoctorEmail varchar(255) foreign key references Doctors(DoctorEmail),
DoctorFees int not null
);
	
insert into Users values('Nareen waseem','nareenwaseem15@gmail.com', 'Lahore','15-10-2002', '0313-4136242' , 'nareen' , '35202-4192423-0');
insert into Users values('hammad anjum','hammadanjum6@gmail.com', 'Quetta','12-10-2005', '0313-4165789' , 'juhjgh' , '35202-2192423-0');
insert into Users values('hammad ashraf','hammadashraf10@gmail.com', 'Karachi','25-10-2006', '0313-6578904' , 'jhujygh' , '35209-4192423-6');
insert into Users values('fizza shahzad','fizzashahzad6@gmail.com', 'Islamabad','06-10-2007', '0313-345674' , 'ghythju' , '35202-4262423-7');
insert into Users values('esah abdullah','esahabdullah9@gmail.com', 'Faisalabad','05-10-2007', '0313-9064758' , 'kimjkiul' , '35342-4192423-0');
insert into Users values('ehtasahm ali','ehtashamali@gmail.com', 'Islamabad','07-10-2008', '0313-7785648' , 'kjmjuk' , '35202-4786423-0');
insert into Users values('zahra batool','zahrabatool90@gmail.com', 'Lahore','05-10-2009', '0313-7689507' , 'hujhghyt' , '45672-3672423-0'); 
insert into Users values('syed amir','amir456@gmail.com', 'Islamabad','09-10-2004', '0313-67589456' , 'hjught' , '34202-4192423-0');
insert into Users values('saba faisal','sabafaisal34@gmail.com', 'Karachi','15-10-2002', '0313-9809878' , 'dfrtghy' , '45202-4189423-0');
insert into Users values('eisah malik','eisahmalik78@gmail.com', 'Lahore','15-10-2003', '0313-7896879' , 'uhujy' , '89202-4196723-9');
insert into Users values('sheraz','sherazmalik4@gmail.com', 'Islamabad','18-10-2003', '0313-7098908' , 'ytuirh' , '89202-3252423-0');
insert into Users values('fiazan ali','faizanali23@gmail.com', 'Multan','19-10-2003', '0313-7845678' , 'hytgy' , '35202-3456423-0');
insert into Users values('adeena fatima','adeeenafatima@gmail.com', 'Multan','14-07-2003', '0313-6789045' , 'hjugty' , '56202-4167423-8');
insert into Users values('haider khaliq','haiderr456@gmail.com', 'Lahore','30-09-2002', '0313-6789456' , 'gdtegt' , '35702-7892423-0');
insert into Users values('zamna razaaq','zamnaraq342@gmail.com', 'Lahore','18-10-2002', '0313-7634562' , 'hugyt' , '35262-4178423-0');
insert into Users values('laiba waseem','laibawaseem15@gmail.com', 'Islamabad','17-10-2002', '0313-7845678' , 'huygdfr' , '37202-4109423-0');
insert into Users values('naba ismail','nabaismail56@gmail.com', 'Faisalabad','17-12-200', '0313-7689078' , 'hujfhy' , '37202-4672423-0');
insert into Users values('sadia ikram','sadiaikram@gmail.com', 'Lahore','17-10-2002', '0313-7890678' , 'hfuhju' , '35702-4782423-0');
insert into Users values('hadia ahmed','hadiaahmed34@gmail.com', 'Islamabad','18-10-2002', '0313-7890908' , 'huyhfy' , '35782-4192423-0');
insert into Users values('hamna shaid','hamnashhid23@gmail.com', 'Lahore','15-09-2002', '0313-6734567' , 'huygh' , '36702-4192483-1');
insert into Users values('zahra ahmed','zahrahamed15@gmail.com', 'Faisalabad','15-06-2002', '0313-6473890' , 'gahye' , '35702-4182423-9');

insert into Hospital values(1347,'Doctors Hospital','152-G/1، Canal Bank Road, Block G 1 Phase 1 Johar Town, Lahore');
insert into Hospital values(1393,'Citi Hospital','Plot 284 Defence Rd, Block D Pgshs 1, Lahore');
insert into Hospital values(1384,'General Hospital','Ferozpur Road، near Chungi, Amar Sidhu Ismail Nagar, Lahore');
insert into Hospital values(1386,'Evercare Hospital',' D1 Commercial, NECHS Lahore');
insert into Hospital values(1321,'Pakistan Air Force Hospital','Munir road cantt, Lahore');
insert into Hospital values(1219,'Islamabad International Hopsital','2 main double rd,FECHS, Islamabad');
insert into Hospital values(1295,'Captain International Hospital','Street 3,Srinagar highway, Islamabad');
insert into Hospital values(1235,'Advance International Hospital','G-8 Markaz, Islamabad');
insert into Hospital values(1455,'The Mordern Hospital','Main University Rd, Block 7 Gulshan-e-Iqbal, Karachi');
insert into Hospital values(1476,'Federal Hospital',' C-8 Ancholi Block 20 Gulberg Town, Karachi');
insert into Hospital values(1422,'Dr.ziauddin Hospital','4/B Shahrah-e-Ghalib Rd, Block 6 Clifton, Karachi');
insert into Hospital values(1588,'Faisalabad International Hospital','204 east canal Rd, Gulshan E Iqbal, Faisalabad');
insert into Hospital values(1521,'Prime Care Hospital','Ahmed St, Saeed Colony, Faisalabad');

insert into Doctors (DoctorName, DoctorEmail, DoctorCity, DoctorPhone, DoctorPass, DoctorCNIC, StartWorkHours, EndWorkHours, HospitalID) values
('Hafsa Ahmed', 'hafsa.ahmed@gmail.com', 'Karachi', '0345-1234567', 'H@fsa123', '12345-1234567-9', '09:00:00', '17:00:00', 1455),
('Abdul Rehman', 'abdul.rehman@gmail.com', 'Faisalabad', '0321-1234567', 'Abdul@123', '23456-1234567-2', '10:00:00', '18:00:00', 1588),
('Fatima Khan', 'fatima.khan@gmail.com', 'Lahore', '0300-1234567', 'Fatima@123', '34567-1234567-3', '08:00:00', '16:00:00', 1393),
('Madiha Akram', 'madiha.akram@gmail.com', 'Quetta', '0345-1234567', 'Madiha@123', '45678-1234567-4', '09:00:00', '17:00:00', 1347),
('Sanaa Qureshi', 'sanaa.qureshi@gmail.com', 'Islamabad', '0321-1234567', 'Sanaa@123', '56789-1234567-5', '10:00:00', '18:00:00', 1219)
go

insert into Doctors (DoctorName, DoctorEmail, DoctorCity, DoctorPhone, DoctorPass, DoctorCNIC, StartWorkHours, EndWorkHours, HospitalID) values
('Ahmed Raza', 'ahmed.raza@gmail.com', 'Lahore', '0300-1234567', 'Ahmed@123', '67890-1234567-6', '08:00:00', '16:00:00', 1386),
('Aisha Anwar', 'aisha.anwar@gmail.com', 'Faisalabad', '0345-1234567', 'Aisha@123', '78901-1234567-7', '09:00:00', '17:00:00', 1521),
('Usman Khan', 'usman.khan@gmail.com', 'Karachi', '0321-1234567', 'Usman@123', '89012-1234567-8', '10:00:00', '18:00:00', 1422),
('Iqra Asif', 'iqra.asif@gmail.com', 'Lahore', '0300-1234567', 'Iqra@123', '90123-1234567-9', '08:00:00', '16:00:00', 1384),
('Saad Ahmed', 'saad.ahmed@gmail.com', 'Multan', '0345-1234567', 'Saad@123', '01234-1234567-0', '09:00:00', '17:00:00', 1321)
go


insert into Doctors (DoctorName, DoctorEmail, DoctorCity, DoctorPhone, DoctorPass, DoctorCNIC, StartWorkHours, EndWorkHours, HospitalID) values
('Mohammad Ahmed', 'mohammad.ahmed@gmail.com', 'Faisalabad', '0321-2345678', 'Ahmed@123', '23456-7891234-5', '09:00:00', '15:00:00', 1588),
('Sadia Khan', 'sadia.khan@gmail.com', 'Lahore', '0333-4567890', 'Sadia@123', '34567-8912345-6', '11:00:00', '17:00:00', 1386),
('Ali Raza', 'ali.raza@gmail.com', 'Multan', '0331-2345678', 'Ali@123', '45678-9123456-7', '12:00:00', '18:00:00', 1386),
('Saba Khurshid', 'saba.khurshid@gmail.com', 'Islamabad', '0334-3456789', 'Saba@123', '56789-1234567-8', '08:30:00', '14:30:00', 1219)


insert into Doctors (DoctorName, DoctorEmail, DoctorCity, DoctorPhone, DoctorPass, DoctorCNIC, StartWorkHours, EndWorkHours, HospitalID) values
('Amir Ali', 'amir.ali@gmail.com', 'Karachi', '0301-2345678', 'Amir@123', '67891-2345678-9', '10:00:00', '16:00:00', 1422),
('Rabia Ahmad', 'rabia.ahmad@gmail.com', 'Lahore', '0315-3456789', 'Rabia@123', '78912-3456789-0', '08:00:00', '14:00:00', 1386)


insert into Doctors (DoctorName, DoctorEmail, DoctorCity, DoctorPhone, DoctorPass, DoctorCNIC, StartWorkHours, EndWorkHours, HospitalID) values
('Sajid Hassan', 'sajid.hassan@gmail.com', 'Quetta', '0332-2345678', 'Sajid@123', '89123-4567891-2', '09:00:00', '15:00:00', 1588),
('Nida Khan', 'nida.khan@gmail.com', 'Islamabad', '0333-4567890', 'Nida@123', '91234-5678912-3', '11:00:00', '17:00:00', 1219)


INSERT INTO DoctorType (DoctorEmail, Specialization, YearsOfExperience) VALUES 
('hafsa.ahmed@gmail.com', 'General Physician', 5),
('abdul.rehman@gmail.com', 'Psychiatrist', 10),
('fatima.khan@gmail.com', 'Dentist', 3),
('madiha.akram@gmail.com', 'Dermatologist', 8),
('sanaa.qureshi@gmail.com', 'General Physician', 2),
('ahmed.raza@gmail.com', 'Psychologist', 6),
('aisha.anwar@gmail.com', 'Psychiatrist', 4),
('usman.khan@gmail.com', 'Cardiologist', 9),
('iqra.asif@gmail.com', 'General Physician', 1),
('saad.ahmed@gmail.com', 'Dentist', 7),
('mohammad.ahmed@gmail.com', 'Dermatologist', 6),
('sadia.khan@gmail.com', 'Psychiatrist', 5),
('ali.raza@gmail.com', 'Cardiologist', 8),
('saba.khurshid@gmail.com', 'General Physician', 3),
('amir.ali@gmail.com', 'Psychologist', 2),
('rabia.ahmad@gmail.com', 'Dentist', 5),
('sajid.hassan@gmail.com', 'General Physician', 6),
('nida.khan@gmail.com', 'Cardiologist', 2);


INSERT INTO DocRating (DoctorEmail, rating)
VALUES
  ('hafsa.ahmed@gmail.com', 8),
  ('abdul.rehman@gmail.com', 6),
  ('fatima.khan@gmail.com', 9),
  ('madiha.akram@gmail.com', 4),
  ('sanaa.qureshi@gmail.com', 10),
  ('ahmed.raza@gmail.com', 7),
  ('aisha.anwar@gmail.com', 5),
  ('usman.khan@gmail.com', 3),
  ('iqra.asif@gmail.com', 8),
  ('saad.ahmed@gmail.com', 2),
  ('mohammad.ahmed@gmail.com', 1),
  ('sadia.khan@gmail.com', 10),
  ('ali.raza@gmail.com', 2),
  ('saba.khurshid@gmail.com', 6),
  ('amir.ali@gmail.com', 4),
  ('rabia.ahmad@gmail.com', 9),
  ('sajid.hassan@gmail.com', 3),
  ('nida.khan@gmail.com', 8);



INSERT INTO Appointment (DoctorEmail, UserEmail, StartTime, EndTime, UserPaymentMethod)
VALUES
('ali.raza@gmail.com', 'zahrabatool90@gmail.com', '2023-05-20 10:00:00', '2023-05-20 11:00:00', 'Cash'),
('ali.raza@gmail.com', 'zahrabatool90@gmail.com', '2023-05-20 13:00:00', '2023-05-20 14:00:00', 'Cash'),
('ali.raza@gmail.com', 'zahrabatool90@gmail.com', '2023-05-20 17:00:00', '2023-05-20 18:00:00', 'Cash'),
('sanaa.qureshi@gmail.com', 'faizanali23@gmail.com', '2023-04-20 11:30:00', '2023-04-20 12:30:00', 'Cash'),
('aisha.anwar@gmail.com', 'nabaismail56@gmail.com', '2023-04-20 14:30:00', '2023-04-20 15:30:00', 'Card'),
('saad.ahmed@gmail.com', 'laibawaseem15@gmail.com', '2023-04-20 16:00:00', '2023-04-20 17:00:00', 'Card'),
('rabia.ahmad@gmail.com', 'sadiaikram@gmail.com', '2023-04-21 09:00:00', '2023-04-21 10:00:00', 'Card'),
('usman.khan@gmail.com', 'haiderr456@gmail.com', '2023-04-21 12:00:00', '2023-04-21 13:00:00', 'Cash'),
('saba.khurshid@gmail.com', 'nareenwaseem15@gmail.com', '2023-04-21 13:30:00', '2023-04-21 14:30:00', 'Cash'),
('amir.ali@gmail.com', 'ehtashamali@gmail.com', '2023-04-21 15:00:00', '2023-04-21 16:00:00', 'Cash'),
('abdul.rehman@gmail.com', 'sabafaisal34@gmail.com', '2023-04-21 16:30:00', '2023-04-21 17:30:00', 'Cash'),
('madiha.akram@gmail.com', 'zamnaraq342@gmail.com', '2023-04-22 09:00:00', '2023-04-22 10:00:00', 'Cash'),
('fatima.khan@gmail.com', 'hamnashhid23@gmail.com', '2023-04-22 10:30:00', '2023-04-22 11:30:00', 'Cash'),
('hafsa.ahmed@gmail.com', 'eisahmalik78@gmail.com', '2023-04-22 12:00:00', '2023-04-22 13:00:00', 'Cash'),
('ali.raza@gmail.com', 'hammadanjum6@gmail.com', '2023-03-12 11:00:00', '2023-03-12 12:00:00', 'Cash'),
('sanaa.qureshi@gmail.com', 'sabafaisal34@gmail.com', '2023-03-16 09:00:00', '2023-03-16 10:00:00', 'Cash'),
('ahmed.raza@gmail.com', 'haiderr456@gmail.com', '2023-03-18 14:00:00', '2023-03-18 15:00:00', 'Cash'),
('rabia.ahmad@gmail.com', 'zamnaraq342@gmail.com', '2023-03-21 16:00:00', '2023-03-21 17:00:00', 'Cash'),
('usman.khan@gmail.com', 'faizanali23@gmail.com', '2023-03-25 10:30:00', '2023-03-25 11:30:00', 'Cash'),
('mohammad.ahmed@gmail.com', 'adeeenafatima@gmail.com', '2023-04-05 14:00:00', '2023-04-05 15:00:00', 'Cash'),
('sadia.khan@gmail.com', 'zahrabatool90@gmail.com', '2023-04-10 16:30:00', '2023-04-10 17:30:00', 'Cash'),
('amir.ali@gmail.com', 'ehtashamali@gmail.com', '2023-04-13 12:00:00', '2023-04-13 13:00:00', 'Cash'),
('fatima.khan@gmail.com', 'hammadashraf10@gmail.com', '2023-04-15 09:30:00', '2023-04-15 10:30:00', 'Cash'),
('saba.khurshid@gmail.com', 'zamnaraq342@gmail.com', '2023-04-22 15:00:00', '2023-04-22 16:00:00', 'Cash'),
('ahmed.raza@gmail.com', 'nabaismail56@gmail.com', '2023-02-18 12:30:00', '2023-02-18 13:30:00', 'Cash'),
('mohammad.ahmed@gmail.com', 'hamnashhid23@gmail.com', '2023-03-02 09:00:00', '2023-03-02 10:00:00', 'Cash'),
('sanaa.qureshi@gmail.com', 'laibawaseem15@gmail.com', '2023-03-05 14:00:00', '2023-03-05 15:00:00', 'Cash'),
('sajid.hassan@gmail.com', 'zamnaraq342@gmail.com', '2023-03-09 16:30:00', '2023-03-09 17:30:00', 'Cash'),
('aisha.anwar@gmail.com', 'hadiaahmed34@gmail.com', '2023-03-15 15:00:00', '2023-03-15 16:00:00', 'Cash'),
('saba.khurshid@gmail.com', 'adeeenafatima@gmail.com', '2023-03-20 13:00:00', '2023-03-20 14:00:00', 'Cash'),
('ali.raza@gmail.com', 'sabafaisal34@gmail.com', '2023-04-01 11:00:00', '2023-04-01 12:00:00', 'Cash'),
('sadia.khan@gmail.com', 'eisahmalik78@gmail.com', '2023-04-03 10:30:00', '2023-04-03 11:30:00', 'Cash');

INSERT INTO Appointment (DoctorEmail, UserEmail, StartTime, EndTime, UserPaymentMethod)
VALUES
('saba.khurshid@gmail.com', 'hammadanjum6@gmail.com', '2023-05-20 13:00:00', '2023-05-20 14:00:00', 'Card'),
('sadia.khan@gmail.com', 'hammadanjum6@gmail.com', '2023-03-20 8:00:00', '2023-03-20 9:00:00', 'Cash');


INSERT INTO Appointment (DoctorEmail, UserEmail, StartTime, EndTime, UserPaymentMethod)
VALUES
('saba.khurshid@gmail.com', 'nareenwaseem15@gmail.com', '2023-05-23 12:00:00', '2023-05-23 13:00:00', 'Card'),
('sadia.khan@gmail.com', 'nareenwaseem15@gmail.com', '2023-05-20 8:00:00', '2023-05-20 9:00:00', 'Cash');



INSERT INTO DoctorsFee(DoctorEmail, DoctorFees)
VALUES 
('hafsa.ahmed@gmail.com', 500),
('abdul.rehman@gmail.com', 700),
('fatima.khan@gmail.com', 600),
('madiha.akram@gmail.com', 800),
('sanaa.qureshi@gmail.com', 900),
('ahmed.raza@gmail.com', 1000),
('aisha.anwar@gmail.com', 1200),
('usman.khan@gmail.com', 1500),
('iqra.asif@gmail.com', 2000),
('saad.ahmed@gmail.com', 2500),
('mohammad.ahmed@gmail.com', 4000),
('sadia.khan@gmail.com', 4500),
('ali.raza@gmail.com', 5000),
('saba.khurshid@gmail.com', 5500),
('amir.ali@gmail.com', 6000),
('rabia.ahmad@gmail.com', 6500),
('sajid.hassan@gmail.com', 7000),
('nida.khan@gmail.com', 7500)


select * from Users
select * from Doctors
select * from DocRating
select * from DoctorType
select * from DoctorsFee
select * from Appointment

drop table Appointment
drop table DocRating
drop table DoctorsFee
drop table DoctorType
drop table Doctors
drop table Users

