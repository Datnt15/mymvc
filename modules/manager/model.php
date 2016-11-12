<?php 
/**
* Author: Nguyen Tien Dat
*/
class Manager_model extends Model
{
	private $cart        = 'cart';
    private $order       = 'order';
	private $transaction = 'transaction';

	function __construct() {
		parent::__construct();	
	}

    /**
     * Adding new item to cart
     * @param [array] $data [data array to store]
     */
    public function add_to_cart($data) {
        return $this->db->add_row($data, $this->cart);
    }



	/**
	 * Adding new item to transaction
	 * @param [array] $data [data array to store]
	 */
	public function add_transaction($data) {
        return $this->db->add_row($data, $this->transaction);
    }


    /**
     * Getting all items in cart of specifix user
     * @param int $uid user id
     * @return [array] [array data returned]
     */
    public function get_cart_of($uid) {
        return $this->db->get_rows($this->cart, array('uid' => $uid, 'stt' => 'pending') );
    }


    /**
     * Get all items in cart
     * @return [array] [array data returned]
     */
    public function get_cart(){
        return $this->db->get_table($this->cart);
    }

    /**
     * Get specifix item in cart
     * @param   $cid [Cart item ID]
     * @return [array] [array data returned]
     */
    public function get_specifix_cart($cid){
        return $this->db->get_row( $this->cart, array( 'cid' => $cid ) );
    }


    /**
     * Update one or more items in cart table
     * @param  [array] $data  [data to update]
     * @param  [array] $where [condition]
     * @return [boolean]      [true/false]
     */
    public function update_cart($data, $where) {
        return $this->db->update( $this->cart, $data, $where );
    }


    /**
     * Update one or more items in order table
     * @param  [array] $data  [data to update]
     * @param  [array] $where [condition]
     * @return [boolean]      [true/false]
     */
    public function update_order($data, $where) {
    	return $this->db->update( $this->order, $data, $where );
    }


    /**
     * Delete one or more items in cart
     * @param  [array] $where [condition]
     * @return [boolean]      [true/false]
     */
    public function delete_cart($where) {
        return $this->db->delete($this->cart, $where);
    }

    /**
     * Delete one or more items in transaction table
     * @param  [array] $where [condition]
     * @return [boolean]      [true/false]
     */
    public function delete_transaction($where) {
    	return $this->db->delete($this->transaction, $where);
    }


    /**
     * Adding new order request
     * @param  [array] $data [data to store]
     * @return [boolean]     [true/false]
     */
    public function send_order($data){
    	return $this->db->add_row( $data, $this->order );
    }


    /**
     * [get_order_of description]
     * @param  [int] $uid [user ID]
     * @return [array]      [mảng dữ liệu]
     */
    public function get_order_of($uid){
        return $this->db->query("SELECT * FROM `order` JOIN `cart` ON(`order`.cid=`cart`.cid) WHERE `order`.uid=" . $uid);
    }



    /**
     * [get_order_of description]
     * @param  [int] $uid [user ID]
     * @return [array]      [mảng dữ liệu]
     */
    public function get_order($oid){
    	return $this->db->query("SELECT * FROM `order` JOIN `cart` ON(`order`.cid=`cart`.cid) WHERE `order`.`oid`=" . $oid);
    }


    /**
     * Delete one or more items in cart
     * @param  [array] $where [condition]
     * @return [boolean]      [true/false]
     */
    public function delete_order($where) {
        return $this->db->delete($this->order, $where);
    }


    /**
     * Get number items in cart of specifix user
     * @param  [int] $uid [user ID]
     * @return [int]      [number of records]
     */
    public function get_number_items_in_cart_of($uid){
        $count = $this->db->query("SELECT count(*) FROM `" . $this->cart . "` where `stt`='pending' and `uid`='".$uid."';");
        return intval( $count[0]['count(*)'] );
    }



    /**
     * Get number items in order table of specifix user
     * @param  [int] $uid [user ID]
     * @return [int]      [number of records]
     */
    public function get_number_items_in_order_of($uid){
        $count = $this->db->query("SELECT count(*) FROM `" . $this->order . "` where `uid`='".$uid."';");
        return intval( $count[0]['count(*)'] );
    }


    public function search($key, $uid){
        $res = $this->db->query("SELECT * FROM `cart` JOIN `order` ON (Concat(`cart`.`name`, `cart`.`url`, `cart`.`customer`,`cart`.`address`,`cart`.`date_create`,`order`.`date_create`) like '%" . $key ."%' AND `order`.`cid`=`cart`.`cid`) WHERE `cart`.`uid`=" . $uid . ";");
        if (empty($res)) {
            $res = $this->db->query("SELECT * FROM `cart` WHERE Concat(`name`, `url`, `customer`,`address`,`date_create`) like '%" . $key ."%' AND `uid`=" . $uid . ";");
        }
        return $res;
    }



}
?>