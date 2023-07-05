<?php

/**
 * Projects Model
 */
class Stages extends Models
{
	
	public $errors = array();
	protected $table = "stages";

	protected $afterSelect=[
		'get_stage_value'
	];
	protected $allowedCols = [
		'stageid',	
		'stagename',	
		'substagename'
	];
	
	public function get_stage_value($row)
	{

		// $project = new Project();
		// $project_progress = new Projectprogress();

		// $uid = Auth::getUser('user_id');

		
		// if(Auth::getUser('role')==3)	
		// 	$project_row = $project->where(['uid'=>$uid]);
		// else
		// 	$project_row = $project->where(['gid'=>$uid]);

		// // $pid = $project_row[0]->pid;
		// // //echo $pid;
		// // //die();
		// // //show($project_row);
		// // if(Auth::getUser('role') != 3)
		// // {
		// // 	$project_progress_row = $project_progress->query("select * from projectprogress where uid = ".$uid." and pid = ")
		// // }

		// if(!empty($project_row))
		// {
		// 	foreach ($row as $key => $value) 
		// 	{
		// 		$row[$key]->project_row = $project_row[0]; 

		// 	}
		// }
		return $row;
	}

	public function get_project_progress_data($row,$username)
	{

		$project_progress = new Projectprogress();
		$project = new Project();
		$users = new Users();

		$uid = Auth::getUser('user_id');
		if(Auth::getUser('role')!=3){
					$user_id = $users->where(['username' => $username]);
					//show($user_id);
					//die();
					$user_id = $user_id[0]->user_id;}
		if(Auth::getUser('role')==3)
		{
			$project_progress_row = $project_progress->query("select * from projectprogress where uid = ".$uid);
			$project_row = $project->query("select * from projects where  uid = ".$uid);

		}
		else
		{
			$project_progress_row = $project_progress->query("select * from projectprogress where gid = ".$uid." and uid = ".$user_id);
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
				$row[$key]->project_progress_row = end($project_progress_row); 

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