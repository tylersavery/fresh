<?php
namespace Pigeon\Package;
	
class Nest extends \Pigeon\Package\Base {
	
	static $name = 'Nest';
	static $version = '1.0.0';
	static $dependencies = array();
    static $author = 'David Di Biase';
    static $description = 'The Pigeon main configurator package.';
    
	public static $routes = array(
	    'Nest\Controller\Nest' => array(
	        array('nest')
	    ),
	    'Nest\Controller\Logout' => array(
		    array('nest', 'logout')
		),
	    'Nest\Controller\Packages_Create_Package_Ajax' => array(
		    array('nest', 'packages', 'create_package')
		),
	    'Nest\Controller\Packages_Create_View_Ajax' => array(
		    array('nest', 'packages', 'create_view')
		),
		'Nest\Controller\Packages_Create_Controller_Ajax' => array(
		    array('nest', 'packages', 'create_controller')
		),
		'Nest\Controller\Packages_Create_Model_Ajax' => array(
		    array('nest', 'packages', 'create_model')
		),
		'Nest\Controller\Packages_Edit' => array(
		    array('nest', 'packages', 'edit', '{is_string:package}')
		),
		'Nest\Controller\Packages_Get_File' => array(
		    array('nest', 'packages', 'get', 'file')
		),
		'Nest\Controller\Packages_Save_File' => array(
		    array('nest', 'packages', 'save', 'file')
		),
		'Nest\Controller\Packages_Delete_File' => array(
		    array('nest', 'packages', 'delete', 'file')
		),
	    'Nest\Controller\Model_Editor' => array(
		    array('nest', 'model_editor')
		),
	    'Nest\Controller\Model_Edit_Field_Ajax' => array(
		    array('nest', 'edit_field')
		),
	    'Nest\Controller\Model_Get_Field_Ajax' => array(
		    array('nest', 'get_field')
		),
	    'Nest\Controller\Model_Delete_Field_Ajax' => array(
		    array('nest', 'delete_field')
		)
    );
	
}