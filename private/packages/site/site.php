<?php
namespace Pigeon\Package;
	
class site extends \Pigeon\Package\Base {
	
	static $name = 'Site';
	static $version = '1.0';
	static $author = 'Tyler Savery';
	static $description = 'Site container (mostly frontend)';
	static $dependencies = array();
	
	public static $routes = array(
	    'site\Controller\site' => array(
	        array('')
	    )
    );
	
}