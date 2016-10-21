<?php
/**
* User controller
*/
class User extends Controller 
{
	protected $user;
	function __construct()
	{
		parent::__construct(__CLASS__);
		$user = $this->load_model();
	}

	function index(){
		$this->load_view('index');
	}

	
}