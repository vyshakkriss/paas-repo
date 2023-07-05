<?php

/**
 * Main Controller
 */
class Controllers 
{
	
	public function view($view, $data = array())
	{
		extract($data);
		$viewname = "private/views/".$view.".view.php";
		if(file_exists($viewname))
		{
			require $viewname;

			
		}
		else
		{
			$this->_404();
			//echo $viewname;
			
		}
	}
	public function _404()
	{
		$data['title'] = "404";
		$this->view("404",$data);
	}
}