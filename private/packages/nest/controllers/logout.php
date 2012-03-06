<?php
namespace Nest\Controller;
	
class Logout extends \Base\Controller\Base {
	
	public function controller() {
		session_destroy(session_id());
		session_unset('admin');
		header('location: /nest');
	}
	
}