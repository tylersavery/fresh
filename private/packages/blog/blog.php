<?php
namespace Pigeon\Package;
	
class blog extends \Pigeon\Package\Base {
	
	static $name = 'Blog';
	static $version = '1.0';
	static $author = 'Tyler Savery';
	static $description = 'Blog with posts, comments. requires users';
	static $dependencies = array();
	
	public static $routes = array(
	    'blog\Controller\blog' => array(
	        array('blog')
	    ),
		'Blog\Controller\Scaffold' => array(
			array('blog', '{is_string:action}')
		)
    );
	
}