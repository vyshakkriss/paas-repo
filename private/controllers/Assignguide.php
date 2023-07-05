	<?php 

/**
 * Home Controller
 */
class Assignguide extends Controllers
{
	
	public function index($id="")
	{
		// code...
		$data['title'] = "Guide Assigment";
		$data['id'] = "home";
		if(Auth::logged_in() && Auth::getUser('role') == 1)
		{
			
			$users = new Users();
			$data['student_row'] = $users->showAll();

			$data['guide_row'] = $users->query("select * from users where role < 3");
			$data['guide_row'] = $users->get_list_of_students_of_guide($data['guide_row']);
			
			
			//show($data['guide_row']);
			//die();
			//$data['non_assigned'] = $users->query("select * from users where role=3 and gid=0");

			//show($data['non_assigned']);
			//die();
			if($_POST)
			{
				$class = $_POST['class'];
				$students = $users->query("select * from users where class='$class' and gid=0");
				$guides = $users->query("select * from users where role < 3");

				if(!empty($students))
					$maxstudents = count($students);
				$maxguide = count($guides);

				
				//die();	
				$x=0; $i=0;
				if(!empty($maxstudents))
				{
					while($x < $maxstudents )
					{
						if($i>=$maxguide)
						{
							$i=0;
						}
						
						$q = "update users set gid=".$guides[$i]->user_id." where user_id=".$students[$x]->user_id;
						$users->query($q);
						$i++;	
						$x++;
					}
					$data['guide_row'] = $users->get_list_of_students_of_guide($data['guide_row']);
					message("Successfully Assigned!",true);
				}
				else
				{
					message("All the students have been Assigned a guide for ". $class, true);
				}

				


			}
			$this->view('profile/profile.admin.guideassignment',$data);
		}
		else
		{
			
			
			$this->view('home',$data);
		}

	}
	

}