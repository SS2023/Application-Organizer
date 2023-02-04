## PLEASE NOTE: For a more detailed explanation including images, please see the user guide in the documentation folder.

# Group5_FinalProject

This website serves as a tool to help people track their job or internship applications. The site contains a page to track completed applications, applications they would like to apply to, upcoming interviews, pending offers, and rejections. Users can move applications from the completed page to the rejections or offers page, and each page has the option to add more applications. 

## The Entry Point
Index.html is the entry point for both registered and unregistered users. It points to the home page, from which the only subsequent page which is accessible is the login page. Attempting to access pages that contain the site's main functionality from this page will redirect the user to the login page. The site was designed in this manner because without sign in information we cannot store the user’s information. Do not confuse index.html with index2.html. The second index page is what the user sees once they have logged in. We designed the site in this manner in order to provide users with information about their progress in the home page once logged in. As a result, making a similar but different index page was necessary.

This index page may be viewed by simply opening the index.html file from our source code. Do note however that no server-side functionality is possible using this method, so this should only be done to view the front end style of the website’s home page. This is not the recommended method, since the main functionality of the site will be inaccessible. The preferred method is outlined in the next section.

## Starting Application Organizer
> Step 1: Download XAMPP

XAMPP can be downloaded from the official Apache Friends website using the following link: https://www.apachefriends.org/download.html 

This tutorial will use version 7.4.29 for OSX, however similar steps can be used on other operating systems. XAMPP makes the installation process intuitive through their tutorials. After downloading has been completed, open the application and start all of the servers. 

> Step 2 - Copy Source Code folder into htdocs:

HTDOCS is where all programs for web pages that are being developed with XAMPP are stored.
Navigate to the github repository with this link: https://github.com/RaymondFeckoury/Group5_FinalProject

Option 1: 
Copy the https web url under the green “code” button. 
In your terminal, navigate to the htdocs directory and clone the git repository using: “git clone <url>”
Option 2:
Under the green “code” button, download the repository as a zip file. 
Move this zip file into your htdocs directory.

In your htdocs directory, you should now see a folder titled “Group5_FinalProject” containing all of the source code.

> Step 3 - Setting up the database:

Enter this command in phpmyadmin to create the database:

“CREATE DATABASE applicationOrganizer”

## Next, create and seed all the database tables by copying and pasting these commands from within the applicationOrganizer database:
## Alternatively, you can import the sql file which is in the same location as the source code. 

