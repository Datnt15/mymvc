<?php 
/**
 * Home controller
 */
class Home extends Controller
{
	
	function __construct()
	{
		parent::__construct(__CLASS__);
	}

	public function index (){
		$this->load_view('index');
	}

}


?>