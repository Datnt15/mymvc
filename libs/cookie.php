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
    	setcookie($key, $value, time()+3600*24*30);
        setcookie($key, $value, time()+3600*24*30, '/');
    }

    public function get_cookie($key){
    	return $_COOKIE[$key];
    }

    public function delete_cookie($key){

    	unset($_COOKIE[$key]);

		setcookie($key,'',time()-3600*24*30);
        setcookie($key,'',time()-3600*24*30, '/');
    }

    public function destroy_cookie(){
    	foreach ($_COOKIE as $key => $value) {
            Cookie::delete_cookie($key);
        }
        // unset cookies
        unset($_COOKIE);
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
    }
}

?>