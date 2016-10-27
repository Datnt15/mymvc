<table class="table">
	<thead>
		<th>
			<input type="checkbox" id="check_all">
		</th>
		<th>Image</th>
		<th>Name</th>
		<th>Address</th>
		<th>Quatity</th>
		<th>Delete</th>
	</thead>
	<tbody>
		<?php $carts = $this->data; 
		foreach ($carts as $cart): ?>
		<tr>
			<td>
				<input type="checkbox" name="cid[]" value="<?= $cart['cid']; ?>" />
			</td>
			<td>
				<img src="<?= $cart['img']; ?>" alt="<?= $cart['name']; ?>" width="100" height="100">
			</td>
			<td>
				<a href="<?= $cart['url']; ?>">
					<h5>
						<?= $cart['name']; ?>
					</h5>
				</a>
			</td>
			<td>
				<?= $cart['address']; ?>
			</td>
			<td>
				<form action="" method="POST">
					<div class="input-group">
				        <input type="number" name="quantity" class="form-control input-number" value="<?= $cart['quantity']; ?>" min="1" max="100">
				        <input type="hidden" name="cid" value="<?= $cart['cid']; ?>">
				        <span class="input-group-btn">
				            <button type="submit" name="update" class="btn btn-success btn-number" data-type="plus" data-field="quatity">
				                <i class="fa fa-refresh" aria-hidden="true"></i>
				            </button>
				        </span>
				    </div>
				</form>
				
			</td>
			<td>
				<form action="" method="POST">
					<input type="hidden" name="cid" value="<?= $cart['cid']; ?>">
					<input type="hidden" name="image" value="<?= $cart['img']; ?>">
					<input type="submit" name="delete" class="btn btn-danger" value="Delete">
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>

<form action="<?= base_url;?>cart/orders" method="POST" id="send_order_form">
	<input type="hidden" name="cat_items">
	<!-- Textarea -->
	<div class="form-group">
	  	
	  	<div class="col-md-8">                     
	    	<textarea class="form-control" name="note">Note</textarea>
	  	</div>
		<div class="col-md-4">
			<button class="btn btn-primary" id="send_order">
				Send Orders
			</button>
		</div>
	</div>

</form>


<script>
	jQuery(document).ready(function($) {
		jQuery("#check_all").click( function(){
		   	if( jQuery(this).is(':checked') ) 
		   		jQuery('input[name="cid[]"]').not(this).prop('checked', this.checked);
		   	else{
		   		jQuery('input[name="cid[]"]').not(this).click();
		   	}
		});
		jQuery("#send_order").on('click', function() {
			var checkedValues = $('input[name="cid[]"]:checked').map(function() {
			    return this.value;
			}).get();

			if(checkedValues == ''){
				alert("Please select one item at least!");
				return false;
			}else {

				jQuery("#send_order_form input[name='cat_items']").val( checkedValues );
				
				jQuery("#send_order_form").submit();
			}
		});

	});
</script>