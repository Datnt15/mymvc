<?php 
/**
* Author: Le Van Thong
*/
class Cart_model extends Model
{
	private $table = 'cart';

	function __construct() {
		parent::__construct();	
	}

	public function add_to_cart($data){
        return $this->db->add_row($data, $this->table);
    }

    public function get_cart(){
        return $this->db->get_table($this->table);
    }

}
?>