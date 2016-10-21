<?php
/**
* index controller
*/
class Index extends Controller 
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		echo "index page";
	}
	
}