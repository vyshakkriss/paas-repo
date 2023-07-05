 <?php


/**
 * Profile Controller
 */
class Profile extends Controllers
{
	
	function index()
	{
		$url = $_GET['url'];
		$url = explode('/', $url); 
		$username = $url[0];
		$users = new Users();
		$data['errors'] = [];
			
		//show($_SESSION['user_row']); // To show the session data
		if(Auth::logged_in() && $username == Auth::getUser('username'))
		{
			
			//show($_SESSION['user_row']); // To show the session data after update
			$username = Auth::getUser('username');
			$row = $users->where(['username'=>$username])[0];
			if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
			{
				
				if($users->updateValidate($_POST))
				{
					$folder = "assets/img/profile/";
					if(!file_exists($folder))
					{
						mkdir($folder,0777,true);
						file_put_contents($folder."index.php", "Access Denied");
						file_put_contents("img/index.php", "Access Denied");
						file_put_contents("assets/index.php", "Access Denied");
					}

					$allowedType = ['image/jpeg','image/png'];
					//echo $_FILES['image']['name'];
					if(!empty($_FILES['image']['name']) && $_FILES['image']['name']!='')
					{
						if($_FILES['image']['error'] == 0)
						{
							if(in_array($_FILES['image']['type'], $allowedType))
							{
								$destination = $folder.time().$_FILES['image']['name'];	
								move_uploaded_file($_FILES['image']['tmp_name'], $destination);
								resize_image($destination);
								$_POST['image'] = $destination;
								if(file_exists($row->image))
									unlink($row->image);

							}
							else
							{
								$users->errors['type'] = "This Image type is unsupported";
							}
						}
						else
						{
							$users->errors['image'] = "Error in uploading the image! Try again.";
						}
					}
					else
					{
						unset($_POST['image']);
					}
					if(count($users->errors)==0)
					{
						$users->update($_POST,['user_id'=>Auth::getUser('user_id')]);
						//message("Updated Successfully");
						//redirect($_POST['username']);
					}
				

				}
				if(count($users->errors)==0)
					$arr['message'] = "Yolo";
				else
				{
					$arr['message'] = "Something went wrong!";
					$arr['error'] = $users->errors;
				}
				//echo $_FILES['image']['name'];
				echo json_encode($arr);
				die;	
			}

			
		}
		$data['errors'] = $users->errors;
		$data['username'] = $username;
		$data['user_row'] = $users->where(['username'=>$username])[0];
		$data['title'] = $username;
		
		$this->view('profile/profile.profile',$data);
	}
}