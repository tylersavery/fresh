<?php
namespace Pigeon\Core;

class Static_404_Controller extends Base_Controller {
	
	function controller() {
	    header('HTTP/1.0 404 Not Found');
	    echo "<h1>404 Not Found</h1>";
	    echo "The page that you have requested could not be found.";
	    exit();
	}
	
}