	<?php 

/**
 * Home Controller
 */
class Home extends Controllers
{
	
	public function index($id="")
	{
		// code...
		$data['title'] =  "Home";
		$data['id'] = "home";
		if(Auth::logged_in())
		{
			
			//show($data['task_list']);
				//die();
			
			
			$user_id = Auth::getUser('user_id');
			
			$users = new Users();
			$gid = Auth::getUser('gid');
			
			$data['guide_row'] = $users->where(['user_id' => $gid]);

			$projects = new Project();
			$data['project_row'] = $projects->where([
				'uid' => $user_id
			]);

			$project_progress = new Projectprogress();
			$data['project_progress_row'] = $project_progress -> where([
					'uid' => $user_id
				]);


			$data['student_row'] = $users->where(['gid' => $user_id]);
			//$data['student_project_row'] = $projects->where(['gid' => $user_id]);
			if(!empty($data['student_row']))
			{
				$data['student_project_row']= $users->get_student_project_details($data['student_row']);
			}
			
		//	show($data['project_progress_row']);
			//show($data['student_row'] );
			//show($data['student_project_row']);
		//	die();	
			//show($data['project_progress_row']);
			//show($data['guide_row']);
			//show($data['project_row']);
			// die();
			$this->view('profile/profile.home',$data);
		}
		else
		{
			
			
			$this->view('home',$data);
		}

	}
	// public function task($task_url="")
	// {
	// 	$tasks = new Tasks();
	// 	$days = new Days();
	// 	if(Auth::logged_in() )
	// 	{
	// 		if($task_url!="")
	// 		{
				
	// 			if($_SERVER['REQUEST_METHOD']=="POST")
	// 			{
	// 				//Update Option request
	// 				if (isset($_REQUEST['update'])) 
	// 				{
						
	// 					unset($_POST['update']);
	// 					if($tasks->tasksValidate($_POST))
	// 					{
							
	// 						//show($_POST);
	// 						$_POST['task_url'] = str_to_url($_POST['task_name']);
	// 						$query = 'select task_id from tasks where task_url = :task_url';
	// 						$task_id = $tasks->query($query,['task_url'=>$task_url])[0]->task_id;
	// 						show($_POST);
	// 						unset($_POST['repitation']);
	// 						unset($_POST['goals']);
	// 						unset($_POST['goal']);
	// 						show($_POST);
	// 						$tasks->update($_POST,['task_id'=>$task_id]);
	// 						message("Task Updated Successfully!");
	// 						redirect('home/task/'.$_POST['task_url']);
							
	// 						//echo $taskurl;
						

	// 					}
						
						
	// 				}

	// 				//Delete option request
	// 				if (isset($_REQUEST['delete'])) 
	// 				{
						
	// 					unset($_POST['delete']);
	// 					//show($_POST);
	// 					$_POST['task_url'] = str_to_url($_POST['task_name']);
	// 					$tasks->delete(['task_url'=>$task_url]);
	// 					message("Task Deleted Successfully!");
	// 					redirect('home');	
	// 				}

	// 			}
	// 			$data['errors'] = $tasks->errors;
	// 			$data['title'] =  $task_url;
	// 			$data['days_row'] = $days->showAll();
	// 			$tasks = new Tasks();
	// 			$data['task_details'] = $tasks->where(['task_url'=>$task_url])[0];
	// 			$data['task_rep_array'] = explode(",",$data['task_details']->repetitive);

	// 			//show($data['task_details']);
	// 			//echo $data['title'];
				
	// 			if(is_object($data['task_details']))
	// 			{
	// 				$data['id'] = "tasks";
	// 				$this->view('profile/profile.home',$data);
	// 			}
	// 			else
	// 			{
	// 				message("No such task exists!");
	// 				redirect('home');
	// 			}
	// 		}
	// 		else
	// 		{
	// 			redirect('home');
	// 		}
	// 	}
	// 	else
	// 	{
	// 		ErrorMessage('login');
	// 		redirect('login');
	// 	}

	// }
	

}