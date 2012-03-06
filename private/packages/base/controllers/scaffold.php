<?php
namespace Base\Controller;

class Scaffold extends \Pigeon\Core\Scaffold_Controller {

    public function __construct($uri, $data) {
        
        parent::__construct($uri, $data);
        
        $this->add_meta('name', 'Sample Site');
        
        $this->title = 'My Sample Site';
        $this->website = 'My Sample Site';
    }

}