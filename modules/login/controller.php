<?php
/**
* Login controller
*/
class Login extends Controller 
{
	protected $user;
	function __construct()
	{
		parent::__construct(__CLASS__);
		$this->user = $this->load_model('user');
	}

	public function index(){
		$this->load_view('index');
	}

	public function check_login(){
		var_dump($users);
		echo "check login";
	}
	
}