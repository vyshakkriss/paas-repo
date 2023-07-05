<?php

/**
 * Progress Controller
 */
class Progress extends Controllers
{
	
	public function index()
	{
		// code...;
		$data['title'] = "Progress";
		$data['errors'] = [];

		if(!Auth::logged_in())
		{
			ErrorMessage('login');
		}

		$this->view("profile/profile.progress",$data);
	}
}