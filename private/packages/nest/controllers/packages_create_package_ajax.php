<?php
namespace Nest\Controller;

class Packages_Create_Package_Ajax extends \Pigeon\Core\Ajax_Controller {
	
	public function controller() {

		if (@\Nest\Controller\Nest::check_logged_in(false)) {

			if (! is_dir(PACKAGE_ROOT.$_POST['package_id'])) {

				mkdir(PACKAGE_ROOT.$_POST['package_id'].DS.'views'.DS.'assets'.DS.'js', 0777, true);
				mkdir(PACKAGE_ROOT.$_POST['package_id'].DS.'views'.DS.'assets'.DS.'css', 0777, true);
				mkdir(PACKAGE_ROOT.$_POST['package_id'].DS.'views'.DS.'assets'.DS.'img', 0777, true);
				mkdir(PACKAGE_ROOT.$_POST['package_id'].DS.'controllers', 0777, true);
				mkdir(PACKAGE_ROOT.$_POST['package_id'].DS.'models', 0777, true);

				$m = new \Mustache();
				$package_data = $m->render(file_get_contents(PACKAGE_ROOT.'nest'.DS.'views'.DS.'package_template.php'), $_POST);
				$file = PACKAGE_ROOT.strtolower($_POST['package_id']).DS.strtolower($_POST['package_id']).'.php';

				$fh = fopen($file, 'w') or die("can't open file");
				fwrite($fh, $package_data);
				fclose($fh);
				
				$this->path = $file;
				$this->response = 'success';
				
			} else {
				$this->response = 'already_exists';
			}

		} else {
			$this->response = 'not_logged_in';
		}
	}

}