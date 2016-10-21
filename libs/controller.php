<?php
/**
* Author : Nguyen Dang Dung Ha
*/
class Controller {
	/**
	 * __construct
	 */
	public $name = null;

	function __construct($clsName) {
		$this->name = $clsName;
	}
	
	/**
	 * load Views
	 * @param  string $name [file  name]
	 * @param  array $data [array of value pass to view] default : null
	 * @return object [View object]
	 */
	
	public function load_view($name,$data = null) {
		return new View("modules/".strtolower($this->name)."/views/".$name,$data);		
	}

	/**
	 * [load_model description]
	 * @param  [string] $name 		   [file name]
	 * @return [object] new $name      [object of model]
	 */
	
	public function load_model($name = ''){
		//echo getcwd();
		if ($name == '') $name = $this->name;

		require "modules/".strtolower($name)."/model.php";
		//include strtolower($this->name)."_model.php";
		//echo 1;
		$cls1 = $name."_model";
		return new $cls1();
	}


	/**
	 * [check_title check post title]
	 * @param  [string] $title      [post title]
	 * @param  string $field_name [This checked field name]
	 * @return [array]             [checking status and its message]
	 */
    protected function check_title($title, $field_name = ''){
        $res = array();
        if ($title === '') {
            $res['stt'] = 'fasle';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !preg_match('/^[A-Za-z0-9\s-]{4,}$/', $title) ){
            $res['stt'] = 'fasle';
            $res['message'] = $field_name . ' containts only alphabet, number and hyphen anh whitespace';
        }
        return $res;
    }

    /**
     * [check_img_url checking image url]
     * @param  [string] $img        [image url]
     * @param  string $field_name [This checked field name]
     * @return [array]             [checking status and its message]
     */
    protected function check_img_url($img, $field_name = ''){
        $res = array();
        if ($img === '') {
            $res['stt'] = 'fasle';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !preg_match('/^[^\?]+\.(jpg|jpeg|gif|png)(?:\?|$)/', $img) ){
            $res['stt'] = 'fasle';
            $res['message'] = $field_name . ' is invalid format';
        }
        return $res;
    }

    /**
     * [check_username description]
     * @param  [type] $username   [description]
     * @param  string $field_name [This checked field name]
     * @return [array]             [checking status and its message]
     */
    protected function check_username($username, $field_name = ''){
        $res = array();
        if ($username === '') {
            $res['stt'] = 'fasle';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !preg_match("/^[A-Za-z_0-9-]{3,15}[^'\x22\s@!]+$/", $username) ){
            $res['stt'] = 'fasle';
            $res['message'] = $field_name . " containts only number, uppercase, lowercase, underscore(_), hyphen(-), maxlength is 15 and minlength is 3.";
        }
        return $res;
    }


    /**
     * [check_password checking password]
     * @param  [type] $pass       [description]
     * @param  string $field_name [This checked field name]
     * @return [array]             [checking status and its message]
     */
    protected function check_password($pass, $field_name = ''){
        $res = array();
        if ($pass === '') {
            $res['stt'] = 'fasle';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}[^'\x22\s@!]+$/", $pass) ){
            $res['stt'] = 'fasle';
            $res['message'] = $field_name . " containts at least one number, one upercase, one lowercase, minlength is 4, can't containt some special characters like ( @, !, ', '' ) and whitespace";
        }
        return $res;
    }


    /**
     * [check_email description]
     * @param  [type] $email      [description]
     * @param  string $field_name [This checked field name]
     * @return [array]             [checking status and its message]
     */
    protected function check_email($email, $field_name = ''){
        $res = array();
        if ($email === '') {
            $res['stt'] = 'fasle';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
            $res['stt'] = 'fasle';
            $res['message'] =$field_name . ' is invalid format';
        }
        return $res;
    }


    /**
     * [check_number checking out number]
     * @param  [string] $number     [string of number (and characters)]
     * @param  string $field_name [This checked field name]
     * @return [array]             [checking status and its message]
     */
    protected function check_number($number, $field_name = ''){
        $res = array();
        if ($number === '') {
            $res['stt'] = 'fasle';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !preg_match("/^[0-9]{1,15}$/", $number ) ){
            $res['stt'] = 'fasle';
            $res['message'] =$field_name . ' containts numbers only';
        }
        return $res;
    }


    /**
     * [cleanString cleaning up string, remove all special character]
     * @param  [string] $text [string to clean up]
     * @return [string]       [Output string after removing all special characters]
     */
    protected function cleanString($text) {
        $text = strtolower($text);
        $text = str_replace('/', '-', $text);
        $text = str_replace('"', '', $text);
        $text = str_replace("'", "", $text);
        $utf8 = array(
            '/[áàâãªäăạảắẳẵằặấầẩẫậ]/u'      =>   'a',
            '/[ÁÀÂÃÄĂẠẢẴẮẲẶẰẦẤẬẨ]/u'        =>   'a',
            '/[ÍÌÎÏỊĨỈ]/u'                  =>   'i',
            '/[íìîïịĩỉ]/u'                  =>   'i',
            '/[éèêëẹẽếềễệẻể]/u'             =>   'e',
            '/[ÉÈÊËẸẼẺẾỀỂỄỆ]/u'             =>   'e',
            '/[óòôõºöọỏơờởớợỡồổốộ]/u'       =>   'o',
            '/[ÓÒÔÕÖỎỌƠỞỢỚỜỠỒỔỐỖỘ]/u'       =>   'o',
            '/[úùûüũụủưứừửữự]/u'            =>   'u',
            '/[ÚÙÛÜŨỤỦƯỨỪỬỮỰ]/u'            =>   'u',
            '/ç/'                           =>   'c',
            '/Ç/'                           =>   'c',
            '/ñ/'                           =>   'n',
            '/Ñ/'                           =>   'n',
            '/–/'                           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'                    =>   '', // Literally a single quote
            '/[“”«»„]/u'                    =>   '', // Double quote
            // '/ /'                           =>   '-', // nonbreaking space (equiv. to 0x160)
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $text);
    }

	
}