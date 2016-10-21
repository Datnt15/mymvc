<?php
/**
* Login controller
*/
class Login extends Controller 
{
	
	function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function index(){
		$this->load_view('index');
		$this->load_model();
	}

	public function check_login(){
		echo "check login";
	}
	
}