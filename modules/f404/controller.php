<?php
/**
* File for 404 request
*/
class File_not_exist extends Controller 
{
	
	function __construct()
	{
		parent::__construct();
		echo "File does not exist!";
	}
}