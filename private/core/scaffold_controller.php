<?php
namespace Pigeon\Core;

class Scaffold_Controller extends Base_Controller {
    
    public $uri;
    public $errors;
    public $fields;

    protected $view;
    protected $model;
    protected $action;
    protected $model_name;
    protected $disallow;
    protected $list_count = 25;
    protected $field_names;

    public function __construct($uri, $data) {
        parent::__construct($uri, $data);

        if ($this->model_name == '') {
            throw new \Pigeon\Core\Exception('You must use define_model([model_name]) in order to use scaffolding.');
            return true;
        }

        $this->model = new $this->model_name;

        $this->action = $uri['action'];
        $this->name = ucfirst($this->model->table_name());

        $this->columns = $this->get_columns();

        if ($this->title == '') {
            $this->title = $this->action.' '.$this->model->table_name();
        }

    }

    public function controller() {
        // This should be overwritten
    }

    public function define_model($model) {
        $this->model_name = $model;
    }

    public function disallow($action, $field) {
        $this->disallow[$action][] = $field;
    }

    public function set_field($key, $name) {
        $this->field_names[$key] = $name;
    }

    protected function get_columns() {

        $columns = array();
        $package = explode('\\', $this->model_name);

        foreach ($this->model
                      ->connection()
                      ->columns($this->model->table_name()) as $key => $column) {

            // Skip any unwanted fields
            if (isset($this->disallow[$this->action])
                && in_array($column->name, $this->disallow[$this->action])) {
                continue;
            }
            if (isset($this->model->field_names[$column->name])) {
                $columns[] = array(
                    'name'      => $this->model->field_names[$column->name],
                    'real_name' => $column->name,
                    'is'        => array($column->name => true)
                );
            } else {
                $columns[] = array(
                    'name'      => $column->name,
                    'real_name' => $column->name,
                    'is'        => array($column->name => true)
                );
            }
        }
        return $columns;
    }

    protected function combine_attributes() {
        $attributes = array();
        foreach ($this->columns as $key => $column) {
            $attributes[] = $column['real_name'];
        }
        return join(', ', $attributes);
    }

    public function generate() {

        switch ($this->action) {

            // Perform the create action
            case 'create':
                if (isset($_POST['create'])) {
                    $this->save_data($_POST['fields']);
                    $this->create_success = true;
                }
                break;
            
            // Perform the delete action
            case 'list':

                $pages = new \Pigeon\Library\Pagination($this->model->count(), $this->list_count);
                $this->pages = $pages->generate();

                if (! isset($_GET['page'])) {
                    $_GET['page'] = 0;
                }
                $rows = $this->model->find('all', array(
                    'select' => current($this->model->get_primary_key()).','.$this->combine_attributes(),
                    'limit'  => $this->list_count,
                    'offset' => $this->list_count * $_GET['page']
                ));
                $row_list = array();
                list($this->primary_key) = $this->model->get_primary_key();

                foreach ($rows as $i => $row) {
                    $row_list[$i]['id'] = $row->{$this->primary_key};
                    foreach ($this->columns as $j => $column) {
                        $row_list[$i]['columns'][] = array(
                            'id'      => $column['real_name'],
                            'value'   => $row->{$column['real_name']},
                            'is'      => $column['is']
                        );
                    }
                }
                $this->rows = $row_list;
                if (count($row_list) == 0) {
                    $this->empty = true;
                }
                break;

            // Perform the row edit option
            case 'edit':
                
                $primary_key_value = $_GET[current($this->model->get_primary_key())];

                if (isset($_POST['edit'])) {
                    $this->save_data($_POST['fields'], $primary_key_value);
                    $this->edit_success = true;
                }
                foreach ($this->columns as $i => $column) {
                    $row = $this->model->find($primary_key_value, array(
                        'select' => current($this->model->get_primary_key()).','.$this->combine_attributes()
                    ));
                    $this->columns[$i]['value']  = $row->{$column['real_name']};
                    $this->columns[$i]['is'] = $column['is'];
                }
                break;
                
            // Perform the row delete action
            case 'delete':
                $row = $this->model->find($_GET[current($this->model->get_primary_key())]);
                $row->delete();
                $this->delete_success = true;
                break;
                
            default:
                die('No action found');
                break;
        }

        $package = explode('\\', get_called_class());
        $view = PACKAGE_ROOT.$package[0].DS.'views'.DS.strtolower($package[2]).'_scaffold_' . $this->action . '.php';
        
        if (is_file($view)) {
            $this->set_view($package[0].'\View\\'.$package[2] . '_Scaffold_' . $this->action);
        } else {
            $this->set_view('Base\View\Scaffold_'.$this->action);
        }
    }

    protected function save_data($post, $id = '') {
        if ($id != '') {
            $row = $this->model->find($id);
        } else {
            $row = $this->model;
        }
        foreach ($this->columns as $i => $column) {
            if (! isset($this->disallow[$this->action][$column['real_name']])) {
                $row->{$column['real_name']} = $post[$column['real_name']];
            }
        }
        $row->save();
        return true;
    }

    public function set_view($name) {
        $this->view = $name;
    }
    
}