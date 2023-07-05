<?php

/**
 * Signin Class
 */
class Login extends Controllers
{
	
	public function index()
	{
		$data['title'] = "Login";
		$data['errors'] = [];
		$users = new Users();
		if($_POST)
		{
			if($users->loginValidate($_POST))
			{
				$row = $users->where([
					'username' => $_POST['name']
				]);
			
				if($row)
				{

					if($_POST['password']== $row[0]->password) 
					{
						
						Auth::authenticateUser($row[0]);	
						redirect('home');
					}
				}

				message("Incorrect Username or Password");
				//$users->errors['name'] = "Incorrect Username or password"; 

			}		

		}
		$data['errors'] = $users->errors;
		$this->view('login',$data);
	}
	

}