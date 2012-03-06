<?php
namespace Nest\Controller;
	
class Model_Editor extends \Nest\Controller\Nest {

      static public function get_model_name($name) {
            $name = str_replace('.php', '', $name);
            $name = str_replace('models', 'model', $name);
            $name = str_replace('/', '\\', $name);
            $name = str_replace('\\\\', '\\', $name);
            return $name;
      }
	
	public function controller() {
		
		$this->add_asset('js', 'model_designer.js');
		$this->model_name = static::get_model_name($_GET['path']);
	      
            $name = explode('\\', $this->model_name);
            $this->model_real_name = ucfirst($name[2]);

            $this->model = new $this->model_name();

            $columns = array();

            foreach ($this->model
                          ->connection()
                          ->columns($this->model->table_name()) as $key => $column) {
            	
            	$columns[] = array(
            		'name'      => $column->name,
            		'length'    => $column->length,
            		'increment' => $column->auto_increment,
            		'type'      => strtoupper($column->raw_type),
            		'null'      => $column->nullable,
            		'default'   => $column->default,
            		'primary'   => $column->pk
            	);

            }
            $this->columns = $columns;

	}
	
}