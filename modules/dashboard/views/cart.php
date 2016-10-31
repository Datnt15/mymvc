<table class="table table-striped">
	<thead>
		<th>
			<input type="checkbox" id="check_all">
		</th>
		<th>Image</th>
		<th>Name</th>
		<th>Address</th>
		<th>Quatity</th>
		<th>Action</th>
	</thead>
	<tbody>
		<?php $carts = $this->data; 
		foreach ($carts as $cart): ?>
		<tr>
			<td>
				<input type="checkbox" name="cid[]" value="<?= $cart['cid']; ?>" />
			</td>
			<td>
				<img class="product_values" src="<?= $cart['img']; ?>" alt="<?= $cart['name']; ?>" width="100" height="100">
				<div class="form-group hidden">
					<input type="file" name="image[]" class="form-control" >
					<input type="hidden" name="cart_id" value="<?= $cart['cid']; ?>" >
				</div>
			</td>
			<td>
				<a class="product_values" href="<?= $cart['url']; ?>">
					<h5>
						<?= $cart['name']; ?>
					</h5>
				</a>
				<div class="form-group hidden">
					<input type="text" name="product_link" class="form-control" value="<?= $cart['url']; ?>">
				</div>
				<div class="form-group hidden">
					<input type="text" name="product_name" class="form-control" value="<?= $cart['name']; ?>">
				</div>
			</td>
			<td>
				<span class="product_values">
					<?= $cart['address']; ?>
				</span>
				<div class="form-group hidden">
					<input type="text" name="address" class="form-control address-input" value="<?= $cart['address']; ?>">
				</div>
			</td>
			<td>
				<span class="product_values">
					<?= $cart['quantity']; ?>
				</span>
				<div class="form-group hidden">
					<input type="text" name="quantity" class="form-control" value="<?= $cart['quantity']; ?>">
				</div>
			</td>
			<td style="min-width: 120px;">
				<button class="btn btn-info edit-cart" style="float: left; display: inline-block;">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				</button>
				<form action="" method="POST" style="float: left; display: inline-block; margin-left: 10px;">
					<input type="hidden" name="cid" value="<?= $cart['cid']; ?>">
					<input type="hidden" name="image" value="<?= $cart['img']; ?>">
					<button type="submit" name="delete" class="btn btn-danger" >
						<i class="fa fa-trash-o" aria-hidden="true"></i>
					</button>
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>

<form action="<?= BASE_URL;?>cart/orders" method="POST" id="send_order_form">
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