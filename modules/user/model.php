<?php
/**
 * Author : Nguyen Tien Dat
 */
class User_model extends Model
{
	
	private $table = 'users';
	function __construct() {
		parent::__construct();	
		$this->db->query("CREATE TABLE IF NOT EXISTS `users` (
		  `uid` int(11) NOT NULL AUTO_INCREMENT,
		  `username` varchar(255) DEFAULT NULL,
		  `password` varchar(255) DEFAULT NULL,
		  `email` varchar(255) DEFAULT NULL,
		  `secret_code` varchar(255) DEFAULT NULL,
		  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  PRIMARY KEY (`uid`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
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
    	return $this->db->add_row($data, $this->table);
    }


    /**
     * [delete_user]
     * @param  [int] $uid [user ID]
     * @return [boolean]      [Trạng thái thực hiện câu lệnh]
     */
    public function delete_user($uid){
    	return $this->db->delete($this->table, array( 'uid' => $uid) );
    }


    /**
     * [update_user_info description]
     * @param  [array] $data [Mảng chứa thông tin cập nhật]
     * @param  [int] 	$uid [User ID]
     * @return [boolean]   	 [Trạng thái thực hiện câu lệnh]
     */
    public function update_user_info($data, $uid){
    	return $this->db->update($this->table, $data, array( 'uid' => $uid) );
    }
	
    /**
     * [get_all_users Lấy hết thông tin trong bảng users]
     * @return [array] [dữ liệu trả về]
     */
	public function get_all_users(){
		return $this->db->get_table($this->table);
	}


	/**
	 * [get_user lấy thông tin của một user cụ thể]
	 * @param  [int] $uid [User ID]
	 * @return [array]      [mảng dữ liệu trả về]
	 */
	public function get_user($where){
		return $this->db->get_row($this->table, $where);
	}

	/**
	 * [is_logged_in checking user logged in]
	 * @return boolean [user is logged in or not]
	 */
	public function is_logged_in(){
		$uid = $this->cookie->get('uid');
		$secret_code = $this->cookie->get('secret_code');
		if ( $uid !== NULL && $secret_code !== '' ) {
			$user = $this->db->get_row($this->table, array('uid' => $uid, 'secret_code' => $secret_code) );
			if (!empty($user)) {
				return true;
			}
		}
		
		$uid = $this->session->get('uid');
		$secret_code = $this->session->get('secret_code');
		if ( $uid !== '' && $secret_code !== null ) {
			$user = $this->db->get_row($this->table, array('uid' => $uid, 'secret_code' => $secret_code) );
			if (!empty($user)) {
				return true;
			}
		}
		return flase;
	}


}