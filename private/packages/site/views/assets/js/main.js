$(document).ready(function(){
  
  
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
  
// Cache the Window object
$window = $(window);

// Cache the Y offset and the speed of each sprite
$('[data-type]').each(function() {
  $(this).data('offsetY', parseInt($(this).attr('data-offsetY')));
  $(this).data('speed', $(this).attr('data-speed'));
  $(this).data('Xposition', $(this).attr('data-Xposition'));
});

// For each element that has a data-type attribute
$('.background').each(function(){

// Store some variables based on where we are
var $self = $(this),
    offsetCoords = $self.offset(),
    topOffset = offsetCoords.top;

$(window).scroll(function(){

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
  
  $('[data-type="sprite"]').each(function() {
    
        

        // Cache the sprite
        var $sprite = $(this);
  
        // Use the same calculation to work out how far to scroll the sprite
        var yPos = -($window.scrollTop() / $sprite.data('speed'));					
       // var coords = $sprite.data('Xposition') + ' ' + (yPos + $sprite.data('offsetY')) + 'px';
        
        var x = $sprite.data('Xposition');
        var y = yPos + $sprite.data('offsetY');
        
        console.log(y);
        
        $sprite.css('right', x + 'px').css('top', y + 'px');
        
       // $sprite.css({ right: yPos +  'px'});
        
        
        
      // $sprite.css({ backgroundPosition: coords });													
  
    }); // sprites

  }; // in view

}); // window scroll

});	// each data-type



});
