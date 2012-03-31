jQuery(document).ready(function(){

	$(".slider").anythingSlider({
		width: 920,
		buildNavigation: false,
		buildStartStop: false,
		hashTags: false,
		delay: 2500,
		autoPlay: true,
		resizeContents:false


	});

	$(".post.store").hide();

	$(" #menu_item_store, #section_store").live('click', function(){
		
		
		
		if(!$(this).hasClass('active')){
			$(".post.freshbossin").slideUp(300, function(){
				
				$("#section_freshbossin").removeClass('active');
				$("#section_store").addClass('active');
				$("#menu_item_freshbossin").removeClass('active');
				$("#menu_item_store").addClass('active');
			});
			
			$(".post.store").slideDown(300);
		}

	});

	$("#section_freshbossin, #menu_item_freshbossin").click(function(){

		if(!$(this).hasClass('active')){
			$(".post.store").slideUp(300, function(){
			
				$("#section_store").removeClass('active');
				$("#section_freshbossin").addClass('active');
				$("#menu_item_store").removeClass('active');
				$("#menu_item_freshbossin").addClass('active');
			});
				$(".post.freshbossin").slideDown(300);
		}

	});

});