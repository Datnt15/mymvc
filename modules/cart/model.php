<?php 
/**
* Author: Le Van Thong
*/
class Cart_model extends Model
{
	private $cart = 'cart';
	private $order = 'order';

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
     * Adding new order request
     * @param  [array] $data [data to store]
     * @return [boolean]     [true/false]
     */
    public function send_order($data){
    	return $this->db->add_row( $data, $this->order );
    }

    public function get_order_of($uid){
    	return $this->db->query("SELECT * FROM `order` JOIN `cart` ON(`order`.cid=`cart`.cid) WHERE `order`.uid=" . $uid);
    }


    /**
     * Delete one or more items in cart
     * @param  [array] $where [condition]
     * @return [boolean]      [true/false]
     */
    public function delete_order($where) {
        return $this->db->delete($this->order, $where);
    }



}
?>