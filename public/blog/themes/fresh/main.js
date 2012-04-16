jQuery(document).ready(function(){
	
	
	

	$(".slider-feature").anythingSlider({
		width: 920,
		buildNavigation: false,
		buildStartStop: false,
		hashTags: false,
		delay: 2500,
		autoPlay: true,
		resizeContents:false


	});
	
	
	$(".slider").anythingSlider({
		width: 920,
		buildNavigation: false,
		buildStartStop: false,
		hashTags: false,
		delay: 2500,
		autoPlay: false,
		resizeContents:false


	});

	$(".post.store").hide();
	
	$("#social .social_item#social_item_instagram").mouseover(function(){
	  $("#hidden_instagram").fadeIn(300);
	  
	});
	  
	  
	$("#social .social_item#social_item_instagram").mouseout(function(){
			$("#hidden_instagram").fadeOut(300);
	});


	$(" #menu_item_store, #section_store").live('click', function(){
		
		
		
		if(!$(this).hasClass('active')){
			$(".post.freshbossin").slideUp(300, function(){
				
			
			});
			
			$(".post.store").slideDown(300);
				$("#section_freshbossin").removeClass('active');
				$("#section_store").addClass('active');
				$("#menu_item_freshbossin").removeClass('active');
				$("#menu_item_store").addClass('active');
		}

	});

	$("#section_freshbossin, #menu_item_freshbossin").click(function(){

		if(!$(this).hasClass('active')){
			$(".post.store").slideUp(300, function(){
			
			
			});
				$(".post.freshbossin").slideDown(300);
				$("#section_store").removeClass('active');
				$("#section_freshbossin").addClass('active');
				$("#menu_item_store").removeClass('active');
				$("#menu_item_freshbossin").addClass('active');
		}

	});
	
	
	var hash = getHash();
	if(hash == 'events'){
		
		$(".post.freshbossin").slideUp(300);
			
		$(".post.store").slideDown(300);
		$("#section_freshbossin").removeClass('active');
		$("#section_store").addClass('active');
		$("#menu_item_freshbossin").removeClass('active');
		$("#menu_item_store").addClass('active');
		
	}

});


function getHash() {
  var hash = window.location.hash;
  return hash.substring(1); // remove #
}