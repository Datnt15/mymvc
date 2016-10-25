<?php
/**
* index controller
*/
class Index extends Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		print_r($this->user->get_username());
        if (isset($_POST['submit'])) {
        	print_r( $this->gallery->upload_img("avatar") );
        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data">
			<input type="file" name="avatar[]">
        	<input type="submit" name="submit" value="Upload">
        </form>
	<?php
	}
	
}