<?php

/**
 * 404 File not found
 */
class _404 extends Controllers
{
	
	public function index()
	{
		// code...
		$data['title'] = "404";

		$this->view('404',$data);
	}
}