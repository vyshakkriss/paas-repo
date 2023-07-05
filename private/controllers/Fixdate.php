	<?php 

/**
 * Home Controller
 */
class Fixdate extends Controllers
{
	
	public function index($id="")
	{
		// code...
		$data['title'] ="Fix Date";
		$data['id'] = "home";
		if(Auth::logged_in())
		{
			$reviewdates = new Reviewdates();
			if($_POST)
			{
				//		show($_POST);
				//$_POST['']	
				$reviewdates->insert($_POST);
				message("Date Updated",true);
			}
			$data['reviewdates'] = $reviewdates->showAll();
			//show($data['reviewdates']);
			//die();
			$this->view('profile/profile.admin.fixdate',$data);
		}
		else
		{
			
			
			$this->view('home',$data);
		}

	}
	
	

}