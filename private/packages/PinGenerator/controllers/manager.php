<?php
namespace PinGenerator\Controller;

class Manager extends \Base\Controller\Scaffold {

	public function controller() {
		$this->define_model('PinGenerator\Model\Pins');
		$this->generate();
	}
	
}