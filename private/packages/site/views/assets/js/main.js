/* globals */ 
var current;
var map;

lat = 43.647870;
lng = -79.401176;
zoom = 16;

stadium_lat = 43.635215;
lat_offset = lat - stadium_lat;

$(document).ready(function(){


  set_bar_x();


  set_arrow_position();
  init_map();

   $("#menu li a, #right_nav_links_container li a").click(function(){
    

    var rel = $(this).attr('href');
    rel = rel.replace('#', '');
    rel = rel.replace('background_', '');


    var $target = $('#container_' + rel);
    var offset_y = $target.offset().top;

    $('body, html').animate({
        
        scrollTop: offset_y
        
        }, 2000);
        
    return false;
    
  });
  
// Cache the Window object
$window = $(window);

  set_arrow_position();

// Cache the Y offset and the speed of each sprite
$('[data-type]').each(function() {
  $(this).data('offsetY', parseInt($(this).attr('data-offsetY')));
  $(this).data('speed', $(this).attr('data-speed'));
  $(this).data('Xposition', $(this).attr('data-Xposition'));
});

$('#right_nav_links_container').each(function(){

  var $self = $(this),
      offsetCoords = $self.offset(),
      topOffset = offsetCoords.top;

  $(window).scroll(function(){

       // Scroll the background at var speed
    // the yPos is a negative value because we're scrolling it UP!
    var yPos = -($window.scrollTop() / $self.data('speed'));

    // If this element has a Y offset then add it on
    if ($self.data('offsetY')) {
      yPos += $self.data('offsetY');
    }

    // Move the background
    $self.css({ marginTop: (yPos + 'px')});


  });


}); //#right_nav_links_container

$('#map').each(function(){

  var $self = $(this),
      offsetCoords = $self.offset(),
      topOffset = offsetCoords.top;

  $(window).scroll(function(){

       // Scroll the background at var speed
    // the yPos is a negative value because we're scrolling it UP!
    var yPos = -($window.scrollTop() / $self.data('speed'));

    // If this element has a Y offset then add it on
    if ($self.data('offsetY')) {
      yPos += $self.data('offsetY');
    }

    // Move the background
    //$self.css({ marginTop: (yPos + 'px')});
    
    var window_offset = $(document).height() - $window.height();

    console.log(window_offset);

    var extra_lat = 0.002;

    lat_offseet = lat + ((yPos + 500) * 0.00001) + lat_offset;

   // lat_offseet = lat;

    //console.log(lat_offseet);

    var newLatLng = new google.maps.LatLng(lat_offseet, lng);

   // console.log(newLatLng)
    map.setCenter(newLatLng);
    

  });


}); //#right_nav_links_container

// For each element that has a data-type attribute
$('.background').each(function(){

  // Store some variables based on where we are
  var $self = $(this),
      offsetCoords = $self.offset(),
      topOffset = offsetCoords.top;

  $(window).scroll(function(){


  //scroll spy

  if ( ($window.scrollTop() + $window.height()) > (topOffset) &&
  ( (topOffset + $self.height()) > $window.scrollTop() ) ) {

    if(current != $self){
      
        current = $self;
        var id = $self.attr('id');

        var target = $('li.right_nav_link a[href="#' + id + '"]');
        
        $(".right_nav_link").removeClass('active');
        target.parent().addClass('active');

         //top menu

         var top_id = id.replace('background_', '');

         var top_target = $('#menu ul li a[href="#' + top_id + '"]')
        
         $("#menu ul li a").removeClass('active'); 
         top_target.addClass('active');

        set_arrow_position();

    }

  }

  if($window.scrollTop() == $(document).height() - $window.height()){

      $("#right_nav_links_container li").removeClass('active'); 
      $("#bottom_link").addClass('active');


  }



  // If this section is in view
  if ( ($window.scrollTop() + $window.height()) > (topOffset) &&
  ( (topOffset + $self.height()) > $window.scrollTop() ) ) {

    // Scroll the background at var speed
    // the yPos is a negative value because we're scrolling it UP!
    var yPos = -($window.scrollTop() / $self.data('speed'));

    // If this element has a Y offset then add it on
    if ($self.data('offsetY')) {
      yPos += $self.data('offsetY');
    }

    // Put together our final background position
    var coords = '50% '+ yPos + 'px';

    // Move the background
    $self.css({ backgroundPosition: coords });
    
   // var percent = $window.scrollTop() / topOffset; //- $self.data('offsetY');

   // console.log(percent);
    
    $('[data-type="sprite"]').each(function() {
      

          // Cache the sprite
          var $sprite = $(this);
    
          // Use the same calculation to work out how far to scroll the sprite
          var yPos = -($window.scrollTop() / $sprite.data('speed'));					
         // var coords = $sprite.data('Xposition') + ' ' + (yPos + $sprite.data('offsetY')) + 'px';
          
          var xPos = -($window.scrollTop() / $sprite.data('speed'));
          
          
          var x = $sprite.data('Xposition');
          var y = yPos + $sprite.data('offsetY');
          
       
          x = '49';

          $sprite.css('right', x + 'px').css('top', y + 'px');
          
      }); // sprites

    }; // in view

  }); // window scroll

  });	// each data-type

});


$(window).resize(function(){

  set_bar_x();

});



function set_arrow_position(){

    var $active_link = $(".right_nav_link.active");
    var offset = $active_link.offset();
    var vscroll = (document.all ? document.scrollTop : window.pageYOffset);
    var arrow_offset = 8;
    offset = offset.top - vscroll - arrow_offset;


    $("#right_nav_arrow").css('top', offset + 'px');

}


function init_map(){

var latLng = new google.maps.LatLng(lat, lng);
  
  var myOptions = {
    zoom: zoom,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false,
    mapTypeControl: false,
    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.BOTTOM_CENTER
    },
    panControl: false,
    panControlOptions: {
        position: google.maps.ControlPosition.TOP_RIGHT
    },
    zoomControl: false,
    zoomControlOptions: {
        style: google.maps.ZoomControlStyle.SMALL,
        position: google.maps.ControlPosition.BOTTOM_LEFT
    },
    scaleControl: false,
    scaleControlOptions: {
        position: google.maps.ControlPosition.TOP_LEFT
    },
    streetViewControl: false,
    streetViewControlOptions: {
        position: google.maps.ControlPosition.LEFT_TOP
    }
  };

  map = new google.maps.Map(document.getElementById('map'), myOptions);

  var marker = new google.maps.Marker({
        position: latLng, 
        map: map,
        title:"Here we are!"
    });   






}


function set_bar_x(){

  var x = Math.floor(($(window).width() - 1280) / 2);
  $("#right_nav").css('right', x + 'px');

}


