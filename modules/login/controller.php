<?php
/**
* Login controller
*/
class Login extends Controller 
{
    protected $access_token;
	function __construct()
	{
		parent::__construct(__CLASS__);
        if ( $this->user->is_logged_in() === true ) {
            // Redirect to home page user are already logged in
            
            ?>
            <script>
                window.location.replace("<?= base_url ?>cart");
            </script>
            <?php
        }
        $this->access_token = md5( uniqid(time(), true) );
    }

    public function index(){
        
        $data = array('access_token' => $this->access_token);
        $message = $this->session->get('message');
        if ( $message !== '' ) { 
            $data['message'] = $message;
            $this->session->set('message', '');
        }
        $this->load_view('index', $data);

        // Neu khong redirect trang thi cap nhat lai access token
        $this->session->set('access_token', $this->access_token) ;
	}

	public function check_login(){

		if( isset($_POST) ){
			$where = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
            	);

            // Kiem tra tinh hop le cua username
            $check = $this->validation->check_username($where['username'], 'Username');
            // co loi thi in ra thong bao loi
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }

            // kiem tra tinh hop le cua password
            $check = $this->validation->check_password($where['password'], 'Password');
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }

            // kiem tra access token co trung hay khong
            if ($this->input->post('access_token') !== $this->session->get('access_token')) {
                echo json_encode(
                        array(
                            'stt' => 'failure',
                            'message' => 'Access Token is not match! Please reload this page!'
                        )
                    );
                return false;
            }

            // encrypt password
            $where['password'] = md5($where['password']);

            $user = $this->user->get_user($where);

            // Lay thành công
            if ( !empty($user) ) {

                $source = base64_encode( $user['password'] . '-' . $user['uid'] );
                // Set session data
            	$this->session->set('uid', $source);

            	if ( $this->input->post('remember') == 'true') {
                    // Store cookie data if user clicked "Remember me" button
            		$this->cookie->set('uid', $source);
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
	            		'stt'        => 'failure',
            			'message'    => "Wrong Password or Username!",
                        'type'       => 'username'
            		) );
            	return false;
            }
    	}
	}

    public function forgot_pass(){

        if ( isset( $_POST['access_token']) ) {
            $email = $this->input->post('email');
            $access_token = $this->input->post('access_token');
            if ( $this->user->is_email_exist( $email ) ) {
                if ($access_token == $this->session->get('access_token')) {
                    $this->cookie->set('mail_access_token', $access_token, 3600);
                    $this->cookie->set($access_token, base64_encode($email), 3600);
                    if( mail(
                        $email, 
                        "Restting Password", 
                        "Please click this link to reset your password:\r\r\n" .
                        base_url . "login/reset_password/" . $access_token . ".\r\r\t\n" .
                        "This link is valiable in 1 hour only."
                        ) ) {
                        echo "Please check your email to reset your password!";
                    }
                } 
                else {
                    echo "Access token not match";
                }
            } else {
                echo "Email is not exist in our system";
            }
        }
        else {
            header("Location: " . base_url);
        }
    }

    public function reset_password($access_token){
        if (isset($_POST['reset'])) {
            if ($this->input->post('access_token') == $this->cookie->get('mail_access_token') ) {
                $email = base64_decode( $this->cookie->get($this->input->post('access_token')) );
                $user = $this->user->get_user( array( 'email' => $email ) );
                $this->user->update_user_info( 
                    array( 'password' => md5( $this->input->post('password') ) ),
                    $user['uid'],
                    $user['secret_code']
                );
                echo "Reset password successfuly. Please login again.";
            }
        }
        $this->load_view('reset-pass',$access_token);

    }

    
}