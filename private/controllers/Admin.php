	<?php 

/**
 * Home Controller
 */
class Admin extends Controllers
{
	
	public function index($id="")
	{
		// code...
		$data['title'] =  "admin";
		$data['id'] = "admin";
		if(Auth::logged_in())
		{
			
			//show($data['task_list']);
				//die();
			
			$this->view('admin/admin.home',$data);
		}
		else
		{
			$users = new Users();
			
			$this->view('home',$data);
		}

	}
	
	

}