<?php
/**
* index controller
*/
class Index extends Controller 
{
	function __construct()
	{
		parent::__construct();
		if ( $this->user->is_logged_in() === true ) {
            // Redirect to home page user are already logged in
            
            ?>
            <script>
                window.location.replace("<?= BASE_URL ?>cart");
            </script>
            <?php
        }
        else {
        	?>
            <script>
                window.location.replace("<?= BASE_URL ?>login");
            </script>
            <?php
        }
	}

	function index(){
		echo "Trang chủ";
	}
	
}