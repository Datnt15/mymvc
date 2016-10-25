<?php 
/**
 * Profile controller
 */
class Profile extends Controller
{
	
	function __construct()
	{
		parent::__construct(__CLASS__);
	}
	public function index (){
		if (!$this->user->is_logged_in()) {
			header("Location: " . base_url . "login");
		}
		$this->load_view('index', $this->user->get_current_user());
	}


	public function update_user_info(){
		if( isset($_POST) ){
			
			$data = array(
				'phone' 		=> $this->input->post('phone'),
				'address' 		=> $this->input->post('address'),
				'birthday'    	=> $this->input->post('birthday'),
            	);
			
			if (isset($_POST['address'])) {

	        	$res = $this->gallery->upload_img("avatar");
	        	$res = $res[0];
	        	if ($res['stt'] === 'success') {
	        		$this->gallery->delete_img( $this->user->get_avatar() );
	        		$data['avatar'] = $res['data'];
	        	}
	        }
	        
            $uid = $this->user->get_id();
                        
            $check = $this->validation->check_phone($data['phone'], 'Phone');
            if (!empty($check)) {
                echo json_encode($check);
                return false;
            }

            // $check = $this->validation->check_birthday($data['birthday'], 'Birthday');
            // if (!empty($check)) {
            //     echo json_encode($check);
            //     return false;
            // }

            if ( $this->user->is_phone_exist($data['phone'],$uid) > 0) {
                echo json_encode(array(
                		'stt' => 'faild',
            			'message' => 'Phone is already exist!'
                	));
                return false;
            }
            $user = $this->user->update_user_info($data, $uid);

            if ( $user ) {
            	$this->session->set('flash_message', 'Updated');
            }
            // Thất bại tràn trề
            else {
            	$this->session->set('flash_message', 'Some errors occured!' );
            	
            }
            header("Location: " . base_url . "profile");
        }
	}
}


?>