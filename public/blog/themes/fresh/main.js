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



	$(".menu_item, .section").click(function(){
		
		var page = $(this).attr('rel');
		
		if(!$(this).hasClass('active')){
			show_page(page);
		}

	});
	
	
	var hash = getHash();
	if(hash != ''){
		show_page(hash);
	}
	
	show_page('freshbossin');

});


function getHash() {
  var hash = window.location.hash;
  return hash.substring(1); // remove #
}

function show_page(page){
	
	
	$(".post").slideUp(300);
	$(".section").removeClass('active');
	$(".menu_item").removeClass('active');
			
	$(".post." + page).slideDown(300);
	$("#section_" + page).addClass('active');
	$("#menu_item_" + page).addClass('active');
	
}