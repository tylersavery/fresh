<?php
namespace Pigeon\Package;

class PinGenerator extends \Pigeon\Package\Base {
	
	static $name = 'PinGenerator';
	static $version = '1.0';
	static $author = 'David Di Biase';
	static $description = 'Generates pin codes for a variety of campaigns.';
	static $dependencies = array();
	
	public static $routes = array(
	    'PinGenerator\Controller\Generator' => array(
	        array('generate')
	    ),
	    'PinGenerator\Controller\Manager' => array(
	    	array('manage', '{is_string:action}')
	    )
    );
	
}