<table class="table">
	<thead>
		<th>
			<input type="checkbox">
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
					<input type="number" name="quatity" value="<?= $cart['quantity']; ?>">
					<input type="submit" name="update" value="Update">
				</form>
				
			</td>
			<td>
				<form action="" method="POST">
					<input type="hidden" name="cid" value="<?= $cart['cid']; ?>">
					<input type="submit" class="btn btn-danger" value="Delete">
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>