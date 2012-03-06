<?php
namespace Nest\Controller;

class Packages_Get_File extends \Pigeon\Core\Ajax_Controller {
	
	public function controller() {
		if (@\Nest\Controller\Nest::check_logged_in(false)) {
			$this->output = 'html';
			$this->data = file_get_contents(PACKAGE_ROOT.str_replace('\\\\', DS, $_GET['path']));
		} else {
			$this->response = 'not_logged_in';
		}
	}
	
}