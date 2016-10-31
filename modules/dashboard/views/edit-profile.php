
<div class="profile">
	<img <?php if ($this->data['avatar'] == NULL){
			echo 'src="'.BASE_URL.'assets/images/default-avatar.png"';}
			else {echo 'src="'.$this->data['avatar'].'"';}?>>
	<div class="about-me">
		<h1 class="name-pro"><b><?php echo $this->data['username'];?></b></h1>
		<div class="rating">
			<span><i class="fa fa-star" aria-hidden="true"></i></span>
			<span><i class="fa fa-star" aria-hidden="true"></i></span>
			<span><i class="fa fa-star" aria-hidden="true"></i></span>
			<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
			<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
		</div>
		<div class="job-info">
    		<p class="job-pro">Student</p>
    		<p><a href="" class="learn-more">Learn more</a></p>
		</div>
		<p class="exp-pro"><i class="fa fa-cog" aria-hidden="true"></i> 8,782 exp</p>
	</div>
	<div class="setting-pro">

		<!-- link edit profile -->
		<a href="" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-pencil" aria-hidden="true"></i></a>

		<!-- link log out -->
		<a href="<?= BASE_URL;?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
		<div class="clearfix"></div>
	</div>
</div>
<div class="tab-panel-info">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#home">Knowledge</a></li>
		<li><a data-toggle="tab" href="#menu1">Course</a></li>
		<li><a data-toggle="tab" href="#menu2">Exam</a></li>
		<li><a data-toggle="tab" href="#menu3">Q&A</a></li>
		<li><a data-toggle="tab" href="#menu4">New</a></li>
		<li><a data-toggle="tab" href="#menu5">Activity</a></li>
	</ul>
	<div class="tab-content">
	    <div id="home" class="tab-pane fade in active">
	    </div>
	    <div id="menu1" class="tab-pane fade">
		    <h3>Menu 1</h3>
		    <p>Some content in menu 1.</p>
	    </div>
	    <div id="menu2" class="tab-pane fade">
		    <h3>Menu 2</h3>
		    <p>Some content in menu 2.</p>
	    </div>
	    <div id="menu3" class="tab-pane fade">
		    <h3>Menu 3</h3>
		    <p>Some content in menu 3.</p>
	    </div>
	    <div id="menu4" class="tab-pane fade">
		    <h3>Menu 4</h3>
		    <p>Some content in menu 4.</p>
	    </div>
	    <div id="menu5" class="tab-pane fade">
		    <h3>Menu 5</h3>
		    <p>Some content in menu 5.</p>
	    </div>
	</div>
</div>

<!-- Profile form -->
<form method="POST" action="<?= BASE_URL . 'cart/update_user_info' ?>" enctype="multipart/form-data">
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	    <div class="modal-dialog">
			<div class="editmodal-container">
				<img src="<?= BASE_URL; ?>assets/images/background-login.jpg" class="background-edit">
				<img <?php if ($this->data['avatar'] == NULL){
	  					echo 'src="'.BASE_URL.'assets/images/default-avatar.png"';}
	  					else {echo 'src="'.$this->data['avatar'].'"';}?> 
	  					class="edit-avatar">

	  				<!-- Avatar -->

					<a class="edit-img-pencil">
						<i class="fa fa-2x fa-pencil" aria-hidden="true"></i>
					</a>
					<input type="file" name="avatar[]" class="hidden" id="change_ava">

				<div class="edit-profile">

					<!-- Phone -->
					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" name="phone" class="form-control" id="phone" value="<?php echo $this->data['phone'];?>">
					</div>

					<!-- Address -->
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" name="address" class="form-control" id="address" value="<?php echo $this->data['address'];?>">
					</div>

					<!-- Birthday -->
					<div class="form-group">
						<label for="birthday">Birthday</label>
						<input type="text" name="birthday" class="form-control" id="birthday" 
						value="<?php if($this->data['birthday'] == '0000-00-00'){ echo 'yyyy-mm-dd';} else echo $this->data['birthday'];?>">
					</div>
				</div>

				<!-- Submit button -->
				<button class="update" type="submit">UPDATE</button>
				
			    
			</div>
		</div>
    </div>
</form>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		jQuery(document).on('click', '.edit-img-pencil', function() {
			jQuery('#change_ava').click();
		});

		jQuery("#change_ava").on('change', function() {
			var file, len = this.files.length;
			for (var i = 0 ; i < len; i++ ) {
				file = this.files[i];

				if (!file.type.match(/image.*/)) {
					alert('This file is not an image');
				} else {
					
					if ( window.FileReader ) {
						reader = new FileReader();
						reader.onloadend = function (e) { 
							jQuery(".edit-avatar").attr('src', e.target.result);
						};
						reader.readAsDataURL(file);
					}
				}
		    }
		});	
	});

	

</script>
