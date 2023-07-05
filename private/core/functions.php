<?php

function show($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}
function ActiveLinkSetter($link,$title)
{
	if(ucfirst($link)==$title)
	{
		echo "active";
		//echo $link;
	}
}
function alertSetter($error)
{
	return count($error) > 0 ? 'danger' : 'success';
}
function setValue($name,$default='')
{
	
	if(!empty($_POST[$name]))
	{
		return $_POST[$name];
	}else
	if(!empty($default))
	{
		return $default;
	}
	
	return '';
}
function set_select($key, $value, $default = '')
{
	if(!empty($_POST[$key]))
	{
		if($value==$_POST[$key])
			return ' selected ';
	}
	else
	{
		if (!empty($default)) {
			// code...
			if ($default==$value) {
				// cod
				return ' selected ';
			}
			return $default;
		}
	}
	return '';
}
function AMPM($time)
{
	return date('h:i A',strtotime($time));
}
function SETDATE($date)
{
	$date=date_create($date);
	return date_format($date,"d/m/Y");
}
function redirect($link)
{
	$link = trim($link,"/");
	$re = "Location: ".ROOT."/".$link;
	header($re);
	die;
}

function message($msg = '', $erase = false, $type = 0)
{
	if(!empty($msg))
	{
		$_SESSION['message'] = $msg;
	}
	else
	{
		if(!empty($_SESSION['message']))
		{
			$msg = $_SESSION['message'];
			if($erase)
			{
				unset($_SESSION['message']);
			}
			if($type==1)
				return "<i class='text-success'>".$msg."</i>";
			return $msg;
		}
	}
}


function str_to_url($url)
{
	$url = str_replace("'" , " " , $url ) ;
	$url = preg_replace('~[^\\pL0-9_]+~u','-',$url );
	$url = trim( $url , " - " );
	//$url = iconv ( " utf - 8 " , " us - ascii // TRANSLIT " , $url ) ;
	$url = strtolower($url);
	$url = preg_replace ('~[^-a-z0-9_]+~' , ' ' , $url );
	return $url;
}

function username($fullname)
{
	$fullname = str_replace("'" , " " , $fullname) ;
	$fullname = str_replace(" ",'_',$fullname);
	return $fullname;
}

function esc($data)
{
	return nl2br(htmlspecialchars($data));
}

function ErrorMessage($error='')
{
	;if($error=='login')
	{
		$msg = "Login using your credentials";
	}
	else if($error=='accessdenied')
	{
		$msg = "Access Denied";
	}
	else if($error = 'Session')
	{
		$msg = "Session Timeout!";
	}
	else
	{
		$msg = "Something went wrong";
	}
	message($msg);
	redirect('login');
}

function emptyCheck($data)
{
	$errors = [];
	foreach ($data as $key => $value)
	{
		if(empty($data[$key]))
		{
			$errors[$key] = str_replace('_',' ',ucfirst($key)). " cannot be empty";
		}
	}
	return $errors;
}

function resize_image($filename,$max_size = 600)
{
	$ext = explode(".", $filename);
	$ext = strtolower(end($ext));
	if(file_exists($filename))
	{
		switch ($ext) 
		{
			case 'png':
				$image = imagecreatefrompng($filename);
				break;

			case 'jpg':
			case 'jpeg':
				$image = imagecreatefromjpeg($filename);
				break;

			case 'gif':
				$image = imagecreatefromgif($filename);
				break;

			default:
				$image = imagecreatefromjpeg($filename);
				break;
		}
		//$image = imagecreatefromjpeg($filename);
		$src_w = imagesx($image);
		$src_h = imagesy($image);

		if ($src_w > $src_h)
		{
			$dst_w = $max_size;
			$dst_h = ($src_h / $src_w) * $max_size;
		}
		else
		{
			$dst_w = ($src_w / $src_h) * $max_size;
			$dst_h = $max_size;
		} 
		
		$dst_image = imagecreatetruecolor($dst_w, $dst_h);
		imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

		imagedestroy($image);

		imagejpeg($dst_image,$filename,90);
		switch ($ext) {
			case 'png':
				imagepng($dst_image, $filename);
				break;
			case 'gif':
				imagegif($dst_image, $filename);
				break;
			case 'jpg':
			case 'jpeg':
				imagejpeg($dst_image, $filename, 90);
				break;
			default:
				imagejpeg($dst_image, $filename, 90);
				break;
		}
		imagedestroy($dst_image);
	}

	return $filename;
}

function set_repetitive_value($arr)
{
	$str = "";
	foreach ($arr as $data) 
	{
		$str =$str.$data.",";
	}
	return trim($str,',');
}