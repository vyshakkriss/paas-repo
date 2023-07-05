<?php

/**
 * Goals Controller
 */
class Projects extends Controllers
{
	
	public function index()
	{
		// code...
		$data['title'] = "Projects";
		$data['errors'] = [];
		if(!Auth::logged_in())
		{	
			ErrorMessage('login');
		}
		
		$project_progress = new Projectprogress();
		$projects = new Project();
		$data['non_approved_projects_row'] = $projects->where(['approved'=>0]);
		$data['approved_projects_row'] = $projects->where(['approved'=>1]);
		//show($data['non_approved_projects_row']);
		//die();
		//show($data['approved_projects_row']);
		
		
		$this->view('profile/profile.projects',$data);
	}
}