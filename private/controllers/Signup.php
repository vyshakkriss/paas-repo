<?php

/**
 * Signup Class
 */
class Signup extends Controllers
{
	
	public function index()
	{
		// code...
		$data['title'] = "Signup";
		$users = new Users();
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($users->validate($_POST))
			{
				//show($_POST);
				$_POST['goals'] = '0';
				$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$_POST['username'] = username($_POST['name']);
				$users->insert($_POST);
				message("Registration Complete. Login using your credentials");
				redirect('login');
			}
			
		}
		$data['errors'] = $users->errors;			
		$this->view('signup',$data);

		

	}
	

}