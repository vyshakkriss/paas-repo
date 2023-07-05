<?php

//APP NAME AND DESC
define('APP_NAME', "PAAS");
define('APP_TAG', "An Application to keep your project work updated.");
define('APP_DESC', "<i>Pass your exams with ease, using PAAS! </i>");
define('APP_AUTHOR', 'Vyshak Kriss');




//show($_SERVER);
if($_SERVER['SERVER_NAME'] == "localhost:8000")
{
	//DATABASE CONNECTION
	define('DBNAME', 'tudu_db');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');
	define('DBHOST', 'localhost');

	//ASSETS AND ROOT
	define('ROOT', "http://localhost:8000/sekarindustry");
	define('ASSETS', "http://localhost:8000/sekarindustry/assets");
}
else
{
	define('DBNAME', 'tudu_db');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');
	define('DBHOST', 'localhost');

	//ASSETS AND ROOT
	define('ROOT', "http://localhost:8000/sekarindustry");
	define('ASSETS', "http://localhost:8000/sekarindustry/assets");
}