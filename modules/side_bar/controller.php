<?php 
/**
 * Side bar for Home controller
 */
class Side_bar extends Controller
{
	function __construct()
	{
		parent::__construct(__CLASS__);
	}
	
	public function index (){
		// $data['user'] = $this->user->get_current_user();
		$data['user'] = array('username' => 'Tien Dat');
		self::load_view('side-bar', $data);
	}

}


?>