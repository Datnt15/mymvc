<?php  
$orders = $this->data;

?>
<h1>Order page</h1>
<table class="table">
	<thead>
		<th>Image</th>
		<th>Name</th>
		<th>Address</th>
		<th>Note</th>
		<th>Quatity</th>
		<th>Delete</th>
	</thead>
	<tbody>
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
				<?= $order['address']; ?>
			</td>
			<td>
				<?= $order['note']; ?>
			</td>
			<td>
				<form action="" method="POST">
					<div class="input-group">
				        <input type="number" name="quantity" class="form-control input-number" value="<?= $order['quantity']; ?>" min="1" max="100">
				        <input type="hidden" name="oid" value="<?= $order['oid']; ?>">
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
					<input type="hidden" name="oid" value="<?= $order['oid']; ?>">
					<input type="submit" name="delete" class="btn btn-danger" value="Delete">
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>
