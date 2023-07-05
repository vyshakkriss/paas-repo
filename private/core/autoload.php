<?php


require 'config.php';
require 'controllers.php';
require 'database.php';
require 'models.php';
require 'functions.php';
require 'app.php';


spl_autoload_register(function($classname){

	require 'private/models/'.$classname.'.model.php';
});