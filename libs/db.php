<?php 
/**
 * Author Nguyễn Tiến Đạt
 */
class Database {

    private $HOST_NAME = 'localhost';

    private $USER_NAME = 'i2910768_wp1';

    private $USER_PASS = 'Q#3dRM(ys9fPpxj9iF(43#]8';

    private $DB_NAME   = 'i2910768_wp1';

    private $conn;

    public function __construct() {

        $this->conn = new mysqli($this->HOST_NAME, $this->USER_NAME, $this->USER_PASS, $this->DB_NAME);
        if ($this->conn->connect_errno) 
        {
            die ("Failed to connect to MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error );
        }

    }

    /**
     * [get_table Show table's records]
     * @param  [string] $table_name [Table name]
     * @param  [int]    $limit      [Limit number of records received]
     * @return [array]  [An Array contains all record's data ]
     */
    public function get_table($table_name, $limit = 50) {

        $result = $this->conn->query("SELECT * FROM $table_name LIMIT $limit");
        $data = array();

        // Kiểm tra có kết quả trả về hay không
        if ($result !== false && $result->num_rows > 0) {

            // Gán dữ liệu từ sql vào mảng trả về
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /**
     * [sql Handle an sql query]
     * @param  [string] $sql [sql query]
     * @return [array]      [trả về mảng dữ liệu]
     */
    public function query($sql) {

        $result = $this->conn->query($sql);
        $data = array();

        // Kiểm tra có kết quả trả về hay không
        if ($result !== false && $result->num_rows > 0) {

            // Gán dữ liệu từ sql vào mảng trả về
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /**
     * [add_row Thêm một bản ghi mới vào bảng]
     * @param [array] $data  [mảng dữ liệu đầu vào]
     * @param [string] $table [tên bảng để thêm dữ liệu]
     * @return [boolean/int] [trạng thái xử lý lệnh (false) hoặc ID bản ghi mới thêm]
     */
    public function add_row($data, $table){

        // Lấy tên các trường trong bảng
        $key = array_keys($data);

        $sql = "INSERT INTO `" . $table . "`(" . "`" . implode("`,`",$key) . "`" . ") VALUES (" . "\"" . implode("\",\"",$data) . "\"" . ");";
        
        if ( $this->conn->query($sql) )
            // Trả về ID bản ghi mới thêm
            return intval($this->conn->insert_id);
        else 
            // Lỗi insert
            return false;
    }


    /**
     * [get_row Lấy dữ liệu trên một bản ghi]
     * @param  [string] $table [Tên bảng]
     * @param  [array] $where [mảng điều kiện]
     * @return [array]        [mảng dữ liệu trả về nếu có hoặc một mảng rỗng]
     */
    public function get_row($table, $where){

        $sql = "SELECT * FROM $table WHERE ";
        $i = 0;
        // Xử lý mảng điều kiện
        foreach ($where as $key => $value) {
            // Gán điều kiện
            $sql .= "`" . $key . "`='" . $value ."' ";


            // Nếu mảng chỉ có một phần tử thì không thêm dấu ','
            // EX: "SELECT * FROM 'table' WHERE ID=1;"
            if (count($where) < 2) {
                break;
            }

            // Thêm liên từ
            elseif (++$i !== count($where)) {
                $sql .= "AND ";
            }

        }

        $result = $this->conn->query($sql);
        // Kiểm tra dữ liệu trả về có hoặc không
        if ($result !== false && $result->num_rows > 0)
            return $result->fetch_assoc();
        else 
            return array();
    }


    /**
     * [get_rows Lấy dữ liệu trên nhiều bản ghi]
     * @param  [string] $table [Tên bảng]
     * @param  [array] $where [mảng điều kiện]
     * @return [array]        [mảng dữ liệu trả về nếu có hoặc một mảng rỗng]
     */
    public function get_rows($table, $where){

        $sql = "SELECT * FROM $table WHERE ";
        $i = 0;
        // Xử lý mảng điều kiện
        foreach ($where as $key => $value) {
            // Gán điều kiện
            $sql .= "`" . $key . "`='" . $value ."' ";


            // Nếu mảng chỉ có một phần tử thì không thêm dấu ','
            // EX: "SELECT * FROM 'table' WHERE ID=1;"
            if (count($where) < 2) {
                break;
            }

            // Thêm liên từ
            elseif (++$i !== count($where)) {
                $sql .= "AND ";
            }

        }
        
        $result = $this->conn->query($sql);

        $data = array();
        // Kiểm tra dữ liệu trả về có hoặc không
        if ($result !== false && $result->num_rows > 0) {
            // Gán dữ liệu vào mảng trả về
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /**
     * [update Cập nhật một bản ghi]
     * @param  [string] $table [tên bảng]
     * @param  [array] $data  [thông tin cập nhật]
     * @param  [array] $where [Điều kiện]
     * @return [boolean]        [trạng thái cập nhật(true/false)]
     */
    public function update($table, $data, $where){

        $sql = "UPDATE `$table` SET ";
        $i = 0;
        // Set thông tin cập nhật
        foreach ($data as $key => $value) {
            $sql .= "`" . $key . "`='" . $value ."' ";
            if (count($data) < 2) {
                break;
            }
            elseif (++$i !== count($data)) {
                $sql .= ", ";
            }
            
        }

        $sql .= " WHERE ";
        $i = 0;
        // Xử điều kiện của câu lệnh SQL
        foreach ($where as $key => $value) {
            $sql .= "`" . $key . "`='" . $value ."' ";
            if (count($where) < 2) {
                break;
            }
            elseif (++$i !== count($where)) {
                $sql .= "AND ";
            }
            
        }

        return $this->conn->query($sql);

    }


    /**
     * [delete Xóa một bản ghi]
     * @param  [string] $table [tên bảng]
     * @param  [array] $where Mảng các điều kiện ràng buộc
     * @return [boolean]        [trạng thái thực thi lệnh(true/false)]
     */
    public function delete($table, $where){

        $sql = "DELETE FROM $table WHERE ";
        $i = 0;
        // Xử lý điều kiện của SQL
        foreach ($where as $key => $value) {
            $sql .= "" . $key . "='" . $value ."' ";
            if (count($where) < 2) {
                break;
            }
            elseif (++$i !== count($where)) {
                $sql .= "AND ";
            }
        }
        
        return $this->conn->query($sql);
    }


    public function __destruct(){
        $this->conn->close();
    }
} 


?>