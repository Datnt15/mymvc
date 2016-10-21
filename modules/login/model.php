<?php
/**
 * Author : Nguyen Tien Dat
 */
class Login_model extends Model
{
	
	private $table = 'users';
	function __construct() {
		parent::__construct();	
	}


	/**
	 * [is_email_exist Kiểm tra email đã tồn tại hay chưa]
	 * @param  [string]  $email [email người dùng]
	 * @return int        [1: nếu email đã tồn tại, ngược lại trả về 0]
	 */
	public function is_email_exist($email){
		return intval( count( $this->db->get_row($this->table, array( 'email' => $email ) ) ) );
	}

	/**
	 * [is_username_exist Kiểm tra username đã tồn tại hay chưa]
	 * @param  [string]  $username [description]
	 * @return int     [1: nếu username đã tồn tại, ngược lại trả về 0]
	 */
	public function is_username_exist($username){
		return intval( count( $this->db->get_row($this->table, array( 'username' => $username ) ) ) );
	}


	/**
	 * [is_valid_username kiểm tra tính hợp lệ của user
	 * chỉ chứa ký tự chữ in hoa, thường, số và gạch dưới
	 * ]
	 * @param  [type]  $username [description]
	 * @return boolean           [description]
	 */
	public function is_valid_username($username){

        return preg_match("/^[A-Za-z_0-9]{3,15}[^'\x22\s@!]+$/", $username);
    }


    /**
     * [check_email kiểm tra tính hợp lệ của email]
     * @param  [string] $email      [description]
     * @return [boolean] [true/false]
     */
    public function is_valid_email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    /**
     * [add_new_user thêm user mới]
     * @param [array] $data [mảng dữ liệu để thêm vào db]
     */
    public function add_new_user($data){
    	return $this->db->add_row($this->table, $data);
    }
	
}