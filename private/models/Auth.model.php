<?php

/**
 * Authentication Class
 */
class Auth
{
	
	public static function authenticateUser($row)
	{
		if(is_object($row))
		{
			$_SESSION['user_row'] = $row;
			
		}	
	}
	public static function logged_in()
	{
		if(!empty($_SESSION['user_row']))
		{
			return true;
		}
		return false;
	}

	public static function logout()
	{
		if(!empty($_SESSION['user_row']))
		{
			unset($_SESSION['user_row']);
			redirect('home');
		}
	}
	public static function getUser($data)
	{
		if(Auth::logged_in())
		{
			return $_SESSION['user_row']->$data;
		}


	}
	public static function authenticate($id)
	{
		$users=new Users();
		$user_row = $users->where(['user_id'=>$id]);
		Auth::authenticateUser($user_row[0]);
	}
}