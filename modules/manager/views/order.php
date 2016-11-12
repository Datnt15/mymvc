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
		<th>Tên sản phẩm</th>
		<th>Người nhận</th>
		<th>Số điện thoại</th>
		<th>Địa chỉ</th>
		<th>Giá lẻ</th>
		<th>Số lượng</th>
	</thead>
	<tbody id="edit-table">
		<?php foreach ($orders as $order): ?>
		<tr>
			<td>
				<img src="<?= $order['img']; ?>" alt="<?= $order['name']; ?>" width="100" height="100">
				
			</td>
			<td>
				<a class="product_values" href="<?= $order['url']; ?>">
					<h5>
						<?= $order['name']; ?>
					</h5>
				</a>
				
			</td>
			<td>
				<span class="product_values">
					<?= $order['customer']; ?>
				</span>
				
			</td>
			<td>
				<span class="product_values">
					<?= $order['phone']; ?>
				</span>
				
			</td>
			<td>
				<span class="product_values">
					<?= $order['address']; ?>
				</span>
				
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
							
			</td>
			
			
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>