CREATE TABLE `userlist` (
 `username` varchar(100) NOT NULL,
 `password` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL,
 `reset_token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `saved` (
 `priority` int(11) NOT NULL,
 `company` text NOT NULL,
 `location` text NOT NULL,
 `jobTitle` text NOT NULL,
 `date` text NOT NULL,
 `workLocation` text NOT NULL,
 `comments` text NOT NULL,
 `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `rejections` (
 `company` text NOT NULL,
 `location` text NOT NULL,
 `jobTitle` text NOT NULL,
 `date` date NOT NULL,
 `comments` text NOT NULL,
 `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `offers` (
 `company` varchar(255) NOT NULL,
 `location` varchar(255) NOT NULL,
 `jobTitle` varchar(255) NOT NULL,
 `date` varchar(255) NOT NULL,
 `workLocation` text NOT NULL,
 `comments` varchar(255) NOT NULL,
 `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `interviews` (
 `company` varchar(255) NOT NULL,
 `location` varchar(255) NOT NULL,
 `jobTitle` varchar(255) NOT NULL,
 `date` varchar(100) NOT NULL,
 `comments` varchar(255) NOT NULL,
 `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `completed` (
 `company` varchar(255) NOT NULL,
 `location` varchar(255) NOT NULL,
 `jobTitle` varchar(255) NOT NULL,
 `date` varchar(255) NOT NULL,
 `workLocation` text NOT NULL,
 `comments` varchar(255) NOT NULL,
 `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


## Table Seeding
Finally, to initialize the tables with some sample data please insert the following commands:

INSERT INTO `completed` (`company`, `location`, `jobTitle`, `date`, `workLocation`, `comments`, `username`) VALUES
('NCR', 'Atlanta', 'SWE Intern', '2022-03-23', 'in-person', 'Really cool people.', 'user1'),
('Microsoft', 'Atlanta', 'SWE', '2022-04-15', 'remote', 'Apparently they have a really cool office here in ATL.', 'user1'),
('Google', 'Atlanta', 'SWE', '2022-03-26', 'unclear', 'Everyone is applying here haha.', 'user1'),
('CGI', 'Atlanta', 'SWE', '2022-04-23', 'hybrid', 'Seems like a good place to work ', 'user1'),
('Amazon', 'Seattle', 'SWE', '2022-04-10', 'unclear', 'Leetcode  ', 'user1'),
('Meta', 'Cali', 'SWE', '2022-04-12', 'in-person', 'stock is tanking ', 'user1'),
('Meta', 'Seattle', 'swe', '2022-05-01', 'remote', 'this is a comment.', 'user1'),
('Startup 1', 'SF', 'SWE', '2022-04-17', 'in-person', 'Cool startup.', 'user1'),
('Startup 2', 'SF', 'SWE', '2022-04-17', 'in-person', 'Another cool startup', 'user1'),
('Startup 1', 'ATL', 'SWE', '2022-04-23', 'in-person', 'Another location for the cool startup', 'user1'),
('BigCommerce', 'Tenessee', 'Full Stack Engineer', '2022-03-17', 'remote', 'Revolutionizing commerce', 'user1'),
('Alfred', 'New York', 'Front end engineer', '2022-03-24', 'in-person', 'Real Estate company.', 'user1'),
('Ascent', 'Chicago', 'SWE', '2022-04-18', 'hybrid', 'Fintech company', 'user1'),
('Dandy', 'New York', 'Data Analysis', '2022-04-22', 'unclear', 'Health tech company, cool stuff', 'user1'),
('Workiva', 'Florida', 'SWE', '2022-04-23', 'in-person', 'Cloud software company', 'user1'),
('NCR', 'Atlanta', 'SWE', '2022-03-17', 'hybrid', 'Met them at a hackathon', 'user2'),
('CNA', 'Chicago', 'SWE', '2022-03-10', 'remote', 'Insurance company', 'user2'),
('8fig', 'Austin', 'SWE', '2022-03-18', 'in-person', 'Ecommerce company.', 'user2'),
('Striveworks', 'Austin', 'SWE', '2022-03-23', 'in-person', 'AI company', 'user2'),
('Vouch Insurance', 'Chicago', 'SWE', '2022-05-01', 'hybrid', 'Business insurance company', 'user2'),
('Yotpo', 'North Carolina', 'SWE', '2022-03-25', 'unclear', 'Marketing tech company', 'user2'),
('Benchling', 'San Francisco', 'SWE', '2022-03-26', 'in-person', 'Healthcare tech company', 'user2'),
('NCR', 'Overseas', 'SWE', '2022-03-23', 'remote', 'Foreign language requirement might finally come in handy.', 'user1'),
('AccuWeather', 'Kentucky', 'Data Scientist', '2022-04-20', 'in-person', 'Would be cool to work with weather data.', 'user1'),
('Talkiatry', 'Fully Remote', '', '2022-04-17', 'remote', 'Serves a good cause', 'user1'),
('Workhuman', 'MA', 'ML Engineer', '2022-05-01', 'in-person', 'HR software. High pay for fully remote', 'user1'),
('Eso', 'Des Moines', 'Data Analyst', '2022-04-06', 'hybrid', 'Healthcare software company ', 'user1'),
('Medtelligent', 'Chicago', 'IT specialist', '2022-04-14', 'unclear', 'Upcoming HealthTech company that solves challenges around drug discounts in the US.', 'user1'),
('DreamBox Learning', 'Bellevue', 'SWE', '2022-04-10', 'remote', 'Edtech company, making tutoring software ', 'user1');

INSERT INTO `interviews` (`company`, `location`, `jobTitle`, `date`, `comments`, `username`) VALUES
('Company1', 'Atlanta', 'SWE', '2022-05-20', 'Get on the leetcode grind!', 'user1'),
('Company2', 'SF', 'SWE', '2022-05-15', 'Behavioral interview', 'user1'),
('Company3', 'Seattle', 'SWE', '2022-05-27', 'They like to ask system design questions.', 'user1'),
('Company4', 'Houston', 'Full Stack Engineer', '2022-06-03', 'Brush up on some web dev technologies beforehand.', 'user1'),
('Company5', 'Palo Alto', 'SWE', '2022-06-25', 'It would be cool to live in that area. They like to use python so be prepared for that.', 'user1');

INSERT INTO `offers` (`company`, `location`, `jobTitle`, `date`, `workLocation`, `comments`, `username`) VALUES
('Company1', 'Atlanta', 'SWE', '2022-04-14', 'in-person', 'Cool opportunity', 'user1'),
('Company2', 'Seattle', 'SWE', '2022-04-16', 'in-person', 'The housing costs though..', 'user1'),
('Company3', 'SF', 'SWE', '2022-03-17', 'in-person', 'Negotiating salary', 'user1'),
('Company4', 'New York', 'SWE', '2022-03-12', 'unclear', 'Sounds like a good time', 'user1'),
('Torii', 'New York', 'SWE', '2022-04-05', 'remote', 'software focused company, about 40 employees', 'user2'),
('Jellyvision', 'Chicago', 'SWE', '2022-04-19', 'unclear', 'HR tech software', 'user2'),
('Wing', 'Palo Alto', 'SWE', '2022-03-10', 'remote', 'IOT company', 'user2'),
('Aurora Solar', 'Fully Remote', 'SWE', '2022-02-18', 'remote', 'Fully remote company focused on having a positive social impact. Competitive pay and a lot of benefits.', 'user2'),
('Company5', 'Atlanta', 'Backend Engineer', '2022-04-15', 'hybrid', 'Good pay and benefits', 'user1'),
('Company 6', 'Palo Alto', 'Full Stack Engineer', '2022-04-22', 'hybrid', 'Pay is low for the cost of living ', 'user1'),
('Company 7 ', 'Chicago', 'Devops engineer', '2022-03-14', 'remote', 'Would have to learn a lot beforehand.', 'user1'),
('Company 8', 'Austin', 'Front end engineer', '2022-04-09', 'unclear', 'Know some alumni there', 'user1'),
('Company 9 ', 'Atlanta', 'Backend engineer', '2022-03-08', 'in-person', 'Pay is low but it would be nice to stay in the state', 'user1'),
('Company 10', 'Atlanta', 'SWE', '2022-04-28', 'in-person', 'Very good offer.', 'user1'),
('Company11', 'Seattle', 'SWE', '2022-04-29', 'unclear', 'Very good offer.', 'user1');

INSERT INTO `rejections` (`company`, `location`, `jobTitle`, `date`, `comments`, `username`) VALUES
('Google ', 'SF', 'SWE', '2022-02-02', 'Very tough interviews', 'user1'),
('Meta', 'SF', 'SWE', '2022-03-17', 'Gave it a try', 'user1'),
('Invicti', 'Austin TX', 'SWE', '2022-03-16', 'cool software security company', 'user1'),
('Apollo', 'Fully Remote', 'Software Engineer', '2022-04-13', 'Seems like a good team', 'user1'),
('Startup 2', 'Alabama', 'SWE', '2022-04-25', 'Another location for another cool startup...', 'user1');

INSERT INTO `saved` (`priority`, `company`, `location`, `jobTitle`, `date`, `workLocation`, `comments`, `username`) VALUES
(1, 'Syndigo', 'Atlanta', 'SWE', '2022-05-14', 'in-person', 'Focused on marketing tech and analytics. Make sure to emphasize personal project based on retail.', 'user1'),
(2, 'TravelPerk', 'Boston', 'SWE', '2022-05-21', 'in-person', 'IOT software company. Talk about experience traveling and personal project on the topic.', 'user1'),
(3, 'CodeSignal', 'Fully Remote', 'SWE', '2022-05-28', 'in-person', 'Very flexible work style. HR tech company. About 80 employees', 'user1'),
(4, 'Kalderos', 'Chicago', 'SWE', '2022-04-11', 'in-person', 'HealthTech company that solves challenges around drug discounts in the US.', 'user1'),
(5, 'Pawp', 'Brooklyn', 'SWE', '2022-05-29', 'in-person', 'A digital clinic for pets.', 'user1'),
(6, 'Blind', 'Austin TX', 'SWE', '2022-06-04', 'remote', 'Fintech company focused on payments and real estate.', 'user1'),
(7, 'Insurify', 'Cambridge', 'SWE', '2022-07-01', 'in-person', 'Online insurance marketplace.', 'user1'),
(8, 'OpenWeb', 'New York', 'SWE', '2022-06-21', 'in-person', 'News, entertainment, social media, \"elevating quality conversations\"', 'user1'),
(9, 'BlueVine', 'Gretna', 'SWE', '2022-08-11', 'in-person', 'Empowering small businesses with innovative banking designed for them.', 'user1'),
(10, 'Gearset', 'Chicago', 'SWE', '2022-05-21', 'remote', 'Working fully remotely would be nice.', 'user1');

INSERT INTO `userlist` (`username`, `password`, `email`, `reset_token`) VALUES
('user1', '$2y$10$9n6GItbvmKtljH4p8MHeoOS.J8Uh7ge5RpFLX2KCinXtHNfPMIzXq', 'raymondfeckoury@icloud.com', '16516779597a4d6853a9f967c7d3957ff8c9fc59a1'),
('user2', '$2y$10$Bhw8bwbpwqGPEaYLW.jmNekpAz5etHnJTh9IHomTq2UVljl.yd/3C', 'email@email.com', ''),
('user3', '$2y$10$0NmxWz.WRju5wWMOcuLJ2uqTiqhTT3/0aEs4USZLulLNn2/kYcp9O', 'fakeemail@email.com', '');
COMMIT;

## The database is now seeded with data that demonstrates the site's functionality.

> Opening Application Organizer:

In XAMPP, click “go to application,” and replace the URL with localhost/Group5_FinalProject. Please note that this URL may change in response to the port being used.

From this URL, click "source code," then "HTML," and then you will see our landing page. 

## Log in with the following account information:

## Username: user1, Password: password123

# Functionality:

> Account Functionality:

Create a new account with username, email, password.
Email a link to reset password if the user forgets their login information. 
Reset password once logged in.

> Security/Validation:

Passwords are hashed.
All forms are validated using PHP and/or JavaScript. 
Passwords have a minimum length requirement. 
Session variables are used to track the user.

> Site features:

Save applications you would like to apply to in the future along with the deadline and a priority field that the user enters.
Add and view completed applications.
Move applications from completed to accepted or rejected.
Save upcoming interviews along with their respective dates.

# Operating Systems and browsers

> Operating Systems:

Mac OSX
Windows

> Browsers:

Safari
Chrome

# Libraries and frameworks

Application Organizer was created using HTML, CSS, Bootstrap, Google Font API, vanilla JavaScript, PHP, and MySQL.

# Starter code

No starter code was used, all source code is available at the github repository.

# Directory structure

An image is provided in the user guide.



