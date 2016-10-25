<?php 
/**
* Author: Le Van Thong
*/
class Home_model extends Model
{
	private $table = 'users';

	function __construct() {
		parent::__construct();	
	}

	/**
	 * [is_phone_exist Kiểm tra phone đã tồn tại hay chưa]
	 * @param  [string]  $phone [phone người dùng]
	 * @return int        [1: nếu phone đã tồn tại, ngược lại trả về 0]
	 */
	public function is_phone_exist($phone){
		return intval( count( $this->db->get_row($this->table, array( 'phone' => $phone ) ) ) );
	}


	/**
     * [check_phone kiểm tra tính hợp lệ của phone]
     * @param  [string] $phone      [description]
     * @return [boolean] [true/false]
     */
    // public function is_valid_phone($phone){
    //     return ;
    // }
    

    /**
     * [update_user_info cập nhật thông tin user]
     * @param  [array] $data [Mảng chứa thông tin cập nhật]
     * @param  [int] 	$uid [User ID]
     * @return [boolean]   	 [Trạng thái thực hiện câu lệnh]
     */
    public function update_user_info($data,$uid){
    	return $this->db->update($this->table, $data, array( 'uid' => $uid) );
    }

}
?>