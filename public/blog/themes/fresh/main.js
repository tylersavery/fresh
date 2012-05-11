var first_show = true;

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
	} else {
		show_page('freshbossin');
	}
	
	

});


function getHash() {
  var hash = window.location.hash;
  return hash.substring(1); // remove #
}

function show_page(page){
	
	if(first_show){
		time = 0;
	} else {
		time = 300;
	}
	
	$(".post").slideUp(time);
	$(".section").removeClass('active');
	$(".menu_item").removeClass('active');
			
	$(".post." + page).slideDown(time);
	$("#section_" + page).addClass('active');
	$("#menu_item_" + page).addClass('active');
	
	first_show = false;
	
}