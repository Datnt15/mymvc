<?php
error_reporting(1);
/**
* Bootstrap 
*/
class Bootstrap {
	
	function __construct() {
		// Define base url
		define('base_url', 'http://nguyendangdungha.com/mymvc/');
		
		// Include db handle file
		require 'db.php';
		
		$_GET   = filter_input_array(INPUT_GET,FILTER_SANITIZE_STRING);		

		if(isset($_GET['url'])) {
			$url = $_GET['url'];
		} else {
			//default controller
			$url = "index";			
		}

		$url = explode("/", rtrim($url,'/'));

		$file_name = "modules/".strtolower($url[0])."/controller.php";

		if(file_exists($file_name)) {
			//neu file ton tai
			require $file_name;
			$controller = new $url[0];

		} else {
			//page 404
			require 'modules/f404/controller.php';
			$controller = new File_not_exist();
			return false;
		}

		if(isset($url[1])) {
			//call the function
			if(isset($url[2])){
				//pass params
				$controller->{$url[1]}($url[2]);
			} else {
				$controller->{$url[1]}();
			}
		} else {
			//call index function
			$controller->index();
		}
	}
}