<?php
namespace Nest\Controller;
	
class Packages_Save_File extends \Pigeon\Core\Ajax_Controller {
	
	public function controller() {

		// Necessary for stopping PHP from magic quoting the POST field
		if (get_magic_quotes_gpc()) {
		    function stripslashes_gpc(&$value) {
		        $value = stripslashes($value);
		    }
		    array_walk_recursive($_POST, 'stripslashes_gpc');
		}

		if (@\Nest\Controller\Nest::check_logged_in(false)) {
			$fh = fopen(PACKAGE_ROOT.$_POST['path'], 'w') or die("can't open file");
			fwrite($fh, join("\n", $_POST['data']));
			fclose($fh);
			$this->result = "success";
		} else {
			$this->response = 'not_logged_in';
		}
	}

}