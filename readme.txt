Assignment 2 of Programming for the Web 2.


Setup to work:


1) Set database parameters: at file classes/Database.php,
There are 2 variables for setting the user and password for database. Also the database name and host
can be configured at the line 14 of this class.

$conn = new PDO("mysql:host=localhost;dbname=assignment2", $user, $password);



2) create database:

with the file setup.php you have the code to generate all the database necessary to run this application.

It will be created the admin user, and some other normal users:

username: john@google.com
password: test



Lafayette Pinheiro
150262