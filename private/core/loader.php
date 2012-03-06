<?php
/**
 * ---------------------------------------------------------------
 * PigeonMVC v0.5
 * ---------------------------------------------------------------
 * @author Pilot Interactive Inc.
 * @see http://www.pigeonmvc.com
 * @license Unreleased
 * ---------------------------------------------------------------
 * 
 * Autoloads many of the dependent classes within Pigeon.
 *
 * @package Loader
 */
namespace Pigeon\Core;

class Loader {
    
    /**
     * Initiates the autoload register function.
     */
	static function init() {
        set_include_path(get_include_path().PATH_SEPARATOR.dirname(dirname(__FILE__)));
		spl_autoload_register('Pigeon\Core\Loader::loadClass', true);
	}
    
    /**
     * Actually performs the autoloader.
     *
     * @param string $class_name Defines the name of the class that is to be required.
     * @return boolean If method success, will return true.
     */
    static function loadClass($class_name) {
        
        $class_array = explode('\\', strtolower($class_name));
        
        if ($class_array[1] == 'core') {
            $class_file = 'core'.DS.$class_array[2].'.php';
        } else if ($class_array[1] == 'library') {
            $class_file = 'libraries'.DS.$class_array[2].'.php';
        } else if($class_array[1] == 'package') {
            $class_file = 'packages'.DS.$class_array[2].DS.$class_array[2].'.php';
        // Handles requests for models or controllers
        } else {
            $class_file = 'packages'.DS.$class_array[0].DS.$class_array[1].'s'.DS.$class_array[2].'.php';
        }
        
		if (! empty($class_file)) {
			require_once($class_file);
		} else {
            throw new \Pigeon\Core\Exception('The library '.$class_name.'('.$class_file.') could not be found.');
        }
        return true;
        
	}
    
}
Loader::init();