// alert('aaaa minh on');
 $(document).ready(function () {
 	$(".dot").on('click', function() {
 		var slide = $(this).find('span').attr('href'),
 		active_slide = $('.item.active').attr('id');
 		if (slide === '#slide_1' && active_slide === 'slide_2' ) {
 			$("#slide_1 img").addClass('zoomIn');
 		}
 		console.log('MINH ON MA');
 		$("#slide_1").removeClass('zoomIn');
 		$('.item.active').toggleClass('active');
 		$(slide).toggleClass('active');
 	});
 	
});