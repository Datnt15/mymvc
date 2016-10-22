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

    public function get($key){
    	return $_SESSION[$key];
    }


    public function set($key, $value){
    	$_SESSION[$key] = $value;
    }

    public function delete($key){
    	$_SESSION[$key] = null;
    }

    public function destroy(){
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
    	session_unset();
    	session_destroy();
    }
}

?>