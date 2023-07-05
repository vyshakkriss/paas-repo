	<?php 

/**
 * Home Controller
 */
class Studentupload extends Controllers
{
	
	public function index($id="", $stats="")
	{
		// code...
		$data['title'] ="Student Upload";
		$data['id'] = "home";
		if(Auth::logged_in())
		{
			
			$username = $id;
			$users = new Users();
			$data['student_row'] = $users->where(['username' => $username]) ;

			$q="select user_id from users where username = $username";
			$userid = $users->query($q)[0]->user_id;
			
			$project_progress = new Projectprogress();
			$data['project_progress_row'] = $project_progress->where(['uid'=>$userid]);

			$project = new Project();
			$data['project_row'] = $project->where(['uid'=>$userid]);

			$stages = new Stages();
			$data['stage_row'] = $stages->showAll();

			// $uploads = new Uploads();
			// $data['upload_row'] = $uploads->where(['uid'=>$userid]);

			// show($data['upload_row']);
			//show($data['student_row']);
			//show($data['project_row']);
			//show($data['project_progress_row']);
			//show($data['stage_row']);
			$stages->get_project_progress_data($data['stage_row'] ,$id);
			//show($stages); 
			//die();
			if($stats == "stats")
				$this->view('profile/profile.studentuploadstats',$data);
			else
				$this->view('profile/profile.studentupload',$data);
		}
		else
		{
			
			
			$this->view('home',$data);
		}

	}
	
	

}