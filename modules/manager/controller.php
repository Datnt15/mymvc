<?php 
/**
 * User controller
 */
class Manager extends Controller
{
    private $model;
    function __construct() {

        parent::__construct(__CLASS__);
        $this->model = $this->load_model();
        
    }

    private function check_login(){
        if (!$this->user->is_logged_in()) {
            header("Location: " . BASE_URL . "login");
        }
        if (!$this->user->is_confirmed()) {
            echo "Vui lòng kiểm tra email để kích hoạt tài khoản của bạn và quay lại sau!";
            die;
        }
        
    }

    private function load_header($title = 'Hồ sơ cá nhân'){
        $this->check_login();
        $user = $this->user->get_current_user();
        $user['number_cart'] = $this->model->get_cart_of( $this->user->get_id() );
        $user['number_order'] = $this->model->get_order_of( $this->user->get_id() );
        $user['title'] = $title;
        $this->load_view('header', $user);
    }



    public function index(){
        
        $this->load_header("Giỏ hàng");
        $this->load_view('add-on', $this->model->get_order_of( $this->user->get_id() ) );
        $this->load_footer();
    }

    public function orders(){
        
        $uid = $this->user->get_id();

        $this->load_header("Quản lý đơn hàng");
        $this->load_view('order', $this->model->get_order_of( $uid ) );
        $this->load_footer();
    }


    /**
     * Đổi từ tiền khác sang VND 
     * @param  [string] $currency [loại tiền] => CNY
     * @param  [int] $amount   [số lượng] => 200
     * @return [int]  [quy đổi tương ứng] 200 * 3.300 (VND/CNY)
     */
    private function convert_currency($currency, $amount){
        $get = file_get_contents("https://www.google.com/finance/converter?a=1&from=" . urlencode($currency) . "&to=" . urlencode('VND') );
        $get = explode("<span class=bld>",$get);
        $get = explode("</span>",$get[1]);

        return intval( preg_replace("/[^0-9\.]/", null, $get[0]) * intval($amount) );
    }


    private function load_footer(){
        $this->load_view('footer');
    }

}


?>