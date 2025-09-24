# Web_Scripting_Cahilig

Setup Instructions

1. Download and place this project folder inside the htdocs directory (if using XAMPP).
2. Open phpMyAdmin and create a database named: cs15_activity2
3. Run the following SQL to create the required table(s):

   CREATE TABLE users (
           user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
           name VARCHAR(127) NOT NULL,
           email VARCHAR(127) NOT NULL UNIQUE,
           username VARCHAR(127) NOT NULL UNIQUE,
           password VARCHAR(127) NOT NULL,
           gender VARCHAR(127) NOT NULL,
           hobbies VARCHAR(127),
           country VARCHAR(127) NOT NULL
   );
5. That's all!
