<?php
namespace Sample\Controller;

class Sample extends \Base\Controller\Base {
	
	public function controller() {
		
		$s = new \Sample\Model\Sample();
		$s->field_key = uniqid();
		$s->field_value = rand();
		$s->save();
		
		$this->all_samples = array();
		foreach (\Sample\Model\Sample::all() as $sample) {
			$this->all_samples[] = array('field' => $sample->field_key, 'value' => $sample->field_value);
		}
		
	}
	
}