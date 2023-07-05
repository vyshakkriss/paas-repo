<?php

/**
 * Projects Model
 */
class Uploads extends Models
{
	
	public $errors = array();
	protected $table = "uploads";

	
	protected $allowedCols = [
		'uploadid',	
		'pid',	
		'uid',	
		'gid',	
		'abstract',	
		'objective',	
		'software-specification',
		'hardware-specification',
		'conclusion'
	];
	
	function uploadValidate($data)
	{
		// code...
		extract($data);
		//show( $data);
		
		if(count(emptyCheck($data))==0)
		{
			if(strlen($projectname) > 100)
			{
				$this->errors['projectname'] = "Project name should less than 100 characters. ";
			}
			if(str_word_count($abstract) > 500 || str_word_count($abstract) <150)
			{
				$this->errors['abstract'] = "Task Descrption should more than 150 and less than 500 words. ";
			}
			
			
			
		}
		else
		{
			$errs = emptyCheck($data);
			//show($errs);
			foreach ($errs as $key => $value) 
			{
				// code...
				$this->errors[$key] = $value;
			}
		}
		if(count($this->errors)==0)
			return true;
		return false;
	}

	

	
}