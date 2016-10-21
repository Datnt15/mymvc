<?php
/**
* Author : Nguyen Dang Dung Ha
*/
class View {
	
	public $data = null;

	/**
	 * __construct
	 * @param  [string] $name [file name]
	 * @param  [array] $passData [array of variable "key" => value]
	 * @return [object]       [View object]
	 */

	function __construct($name,$passData = null)	{
		if($passData) $this->data = $passData;
		require strtolower($name).".php";
	}

	
}