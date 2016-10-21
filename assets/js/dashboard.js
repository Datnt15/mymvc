jQuery(document).ready(function($) {

	var url = document.getElementsByTagName('base')[0].href;


	$('#toggle').click(function(){
	    $('#target').toggleClass('active');
	    return false;
	});

	var href = window.location.href,
	page_now = href.substr(href.lastIndexOf('/') + 1);

	/*=========================== Upload Image Handle ============================*/

	$(".upload_img").click(function(event) {
		var formData = new FormData($("#upload_form")[0]);
		
        $.ajax({
            url: url + 'dashboard/upload_img',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
            	data = JSON.parse(data);
            	console.log(data);
            	for (var i = 0; i < data.length; i++) {
            		append_img_and_alert(data[i]);
            	}
            	if (page_now === 'gallery') {
	            	$("#upload_modal").modal('hide');
            	}
            	else {
            		$("#prev").click();
            	}
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
	});


	/*=========================== Deleting Image Handle ============================*/

	$(document).on("click", ".delete_img", function(event) {
		var src = $(this).siblings('img').attr('src'), _this = $(this);
		
        $.post(
        	url + 'dashboard/delete_img', 
        	{ url : src}, 
        	function(data) {
        		console.log(JSON.parse(data));
	        	_this.parent().remove();
	        }
	    );
        return false;
	});

	/*=========================== Append Image & Alert Function Handle ============================*/

	function append_img_and_alert(data){
		var alert = "<div class=\"alert alert-" + data.stt + "\">";
		alert += "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
		alert += "<strong>" + data.message + "</strong></div>";
		$("#message").append(alert);
		if (data.stt === 'success') {
			var img = "<div class=\"col-md-3 col-sm-4 col-xs-6 media_file\">";
					img += "<img class=\"img-responsive\" src=\"" + data.data['img_src'] + "\" alt=\"\">";
					img += "<span class=\"delete_img\">x</span></div>";
			$("#gallery_content").append(img);
		}
	}


	/*============================ Showing Add new form =============================*/
	$("#add_brand_form").hide();

	$(".add_new_brand_btn").click(function() {
		$("#save_brand").addClass('hidden');
		$("#add_brand").removeClass('hidden');
		$("#add_brand_form").show(400);
	});

	/*=========================== Canceling this form ==============================*/

	$("#cancel_form").click(function() {
		$("#add_brand_form").hide(400);		
		return false;
	});

	function html_entity_decode(message){
		return message.replace(/[<>'"]/g, function(m) {
		    return '&' + {
				'\'': 'apos',
				'"': 'quot',
				'&': 'amp',
				'<': 'lt',
				'>': 'gt',
		    }[m] + ';';
		});
	}

	/*=========================== Adding new brand handle =========================*/
	$("#add_brand").click(function(event) {
		var formData = new FormData($("#add_brand_form")[0]);
		$.ajax({
            url: url + 'dashboard/add_brand',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
            	var res = JSON.parse(data);
            	console.log(res);
            	if(res.code === '1000'){
            		var brand = res.data;
            		var tr = '<tr><td><img src="' + html_entity_decode(brand['thumb']) + '" width="50" alt="' + brand['name'] + '">';
					tr += '</td><td>' + brand['name'] + '</td><td>' + html_entity_decode(brand['desc']) + '</td><td>';
					tr += '<button data-id="' + brand['b_id'] + '" class="btn btn-warning edit_brand">';
					tr += '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td><td>';
					tr += '<button data-id="' + brand['b_id'] + '" class="btn btn-warning delete_brand">';
					tr += '<i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>';
					$(".brands-list").append(tr);
					$("#add_brand_form").hide(400);
            	} else {
            		alert(res.message);
            	}
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
	});

	/*================= Setting up target object to insert image source =============*/
	$(".target_input").click(function(event) {
		$("#gallery_modal").modal('show');
		$("#insert_to").val("#" + $(this).attr('id') );
	});

	/*================= Adding animation when ever image's selected =================*/
	$(document).on('click', '.media_file img.img-responsive', function(event) {
		event.preventDefault();
		$("#img_src").val( $(this).attr('src') );
		$(".media_file img.img-responsive.selected").toggleClass('selected');
		$(this).toggleClass('selected');
	});


	/*===================== Fill image's source into object ======================*/
	$(".select_img").on('click', function(event) {
		event.preventDefault();
		if ($("#img_src").val() === '') {
			alert("Vui lòng chọn ảnh trước");
			return;
		}
		$( $("#insert_to").val() ).val( $("#img_src").val() );
		$("#gallery_modal").modal('hide');
	});

	// Intial Border Position
	var activePos = $('.tabs-header .active').position();

	// Change Position
	function changePos() {

		// Update Position
		activePos = $('.tabs-header .active').position();

		// Change Position & Width
		$('.border').stop().css({
			left: activePos.left,
			width: $('.tabs-header .active').width()
		});
	}

	changePos();

	// Change Tab
	function changeTab() {
		var getTabId = $('.tabs-header .active a').attr('tab-id');

		// Remove Active State
		$('.tab').stop().fadeOut(300, function () {
		  	// Remove Class
		  	$(this).removeClass('active');
		}).hide();

		$('.tab[tab-id=' + getTabId + ']').stop().fadeIn(300, function () {
		  	// Add Class
		  	$(this).addClass('active');
		  	
		});
	}

	// Tabs
	$('.tabs-header a').on('click', function (e) {
		e.preventDefault();

		// Tab Id
		var tabId = $(this).attr('tab-id');

		// Remove Active State
		$('.tabs-header a').stop().parent().removeClass('active');

		// Add Active State
		$(this).stop().parent().addClass('active');

		changePos();

		// Update Current Itm
		tabCurrentItem = tabItems.filter('.active');

		// Remove Active State
		$('.tab').stop().fadeOut(300, function () {
		  // Remove Class
		  $(this).removeClass('active');
		}).hide();

		// Add Active State
		$('.tab[tab-id="' + tabId + '"]').stop().fadeIn(300, function () {
		  // Add Class
		  $(this).addClass('active');

		  // Animate Height
		  
		});
	});

	// Tab Items
	var tabItems = $('.tabs-header ul li');

	// Tab Current Item
	var tabCurrentItem = tabItems.filter('.active');

	// Next Button
	$('#next').on('click', function (e) {
	    e.preventDefault();

	    var nextItem = tabCurrentItem.next();

	    tabCurrentItem.removeClass('active');

	    if (nextItem.length) {
	      	tabCurrentItem = nextItem.addClass('active');
	    } else {
	      	tabCurrentItem = tabItems.first().addClass('active');
	    }

	    changePos();
	    changeTab();
	});

	// Prev Button
	$('#prev').on('click', function (e) {
	    e.preventDefault();

	    var prevItem = tabCurrentItem.prev();

	    tabCurrentItem.removeClass('active');

	    if (prevItem.length) {
	      	tabCurrentItem = prevItem.addClass('active');
	    } else {
	      	tabCurrentItem = tabItems.last().addClass('active');
	    }

	    changePos();
	    changeTab();
	});

	// Ripple
	$('[ripple]').on('click', function (e) {
	    var rippleDiv = $('<div class="ripple" />'),
			rippleOffset = $(this).offset(),
			rippleY = e.pageY - rippleOffset.top,
			rippleX = e.pageX - rippleOffset.left,
			ripple = $('.ripple');

	    rippleDiv.css({
			top: rippleY - (ripple.height() / 2),
			left: rippleX - (ripple.width() / 2),
			background: $(this).attr("ripple-color")
	    }).appendTo($(this));

	    window.setTimeout(function () {
	      	rippleDiv.remove();
	    }, 1500);
	});

	/*========================= Deleting brand handle =======================*/

	$(document).on('click', '.delete_brand', function(e) {
		e.preventDefault();
		var _this = $(this), _b_id = _this.attr('data-id');
		$.post(
        	url + 'dashboard/delete_brand', 
        	{ 
        		b_id : _b_id
        	}, 
        	function(data) {
        		console.log( JSON.parse(data) );
	        	_this.parent().parent().remove();
	        }
	    );
        return false;
	});


	/*=========================== Show edit brand form ==========================*/

	$(document).on('click', '.edit_brand', function(event) {
		event.preventDefault();
		var _this = $(this), _b_id = _this.attr('data-id');
		$.get(
			url + 'dashboard/get_brand/' + _b_id,
			function(data) {
				var res = JSON.parse(data);
            	console.log(res);
            	if(res.code === '1000'){
            		var brand = res.data;
            		$("#name").val(brand['name']);
            		$("#desc").text( brand['desc'] ).html();
            		$("#thumb").val( brand['thumb'] );
            		$("#b_id").val(_b_id);
					$("#save_brand").removeClass('hidden');
					$("#add_brand").addClass('hidden');
					$("#add_brand_form").show(400);
            	}
            	else {
            		alert(res.message);
            	}
			}
		);
        return false;
	});


	/*=========================== Saving brand information ============================*/
	$("#save_brand").click(function() {
		var formData = new FormData($("#add_brand_form")[0]);
		$.ajax({
            url: url + 'dashboard/edit_brand',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
            	var res = JSON.parse(data);
            	console.log(res);
            	if(res.code === '1000'){
            		var brand = res.data;
					$("#add_brand_form").toggle(400);
					$(".brands-list tr").each(function(index) {
						var _this = $(this),
						row_b_id = _this.find('td').eq(3).find('button').attr('data-id');

						if ( row_b_id === $("#b_id").val()) {
							_this.find('td').eq(0).find('img').attr('src', brand['thumb']);
							_this.find('td').eq(1).text( brand['name'] );
							_this.find('td').eq(2).html( brand['desc'] ).text();
						}
					});
            	} else {
            		alert(res.message);
            	}
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
	});


});