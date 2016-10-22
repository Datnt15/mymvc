<?php
/**
* Login controller
*/
class Logout extends Controller 
{

	function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function index(){
		Session::destroy_session();
        Cookie::destroy_cookie();
        header("Location: " . base_url . "login/");
	}

	
	
}