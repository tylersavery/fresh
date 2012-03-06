<?php
namespace Nest\Controller;

class Model_Delete_Field_Ajax extends \Pigeon\Core\Ajax_Controller {
	
	protected $model = null;
	
	public function controller() {

		$this->model_name = \Nest\Controller\Model_Editor::get_model_name($_GET['model_name']);;
        $this->model = new $this->model_name();
        $table = explode('\\', $this->model_name);
        $table = $table[2];

        $query = 'ALTER TABLE `'.$table.'` DROP `'.$_GET['field_name'].'`';
        $this->result = 'success';

        try {
	        $this->model->connection()->query($query);
		} catch (\ActiveRecord\DatabaseException $e) {
			$this->error = $e->getMessage();
			$this->result = 'false';
		}
		
	}
	
}