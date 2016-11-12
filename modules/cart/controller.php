<?php 
/**
 * User controller
 */
class Cart extends Controller
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

    public function profile (){
        $this->load_header();
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
        $this->load_footer();
    }

    public function add_product(){
        $this->load_header("Thêm sản phẩm mới");
        $this->load_view('add-product');
        $this->load_footer();
    }

    public function index(){
        if (!empty($message)) { ?>
            <div class="alert alert-success" style="margin: 20px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $message; ?>
            </div>
        <?php
        $this->session->set('message', '');
        }
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
                $this->session->set('message', 'Thêm sản phẩm thành công');
            }
            // Thất bại tràn trề
            else {
                $this->session->set('message', 'Đã có lỗi xảy ra!' );
                
                header("Location: " . BASE_URL . "cart");
            }
        }
        
        if ( isset( $_POST['delete'] ) ) {
            unlink( $this->input->post('img') );
            $this->model->delete_cart( array('cid' => $this->input->post('cid') ) );
        }
        $uid = $this->user->get_id();
        // $addon_token = $this->cookie->get('addon_token');
        // if ($addon_token !== '' && $addon_token !== NULL) {
        //     $this->model->update_cart( 
        //         array( 'uid' => $uid ), 
        //         array( 'uid' => $addon_token ) );
        // }
        $this->load_header("Giỏ hàng");
        $this->load_view('cart', $this->model->get_cart_of( $uid ) );
        $this->load_footer();
    }


    public function addon_add_item(){
        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }

        if (isset($_POST['is_addon'])) {

            $uid = $this->user->get_id();
            if($uid == 0){
                echo "not_logged_in";
            }
            else {
                $item = array(
                    'url'           => $this->input->post('item_url'),
                    'name'          => $this->input->post('item_name'),
                    'img'           => $this->input->post('item_image'),
                    'uid'           => $uid,
                    'customer'      => $this->user->get_username(),
                    'phone'         => $this->user->get_phone(),
                    'address'       => $this->user->get_address(),
                    'price'         => $this->input->post('item_price'),
                    'size'          => $this->input->post('item_color_size'),
                    'quantity'      => $this->input->post('quantity'),
                    'currency'      => $this->input->post('currency'),
                    'is_add_on'     => $this->input->post('is_addon'),
                    'type'          => $this->input->post('type'),
                    'seller_id'     => $this->input->post('seller_id'),
                    'seller_name'   => $this->input->post('seller_name'),
                    'note'          => $this->input->post('note'),
                    'shipcharge'    => $this->input->post('shipcharge')
                    );
                // Lấy thông tin số dư tài khoản của người dùng
                $balance = intval($this->user->get_balance());

                // Tính khoản tiền cần đặt cọc
                $milestone = intval($this->convert_currency($item['currency'], $item['price']) * 0.3 * intval( $item['quantity'] ));

                if ($balance < $milestone) {
                    echo "balance_not_enought";
                }
                else {
                    
                    $cid = $this->model->add_to_cart($item);

                    if ( $cid ) {
                        echo 'success';
                    }else {
                        echo "failured";
                    }
                }
            }
        }
    }

    public function update_cart_info(){
        if ( isset( $_POST ) ) {
            $data = array();
            foreach ($this->input->post() as $key => $value) {
                if ($key == 'cart_id' || $key == 'image' || $key == 'old_ava') {
                    continue;
                }
                $data[$key] = $value; 
            }
            $cid = $this->input->post('cart_id');
            if ( isset( $_FILES['image'] ) ) {
                $res = $this->gallery->upload_img("image");
                $res = $res[0];
                if ( $res['stt'] === 'success' ) {
                    $this->gallery->delete_img( $this->input->post( 'old_ava' ) );
                    $data['img'] = $res['data'];
                }
            }
            if ($this->model->update_cart( $data, array( 'cid' => $cid ) ) ) {
                echo json_encode( array(
                    'stt' => 'success',
                    'data' => $this->model->get_specifix_cart( $cid )
                    ) 
                );
            }else{
                echo json_encode( array(
                    'stt' => 'failure'
                    ) 
                );
            }
        }
    }


    public function update_order_info(){
        if (isset($_POST['oid'])) {
            $flag = true;
            if( !$this->model->update_order( 
                array('note'    => $this->input->post('note') ),
                array('oid'     => $this->input->post('oid') ) 
            ) ) $flag = false;
            $data = array(
                    'url'       => $this->input->post('url'),
                    'name'      => $this->input->post('name'),
                    'customer'  => $this->input->post('customer'),
                    'phone'     => $this->input->post('phone'),
                    'address'   => $this->input->post('address'),
                    'quantity'  => $this->input->post('quantity')
            );
            if ( isset( $_FILES['image'] ) ) {
                $res = $this->gallery->upload_img("image");
                $res = $res[0];
                if ( $res['stt'] === 'success' ) {
                    $this->gallery->delete_img( $this->input->post( 'old_ava' ) );
                    $data['img'] = $res['data'];
                }
            }
            if ( ! $this->model->update_cart( $data, array('cid' => $this->input->post('cid') ) ) )
                $flag = false;
            $data['note'] = $this->input->post('note');
            if ( $flag ) {
                echo json_encode( array(
                    'stt' => 'success',
                    'data' => $data
                    ) 
                );
            }else{
                echo json_encode( array(
                    'stt' => 'failure'
                    ) 
                );
            }
        }
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
        // Xóa đơn hàng
        if( isset( $_POST['delete'] ) ){
            // Kiểm tra đơn hàng tồn tại hay không;
            $order = $this->model->get_order( $this->input->post('oid') );
            $order = $order[0];
            // Lấy số dư tài khoản của người dùng
            $balance = intval($this->user->get_balance());

            // Tính khoản tiền đã đặt cọc
            $milestone = intval($this->convert_currency($order['currency'], $order['price']) * 0.3 * intval( $order['quantity'] ));
            // Nếu xóa thành công
            if ( $this->model->delete_order( array( 'oid' => $this->input->post('oid') ) ) ){
                // Cập nhật lại trạng thái của sản phẩm
                $this->model->update_cart( 
                    array( 'stt' => 'pending'), 
                    array( 'cid' => $this->input->post('cid') ) 
                );
                // Bù lại tiền đã đặt cọc vào tài khoản
                $this->user->update_user_info(
                    array('balance' => $balance + $milestone),
                    $this->user->get_id()
                );
                // Xóa giao dịch
                $this->model->delete_transaction(  array( 'oid' => $this->input->post('oid') ) );
            }
        }

        $this->load_header("Quản lý đơn hàng");

        // Tạo giao dịch đặt cọc 
        if( isset( $_POST['make_milestone'] ) ){
            // Lấy thông tin đơn hàng
            $order = $this->model->get_order( $this->input->post('oid') );
            $order = $order[0];

            // Lấy thông tin số dư tài khoản của người dùng
            $balance = intval($this->user->get_balance());

            // Tính khoản tiền cần đặt cọc
            $milestone = intval($this->convert_currency($order['currency'], $order['price']) * 0.3 * intval( $order['quantity'] ));

            // Nếu số dư nhỏ hơn tiền đặt cọc
            if ($balance < $milestone) {?>
                <div class="alert alert-danger" style="margin: 20px;">
                    <span class="close" data-dismiss="alert" aria-label="close">&times;</span>
                    Tài khoản của bạn không đủ số dư để đặt cọc. Vui lòng nạp thêm tiền vào tài khoản
                </div>
            <?php }
            // Có thể đặt cọc
            else {

                $data = array(
                    'uid' => $this->user->get_id(),
                    'oid' => $this->input->post('oid'),
                    'quantity' => $milestone
                );
                
                // Tạo mới giao dịch
                if ($this->model->add_transaction($data)) {
                    
                    // Cập nhật trạng thái đơn hàng
                    $this->model->update_order( 
                        array( 'status' => 'milestoned'), 
                        array( 'oid' => $this->input->post('oid') ) 
                    );
                    // Cập nhật thông tin tài khoản người dùng
                    $this->user->update_user_info(
                        array('balance' => $balance - $milestone),
                        $this->user->get_id()
                    );
                }
            }
            
        }
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


    public function update_user_info(){
        
        if( isset($_POST) ){
            
            $data = array(
                'phone'         => $this->input->post('phone'),
                'address'       => $this->input->post('address'),
                'birthday'      => $this->input->post('birthday'),
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
                $this->session->set('message', 'Số điện thoại đã tồn tại!');
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
                $this->session->set('message', 'Cập nhật thành công');
                ?>
                <script>
                    window.location.replace($('base').attr('href') + 'cart/profile');
                </script>
                <?php
            }
            // Thất bại tràn trề
            else {
                $this->session->set('message', 'Đã có lỗi xảy ra!' );
                ?>
                <script>
                    window.location.replace($('base').attr('href') + 'cart/profile');
                </script>
                <?php
                
            }
        }
        $this->load_header();
        $this->load_footer();
    }

    private function load_footer(){
        $this->load_view('footer');
    }

    public function search(){
        if (isset($_POST['key'])) {
            // echo $this->input->post('key');
            $data = $this->model->search( $this->input->post('key'), $this->user->get_id() );
            if (!empty($data)) {
                if (isset($data[0]['oid'])) {
                    $this->load_view('order', $data);
                }
                else{
                    $this->load_view('cart-result', $data);
                }
            }
            else {
                echo "<h1>Không tìm thấy kết quả nào phù hợp với <b>" . $this->input->post('key') . "</b></h1>";
            }
        }
    }
}


?>