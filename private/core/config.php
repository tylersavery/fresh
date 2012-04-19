<?php
/**
 * ---------------------------------------------------------------
 * PigeonMVC v0.5
 * ---------------------------------------------------------------
 * @author Pilot Interactive Inc.
 * @see http://www.pigeonmvc.com
 * @license Unreleased
 * @package Config
 * ---------------------------------------------------------------
 * 
 * Master configuration file for the framework.
 *
 * @package Config
 */
namespace Pigeon\Core;

class Config {

    static public $packages;

    /**
     * Initiates the main definitions and environment settings.
     */
    public static function init() {
        
        static::$packages = new \SplFixedArray(2);
        static::$packages[0] = 'nest';
        static::$packages[1] = 'sample';
        static::$packages[1] = 'PinGenerator';

        define('ENVIRONMENT', $_SERVER['SERVER_NAME']);
        define('PRIVATE_ROOT', DOCUMENT_ROOT.'private'.DS);
        define('PUBLIC_ROOT',  DOCUMENT_ROOT.'public'.DS);
        define('LIBRARY_ROOT', PRIVATE_ROOT.'libraries'.DS);
        define('PACKAGE_ROOT', PRIVATE_ROOT.'packages'.DS);

        static::init_includes();

        // This doesn't have to be defined
        define('ROOT_PACKAGE', 'site');

        switch (ENVIRONMENT) {
            case 'getfreshcompany.com':
            case 'www.getfreshcompany.com':
                define('MODE', 'PRODUCTION');
                define('DB_HOST', '127.0.0.1');
                define('DB_USER', 'fresh');
                define('DB_PASS', 'aiNgahBu3wah');
                define('DB_NAME', 'fresh');
                define('DB_SALT', '0c280e4ea00a8626830d0368a01e8da7');
            break;
        
            case 'fresh.theyoungastronauts.com':
                define('MODE', 'PRODUCTION');
                define('DB_HOST', '127.0.0.1');
                define('DB_USER', 'fresh');
                define('DB_PASS', 'aiNgahBu3wah');
                define('DB_NAME', 'fresh');
                define('DB_SALT', '0c280e4ea00a8626830d0368a01e8da7');
            break;
        
            case 'getfreshco.com':
                define('MODE', 'PRODUCTION');
                define('DB_HOST', '127.0.0.1');
                define('DB_USER', 'dbname');
                define('DB_PASS', 'dbpass');
                define('DB_NAME', 'dbuser');
                define('DB_SALT', '0c280e4ea00a8626830d0368a01e8da7');
            break;
        
            case 'fresh':
                define('MODE', 'DEVELOPMENT');
                define('DB_HOST', '127.0.0.1');
                define('DB_USER', 'root');
                define('DB_PASS', '');
                define('DB_NAME', 'fresh');
                define('DB_SALT', '0c280e4ea00a8626830d0368a01e8da7');
            break;


            default:
                die('You must define configuration settings for this server.');

        }
        static::init_database();
    }

    /**
     * Establishes the database connection.
     */
    public static function init_database() {
        global $conns;
        $conns = array(
            'main' => 'mysql://' . DB_USER . ':' . DB_PASS . '@' . DB_HOST . '/' . DB_NAME
        );
        \ActiveRecord\Config::initialize(function($c) use ($conns) {
            $c->set_connections($conns);
            $c->set_default_connection('main');
        });
    }

    /**
     * Conducts any further includes required by the framework.
     */
    public static function init_includes() {
        require_once(LIBRARY_ROOT.'PHPActiveRecord1.0/ActiveRecord.php');
        require_once(LIBRARY_ROOT.'Mustache.php');
    }

}