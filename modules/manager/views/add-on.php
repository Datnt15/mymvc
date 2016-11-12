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
		<th width="120">Trạng thái</th>
	</thead>
	<tbody id="edit-table">
		<?php foreach ($orders as $order): ?>
		<tr>
			<td>
				<img src="<?= $order['img']; ?>" alt="<?= $order['name']; ?>" width="100" height="100">
			</td>
			<td>
				<a href="<?= $order['url']; ?>">
					<h5>
						<?= $order['name']; ?>
					</h5>
				</a>
			</td>
			<td>
				<span>
					<?= $order['customer']; ?>
				</span>
			</td>
			<td>
				<span>
					<?= $order['phone']; ?>
				</span>
			</td>
			<td>
				<span>
					<?= $order['address']; ?>
				</span>
			</td>
			<td>
				<span>
					<?= number_format( currencyConverter($order['currency'], $order['price']), 0, ',', ' '); ?> VND 
				</span>
			</td>
			<td>
				<span>
					<?= $order['quantity']; ?>
				</span>
							
			</td>
	
			<td>
				<form action="" method="POST">
					<button name="handle_order" value="<?= $order['oid']; ?>" class="btn btn-info handle_order">
						<i class="fa fa-pencil-square-o " aria-hidden="true"></i>
					</button>					
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>

