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
 * A script that handles resolving the paths of Pigeon.
 *
 * @package Router
 */
namespace Pigeon\Core;

class Router {
    
    /**
     * The full URI of the given path.
     *
     * @var array
     */
    protected static $uri;
    /**
     * The flattened, string based version of the URI.
     *
     * @var string
     */
    protected static $uri_string;
    /**
     * A reference to the controller.
     *
     * @var class
     */
    protected static $controller;
    /**
     * Not sure.
     *
     * @var array
     */
    protected static $controllers;
    /**
     * Data contained by the controller.
     *
     * @var array
     */
    protected static $controller_data;
    
    /**
     * Sets the paths that the router will resolve.
     *
     * @param array $paths Pass paths with controller as key and resolve paths as subarrays.
     * @return boolean If method success, will return true.
     */
    public static function set_paths($paths) {
        static::$controllers = $paths;
        return true;
    }
    
    /**
     * Resolves the current URL to the correct path.
     *
     * @param boolean $recurse Should the script continue parsing or look into package routes.
     * @return string Renders out the view directly.
     */
    public static function resolve($recurse = true) {
        
        static::$uri_string = (isset($_GET['p'])) ? rtrim($_GET['p'], '/') : '';
        static::$uri = explode('/', static::$uri_string);
        
        // Handle incoming asset requests
        if (! $recurse
            && isset(static::$uri[0])
            && (static::$uri[0] == 'js' || static::$uri[0] == 'css' || static::$uri[0] == 'img')) {
            
            // Build the file path
            $file = PACKAGE_ROOT.static::$uri[1].DS.'views'.DS.'assets'.DS.static::$uri[0].DS.join(DS, array_slice(static::$uri, 2));

            if (@is_file($file)) {
            
                switch (static::$uri[0]) {
                    case 'js':  $mime = 'text/javascript'; break;
                    case 'css': $mime = 'text/css'; break;
                    case 'img':
                        switch (substr($file, -3)) {
                            case 'jpg':
                            case 'peg':
                                $mime = 'image/jpeg';
                                break;
                            case 'png':
                                $mime = 'image/png';
                                break;
                            case 'gif':
                                $mime = 'image/gif';
                                break;
                            default:
                                $mime = 'application/octet-stream';
                                break;
                        }
                    break;
                }
                header('Content-Type: text/'.((static::$uri[0] == 'js') ? 'javascript' : 'css'));
                header('Expires: Mon, 26 Jul 2025 05:00:00 GMT');
                header('Cache-Control: max-age=315360000');
                header('Pragma: no-cache');
                die(file_get_contents($file));
            }
        }
        
        $preg_pattern = '/[a-zA-Z]/';
        foreach (static::$uri as $key => $value) {
            preg_match($preg_pattern, $value, $matches);
            if (empty($matches)) {
                if ((int) $value != null) static::$uri[$key] = (int) $value;
                else if ((float) $value != null) static::$uri[$key] = (float) $value; 
            }
        }
        
        $match = false;

        if (count(static::$controllers) != 0) {
            foreach (static::$controllers as $controller => $patterns) {
                
                if ($match) break;
                
                foreach ($patterns as $pattern) {
                    
                    if ($match) break;
                    $pattern_string = '';
                    
                    foreach ($pattern as $pattern_key=>$pattern_value) {
                        $pattern_needle = '~'.$pattern_value;
                        if (strpos($pattern_needle, '{') && strpos($pattern_needle, '}')) {   
                            $stripped_pattern = str_replace(array('{', '}'), '', $pattern_value);
                            $data_options = explode('||', $stripped_pattern);
                            $data_match = false;
                            
                            if (isset(static::$uri[$pattern_key])) {
                                foreach ($data_options as $data_option) { 
                                    $data = explode(':', $data_option);
                                    if ($data[0](static::$uri[$pattern_key])) {
                                        static::$controller_data[$data[1]] = static::$uri[$pattern_key];
                                        $data_match = true;
                                        break;
                                    } 
                                }
                            }
                            if ($data_match) $pattern_string .= static::$uri[$pattern_key];  
                        } else {
                            $pattern_string .= $pattern_value;
                        } 
                        if ($pattern_key != (sizeof($pattern)-1)) $pattern_string .= '/';   
                    }
                    
                    if ($pattern_string == static::$uri_string) {
                        $match = true;
                        static::$controller = new $controller(static::$controller_data, static::$uri);
                        break;
                    } else { 
                        static::$controller_data = null; 
                    }
                }
            }
        }
        
        // Find a package and it's related routes paths
        if (empty(static::$controller) && $recurse) {
            
            $controller = static::$uri[0];
            $packages = &\Pigeon\Core\Config::$packages;

            for ($j = 0; $j <= $packages->getSize() - 1; $j++) {

                if ($packages->current() == $controller) {
                    $controller = PACKAGE_ROOT.$controller.DS.$controller.'.php';
                    if (is_file($controller)) {
                        $controller = 'Pigeon\Package\\'.ucfirst(static::$uri[0]);
                        
                        $controller = new $controller();
                        static::set_paths($controller->get_paths());
                        return static::resolve(false);
                    }
                }
                $packages->next();
            }
        }
        
        // Search for routes in a package
        if (defined('ROOT_PACKAGE') && $recurse) {
            $controller = 'Pigeon\Package\\'.ROOT_PACKAGE;
            $controller = new $controller();
            static::set_paths($controller->get_paths());
            static::resolve(false);
            return true;
        }
        
        // Display the 404 class if nothing else was found
        if (empty(static::$controller)) {
            $static_root = '\Base\Controller\Static_404';
            static::$controller = new $static_root(static::$uri, static::$controller_data);
            static::$controller->controller();
        } else {
            static::output();
        }
        return true;
    }
    
    /**
     * Outputs the controller response.
     *
     * @return string Outputs html from the given request
     */
    public static function output() {
        static::$controller->controller();
        static::$controller->render_view();
    }
    
}