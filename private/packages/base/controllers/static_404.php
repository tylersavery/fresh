<?php
namespace Base\Controller;

class Static_404 extends Base {
	
	function controller() {
	    header('HTTP/1.0 404 Not Found');
	    echo "<h1>Custom 404 Not Found</h1>";
	    echo "The page that you have requested could not be found.";
	    exit();
	}
	
}