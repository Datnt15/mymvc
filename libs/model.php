<?php
/**
* Author : Nguyen Dang Dung Ha
*/
class Model{
	protected $db;
	function __construct() {	
		$this->db = new Database();
	}

}