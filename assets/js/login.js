jQuery(document).ready(function($) {
	$("#login-btn").on('click', function() {
		$("#results").text('');
		$.post(
			$("#login-form").attr('action'), 
			{
				username 		: $("#username").val(),
		        password 		: $("#password").val(),
		        access_token 	: $("#access_token").val(),
		        remember 		: ($('input#remember').prop('checked')) ? true : false,
		    }, function(data) {
		    	data = JSON.parse(data);
			    var message = "<div class=\"alert col-md-12 alert-warning\" role=\"alert\">";
				message += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\"";
				message += " aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
				message += "<i class=\"fa fa-info fa-fw\"></i> " + data.message + "</div>";
				$("#results").append(message);
				$("#results").slideDown('400');
			    if (data.stt === 'success') {
			    	window.location.replace($('base').attr('href'));
			    }
			    return false;
			}
		);
		return false;
		
	});

	window.setTimeout(function() {
	    $(".alert").fadeTo(500, 0).slideUp(500, function(){
	        $(this).remove(); 
	    });
	}, 6000);

	$("#register-btn").on('click', function() {
		$("#results").text('');
		$.post(
			$("#register-form").attr('action'), 
			{
				username : $("#username").val(),
		        password : $("#password").val(),
		        email 	 : $("#email").val()
		    }, function(data) {
		    	data = JSON.parse(data);
			    var message = "<div class=\"alert col-md-12 alert-warning\" role=\"alert\">";
				message += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\"";
				message += " aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
				message += "<i class=\"fa fa-info fa-fw\"></i> " + data.message + "</div>";
				$("#results").append(message);
				$("#results").slideDown('400');
			    // if (data.stt === 'success') {
			    // 	alert(data.message);
			    // }
			    return false;
			}
		);
		return false;
		
	});


	// //minimum 8 characters
	// var bad = /(?=.{8,}).*/;
	// //Alpha Numeric plus minimum 8
	// var good = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/;
	// //Must contain at least one upper case letter, one lower case letter and (one number OR one special char).
	// var better = /^(?=\S*?[A-Z])(?=\S*?[a-z])((?=\S*?[0-9])|(?=\S*?[^\w\*]))\S{8,}$/;
	// //Must contain at least one upper case letter, one lower case letter and (one number AND one special char).
	// var best = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{8,}$/;

	// $('#password').on('keyup', function () {
	//     var password = $(this);
	//     var pass = password.val();
	//     var passLabel = $('[for="password"]');
	//     var stength = 'Weak';
	//     var pclass = 'danger';
	//     if (best.test(pass) == true) {
	//         stength = 'Very Strong';
	//         pclass = 'success';
	//     } else if (better.test(pass) == true) {
	//         stength = 'Strong';
	//         pclass = 'warning';
	//     } else if (good.test(pass) == true) {
	//         stength = 'Almost Strong';
	//         pclass = 'warning';
	//     } else if (bad.test(pass) == true) {
	//         stength = 'Weak';
	//     } else {
	//         stength = 'Very Weak';
	//     }
	    
	//     var popover = password.attr('data-content', stength).data('bs.popover');
	//     popover.setContent();
	//     popover.$tip.addClass(popover.options.placement).removeClass('danger success info warning primary').addClass(pclass);

	// });

	// $('input[type="password"]').popover({
	//     placement: 'top',
	//     trigger: 'change'
	// });

});
