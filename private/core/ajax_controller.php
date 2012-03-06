<?php
namespace Pigeon\Core;

class Ajax_Controller {
    
    protected $uri;
    protected $data;
    protected $output = 'json';
    
    public function __construct($uri, $data) {
        $this->uri          = $uri;
        $this->data         = $data;

        if (isset($uri['type'])) {
            $this->output = $uri['type'];
        } else {
            $this->output = 'json';
        }
    }
    
    public function render_view() {
        switch ($this->output) {
        	case 'html':
        		echo $this->data;
                break;
        	case 'json':
        		header('Content-type: application/json');
        		echo json_encode($this);
                break;
            case 'jsonp':
                header('Content-type: application/json');
                if (isset($_GET['callback'])) {
                    $callback = $_GET['callback'];
                } else {
                    $callback = 'jsonpCallback';
                }
                echo $callback.'('.json_encode($this).')';
                break;
        	case 'xml':
        	    header('Content-type: application/xml');
			    $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><ajax></ajax>"); 
			    $f = create_function('$f, $c, $a',' 
			            foreach ($a as $k=>$v) {
			                if(is_array($v)) { 
			                    $ch=$c->addChild($k); 
			                    $f($f,$ch,$v); 
			                } else { 
			                    $c->addChild($k,$v); 
			                } 
			            }'); 
			    $f($f, $xml, $this);
			    echo $xml->asXML();
                break;
        }
    }
    
}