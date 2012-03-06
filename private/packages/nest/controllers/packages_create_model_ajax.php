<?php
namespace Nest\Controller;
	
class Packages_Create_Model_Ajax extends \Pigeon\Core\Ajax_Controller {
	
	public function controller() {
		
		if (@\Nest\Controller\Nest::check_logged_in(false)) {
			
			$controller = $_POST['package_id'].DS.'models'.DS.strtolower($_POST['model_name']).'.php';
			$file = PACKAGE_ROOT.$controller;
			
			if (! is_file($file)) {
				
				$m = new \Mustache();

				$_POST['package_name'] = ucfirst($_POST['package_id']);
				$_POST['model_name'] = ucfirst($_POST['model_name']);
				
				// Generate the model's PHP file
				$model_data = $m->render(file_get_contents(PACKAGE_ROOT.'nest'.DS.'views'.DS.'model_template.php'), $_POST);
				$fh = fopen($file, 'w') or die("can't open file");
				fwrite($fh, $model_data);
				fclose($fh);
				
				// Generate the model's INI file
				$file = str_replace('.php', '.ini', $file);
				$model_data = $m->render(file_get_contents(PACKAGE_ROOT.'nest'.DS.'views'.DS.'model_ini_template.php'), $_POST);
				$fh = fopen($file, 'w') or die("can't open file");
				fwrite($fh, $model_data);
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