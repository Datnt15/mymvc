jQuery(document).ready(function($) {
	$("#login-btn").on('click', function() {
		$("#results").text('');
		var url = $("#login-form").attr('action'),
		username = $("#username").val(),
		password = $("#password").val();
		$.post(
			url, 
			{
				username : $("#username").val(),
		        password : $("#password").val()
		    }, function(data) {
		    	data = JSON.parse(data);
			    console.log(data);
			    var message = "<div class=\"alert col-md-12 alert-warning\" role=\"alert\">";
				message += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\"";
				message += " aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
				message += "<i class=\"fa fa-info fa-fw\"></i> " + data.message + "</div>";
				$("#results").append(message);
				$("#results").slideDown('400');
			    // if (data.code === '1000') {
			    // 	alert(data.message);
			    // }
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
});
