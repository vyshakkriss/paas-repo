<?php

/**
 * Search Class
 */
class Search extends Controllers
{
	
	public function index()
	{
		// code...
		$url = $_GET['url'];
		$url = explode('/', $url); 
		$username = $url[0];
		
		$viewname = "private/views/search.view.php";
		require($viewname);
	}
}