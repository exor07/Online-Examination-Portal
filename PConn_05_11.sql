--
-- Database: `pconn`
--

--
-- add new tables to be droped from top
--

DROP TABLE IF EXISTS student_choice;
DROP TABLE IF EXISTS projectpref;
DROP TABLE IF EXISTS discussion;
DROP TABLE IF EXISTS users_linkedin;
DROP TABLE IF EXISTS enrolled_master;
DROP TABLE IF EXISTS project_request;
DROP TABLE IF EXISTS assignment;
DROP TABLE IF EXISTS course;
DROP TABLE IF EXISTS course_master_univ;
DROP TABLE IF EXISTS organization_master;
DROP TABLE IF EXISTS teacher_master;
DROP TABLE IF EXISTS student_master;
DROP TABLE IF EXISTS users_master;

--
-- Table structure for table `all_users`
--

CREATE TABLE IF NOT EXISTS `users_master` (
  `id` int(11) NOT NULL auto_increment,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
   primary key(id, email)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_users`
--

INSERT INTO `users_master` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'sm', 'patil', 'aaa@gmail.com', 'admin');

--
-- Table structure for table `teacher_master`
--

CREATE TABLE IF NOT EXISTS `teacher_master` (
  `teacher_id` int(10) NOT NULL auto_increment,
  `firstName` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lastName` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
   primary key(teacher_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher_master`
--

INSERT INTO `teacher_master` (`teacher_id`, `firstName`, `lastName`, `sex`, `address`, `phone`, `email`, `password`) VALUES
(1001, 'Tom', 'Connolly', 'male', '694 Michael Street', '713-732-6331', 'TomConnolly@teachers.com', 'teacher'),
(1002, 'Alfie', 'Gibbs', 'female', '4841 Andell Road', '614-901-1543', 'AlfieGibbs@gmail.com', 'canada');

--
-- Table structure for table `organization_master`
--

CREATE TABLE IF NOT EXISTS `organization_master` (
  `organization_id` int(11) NOT NULL auto_increment,
  `firstName` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lastName` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
   primary key(organization_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization_master`
--

INSERT INTO `organization_master` (`organization_id`, `firstName`, `lastName`, `sex`, `address`, `phone`, `email`, `password`) VALUES
(10001, 'Keathe', 'Lancaster', 'male', '694 Michael Street', '713-732-6331', 'organization@test1.com', 'org1'),
(10002, 'Newton', 'Ogle', 'male', '694 Michael Street', '713-732-6331', 'organization@test2.com', 'org2'),
(10003, 'Stampe', 'Thursby', 'male', '694 Michael Street', '713-732-6331', 'organization@test3.com', 'org3');

--
-- Table structure for table `student_master`
--

CREATE TABLE IF NOT EXISTS `student_master` (
  `stud_id` int(11) NOT NULL auto_increment,
  `firstName` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lastName` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (stud_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_master`
--

INSERT INTO `student_master` (`stud_id`, `firstName`, `lastName`, `sex`, `address`,`phone`, `email`, `password`) VALUES
(1, 'SMITH', 'JOHNSON', 'male', '62 Yukon Street 
Neenah, WI 54956', '8573322312', 'smith@abc.com', 'student'),
(2, 'WILLIAMS', 'BROWN', 'male', '4 Cross Lane 
Schererville, IN 46375', '8512345678', 'jay@ced.com', 'class'),
(3, 'JONES', 'MILLER', 'male', '86 Chapel St. 
Mason City, IA 50401', '9512345678', 'kay@ced.com', 'class1'),
(4, 'Mareli', 'Brooks', 'female', '156 pike boston MA', '9512345678', 'Mareli@ced.com', 'class2'),
(5, 'Aniya', 'Hester', 'female', '6 jay st boston MA', '9512345678', 'aniya@ced.com', 'aniya'),
(6, 'Natasha', 'Mcdonald', 'female', '32 ray blvd boston MA', '9512345678', 'kay@ced.com', 'natasha'),
(7, 'Selena', 'Francis', 'female', '17 oak rd boston MA', '9512345678', 'francis@ced.com', 'class12'),
(8, 'Laura', 'Montoya', 'female', '3 Lakeshore Road 
New Brunswick, NJ 08901', '9512345678', 'kay@ced.com', 'class32'),
(9, 'Victor', 'Barrett', 'male', '43 tim Rd boston MA', '9512345678', 'kay@ced.com', 'class34'),
(10, 'Anton', 'JOHNSON', 'male', '02 Yun Street 
leen, WI 54956', '8573322365', 'anton@aabc.com', 'stud14'),
(11, 'Xander', 'Riley', 'male', '903 High Drive 
Laurel, MD 20707', '8516345676', 'xander@ced.com', 'clair'),
(12, 'Bryan', 'Ellis', 'male', '5 Penn St. 
Mason City, IA 50401', '9517605678', 'ray@red.com', 'class1'),
(13, 'Brittany', 'Carr', 'female', '045 def boston MA', '9510305678', 'Mareli@ced.com', 'class2'),
(14, 'Marlee', 'Hester', 'female', '7 canton MA', '9512098567', 'rlee@ced.com', 'marlee'),
(15, 'Anaya', 'Mathews', 'female', '045 king road boston MA', '9512345678', 'mathews@ced.com', 'Anaya'),
(16, 'Eli', 'Francis', 'female', '045 bnm boston MA', '6112345610', 'franciseli@ced.com', 'eli345'),
(17, 'Aubrie', 'Montoya', 'female', '045 def boston MA', '9512995678', 'monau@ced.com', 'aumon34'),
(18, 'Jakobe', 'Potts', 'male', '23 ring road boston MA', '9512345678', 'jpotts@ced.com', 'pottsclass');


--
-- Table structure for table `course_master_univ`
--

CREATE TABLE IF NOT EXISTS `course_master_univ` (
  `course_id` varchar(11) NOT NULL,
  `course_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `course_description` longtext COLLATE utf8_unicode_ci NOT NULL,
   PRIMARY KEY (course_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Dumping data for table `course_master_univ`
--

INSERT INTO `course_master_univ` (`course_id`, `course_name`, `course_description`) VALUES
('CS682', 'Software Development Laboratory I','This is a laboratory course in which students, working in small groups, specify, design, implement, and document a large software project.There is a strong emphasis on process: the systematic use of an object-oriented development methodology based on UML models and incremental development is employed throughout each project.'),
('CS670', 'Artificial Intelligence','A broad technical introduction to the techniques that enable computers to behave intelligently: problem solving and game playing, knowledge representation and reasoning, planning and decision making, learning, perception and interpretation. The application of these techniques to real-world systems, with some programming in LISP.'),
('CS674', 'Natural Language Processing','The course provides the basic principles and theoretical issues underlying Natural Language Processing (NLP). It provides information on techniques and tools used to develop practical, robust systems that can communicate with users in multiple languages. The course will also provide insights into many open research problems in natural language such as information extraction, statistical corpus analysis, machine translation, speech processing, and text summarization.');

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` varchar(11) NOT NULL,
  `access_code` varchar(11) NOT NULL,
  `course_level` varchar(12) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `class_size` int(5) NOT NULL,
  `course_term` varchar(20)NOT NULL,
  `project_hours` int(11) NOT NULL,
  `place` varchar(25) NOT NULL,
  `org_type` varchar(25) NOT NULL,
  `org_area` varchar(25) NOT NULL,
  `file` varchar(25) NOT NULL,
  `org_commitments` longtext COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
   PRIMARY KEY (course_id),
   foreign key (course_id) references course_master_univ(course_id),
   foreign key (teacher_id) references teacher_master(teacher_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `access_code`, `course_level`, `start_date`, `end_date`, `class_size`, `course_term`, `project_hours`, `place`, `org_type`, `org_area`, `file`, `org_commitments`, `teacher_id`) VALUES
('CS682', 'DGJCDX', 'Graduate', '2018-05-30', '2018-07-05', 35, 'summer', 155, 'DORCHESTER', 'medium', 'Software', '19175-SRS_Example_1_2011.', 'Provide students access to gain input from management team, customers, suppliers and staff.', 1001),
('CS674', 'LDCS1U', 'Undergrad', '2018-05-26', '2018-06-28', 54, 'summer', 135, 'Boston', 'small', 'Information Technology', '16085-Whatley_425-433.pdf', 'Must be an organization with $5M+ in annual revenue, with a preference for companies with 50+ employees. Exceptions made for well-defined projects.', 1001),
('CS670', 'Y8JO9X', 'Graduate', '2018-04-03', '2018-07-12', 54, 'summer', 100, 'Boston', 'small', 'Marketing', '75782-SRS_Example_1_2011.', 'Be available for a quick phone call with the organizer to initiate your relationship and confirm your scope is an appropriate fit for the experience.', 1001);




--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assign_id` int(10) NOT NULL auto_increment,
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_size` int(11) NOT NULL,
  `course_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  primary key(assign_id),
  foreign key (teacher_id) references teacher_master(teacher_id),
  foreign key (course_id) references course(course_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `d_id` int(11) NOT NULL auto_increment,
  `course_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  `date_sent` datetime,
  foreign key (course_id) references course(course_id),
  primary key(d_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



--
-- Table structure for table `enrolled_master`
--

CREATE TABLE `enrolled_master` (
	`stud_id` int(11) NOT NULL,
 	`course_id` varchar(11) NOT NULL,
	`teacher_id` int(11) NOT NULL,
 	foreign key (teacher_id) references teacher_master(teacher_id) ON DELETE CASCADE,
    foreign key (course_id) references course(course_id) ON DELETE CASCADE,
	foreign key (stud_id) references student_master(stud_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enrolled_master`
--

INSERT INTO `enrolled_master`(`stud_id`, `course_id`, `teacher_id`) VALUES (1,'CS682',1001),(2,'CS682',1001),(3,'CS682',1001),(4,'CS682',1001),(5,'CS682',1001),(6,'CS682',1001),(7,'CS682',1001),(8,'CS682',1001),(9,'CS682',1001);


--
-- Table structure for table `project_request`
--

CREATE TABLE `project_request` (
  `request_id` int(10) NOT NULL auto_increment,
  `organization_id` int(11) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `project_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `nos` int(2) DEFAULT NULL,
  `comments` longtext COLLATE utf8_unicode_ci,
  `file` longtext COLLATE utf8_unicode_ci,
  foreign key (teacher_id) references teacher_master(teacher_id) ON DELETE CASCADE,
  foreign key (organization_id) references organization_master(organization_id) ON DELETE CASCADE,
  foreign key (course_id) references course(course_id) ON DELETE CASCADE,
  PRIMARY KEY (request_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Dumping data for table `project_request`
--


INSERT INTO `project_request`(`request_id`, `organization_id`, `status`, `teacher_id`, `title`, `project_description`, `course_id`, `nos`, `comments`, `file`) VALUES
(1, 10001, 1, 1001, 'A Web Platform to Connect Educators, Organizations and Students', 'This project seeks to provide a platform for educators, organizations and students to
connect and work on mutually beneficial projects, creating real world experience in the classroom.
The platform allows educators such as college professors to post classroom assignments/projects
(e.g. software development) with specified criteria. Organizations interested in leveraging the
skills of students in these classroom assignments, submit actual project that meets the criteria
specified by the educator. ','CS682','4','This is the test comments', '88197-Black.Panther.2018.720p.BluRay.x264-SPARKS.srt'),(2, 10002, 1, 1001, 'MITREid Connect', 'Students will focus on developing and enhancing the MITREid Connect project. As
an established project, students will work on providing new features to enhance functionality and
flexibility of the project going forward. This is a fairly established project with many possible
areas of engagement, depending on the interest and skills of students. ','CS682','4','This is the test comment for request Two', '98298-Panther.2018.SPARKS'),(3, 10003, 0, 1001, 'Software Development Robotics Visualization Platform', 'We are a small robotics company that is part of GDMS and design and manufacture
autonomous underwater vehicles. We make a class of hovering autonomous vehicles and are
looking to create a home grown simulation environment that can visualize the kinematics of the
underlying physical model and behavior of the robot. We do have a sensitivity around participants
having US citizenship but are willing to come to an agreement on a case by case basis. ','CS682','4','This is the test comment for request Three', '65793-Graduate_Degree_App_formatted_SUM2015_V6.pdf');





--
-- Table structure for table `projectpref`
--

CREATE TABLE `projectpref` (
  `stud_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  foreign key (`teacher_id`) references `project_request` (`teacher_id`) ON DELETE CASCADE,
  foreign key (`request_id`) references `project_request` (`request_id`) ON DELETE CASCADE,
  foreign key (`stud_id`) references `enrolled_master` (`stud_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



--
-- Table structure for table `student_choice`
--

CREATE TABLE `student_choice` (
  `stud_id` int(11) NOT NULL,
  `cno` int(3) NOT NULL,
  `request_id` int(10) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  FOREIGN KEY (`request_id`) REFERENCES `project_request` (`request_id`),
  foreign key (teacher_id) references teacher_master(teacher_id) ON DELETE CASCADE,
  foreign key (stud_id) references student_master(stud_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_choice`
--
INSERT INTO `student_choice`(`stud_id`, `cno`, `request_id`, `teacher_id`) VALUES (1,1,1,1001),(1,2,2,1001),(2,1,2,1001),(2,2,1,1001),(3,1,1,1001),(3,2,1,1001);




--
-- Table structure for table `linkedin`
--

CREATE TABLE `users_linkedin` (
 	`id` int(11) NOT NULL AUTO_INCREMENT,
 	`oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,	
 	`picture_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`profile_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`created` datetime NOT NULL,
 	`modified` datetime NOT NULL,
 	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci