<?php
namespace Nest\Controller;
	
class Packages_Create_View_Ajax extends \Pigeon\Core\Ajax_Controller {
	
	public function controller() {
		
		if (@\Nest\Controller\Nest::check_logged_in(false)) {
			
			$file = $_POST['package_id'].DS.'views'.DS.strtolower($_POST['view_name']).'.php';
			
			if (! is_file($file)) {

				$fh = fopen(PACKAGE_ROOT.$file, 'w') or die("can't open file");
				fwrite($fh, file_get_contents(PACKAGE_ROOT.'nest'.DS.'views'.DS.'view_template.php'));
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