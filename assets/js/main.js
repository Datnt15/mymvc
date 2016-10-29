 $(document).ready(function () {
 	$('.edit-cart').on('click', function() {
		
		$(this).parent().parent().find('div.form-group').each(function() {
			$(this).toggleClass('hidden');
		});
		$(this).parent().parent().find('.product_values').each(function() {
			$(this).toggleClass('hidden');
		});
	});
 	
});

