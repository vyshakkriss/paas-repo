	<?php 

/**
 * Home Controller
 */
class Projectupload extends Controllers
{
	
	public function index($id="")
	{
		// code...
		$data['title'] =  "Your Project";
		$data['id'] = "projectupload";
		$data['errors'] = [];	

		if(Auth::logged_in())
		{

			$user_id = Auth::getUser('user_id');
			$projects = new Project();
			$project_progress = new Projectprogress();
			$data['project_row'] = $projects->where([
				'uid' => $user_id
			]);
			
			//$con=['='];
			$stages = new Stages();
			$data['stage_row'] = $stages->showAll();

			// $uploads = new Uploads();
			// $data['upload_row'] = $uploads->where(['uid'=>$user_id]);

			$data['project_progress_row'] = $project_progress->query("select * from projectprogress where uid = ".$user_id);
			$stages->get_project_progress_data($data['stage_row'] ,$id);
			
			//show($stages);
			//die();
			if($id=='abstract')
				$this->view('profile/profile.projectupload.abstract',$data);
			else
				$this->view('profile/profile.projectupload',$data);
		}
		else
		{
			
			
			$this->view('home',$data);
		}



	}
	public function uploads($file='')
	{
		$data['title'] =  "Your Project";
		$data['id'] = "projectupload";
		if($file=='abstract')
		{
			$fileupload = new Uploads();
			if($fileupload->uploadValidate($_POST))
			{
				//show($_POST);
				$_POST['stagecontent'] = $_POST['abstract'];
				//$_POST['stage']
				//show($_POST['stagename']);
				//die();
				$_POST['uid'] = AUTH::getUser('user_id');
				$_POST['gid'] = AUTH::getUser('gid');
				$_POST['date'] = date("Y/m/d");
				$_POST['section'] = 6;

				//$_POST['project']
				$projects = new Project();
				$projects->insert($_POST);

				$_POST['pid'] = $projects->where(['uid' => $_POST['uid']])[0]->pid;
				//$fileupload->insert($_POST);

				$project_progress = new Projectprogress();

				$_POST['stagename'] = "Abstract";
				$_POST['remark'] = "Pending for Approval"; 
				//show($_POST);
				$project_progress->insert($_POST);



				//die();	
				redirect('home');
				

				
				
			}
			else
			{
				$data['errors'] = $fileupload->errors;
				$this->view('profile/profile.projectupload.abstract',$data);
			}
		}
		else
		{
			$this->view('profile/profile.projectupload',$data);
		}
	}

	

}