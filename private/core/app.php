<?php

/**
 * Main App
 */
class App 
{
	

	protected $controller = "_404";
	protected $method = "index";
	protected $params = array();
	function __construct() 
	{
		// code...
		$URL = $this->getURL();
		$users  = new Users();
		$filename = "private/controllers/".ucfirst($URL[0]).".php";
		if(file_exists($filename))
		{
			//Loading the Controller.
			require $filename;
			$this->controller = $URL[0];
			//echo $this->controller;
			unset($URL[0]);
		} 
		elseif($users->where(['username'=>$URL[0]]))
		{
			//echo "hel";
			require "private/controllers/Profile.php";
			$this->controller = 'profile';
			unset($URL[0]);
		}
		else
		{
			//Loading 404 file
			require "private/controllers/".$this->controller.".php";
		}

		$this->controller = new $this->controller;

		$methodname = $URL[1] ?? 'index'; //If $URL[1] is set, $methodname = $URl[1] or then 'Index.'
		if(method_exists($this->controller, $methodname))
		{
			//Loading the method.
			$this->method = $methodname;
			unset($URL[1]);
		}
		//if method is not found, it will take _404 as the method, and call the 404 page.

		$URL = array_values($URL);
		$this->params = $URL;

		if(Auth::logged_in())
		{
			Auth::authenticate(Auth::getUser('user_id'));
		}
		call_user_func_array([$this->controller,$this->method], $this->params);
	}
	private function getURL()
	{
		$url = $_GET['url'] ?? 'home'; // Getting the URL after domain name 
		$url = filter_var(trim($url,"/"),FILTER_SANITIZE_URL); // Filtering the url for empty spaces and trimming empty spaces and slashes at the end and start of the string.
		$arr = explode('/', $url); // Converting the url into array
		return $arr	;

	}
}