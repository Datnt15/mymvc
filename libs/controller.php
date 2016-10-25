<?php
/**
* Author : Nguyen Dang Dung Ha
*/
class Controller {
	/**
	 * __construct
	 */
	public $name = null;
    protected $cookie;
    protected $session;
    protected $input;
    protected $user;
    protected $gallery;
    protected $validation;

	function __construct($clsName) {
		$this->name = $clsName;
        $this->cookie = new Cookie();
        $this->session = new Session();
        $this->input = new Input();
        $this->user = new User();
        $this->gallery = new Gallery();
        $this->validation = new Validation();

	}
	
	/**
	 * load Views
	 * @param  string $name [file  name]
	 * @param  array $data [array of value pass to view] default : null
	 * @return object [View object]
	 */
	
	public function load_view($name,$data = null) {
		return new View("modules/".strtolower($this->name)."/views/".$name,$data);		
	}

	/**
	 * [load_model description]
	 * @param  [string] $name 		   [file name]
	 * @return [object] new $name      [object of model]
	 */
	
	public function load_model($name = ''){
		//echo getcwd();
		if ($name == '') $name = $this->name;

		require "modules/".strtolower($name)."/model.php";
		//include strtolower($this->name)."_model.php";
		//echo 1;
		$cls1 = $name."_model";
		return new $cls1();
	}

	// /**
	//  * [load_module description]
	//  * @param  [string] $name 		   [module name]
	//  * @return [object] new $name      [object of model]
	//  */
	
	// public function load_module($name){
	// 	//echo getcwd();
	// 	if ($name == '') die;

	// 	require "modules/".strtolower($name)."/controller.php";
	// 	$controller = ucfirst($name);
	// 	$controller::index();
	// }



	
}