var current_scroll;

$(document).ready(function(){
   
  current_scroll = $(window).scrollTop();
  
  
  
  $("#menu li a").click(function(){
    
    var rel = $(this).attr('href');
    var rel = rel.replace('#', '');
    
    var $target = $('#container_' + rel);
    var offset_y = $target.offset().top;

    
    
    $('body, html').animate({
        
        scrollTop: offset_y
        
        }, 2000);
    
    
    return false;
    
  });
  
  
});


$(window).bind('scroll', function(){
    
   current_scroll = $(window).scrollTop();
   
   console.log('CURRENT SCROLL: ' + current_scroll);
   
   update();
    
});



function update(){
    
    var $content;
    var percent;
    var right;
    var $bg;
    
    if(current_scroll >= 0 && current_scroll <= 550){
        
        percent = current_scroll / 550;
        right = (0 - (0 - ((percent * 500) - 500))) * 2;
        $content = $("#content_events");
        $bg = $("#background_events");
 
    } else if(current_scroll >= 551 && current_scroll <= 1200){
        
        percent = current_scroll / 1200; 
        right = (0 - (0 - ((percent * 500) - 500))) * 2;
        $content = $("#content_store");
        
        $bg = $("#background_store");
 
    } else if(current_scroll >= 1201 && current_scroll <= 2005){
        
        percent = current_scroll / 2005; 
        right = (0 - (0 - ((percent * 500) - 500))) * 2;
        $content = $("#content_kinlock");
            
        $bg = $("#background_kinlock")
 
    } else if(current_scroll >= 2006 && current_scroll <= 2734){
        
        percent = current_scroll / 2734; 
        right = (0 - (0 - ((percent * 500) - 500))) * 2;
        $content = $("#content_blog");
        
        $bg = $("#background_blog")
 
    } else {
        $content = false;
        $bg = false;
    }
    
    var extra = 20;
    
    if(right > 0){
        right = 0;
    }
    
    y = Math.round(right / 3);
    
    if($content != false){
        $content.css('right', right + extra + 'px');
    }
    
    if($bg != false){
        $bg.css('background-position-y', y + 'px');
        console.log($bg);
        console.log(y);
    }
    
    
    
}