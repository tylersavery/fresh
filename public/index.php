<?php
/**
 * ---------------------------------------------------------------
 * PigeonMVC v0.5
 * ---------------------------------------------------------------
 * @author Pilot Interactive Inc.
 * @see http://www.pigeonmvc.com
 * @license Unreleased
 * @package Bootstrap
 * ---------------------------------------------------------------
 */

define('DS', DIRECTORY_SEPARATOR);
define('DOCUMENT_ROOT', dirname(dirname(__FILE__)).DS);

require_once(DOCUMENT_ROOT.'private'.DS.'core'.DS.'loader.php');

Pigeon\Core\Config::init();
Pigeon\Core\Router::resolve();