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
		$this->session->destroy();
        $this->cookie->destroy();
        header("Location: " . BASE_URL . "login/");
	}

	
	
}