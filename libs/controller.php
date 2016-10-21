<?php
/**
* Author : Nguyen Dang Dung Ha
*/
class Controller {
	/**
	 * __construct
	 */
	public $name = null;

	function __construct($clsName) {
		$this->name = $clsName;
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
	
}