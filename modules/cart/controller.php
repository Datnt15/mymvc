<?php 
/**
 * User controller
 */
class Cart extends Controller
{
	private $model;
	function __construct() {

		parent::__construct(__CLASS__);
        if (!$this->user->is_logged_in()) {
            header("Location: " . base_url . "login");
        }
        $user = $this->user->get_current_user();
        $user['title'] = 'Profile Page';
        $this->load_view('header', $user);
        $this->model = $this->load_model();
        
        
	}

    public function profile (){
    		$message = $this->session->get('message');
            if (!empty($message)) { ?>
                <div class="alert alert-success" style="margin: 20px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $message; ?>
                </div>
            <?php
            }
    		$this->load_view('edit-profile', $this->user->get_current_user());

    	}

    public function add_product(){
        $this->load_view('add-product');

    }

    public function index(){
        if( isset($_POST['url']) ){
            
            $data = array(
                'url'       => $this->input->post('product_url'),
                'name'      => $this->input->post('product_name'),
                'customer'  => $this->input->post('customer'),
                'phone'     => $this->input->post('phone'),
                'address'   => $this->input->post('address'),
                'quantity'  => $this->input->post('quantity'),
                'uid'       => $this->user->get_id(),
                );
            if (isset($_POST['address'])) {

                $res = $this->gallery->upload_img("image");
                $res = $res[0];
                if ($res['stt'] === 'success') {
                    $data['img'] = $res['data'];
                }
            }
                        

            $cid = $this->model->add_to_cart($data);

            if ( $cid ) {
                $this->session->set('message', 'Adding new product to cart successfuly');
            }
            // Thất bại tràn trề
            else {
                $this->session->set('message', 'Some errors occured!' );
                
                header("Location: " . base_url . "cart");
            }
        }
        $cart = $this->model->get_cart();
        $this->load_view('cart', $cart);

    }

    public function orders(){
        echo "<h1>string</h1>";

    }


	public function update_user_info(){
		if( isset($_POST) ){
			
			$data = array(
				'phone' 		=> $this->input->post('phone'),
				'address' 		=> $this->input->post('address'),
				'birthday'    	=> $this->input->post('birthday'),
            	);
			

            $uid = $this->user->get_id();
                        
            $check = $this->validation->check_phone($data['phone'], 'Phone');
            if (!empty($check)) {
                $this->session->set('message', $check['message']);
                header("Location: " . base_url . "cart/profile");
            }

            // $check = $this->validation->check_birthday($data['birthday'], 'Birthday');
            // if (!empty($check)) {
            //     echo json_encode($check);
            //     return false;
            // }

            if ( $this->user->is_phone_exist($data['phone'],$uid) > 0) {
                $this->session->set('message', 'Phone is already exist!');
                header("Location: " . base_url . "cart/profile");
            }

            if (isset($_POST['address'])) {

                $res = $this->gallery->upload_img("avatar");
                $res = $res[0];
                if ($res['stt'] === 'success') {
                    $this->gallery->delete_img( $this->user->get_avatar() );
                    $data['avatar'] = $res['data'];
                }
            }
            
            $user = $this->user->update_user_info($data, $uid);

            if ( $user ) {
            	$this->session->set('message', 'Updated');
                header("Location: " . base_url . "cart/profile");
            }
            // Thất bại tràn trề
            else {
            	$this->session->set('message', 'Some errors occured!' );
                header("Location: " . base_url . "cart/profile");
                
            }
        }
	}

    public function __destruct(){
        $this->load_view('footer');
    }
}


?>