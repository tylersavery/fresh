<?php
namespace Pigeon\Core;

class Package {
	
    static $name = 'Base Package';
	static $version = '1.0.0';
    static $author = 'No Author';
	static $dependencies;
	static $description;
	static $routes;
	
	static function get_paths() {
		return static::$routes;
	}
    
}