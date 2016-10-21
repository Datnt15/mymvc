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
				'username' => $_POST['username'],
				'password' => $_POST['password'],
				'email'    => $_POST['email'],
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
	
}