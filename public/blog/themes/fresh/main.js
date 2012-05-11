var first_show = true;
var current_page;

jQuery(document).ready(function(){
	
	
	load_all_posts();

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
	
	current_page = page;
	
	$(".post").slideUp(time);
	$(".section").removeClass('active');
	$(".menu_item").removeClass('active');
			
	$(".post." + page).slideDown(time);
	$("#section_" + page).addClass('active');
	$("#menu_item_" + page).addClass('active');
	
	first_show = false;
	
}


function load_all_posts(){
	
   var totalPages = $("#hidden_navinfo .totalpages").text();
   for ( var i = 1, len = totalPages; i < len; i++) {
		var count = i+1;
		var new_posts = "";
		$.get("/page/" + count, function(data) {
		 	//$("#posts").append($('#posts', $(data)));
			//$("#newposts").append($(data));
		
			console.log(data);
		
		});
			
	}
	
}