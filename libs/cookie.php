<?php  
/**
 * Author: Nguyen Tien Dat
 */
class Cookie
{
    /**
     * summary
     */
    public function __construct()
    {
        
    }

    public function set_cookie($key, $value){
    	setcookie($key, $value, time()+3600*24*30, "/", base_url);
    }

    public function get_cookie($key){
    	return $_COOKIE[$key];
    }

    public function delete_cookie($key){
    	unset($_COOKIE[$key]);

		setcookie($key,null,time()-1);
    }

    public function destroy_cookie(){
    	foreach ($_COOKIE as $key => $value) {
    		$this->delete_cookie($key);
    	}

    	unset($_COOKIE);
    }
}

?>