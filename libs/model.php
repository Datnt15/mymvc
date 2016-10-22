<?php
/**
* Author : Nguyen Dang Dung Ha
*/
class Model{
	protected $db;
	protected $session;
	protected $cookie;
	function __construct() {	
		$this->db = new Database();
		$this->session = new Session();
		$this->cookie = new Cookie();
	}

}