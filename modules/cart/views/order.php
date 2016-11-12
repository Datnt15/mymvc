<?php  
$orders = $this->data;

function currencyConverter($from_Currency ,$amount , $to_Currency = 'VND') {
	$from_Currency = urlencode($from_Currency);
	$to_Currency = urlencode($to_Currency);
	$encode_amount = 1;
	$get = file_get_contents("https://www.google.com/finance/converter?a=$encode_amount&from=$from_Currency&to=$to_Currency");
	$get = explode("<span class=bld>",$get);
	$get = explode("</span>",$get[1]);
	$converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
	return intval($converted_currency * intval($amount));
}
?>
<h1>Đơn hàng</h1>
<table class="table">
	<thead>
		<th>Ảnh</th>
		<th width="200">Tên sản phẩm</th>
		<th width="100">Người nhận</th>
		<th width="120">Số điện thoại</th>
		<th width="150">Địa chỉ</th>
		<th>Giá lẻ</th>
		<th>Số lượng</th>
		<th>Trạng thái</th>
		<th width="120">Hành động</th>
	</thead>
	<tbody id="edit-table">
		<?php foreach ($orders as $order): ?>
		<tr>
			<td>
				<img src="<?= $order['img']; ?>" alt="<?= $order['name']; ?>" width="100" height="100">
				<div class="form-group hidden">
					<input type="file" name="image" class="form-control" >
					<input type="text" class="hidden" name="cid" value="<?= $order['cid']; ?>" >
				</div>
				<div class="form-group hidden">
					
					<input type="text" class="hidden" name="old_ava" value="<?= $order['img']; ?>" >
				</div>
			</td>
			<td>
				<a class="product_values" href="<?= $order['url']; ?>">
					<h5>
						<?= $order['name']; ?>
					</h5>
				</a>
				<div class="form-group hidden">
					<input type="text" name="url" class="form-control" value="<?= $order['url']; ?>">
				</div>
				<div class="form-group hidden">
					<input type="text" name="name" class="form-control" value="<?= $order['name']; ?>">
				</div>
			</td>
			<td>
				<span class="product_values">
					<?= $order['customer']; ?>
				</span>
				<div class="form-group hidden">
					<input type="text" name="customer" class="form-control" value="<?= $order['customer']; ?>">
				</div>
			</td>
			<td>
				<span class="product_values">
					<?= $order['phone']; ?>
				</span>
				<div class="form-group hidden">
					<input type="text" name="phone" class="form-control" value="<?= $order['phone']; ?>">
				</div>
			</td>
			<td>
				<span class="product_values">
					<?= $order['address']; ?>
				</span>
				<div class="form-group hidden">
					<input type="text" name="address" class="form-control address-input" value="<?= $order['address']; ?>">
				</div>
			</td>
			<td>
				<span>
					<?= number_format( currencyConverter($order['currency'], $order['price']), 0, ',', ' '); ?> VND 
				</span>
			</td>
			<td>
				<span class="product_values">
					<?= $order['quantity']; ?>
				</span>
				<div class="form-group hidden">
					<input type="text" name="quantity" class="form-control" value="<?= $order['quantity']; ?>">
				</div>				
			</td>
			<td>
				<span>
				<?php
					
					/**
					 * Có các trạng thái của đơn hàng là
					 * pending: Đang đợi nhân viên bán hàng duyệt và báo giá
					 * milestoned: Đã đặt cọc.
					 * shipping: Đang chuyển hàng
					 * paid: đã thanh toán và hoàn tất đơn hàng
					 */
					switch ($order['status']) {
						case 'pending':
						// Nếu là đơn hàng thêm từ addon thì sẽ hiển thị nút đặt cọc
							if ($order['is_add_on']) {?>
							<form action="" method="POST">
								<input type="hidden" name="oid" value="<?= $order['oid']; ?>">
								<button class="btn btn-info make_milestone" name="make_milestone" data-toggle="tooltip" data-placement="bottom" title="Đặt cọc 30% của <?= number_format( currencyConverter($order['currency'], $order['price']) * intval($order['quantity']), 0, ',', ' '); ?> VND là <?= number_format( currencyConverter($order['currency'], $order['price']) * intval($order['quantity']) * 0.3, 0, ',', ' '); ?> VND">
									<i class="fa fa-credit-card" aria-hidden="true"></i> Đặt cọc
								</button>
							</form>
							<?php }
							// Ngược lại thì hiển thị thông báo đang đợi duyệt từ admin
							else{
								echo 'Đang đợi duyệt';
								
							}
							break;

						case 'milestoned':
							echo 'Đã đặt cọc';
							break;
						
						case 'shipping':
							echo 'Đang chuyển hàng';
							break;

						case 'paid':
							echo 'Đã thanh toán';
							break;
					} 
				?>
				</span>
				
			</td>
			<td>
				<div class="product_values">
					
					<button class="btn btn-info edit-cart" style="float: left; display: inline-block;">
						<i class="fa fa-pencil-square-o " aria-hidden="true"></i>
					</button>
					<form action="" method="POST">
						<input type="hidden" name="oid" value="<?= $order['oid']; ?>">
						<input type="hidden" name="cid" value="<?= $order['cid']; ?>">
						<button type="submit" name="delete" class="btn btn-danger" style="float: left; display: inline-block; margin-left: 10px;" >
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
					</form>
				</div>

				<div class="form-group hidden">
					<input type="text" class="hidden" name="oid" value="<?= $order['oid'];?>">
					<button class="btn btn-info save-order" style="float: left; display: inline-block;">
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

