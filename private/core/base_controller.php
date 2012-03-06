<?php
namespace Pigeon\Core;

class Base_Controller {
    
    public $uri;
    public $title;
    public $meta;
    public $css;
    public $head_js;
    public $foot_js;
    public $errors;
    
    protected $template;
    protected $view;
    
    public function __construct($uri, $data) {
        $this->uri          = $uri;
        $this->data         = $data;
        $this->css          = new \SplFixedArray(0);
        $this->head_js      = new \SplFixedArray(0);
        $this->foot_js      = new \SplFixedArray(0);
        $this->meta         = new \SplFixedArray(0);
        $this->called_class = get_called_class();
        $this->view         = '';
        
        $this->title = 'Pigeon';
        $this->website = 'Pigeon v0.5';
    }
    
    public function add_asset($type, $file, $public = false, $minify = true, $attributes = '', $position = 'head') {
        $package = explode('\\', get_called_class());
        switch ($type) {
            case 'js':
                if ($public) {
                    $file = '/js/'.$file;
                } else {
                    $file = '/js/'.strtolower($package[0]).'/'.$file.(($minify) ? '?min=true' : '');
                }
                $position .= '_js';
                $this->{$position}->setSize($this->{$position}->getSize() + 1);
                $this->{$position}[$this->{$position}->getSize() - 1] = 'src="'.$file.'" '.$attributes;
                break;
            case 'css':
                if ($public) {
                    $file = 'href="/css/'.$file.'" '.$attributes;
                } else {
                    $file = 'href="/css/'.strtolower($package[0]).'/'.$file.'" '.$attributes;
                }
                $this->css->setSize($this->css->getSize() + 1);
                $this->css[$this->css->getSize() - 1] = $file;
                break;
        }
    }

    public function __set($key, $val) {
        $this->$key = $val;
    }

    public function view() {
        $this->template->__construct($this);
        return $this->template;
    }

    public function add_meta($name, $content, $id = '', $attributes = '') {
        $this->meta->setSize($this->meta->getSize() + 1);
        $this->meta[$this->meta->getSize() - 1] = (($id != '') ? 'id="'.$id.'"' : '').'name="'.$name.'" content="'.$content.'" '.$attributes;
    }
    
    public function set_view($name) {
        $this->view = $name;
    }

    public function controller() {
        // Should be overwritten
    }

    public function render_view() {
        $this->template = new \Pigeon\Core\Template_Controller($this);
        if (! empty($this->view)) {
            $this->template->view = $this->view;
        } else {
            $this->template->view = str_replace('Controller', 'View', get_called_class());
        }
        echo $this->template->render();

    }
    
}