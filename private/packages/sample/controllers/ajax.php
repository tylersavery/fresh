<?php
namespace Sample\Controller;

class Ajax extends \Pigeon\Core\Ajax_Controller {
   	
	function controller() {
		
		$all_samples = array();
		foreach (\Sample\Model\Sample::all() as $sample) {
			$all_samples[] = array('field' => $sample->field_key, 'value' => $sample->field_value);
		}
		$this->all_samples = $all_samples;
		
	}
	
}