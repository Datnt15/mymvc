<?php  

/**
 * Author: Nguyen Tien Dat
 */
class Input
{

    public function __construct()
    {
        
    }

    /**
     * [fetch_from_array Tìm kiếm giá trị trong mảng]
     * @param  [array] &$array [mảng đầu vào (có thể sẽ thay đổi)]
     * @param  [type] $index  [description]
     * @return [type]         [description]
     */
    protected function fetch_from_array(&$array, $index = NULL) {

		// If $index is NULL, it means that the whole $array is requested
		isset($index) OR $index = array_keys($array);

		// allow fetching multiple keys at once
		if (is_array($index))
		{
			$output = array();
			foreach ($index as $key)
			{
				// Recure function its self
				$output[$key] = self::fetch_from_array($array, $key);
			}

			return $output;
		}

		$value = NULL;

		if (isset($array[$index]))
		{
			$value = $array[$index];
		}
		elseif (($count = preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $index, $matches)) > 1) 
		// Does the index contain array notation
		{
			$value = $array;
			for ($i = 0; $i < $count; $i++)
			{
				$key = trim($matches[0][$i], '[]');
				if ($key === '') {
				// Empty notation will return the value as array
					break;
				}

				if (isset($value[$key]))
				{
					$value = $value[$key];
				}
				else
				{
					return NULL;
				}
			}
		}
		
		return $value;
	}

	/**
	 * [get Lấy dữ liệu từ biến $_GET]
	 * @param  [string] $index [Chỉ số mảng (để rỗng nếu lấy cả mảng) ]
	 * @return [string/array]        [description]
	 */
    public function get($index = NULL ){
    	return self::fetch_from_array($_GET, $index);
    }


    /**
	 * [post Lấy dữ liệu từ biến $_POST]
	 * @param  [string] $index [Chỉ số mảng (để rỗng nếu lấy cả mảng) ]
	 * @return [string/array]        [description]
	 */
    public function post($index = NULL) {
    	return self::fetch_from_array($_POST, $index);
    }
}

?>