jQuery(document).ready(function(){
		alert("HEY");

	$(".slider").anythingSlider({
		width: 920,
		buildNavigation: false,
		buildStartStop: false,
		hashTags: false,
		delay: 2500,
		autoPlay: true


	});


	$(".post.store").hide();

	$(" #menu_item_store, #section_store").live('click', function(){

		alert('click');
		
		if(!$(this).hasClass('active')){
			$(".post.freshbossin").slideUp(300, function(){
				$(".post.store").slideDown(300);
				$("#section_freshbossin").removeClass('active');
				$("#section_store").addClass('active');
				$("#menu_item_freshbossin").removeClass('active');
				$("#menu_item_store").addClass('active');
			});
		}

		

	});

	$("#section_freshbossin, #menu_item_freshbossin").click(function(){

		if(!$(this).hasClass('active')){
			$(".post.store").slideUp(300, function(){
				$(".post.freshbossin").slideDown(300);
				$("#section_store").removeClass('active');
				$("#section_freshbossin").addClass('active');
				$("#menu_item_store").removeClass('active');
				$("#menu_item_freshbossin").addClass('active');
			});
		}

	});

});