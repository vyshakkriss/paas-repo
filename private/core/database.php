<?php

/**
 * Database class
 */
class Database
{
	
	private function connect()
	{
		$connectionString = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
		$con = new PDO($connectionString,DBUSER,DBPASS);
		return $con;
	}

	public function query($query,$data = [] , $type = 'object')
	{

		$con = $this->connect();

		$stm = $con->prepare($query);
		if($stm)
		{
			$check = $stm->execute($data);

			if($check)
			{
				if($type!='object')
					$type = PDO::FETCH_ASSOC;
				else
					$type = PDO::FETCH_OBJ;

				$result = $stm->fetchAll($type);
			}

			if(is_array($result) && count($result) > 0)
			{
				//show($result);
				return $result;
			}
		}

		return false;
	}


	public function create_table()
	{
		$query = "
			  CREATE TABLE IF NOT EXISTS `users` (
			 `sno` int(11) NOT NULL AUTO_INCREMENT,
			 `name` varchar(300) NOT NULL,
			 `password` varchar(300) NOT NULL,
			 `email` varchar(300) NOT NULL,
			 `user_url` varchar(500) NOT NULL,
			 `username` varchar(300) NOT NULL,
			 `goals` varchar(300) NOT NULL,
			 PRIMARY KEY (`sno`),
			 KEY `email` (`email`),
			 KEY `user_url` (`user_url`),
			 KEY `username` (`username`)
			) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4


		";

		$this->query($query);
	}
}