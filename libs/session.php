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

    public function get($key = ''){
        // Get whole array
        if ($key === '') {
            return $_SESSION;
        }
        // If key not in array
        if ( !in_array($key, array_keys($_SESSION))) {
            return NULL;
        }
        // If key exists in array
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
            self::delete($key);
            unset($_SESSION[$key]);
        }
    	session_unset();
    	session_destroy();
    }
}

?>