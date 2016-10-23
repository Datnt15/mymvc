<?php
/**
* Register controller
*/
class Register extends Controller 
{
	
	protected $user;
	function __construct()
	{
		parent::__construct(__CLASS__);
		$this->user = $this->load_model('user');
	}

	public function index(){
		$this->load_view('index');
	}

	public function register(){
		$users = $this->user->get_all_users();
		if( isset($_POST) ){
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'email'    => $this->input->post('email'),
            	);
            
            $check = $this->check_username($data['username'], 'Username');
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }


            $check = $this->check_password($data['password'], 'Password');
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }

            $check = $this->check_email($data['email'], 'Email');
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }

            if ($this->user->is_username_exist($data['username'])) {
                echo json_encode(array(
                		'stt' => 'faild',
            			'message' => 'Username is already exist!'
                	));
                return false;
            }

            if ($this->user->is_email_exist($data['email'])) {
                echo json_encode(array(
                		'stt' => 'faild',
            			'message' => 'Email is already exist!'
                	));
                return false;
            }

            $data['secret_code'] = md5(uniqid($data['username'], true));
            $data['password'] = md5($data['password']);
            $user = $this->user->add_new_user($data);
            // thêm thành công
            if ( $user ) {
            	echo json_encode( array(
            			'stt' => 'success',
            			'message' => 'Register successfuly! Please Login.'
            		) );
            	return false;
            }
            // Thất bại tràn trề
            else {
            	echo json_encode( array(
	            		'stt' => 'faild',
            			'message' => 'Some errors occured!'
            		) );
            	return false;
            }
    	}
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
            $res['stt'] = 'failure';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !preg_match("/^[A-Za-z_0-9-]{3,15}[^'\x22\s@!]+$/", $username) ){
            $res['stt'] = 'failure';
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
            $res['stt'] = 'failure';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}[^'\x22\s@!]+$/", $pass) ){
            $res['stt'] = 'failure';
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
            $res['stt'] = 'failure';
            $res['message'] = $field_name . ' can\'t be null';
        }
        elseif ( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
            $res['stt'] = 'failure';
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