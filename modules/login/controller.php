<?php
/**
* Login controller
*/
class Login extends Controller 
{
	protected $user;
	function __construct()
	{
		parent::__construct(__CLASS__);
		$this->user = $this->load_model('user');
	}

	public function index(){
        $this->load_view('index');

        if ( $this->user->is_logged_in() === true ) {
            // Redirect to home page user are already logged in
            
            print_r($this->cookie->get());die;
            ?>
            <script>
                window.location.replace($('base').attr('href'));
            </script>
            <?php
        }
	}

	public function check_login(){

		if( isset($_POST) ){
			$where = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
            	);
            
            $check = $this->check_username($where['username'], 'Username');
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }


            $check = $this->check_password($where['password'], 'Password');
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }

            $where['password'] = md5($where['password']);
            $user = $this->user->get_user($where);

            // Lay thành công
            if ( !empty($user) ) {

                // Set session data
            	$this->session->set('uid', $user['uid']);
            	$this->session->set('secret_code', $user['secret_code']);

            	if ( $this->input->post('remember') == 'true') {
                    // Store cookie data if user clicked "Remember me" button
            		$this->cookie->set('uid', $user['uid']);
            		$this->cookie->set('secret_code', $user['secret_code']);
            	}
            	
            	echo json_encode( 
            		array(
            			'stt' => 'success',
            			'message' => 'Login successfuly!'
            		) 
            	);

            	return false;
            }
            // Thất bại tràn trề
            else {
            	echo json_encode( array(
	            		'stt' => 'failure',
            			'message' => $where['password']
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

	
}