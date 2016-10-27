<?php
/**
* Register controller
*/
class Register extends Controller 
{
	
	function __construct()
	{
		parent::__construct(__CLASS__);
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
            
            $check = $this->validation->check_username($data['username'], 'Username');
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }


            $check = $this->validation->check_password($data['password'], 'Password');
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }

            $check = $this->validation->check_email($data['email'], 'Email');
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }

            if ($this->user->is_username_exist($data['username'])) {
                echo json_encode(array(
                		'stt'        => 'faild',
            			'message'    => 'Username is already exist!',
                        'type'       => 'username'
                	));
                return false;
            }

            if ($this->user->is_email_exist($data['email'])) {
                echo json_encode(array(
                		'stt'        => 'faild',
            			'message'    => 'Email is already exist!',
                        'type'       => 'email'
                	));
                return false;
            }

            $data['secret_code'] = md5(uniqid(time(), true));
            $data['password'] = md5($data['password']);
            $user = $this->user->add_new_user($data);
            // thêm thành công
            if ( $user ) {
            	echo json_encode( array(
            			'stt'        => 'success',
            			'message'    => 'Register successfuly! Please check your email to activate your account.'
            		) );
                mail(
                    // $data['email'], 
                    "tiendatbt19@gmail.com", 
                    "Registration Confirm", 
                    "Please click this link to activate your account:" . "\r\r\t\n"
                    . base_url . "register/confirm_registration/" . $user . "/" . $data['secret_code']
                );
            	return false;
            }
            // Thất bại tràn trề
            else {
            	echo json_encode( array(
	            		'stt'        => 'faild',
            			'message'    => 'Some errors occured!',
                        'type'       => 'username'
            		) );
            	return false;
            }
    	}
	}


    public function confirm_registration( $uid, $secret_code ){
        if ( !$this->user->is_confirmed( $uid, $secret_code ) ) {
            sleep(4);
            $this->user->update_user_info(array('stt' => 'confirmed'), $uid, $secret_code);
            header( "Location: " . base_url . "/cart/profile" );
        }else {
            echo "This user has already confirmed his account!";
        }
    }

}