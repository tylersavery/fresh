<?php
namespace Pigeon\Core;

class Template_Controller {
    
    protected $main_controller;
    public $view;
    
    public function __construct($controller) {
    	$this->main_controller = $controller;
    }
    
    public function __get($name) {
        $package = explode('_', $name);
        $this->view = $package[0].'\view\\'.$package[1];
        return $this->render();
    }
    
    public function render() {
        $package = explode('\\', strtolower($this->view));
        $file = PACKAGE_ROOT.strtolower($package[0]).DS.'views'.DS.strtolower($package[2]).'.php';
        
        if (is_file($file)) {
            $m = new \Mustache();
            return $m->render(file_get_contents($file), $this->main_controller);
        }
    }
    
    public function __isset($name) {
        return true;
    }
    
}
