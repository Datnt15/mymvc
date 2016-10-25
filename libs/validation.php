<?php  

/**
 * Author: Nguyen Tien Dat
 */
class Validation {
    

    /**
     * [check_username description]
     * @param  [type] $username   [description]
     * @param  string $field_name [This checked field name]
     * @return [array]             [checking status and its message]
     */
    public function check_username($username, $field_name = ''){
        $res = array();
        if ($username === '') {
            $res['stt'] = 'failure';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !preg_match("/^[A-Za-z_0-9-]{3,15}[^'\x22\s@!]+$/", $username) ){
            $res['stt'] = 'failure';
            $res['message'] = $field_name . " containts only number, uppercase, lowercase, underscore(_), hyphen(-), maxlength is 15 and minlength is 3.";
            $res['type'] = 'username';
        }
        return $res;
    }


    /**
     * [check_password checking password]
     * @param  [type] $pass       [description]
     * @param  string $field_name [This checked field name]
     * @return [array]             [checking status and its message]
     */
    public function check_password($pass, $field_name = ''){
        $res = array();
        if ($pass === '') {
            $res['stt'] = 'failure';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}[^'\x22\s@!]+$/", $pass) ){
            $res['stt'] = 'failure';
            $res['message'] = $field_name . " containts at least one number, one upercase, one lowercase, minlength is 4, can't containt some special characters like ( @, !, ', '' ) and whitespace";
            $res['type'] = 'password';
        }
        return $res;
    }



    /**
     * [check_email description]
     * @param  [type] $email      [description]
     * @param  string $field_name [This checked field name]
     * @return [array]             [checking status and its message]
     */
    public function check_email($email, $field_name = ''){
        $res = array();
        if ($email === '') {
            $res['stt'] = 'failure';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
            $res['stt'] = 'failure';
            $res['message'] =$field_name . ' is invalid format';
            $res['type'] = 'email';
        }
        return $res;
    }


    /**
     * [check_number checking out number]
     * @param  [string] $number     [string of number (and characters)]
     * @param  string $field_name [This checked field name]
     * @return [array]             [checking status and its message]
     */
    public function check_number($number, $field_name = ''){
        $res = array();
        if ($number === '') {
            $res['stt'] = 'failure';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !preg_match("/^[0-9]{1,15}$/", $number ) ){
            $res['stt'] = 'failure';
            $res['message'] =$field_name . ' containts numbers only';
        }
        return $res;
    }


    /**
     * [check_phone description]
     * @param  [type] $phone   [description]
     * @param  string $field_phone [This checked field phone]
     * @return [array]             [checking status and its message]
     */
    public function check_phone($phone, $field_phone = ''){
        $res = array();
        if ($phone === '') {
            $res['stt'] = 'failure';
            $res['message'] = $field_phone . ' can\'t be null';
        }
        elseif ( !preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4,5})$/", $phone) ){
            $res['stt'] = 'failure';
            $res['message'] = $field_phone . " Please enter a valid phonenumber.\t\t\nPhone No.[000-000-0000, 000.000.0000, 000 000 0000]";
        }
        return $res;
    }


    /**
     * [check_date description]
     * @param  [type] $birthday   [description]
     * @param  string $field_birthday [This checked field birthday]
     * @return [array]             [checking status and its message]
     */
    public function check_date($birthday, $field_birthday = ''){
        $res = array();
        if ($birthday === '') {
            $res['stt'] = 'failure';
            $res['message'] = $field_birthday . ' can\'t be null';
        }
        elseif ( !preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $birthday) ){
            $res['stt'] = 'failure';
            $res['message'] = $field_birthday . " Please enter a valid day.\t\t\n YYYY-MM-DD";
        }
        return $res;
    }



    /**
     * [cleanString cleaning up string, remove all special character]
     * @param  [string] $text [string to clean up]
     * @return [string]       [Output string after removing all special characters]
     */
    public function cleanString($text) {
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

?>