<?php
namespace Pigeon\Package;

class Sample extends \Pigeon\Core\Package {
	
    static $name = 'Sample Package';
	static $version = '1.0.0';
    static $author = 'David Di Biase';
	static $dependencies = array();
	static $description = 'A very basic example of all Pigeon functionality.';
	
	public static $routes = array(
	    'Sample\Controller\Sample' => array(
	        array('')
	    ),
	    'Sample\Controller\Ajax' => array(
	    	array('sample', 'ajax', '{is_string:type}'),
		    array('sample', 'ajax')
		),
		'Sample\Controller\Scaffold' => array(
			array('sample', '{is_string:action}')
		)
    );
    
}