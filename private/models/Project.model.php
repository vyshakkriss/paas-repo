<?php

/**
 * Projects Model
 */
class Project extends Models
{
	
	public $errors = array();
	protected $table = "projects";

	protected $afterSelect = [
		'get_user_details',
		'get_guide_details'
	];
	protected $allowedCols = [
		'pid',
		'projectname',
		'date',
		'gid',
		'uid',
		'section',
		'status'
	];
	protected $beforeInsert = [
		'set_repetitive_status'
	];
	function tasksValidate($data)
	{
		// code...
		extract($data);

		if(count(emptyCheck($data))==0)
		{
			if(strlen($task_name) > 300)
			{
				$this->errors['task_name'] = "Task Name should less than 300 characters. ";
			}
			if(strlen($task_desc) > 512)
			{
				$this->errors['task_desc'] = "Task Descrption should less than 500 characters. ";
			}
			if($task_max_time < 0 || $task_max_time > 512)
			{
				$this->errors['task_max_time'] = "Maximum time limit should be more than Zero and Less than 512 minutes!";
			}
			if($task_lastdate < date("Y-m-d") )
			{
				$this->errors['task_lastdate'] = "Invalid Date! Please select a proper date!";
			}
			if(isset($_POST['repitation']))
			{
				
				if(empty($repetitive))
				{
					$this->errors['repetation'] = "Select the days to repeat the task.";
				}
				else
				{
					$_POST['repetitive'] = set_repetitive_value($repetitive);
				}
			}
			else
			{
				$_POST['repetitive'] = "0";
			}
			if(isset($_POST['goal']))
			{
				if(empty($goals))
				{
					$this->errors['goals'] = "Select a goal to continue!";
				}
				else
				{
					$_POST['goal_id'] = $goals;
					unset($goals);
				}
			}
			else
			{
				$_POST['goal_id'] = "0";
			}
	
		}
		else
		{
			$errs = emptyCheck($data);
			//show($errs);
			foreach ($errs as $key => $value) 
			{
				// code...
				$this->errors[$key] = $value;
			}
		}
		
		if(count($this->errors)==0)
			return true;
		return false;
	}

	// protected function get_userid($rows)
	// {
	// 	$users = new Users();
	// 	if(!empty($rows[0]->user_id))
	// 	{	
	// 		$user_details = $users->where(['user_id'=>$rows[0]->user_id])[0];
	// 		if(!empty($user_details))
	// 		{
	// 			foreach ($rows as $key => $value) 
	// 			{
	// 				$rows[$key]->user_data = $user_details; 

	// 			}
	// 		}
	// 	}
	// 	//$rows = $user_details;
	// 	return $rows;
	// }

	protected function get_user_details($row)
	{
		$users = new Users();
		for ($i=0; $i < sizeof($row); $i++) 
		{ 
			// code...
		
			if(!empty($row[$i]->uid))
			{	
				$user_row = $users->where(['user_id'=>$row[$i]->uid]);
				//show($user_row);
				if(!empty($user_row))
				{
					
						$row[$i]->student_row = $user_row[0]; 

					
				}
			}

		}
		//row = $user_row;
		return $row;
	}
	protected function get_guide_details($row)
	{
		$users = new Users();
		
		//show($row);

		for ($i=0; $i < sizeof($row); $i++) 
		{ 
			// code...
		
			if(!empty($row[$i]->gid))
			{	
				//echo $row[$i]->gid;
				$user_row = $users->where(['user_id'=>$row[$i]->gid]);
				//show($user_row);
				if(!empty($user_row))
				{
					
						$row[$i]->guide_row = $user_row[0]; 

					
				}
			}
		}
		//show($row);
		return $row;
	}
	// protected function get_user_goal($rows)
	// {
	// 	$goals = new Goal();
			
	// 		$goal_details = $goals->where(['user_id'=>$rows[0]->user_id]);
	// 		if(!empty($goal_details))
	// 		{
	// 			foreach ($rows as $key => $value) 
	// 			{
	// 				$rows[$key]->user_goal_row = $goal_details; 

	// 			}
	// 		}
		
	// 	//$rows = $user_details;
	// 	return $rows;
	// }

	public function get_project_progress_data($row,$id="")
	{
		$project_progress = new Projectprogress();
		$project = new Project();
		$users = new Users();

		$uid = Auth::getUser('user_id');
		if(Auth::getUser('role')!=3)
		{
					$user_id = $users->where(['user_id' => $id]);
					//show($user_id);
					//die();
					$user_id = $user_id[0]->user_id;
		}
		if(Auth::getUser('role')==3)
		{
			$project_progress_row = $project_progress->query("select * from projectprogress where uid = ".$uid." and status = 1");
			$project_row = $project->query("select * from projects where  uid = ".$uid);

		}
		else
		{
			$project_progress_row = $project_progress->query("select * from projectprogress where gid = ".$uid." and uid = ".$user_id. " and status = 1");
			$project_row = $project->query("select * from projects where gid = ".$uid." and uid = ".$user_id);
			
		}

		// //echo $pid;
		// //die();
		// //show($project_row);
		// if(Auth::getUser('role') != 3)
		// {
		// 	$project_progress_row = $project_progress->query("select * from projectprogress where uid = ".$uid." and pid = ")
		// }
		//show(end($project_progress_row));
		//die();
		if(!empty($project_progress_row))
		{
			foreach ($row as $key => $value) 
			{
				$row[$key]->project_progress_row = $project_progress_row; 

			}
		}
		//show($row);
		if(!empty($project_row))
		{
			foreach ($row as $key => $value) 
			{
				$row[$key]->project_row = $project_row[0]; 

			}
		}
		
		//show($row);
		//die();
		return $row;
	}

	
}