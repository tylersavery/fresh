<?php
namespace Sample\Controller;

class Scaffold extends \Base\Controller\Scaffold {
	
	function controller() {
		
		$this->disallow('edit', 'modify_date');
		$this->disallow('create', 'modify_date');
		
		$this->define_model('Sample\Model\Sample');
		$this->generate();
	}
	
}