<?php
namespace Nest\Controller;
	
class Packages_Create_Controller_Ajax extends \Pigeon\Core\Ajax_Controller {
	
	public function controller() {

		if (@\Nest\Controller\Nest::check_logged_in(false)) {

			$controller = $_POST['package_id'].DS.'controllers'.DS.strtolower($_POST['controller_name']).'.php';
			$file = PACKAGE_ROOT.$controller;

			if (! is_file($file)) {

				$m = new \Mustache();
				$_POST['package_id'] = ucfirst($_POST['package_id']);
				$_POST['controller_name'] = ucfirst($_POST['controller_name']);
				$_POST['type'] = ucfirst($_POST['type']);

				$package_data = $m->render(file_get_contents(PACKAGE_ROOT.'nest'.DS.'views'.DS.'controller_template.php'), $_POST);

				$fh = fopen($file, 'w') or die("can't open file");
				fwrite($fh, $package_data);
				fclose($fh);

				$this->path = $controller;
				$this->response = 'success';
				
			} else {
				$this->response = 'already_exists';
			}
			
		} else {
			$this->response = 'not_logged_in';
		}
	}
}