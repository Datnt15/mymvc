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
		if ($this->user->is_logged_in() === true) {
			header("Location: " . base_url);
		}
	}

	public function check_login(){

		if( isset($_POST) ){
			$where = array(
				'username' => $_POST['username'],
				'password' => $_POST['password'],
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
            	Session::set_session('uid', $user['uid']);
            	Session::set_session('secret_code', $user['secret_code']);
            	if ( $_POST['remember'] == 'true') {
            		Cookie::set_cookie('uid', $user['uid']);
            		Cookie::set_cookie('secret_code', $user['secret_code']);
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
	
}