<?php
/**
* Register controller
*/
class Register extends Controller 
{
	
	function __construct()
	{
		parent::__construct(__CLASS__);
	}

	function index(){
		$this->load_view('index');
		$this->load_model();
	}
	
}