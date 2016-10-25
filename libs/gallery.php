<?php  

/**
 * AuthorL Nguyen Tien Dat
 */
class Gallery
{

	/**
	 * Upload image handle (multiple files)
	 * @param  string  $input_name [name of input file (HTML input tag's name)]
	 * @return [array] tra ve mang thong bao trang thai upload anh.
	 */
    public function upload_img($input_name = 'upload_img'){
        if ($_FILES[$input_name]) {
            $file_ary = $this->reArrayFiles($_FILES[$input_name]);
            $res = array();
            foreach ($file_ary as $file) {
                $res[] = $this->upload_img_handle($file);
            }
            return $res;
        }
    }

    /**
     * Sap xep lai mang $_FILE de tien cho viec duyet mang
     * @param  [array] &$file_post [ mang $_FILE (&: tham bien, dau ra se thay doi) ]
     * @return [array]             [mang dau ra]
     */
    private function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

    /**
     * upload image
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    private function upload_img_handle($file){
        
        // Array trả về
        $respons = array(
            'stt'   => '',
            'message'   => '',
            'data'  => '',
            );

        $target_file = "uploads/" . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image

        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $respons['stt'] = 'failure';
            $respons['message'] = "This is not an image";
            $uploadOk = 0;
        }

       
        // Check file size
        // File quá là lớn > 5MB = 5242880 bites
        if ($file["size"] > 5242880) {
            $respons['stt'] = 'failure';
            $respons['message'] = "This image is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        // Các định dạng cho phép (Chỉ ảnh thôi na cưng)
        $fileTypeAllow = array("jpg","png","jpeg","gif","tiff","ico","JPG","TIFF","PNG","JPEG","GIF","ICO");
        if( !in_array( strtolower($imageFileType), $fileTypeAllow ) ) {
            $respons['stt'] = 'failure';
            $respons['message'] = "These format JPG, JPEG, PNG & GIF allowed.";
            $uploadOk = 0;
        }
        
        if ($uploadOk == 1) {
            // move_uploaded_file: Upload ảnh từ local (từ máy tính của ông í) lên server
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                $respons['stt'] = 'success';
                $respons['message'] = "Successfuly, uploaded";
                $respons['data'] = $target_file;

            } 
            // Trường hợp không upload đc, xảy ra lỗi
            // Vãi cả source lấy ở đâu
            else {

                $respons['stt'] = 'failure';
                $respons['message'] = "Some errors ouccured";
            }
        }
        // trả về dữ liệu
        return $respons;

    }


    /**
     * [delete_img description]
     * @param  [string] $url [duong dan anh]
     * @return [boolean]     [true/false]
     */
    public function delete_img($url){
        return unlink($url);
    }
}

?>