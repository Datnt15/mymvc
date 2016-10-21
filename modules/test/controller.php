<?php
/**
* index controller
*/
class Test extends Controller 
{
	
	function __construct()
	{
		parent::__construct(__CLASS__);
	}

	function index(){
		$this->load_view('index');
	}

	function test_function(){
		$this->load_model('test2');		
	}
	
}