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
        $browser = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
        if ($browser === 'Chrome') {
            
        	setcookie($key, $value, time()+3600*24*30, '/', NULL);
        }
        else setcookie($key, $value, time()+3600*24*30, '/');
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

		$browser = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
        if ($browser === 'Chrome') {
            
            setcookie($key, '', time()-3600*24*30, '/', NULL);
        }
        else setcookie($key,'',time()-3600*24*30, '/');
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
            $browser = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                if ($browser === 'Chrome') {
                    
                    setcookie($name, '', time()-+3600*24*30, '/', NULL);
                }
                else setcookie($name, '', time()-3600*24*30, '/');
            }
        }
    }

    private function get_browser_name($user_agent){
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        
        return 'Other';
    }
}

?>