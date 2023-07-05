<?php 
/**
 * User Model
 */
class Users extends Models
{
	
	public $errors = array();
	protected $table = "users";

	
	protected $allowedCols = [
			
			'user_id',	
			'name',	
			'password',	
			'email',	
			'gid',	
			'username',	
			'role',	
			'guidedsg',	
			'guidedegree',	
			'prefix',	
			'uploads',	
			'class',	
			'year',	
			'stage',
			'approved'	
	];
	public function validate($data,$errorCount = 0)
	{
		extract($data);
		$this->errors = [];
		if(empty($name) )
		{
			$this->errors['name'] = "Name cannot be empty.";
		}

		if(empty($password))
		{
			$this->errors['password'] = "Password cannot be empty.";
		}

		if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL) )
		{
			$this->errors['email'] = "Email is not valid.";
		}
		else
		{
			
			if($this->where(['email'=>$email]))
			{
				$this->errors['email'] = "This email already exists";
			}
		}

		
		if(empty($check) )
		{
			$this->errors['check'] = "The checkbox should be checked.";
		}

				

		if(empty($this->errors))// || count($this->errors) <= $errorCount)
		{
			return true;
		}
		return false;
	}

	public function loginValidate($data)
	{
		extract($data);
		$this->errors = [];
		if(empty($name) )
		{
			$this->errors['name'] = "Name cannot be empty.";
		}

		if(empty($password))
		{
			$this->errors['password'] = "Password cannot be empty.";
		}
		if(empty($check) )
		{
			$this->errors['check'] = "The checkbox should be checked.";
		}
		
		if(empty($this->errors))// || count($this->errors) <= $errorCount)
		{
			return true;
		}
		return false;
	}


	public function updateValidate($data)
	{
		extract($data);
		$this->errors = [];
		if(empty($name) )
		{
			$this->errors['name'] = "Name cannot be empty.";
		}

		if(empty($email))
		{
			$this->errors['email'] = "Email Cannot be empty!";
		}

		if(empty($username))
		{
			$this->errors['username'] = "Username cannot be empty";
		}
		else
		{
			if(!preg_match("/^[a-zA-Z0-9]+$/", $username))
			{
				$this->errors['username'] = "Username cannot have spaces or any other symbols!";
			}
		}

		if(empty($this->errors))// || count($this->errors) <= $errorCount)
		{
			return true;
		}
		return false;

	}
	public function get_student_project_details($row)
	{

		$projects = new Project();
		for ($i=0; $i < sizeof($row); $i++) 
		{ 
			// code...
		
			if(!empty($row[$i]->user_id))
			{	
				$project_row = $projects->where(['uid'=>$row[$i]->user_id]);
				//show($user_row);
				
				if(!empty($project_row ))
				{
					
						$row[$i]->project_row = $project_row;
					
				}
			}

		}
		
		return $row;
	}

	public function get_list_of_students_of_guide($row)
	{


		for ($i=0; $i < sizeof($row); $i++) 
		{ 
			// code...
		
			if(!empty($row[$i]->user_id))
			{	
				$user_row = $this->where(['gid'=>$row[$i]->user_id]);
				//show($user_row);
				
				if(!empty($user_row))
				{
					
						$row[$i]->student_row = $user_row; 

					
				}
			}

		}
		//show($row);
		//die();
		//row = $user_row;
		return $row;
	}
}