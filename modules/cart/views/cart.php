<table class="table table-striped">
	<thead>
		<th>
			<input type="checkbox" id="check_all">
		</th>
		<th>Ảnh</th>
		<th width="200">Tên sản phẩm</th>
		<th width="150">Người nhận</th>
		<th>Số điện thoại</th>
		<th>Địa chỉ</th>
		<th>Số lượng</th>
		<th>Hành động</th>
	</thead>
	<tbody id="edit-table">
		<?php $carts = $this->data; 
		foreach ($carts as $cart): ?>
		<tr>
			<td>
				<input type="checkbox" name="cid[]" value="<?= $cart['cid']; ?>" />
			</td>
			<td>
				<img class="" src="<?= $cart['img']; ?>" alt="<?= $cart['name']; ?>" width="100" height="100">
				<div class="form-group hidden">
					<input type="file" name="image" class="form-control" >
					<input type="text" class="hidden" name="cart_id" value="<?= $cart['cid']; ?>" >
				</div>
				<div class="form-group hidden">
					
					<input type="text" class="hidden" name="old_ava" value="<?= $cart['img']; ?>" >
				</div>
			</td>
			<td>
				<a class="product_values" href="<?= $cart['url']; ?>">
					<h5>
						<?= $cart['name']; ?>
					</h5>
				</a>
				<div class="form-group hidden">
					<input type="text" name="url" class="form-control" value="<?= $cart['url']; ?>">
				</div>
				<div class="form-group hidden">
					<input type="text" name="name" class="form-control" value="<?= $cart['name']; ?>">
				</div>
			</td>
			<td>
				<span class="product_values">
					<?= $cart['customer']; ?>
				</span>
				<div class="form-group hidden">
					<input type="text" name="customer" class="form-control" value="<?= $cart['customer']; ?>">
				</div>
			</td>
			<td>
				<span class="product_values">
					<?= $cart['phone']; ?>
				</span>
				<div class="form-group hidden">
					<input type="text" name="phone" class="form-control" value="<?= $cart['phone']; ?>">
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
				<div class="product_values">
					
					<button class="btn btn-info edit-cart" style="float: left; display: inline-block;">
						<i class="fa fa-pencil-square-o " aria-hidden="true"></i>
					</button>
					<form action="" method="POST" style="float: left; display: inline-block; margin-left: 10px;">
						<input type="hidden" name="cid" value="<?= $cart['cid']; ?>">
						<input type="hidden" name="image" value="<?= $cart['img']; ?>">
						<button type="submit" name="delete" class="btn btn-danger" >
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
					</form>
				</div>
				<div class="form-group hidden">
					
					<button class="btn btn-info save-cart" style="float: left; display: inline-block;">
						<i class="fa fa-floppy-o" aria-hidden="true"></i>
					</button>
					<button class="btn btn-info undo" style="float: left; display: inline-block; margin-left: 10px;">
						<i class="fa fa-undo" aria-hidden="true"></i>
					</button>
				</div>
				
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
	    	<textarea class="form-control" name="note">Ghi chú cho đơn hàng</textarea>
	  	</div>
		<div class="col-md-4">
			<button class="btn btn-primary" id="send_order">
				Gửi đơn hàng
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
				alert("Vui lòng chọn ít nhất một sản phẩm!");
				return false;
			}else {

				jQuery("#send_order_form input[name='cat_items']").val( checkedValues );
				
				jQuery("#send_order_form").submit();
			}
		});

	});
</script>