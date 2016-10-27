<?php  


/**
 * summary
 */
class User
{
    private $uid;
	private $username;
	private $avatar;
	private $cookie;
    private $session;
	private $db;
	private $email;
	private $fullname;
	private $table = 'users';
    public function __construct()
    {
        $this->cookie = new Cookie();
        $this->session = new Session();
        $this->db = new Database();
        $user_data = self::get_current_user();
        if (!empty($user_data)) {

        	$this->uid 		= $user_data['uid'];
        	$this->username = $user_data['username'];
        	$this->email 	= $user_data['email'];
        	$this->fullname = $user_data['fullname'];
        	$this->avatar 	= $user_data['avatar'];
        }

        else{

        	$this->uid 		= 0;
        	$this->username = NULL;
        	$this->email 	= NULL;
        	$this->fullname = NULL;
        	$this->avatar 	= NULL;
        }
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
	 * [is_phone_exist Kiểm tra phone đã tồn tại hay chưa]
	 * @param  [string]  $phone [phone người dùng]
	 * @return int        [1: nếu phone đã tồn tại, ngược lại trả về 0]
	 */
	public function is_phone_exist($phone,$uid){
		$count = $this->db->query("SELECT count(*) FROM " . $this->table . " where 'phone'='" . $phone . "' and 'uid'<>'".$uid."';");
		return intval( $count[0]['count(*)'] );
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
    public function update_user_info($data, $uid, $secret_code = NULL){
    	if ($secret_code !== NULL) {
    		return $this->db->update($this->table, $data, array( 'uid' => $uid, 'secret_code' => $secret_code ) );
    	}
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
	public function get_user($where = NULL){
		if ($where === NULL) {
			self::get_current_user();
		}
		return $this->db->get_row($this->table, $where);
	}

	/**
	 * [is_logged_in checking user logged in]
	 * @return boolean [user is logged in or not]
	 */
	public function is_logged_in(){
		$uid = $this->cookie->get('uid');
		if ( $uid !== NULL ) {
			$uid = base64_decode( $uid );
			$data = explode("-",$uid);
			$user = $this->db->count($this->table, array('uid' => $data[1], 'password' => $data[0]) );
			if (intval($user) > 0) {
				return true;
			}
		}
		
		$uid = $this->session->get('uid');
		if ( $uid !== null ) {
			$uid = base64_decode ( $uid );
			$data = explode("-",$uid);
			$user = $this->db->count($this->table, array('uid' => $data[1], 'password' => $data[0]) );
			if (intval($user) > 0) {
				return true;
			}
		}
		return false;
	}
	

	/**
	 * [get_current_user Lay thong tin cua user hien tai]
	 * @return array [mang thong tin cua user]
	 */
	public function get_current_user(){
		$uid = $this->cookie->get('uid');
		if ( $uid !== NULL ) {
			$uid = base64_decode( $uid );
			$data = explode("-",$uid);
			return $this->db->get_row($this->table, array('uid' => $data[1], 'password' => $data[0]) );
		}
		
		$uid = $this->session->get('uid');
		if ( $uid !== NULL ) {
			$uid = base64_decode ( $uid );
			$data = explode("-",$uid);
			return $this->db->get_row($this->table, array('uid' => $data[1], 'password' => $data[0]) );
		}
		return array();
	}

	

	/**
	 * [get_id Lay ID cua user hien tai]
	 * @return int [user id]
	 */
	public function get_id(){
		return $this->uid;
	}



	/**
	 * [get_username Lay username cua user hien tai]
	 * @return int [user id]
	 */
	public function get_username(){
		return $this->username;
	}



	/**
	 * [get_email Lay email cua user hien tai]
	 * @return int [user email]
	 */
	public function get_email(){
		return $this->email;
	}



	/**
	 * [get_fullname Lay fullname cua user hien tai]
	 * @return int [user fullname]
	 */
	public function get_fullname(){
		return $this->fullname;
	}


	/**
	 * [get_avatar Lay avatar cua user hien tai]
	 * @return int [user avatar]
	 */
	public function get_avatar(){
		return $this->avatar;
	}

	/**
	 * Checking user has confirmed yet?
	 * @param  [int]  $uid            [user ID]
	 * @param  [string]  $secret_code [unique string for user]
	 * @return boolean                [true/false]
	 */
	public function is_confirmed($uid, $secret_code){
		return count( self::get_user( 
							array(
									'uid' => $uid, 
									'secret_code' => $secret_code, 
									'stt' => 'confirmed'
								) 
						) 
				);
	}


}

?>