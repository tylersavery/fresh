<?php
namespace Nest\Controller;
	
class Model_Edit_Field_Ajax extends \Pigeon\Core\Ajax_Controller {

	protected $model = null;

	protected function create_ini_file($array_name, $indent = 0) {
	    global $str;
	    foreach ($array_name as $k => $v) {
	        if (is_array($v)) {
	            for ($i=0; $i < $indent * 5; $i++) { $str.= " "; }
	            $str.= " [$k] \r\n";
	            listINIRecursive($v, $indent + 1);
	        } else {
	            for ($i = 0; $i < $indent * 5; $i++) { $str.= " "; }
	            $str.= "$k = $v \r\n";
	        }
	    }
	}

	public function controller() {

		$this->model_name = \Nest\Controller\Model_Editor::get_model_name($_POST['model_name']);
        $this->model = new $this->model_name();
        
        $table = explode('\\', $this->model_name);
        $table = $table[2];

        foreach ($this->model
		              ->connection()
		              ->columns($this->model->table_name()) as $key => $column) {

          	if ($column->name == $_POST['field_name']) {
          		$exists = true;
          		$action = 'CHANGE '.$_POST['field_name'];
            } else {
        		$exists = false;
        		$action = 'ADD';
		    }

        }

        // Set at least some basic values to help the user along
        if ($_POST['field_type'] == 'VARCHAR'
        	&& $_POST['length'] == '') {
        	$_POST['length'] = '50';
        }
        if ($_POST['field_type'] == 'VARCHAR') {
        	$_POST['field_type'] = $_POST['field_type'].'('.$_POST['length'].')';
        	if ($_POST['default_value'] != '') {
        		$_POST['default_value'] = '"'.$_POST['default_value'].'"';
        	}
        }

        $query = 'ALTER TABLE `'.$table.'` '.$action.' `'.$_POST['field_name'].'` '.$_POST['field_type'].' '.
            (($_POST['allow_null'] == 'allow') ? ' NULL' : ' NOT NULL').
            (($_POST['default_value'] != '') ? ' DEFAULT '.$_POST['default_value'] : '').
            (($_POST['field_increment'] == 'yes') ? ' AUTO_INCREMENT' : '').
            (($_POST['primary_key'] == 'yes') ? ' PRIMARY KEY' : '');

        $this->result = 'success';

        try {
	        $this->model->connection()->query($query);
		} catch (\ActiveRecord\DatabaseException $e) {
			$this->error = $query.' -> '.$e->getMessage();
			$this->result = 'false';
		}
		
	}
	
}