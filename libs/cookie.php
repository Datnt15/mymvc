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

    public function set($key, $value){
    	setcookie($key, $value, time()+3600*24*30);
    }

    public function get($key = ''){
        // Get whole array
        if ($key === '') {
            return $_COOKIE;
        }
        // If key not in array
        if (!in_array($key, array_keys($_COOKIE))) {
            return NULL;
        }
        // If key exists in array
    	return $_COOKIE[$key];
    }

    public function delete($key){

    	unset($_COOKIE[$key]);

		setcookie($key,'',time()-3600*24*30);
    }

    public function destroy(){
        // Delete all item's value in $_COOKIE variable
    	foreach ($_COOKIE as $key => $value) {
            self::delete($key);
        }
        // unset cookies
        unset($_COOKIE);

        // Delete all item's value in $_SERVER variable
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-3600*24*30);
            }
        }
    }
}

?>