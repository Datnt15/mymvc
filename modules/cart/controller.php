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
            $this->session->set('message', '');
            }
    		$this->load_view('edit-profile', $this->user->get_current_user());

    	}

    public function add_product(){
        $this->load_view('add-product');

    }

    public function index(){
        if( isset($_POST['product_url']) ){
            
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
        if ( isset( $_POST['update'] ) ) {
            $this->model->update_cart( array('quantity' => $this->input->post('quantity') ), array('cid' => $this->input->post('cid') ) );
        }
        if ( isset( $_POST['delete'] ) ) {
            unlink( $this->input->post('img') );
            $this->model->delete_cart( array('cid' => $this->input->post('cid') ) );
        }
        $cart = $this->model->get_cart_of( $this->user->get_id() );
        $this->load_view('cart', $cart);

    }

    public function orders(){
        $uid = $this->user->get_id();
        if( isset( $_POST['note'] ) ){
            $cat_items = explode(',',$this->input->post('cat_items'));
            $note = $this->input->post('note');
            foreach ($cat_items as $cid) {
                if ( $this->model->send_order( array( 'cid' => $cid, 'uid' => $uid, 'note' => $note ) ) ){
                    $this->model->update_cart( array( 'stt' => 'sent'), array( 'cid' => $cid ) );
                }

            }
        }

        $this->load_view('order',$this->model->get_order_of( $uid ));

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
                ?>
                <script>
                    window.location.replace($('base').attr('href') + 'cart/profile');
                </script>
                <?php
            }

            // $check = $this->validation->check_birthday($data['birthday'], 'Birthday');
            // if (!empty($check)) {
            //     echo json_encode($check);
            //     return false;
            // }

            if ( $this->user->is_phone_exist($data['phone'],$uid) > 0) {
                $this->session->set('message', 'Phone is already exist!');
                ?>
                <script>
                    window.location.replace($('base').attr('href') + 'cart/profile');
                </script>
                <?php
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
                ?>
                <script>
                    window.location.replace($('base').attr('href') + 'cart/profile');
                </script>
                <?php
            }
            // Thất bại tràn trề
            else {
            	$this->session->set('message', 'Some errors occured!' );
                ?>
                <script>
                    window.location.replace($('base').attr('href') + 'cart/profile');
                </script>
                <?php
                
            }
        }
	}

    public function __destruct(){
        $this->load_view('footer');
    }
}


?>