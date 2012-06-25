var first_show = true;
var current_page;

jQuery(document).ready(function(){
	
	
	load_all_posts();



	
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
	
	var splittedUrl = window.location.href.split("/");
	var depth = 5;
	var url1 =  splittedUrl[3] + '/';
	
	/*
	if(url1 == 'post'){
		var donthide = true;
	} else {
		var donthide = false;
	}
	*/
	
	if(first_show){
		time = 0;
	} else {
		time = 300;
	}
	
	current_page = page;
	
	if(!donthide){
		$(".post").hide();
	}
	
	$(".section").removeClass('active');
	$(".menu_item").removeClass('active');
			
	$(".post." + page).show();
	$("#section_" + page).addClass('active');
	$("#menu_item_" + page).addClass('active');
	
	init_sliders();
	window.setTimeout(init_sliders, 1000);
	
	first_show = false;
	
}


function load_all_posts(){
	
   var totalPages = $("#hidden_navinfo .totalpages").text();
   for ( var i = 1, len = totalPages; i < len; i++) {
		var count = i+1;
		var new_posts = "";
		var html = "";
		$.get("/page/" + count, function(data) {
		 	//$("#posts").append($('#posts', $(data)));
			//$("#newposts").append(data);
			
			//console.log($('#posts', $(data)));
						
			$("#newposts").append($('#posts', $(data)));
			init_sliders();
			
			window.setTimeout(init_sliders, 2000);
			show_page(current_page);
			init_addthis();
			
			
		});
	}

	
}



function init_sliders(){
		
	$(".slider-feature").anythingSlider({
		width: 920,
		buildNavigation: false,
		buildStartStop: false,
		hashTags: false,
		delay: 2500,
		autoPlay: true,
		resizeContents:false

	});
	
	
	$(".slider").each(function(){
		
		$(this).anythingSlider({
			width: 920,
			buildNavigation: false,
			buildStartStop: false,
			hashTags: false,
			delay: 2500,
			autoPlay: false,
			resizeContents:false,
			//infiniteSlides:false
	
		});
		
	});
	

}


function init_addthis(){
	var script = 'http://s7.addthis.com/js/250/addthis_widget.js#domready=1';
	if (window.addthis){
		window.addthis = null;
	}
	$.getScript( script );
}