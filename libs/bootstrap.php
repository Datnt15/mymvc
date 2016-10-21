<?php
error_reporting(1);
/**
* Bootstrap 
*/
class Bootstrap {
	
	function __construct() {
		// Define base url
		define('base_url', 'http://nguyendangdungha.com/mymvc/');
		
		
		
		$_GET   = filter_input_array(INPUT_GET,FILTER_SANITIZE_STRING);		

		if(isset($_GET['url'])) {
			$url = $_GET['url'];
		} else {
			//default controller
			$url = "index";			
		}

		$url = explode("/", rtrim($url,'/'));

		$file_name = "modules/".strtolower($url[0])."/controller.php";
		$controller = '';
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

		if ( isset($url[1]) && $url[1] !== ''  ) {
			if ( !method_exists($controller, $url[1]) ){
				// Khong ton tai method
				require 'modules/f404/controller.php';
				$controller = new File_not_exist();
				$controller->index();
				die;
			} elseif( isset($url[2]) ) {
				// method co tham so truyen vao
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