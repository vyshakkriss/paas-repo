<?php 

/**
 * Logout Controller
 */
class Logout extends Controllers
{
	
	public function index()
	{
	
		Auth::logout();
		redirect('login');
	}
	

}