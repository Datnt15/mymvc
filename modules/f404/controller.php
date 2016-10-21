<?php
/**
* File for 404 request
*/
class File_not_exist extends Controller 
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		echo "Page not found";
	}
}