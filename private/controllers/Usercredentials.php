	<?php 

/**
 * Home Controller
 */
class Usercredentials extends Controllers
{
	
	public function index($id="")
	{
		// code...
		$data['title'] = "Student User Credentials";
		$data['id'] = "home";
		if(Auth::logged_in() && Auth::getUser('role') == 1)
		{
			
			
			$user_id = Auth::getUser('user_id');
			if($_POST)
			{
				$users = new Users();
				for($i=1;$i<=$_POST['maxvalue'];$i++)
				{
					$username = $_POST['prefix'].$_POST['middle'];
					if($i<10)
						$username.='0';
					$username.=$i;
					$_POST['username'] = $username;
					$_POST['password'] = $username;
					$_POST['role'] = 3;

					if(!$users->where(['username'=>$username]))
					{
						$users->insert($_POST);
						message(($i)." Users Credentials Created", true);
					}
					else
						message("User Credentials already exists.", true);
				}
				
					
				
			}	

			$this->view('profile/profile.admin.usercredentials',$data);
		}
		else
		{
			
			
			$this->view('home',$data);
		}

	}
	

}