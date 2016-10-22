<?php  


/**
 * Author: Nguyen Tien Dat
 */
class Session
{
    /**
     * summary
     */
    public function __construct()
    {
        
    }

    public function get_session($key){
    	return $_SESSION[$key];
    }


    public function set_session($key, $value){
    	$_SESSION[$key] = $value;
    }

    public function delete_session($key){
    	$_SESSION[$key] = null;
    }

    public function destroy_session(){
    	session_unset();
    	session_destroy();
    }
}

?>