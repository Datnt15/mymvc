<?php 
/**
 * Admin controller
 */
class Dashboard extends Controller
{
    private $model;
    function __construct() {

        parent::__construct(__CLASS__);
        if (!$this->user->is_logged_in()) {
            header("Location: " . BASE_URL . "login");
        }
        if (!$this->user->is_admin()) {
            header("Location: " . BASE_URL . "login");
        }
        // $this->model = $this->load_model();
        
    }

    private function load_header($title = 'Profile Page'){
        $user = $this->user->get_current_user();
        $user['title'] = $title;
        $this->load_view('header', $user);
    }

    

    public function index(){
        $this->load_header("Cart");
        $this->load_view('cart', $cart);
        $this->load_footer();
    }
    
    public function orders(){
        $this->load_header("Manage your orders");
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
        if( isset( $_POST['delete'] ) ){
            if ( $this->model->delete_order( array( 'oid' => $this->input->post('oid') ) ) ){
                $this->model->update_cart( 
                    array( 'stt' => 'pending'), 
                    array( 'cid' => $this->input->post('cid') ) 
                );
            }
        }

        $this->load_view('order',$this->model->get_order_of( $uid ));
        $this->load_footer();
    }

    private function load_footer(){
        $this->load_view('footer');
    }
}


?>