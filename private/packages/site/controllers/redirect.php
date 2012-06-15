<?php
namespace Site\Controller;

class Redirect extends \Base\Controller\Base {

    public function __construct($data, $uri){
       
		switch(strtolower($uri[0])){
			case "theblog":
				$url = 'http://freshbossin.com/';
				break;
			case "events":
				$url = 'http://freshbossin.com/#events';
				break;
			case "498":
				$url = 'http://freshbossin.com/#498';
				break;
			case "dygf":
				$url = 'http://freshbossin.com/#doyou';
				break;
		}
		
		
		header("Location: " . $url);
	   
    }

	public function controller() {
     
        echo "hey";
        
    }
}