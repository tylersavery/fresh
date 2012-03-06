<?php
namespace Nest\Controller;
	
class Model_Get_Field_Ajax extends \Pigeon\Core\Ajax_Controller {
	
	protected $model_name;
	protected $model;
    
	public function controller() {
		
		$this->model_name = '\\'.str_replace('.php', '',
			                          str_replace('models', 'model',
			                          	  str_replace('\\\\', '\\', $_GET['model_name'])));
		
        $this->model = new $this->model_name();
        
        foreach ($this->model
                      ->connection()
                      ->columns($this->model->table_name()) as $key => $column) {
        	
        	if ($_GET['field_name'] == $column->name) {
        		$this->name      = $column->name;
            	$this->length    = $column->length;
            	$this->increment = $column->auto_increment;
            	$this->type      = strtoupper($column->raw_type);
            	$this->null      = $column->nullable;
            	$this->default   = $column->default;
            	$this->primary   = $column->pk;
        	}
        	
        }
        
	}
	
}