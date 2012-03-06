<?php
namespace Pigeon\Package;
	
class {{package_id}} extends \Pigeon\Package\Base {
	
	static $name = '{{package_name}}';
	static $version = '{{version}}';
	static $author = '{{author}}';
	static $description = '{{description}}';
	static $dependencies = array();
	
	public static $routes = array(
	    '{{package_id}}\Controller\{{package_id}}' => array(
	        array('{{package_id}}')
	    )
    );
	
}