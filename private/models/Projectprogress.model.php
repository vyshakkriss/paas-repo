<?php

/**
 * Projects Model
 */
class Projectprogress extends Models
{
	
	public $errors = array();
	protected $table = "projectprogress";

	
	protected $afterSelect = [
		'get_user_details',
		'get_guide_details',
		'get_project_details'
	];
	protected $allowedCols = [
		'aid',
		'pid',
		'uid',
		'gid',
		'stage',
		'stagename',
		'status',
		'remark',
		'date',
		'stagecontent'
	];
	
	
	protected function get_user_details($row)
	{

		$users = new Users();
		
		if(!empty($row[0]->uid))
		{	
			$user_row = $users->where(['user_id'=>$row[0]->uid]);
			if(!empty($user_row[0]))
			{
				foreach ($row as $key => $value) 
				{
					$row[$key]->user_row = $user_row[0]; 

				}
			}
		}
		//row = $user_row;
		return $row;
	}
	protected function get_guide_details($row)
	{
		$users = new Users();
		
		if(!empty($row[0]->gid))
		{	
			$user_row = $users->where(['user_id'=>$row[0]->gid]);
			if(!empty($user_row[0]))
			{
				foreach ($row as $key => $value) 
				{
					$row[$key]->guide_row = $user_row[0]; 

				}
			}
		}
		//row = $user_row;
		
		return $row;
	}
	protected function get_project_details($row)
	{

		$project = new Project();
		
		if(!empty($row[0]->pid))
		{	
			$project_row = $project->where(['pid'=>$row[0]->pid]);
			if(!empty($project_row[0]))
			{
				foreach ($row as $key => $value) 
				{
					$row[$key]->project_row = $project_row[0]; 

				}
			}
		}
		//row = $user_row;
		//show($row);
		//die();
		return $row;
	}
	
	

	
}