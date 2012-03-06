<?php
namespace Nest\Controller;
    
class Packages_Delete_File extends \Pigeon\Core\Ajax_Controller {
	
	public function controller() {

        if (@\Nest\Controller\Nest::check_logged_in(false)) {

            if (is_file(PACKAGE_ROOT.$_GET['path'])) {
                unlink(PACKAGE_ROOT.$_GET['path']);
                @unlink(PACKAGE_ROOT.str_replace('.php', '.ini', $_GET['path']));
    		    $this->result = "success";
            } else {
                $this->result = "false";
            }

        }
	}
    
}