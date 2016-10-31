 $(document).ready(function () {
 	$('.edit-cart').on('click', function() {
 		var edit_button = $(this);
		$('#edit-table div.form-group').each(function() {
			$(this).addClass('hidden');
		});
		$('#edit-table .product_values').each(function() {
			$(this).removeClass('hidden');
		});
		edit_button.parent().parent().parent().find('div.form-group').each(function() {
			$(this).toggleClass('hidden');
		});
		edit_button.parent().parent().parent().find('.product_values').each(function() {
			$(this).toggleClass('hidden');
		});
	});
	$(".undo").on('click', function() {
		
		$('#edit-table div.form-group').each(function() {
			$(this).addClass('hidden');
		});
		$('#edit-table .product_values').each(function() {
			$(this).removeClass('hidden');
		});
	});

	$('.save-cart').on('click', function() {
		
		var formData = new FormData(), _this = $(this);
		_this.parent().parent().parent().find('div.form-group').each(function() {
			var input = $(this).find('input[type="text"]');
			if(input.length > 0){
				formData.append( input.attr('name'), input.val() );
			}
			input = $(this).find('input[type="file"]');
			if (input.length > 0) {
				formData.append( input.attr('name') + "[]", input.prop('files')[0] );
			}
		});
		
		
		$.ajax({
			url: $("base").attr('href') + "cart/update_cart_info",
			type: 'POST',
			data: formData,
			processData: false, 
			contentType: false,
			success: function ($res) {
                $res = JSON.parse($res);
                if ($res.stt == 'success') {
                	var data = $res.data;
	                var _td = _this.parent().parent().parent().find('td');
	                // img
	                _td.eq(1).find('img').attr('src', data.img);
	                _td.eq(1).find('input[name="old_ava"]').attr('value', data.img);

	                // link
	                _td.eq(2).find('a').attr('href', data.url);
	                _td.eq(2).find('a').html("<h5>" + data.name + "</h5>");
	                _td.eq(2).find('input[name="url"]').attr('value', data.url);
	                _td.eq(2).find('input[name="name"]').attr('value', data.name);

	                // customer
	                _td.eq(3).find('span').html(data.customer);
	                _td.eq(3).find('input[name="customer"]').attr('value', data.customer);
	                
	                // phone
	                _td.eq(4).find('span').html(data.phone);
	                _td.eq(4).find('input[name="phone"]').attr('value', data.phone);
	                
	                // address
	                _td.eq(5).find('span').html(data.address);
	                _td.eq(5).find('input[name="address"]').attr('value', data.address);
	                
	                // quantity
	                _td.eq(6).find('span').html(data.quantity);
	                _td.eq(6).find('input[name="quantity"]').attr('value', data.quantity);
                }else{
                	alert("Some errors occured!");
                }
                $('#edit-table div.form-group').each(function() {
					$(this).addClass('hidden');
				});
				$('#edit-table .product_values').each(function() {
					$(this).removeClass('hidden');
				});
            }
		});
	});

	$('.save-order').on('click', function() {
		
		var formData = new FormData(), _this = $(this);
		_this.parent().parent().parent().find('div.form-group').each(function() {
			var input = $(this).find('input[type="text"]');
			if(input.length > 0){
				formData.append( input.attr('name'), input.val() );
			}
			input = $(this).find('input[type="file"]');
			if (input.length > 0) {
				formData.append( input.attr('name') + "[]", input.prop('files')[0] );
			}
		});
		
		
		$.ajax({
			url: $("base").attr('href') + "cart/update_order_info",
			type: 'POST',
			data: formData,
			processData: false, 
			contentType: false,
			success: function ($res) {
                $res = JSON.parse($res);
                if ($res.stt == 'success') {
                	var data = $res.data;
	                var _td = _this.parent().parent().parent().find('td');
	                // img
	                _td.eq(0).find('img').attr('src', data.img);
	                _td.eq(0).find('input[name="old_ava"]').attr('value', data.img);

	                // link
	                _td.eq(1).find('a').attr('href', data.url);
	                _td.eq(1).find('a').html("<h5>" + data.name + "</h5>");
	                _td.eq(1).find('input[name="url"]').attr('value', data.url);
	                _td.eq(1).find('input[name="name"]').attr('value', data.name);

	                // customer
	                _td.eq(2).find('span').html(data.customer);
	                _td.eq(2).find('input[name="customer"]').attr('value', data.customer);
	                
	                // phone
	                _td.eq(3).find('span').html(data.phone);
	                _td.eq(3).find('input[name="phone"]').attr('value', data.phone);
	                
	                // address
	                _td.eq(4).find('span').html(data.address);
	                _td.eq(4).find('input[name="address"]').attr('value', data.address);

	                // note
	                _td.eq(5).find('span').html(data.note);
	                _td.eq(5).find('input[name="note"]').attr('value', data.note);
	                
	                // quantity
	                _td.eq(6).find('span').html(data.quantity);
	                _td.eq(6).find('input[name="quantity"]').attr('value', data.quantity);
                }else{
                	alert("Some errors occured!");
                }
                $('#edit-table div.form-group').each(function() {
					$(this).addClass('hidden');
				});
				$('#edit-table .product_values').each(function() {
					$(this).removeClass('hidden');
				});
            }
		});
	});
});

