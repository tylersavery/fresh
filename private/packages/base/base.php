<?php
namespace Pigeon\Package {

	class Base {
		
		static $name = 'Base';
		static $author  = 'No Author';
		static $created = 'Never';
		static $description = 'The base package which Pigeon mostly depends on.';
		static $version      = '1.0.0';
		static $dependencies = array();
		static $routes       = array();
		
		public function get_paths() {
			return static::$routes;
		}
		
	}
	
}