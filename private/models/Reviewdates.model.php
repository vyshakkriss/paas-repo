<?php

/**
 * Projects Model
 */
class Reviewdates extends Models
{
	
	public $errors = array();
	protected $table = "reviewdates";

	
	protected $allowedCols = [
		'dateid',
		'eventname',	
		'lastdate'	
	];
	

	

	
}