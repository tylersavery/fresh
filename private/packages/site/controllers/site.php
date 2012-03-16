<?php
namespace Site\Controller;

class Site extends \Base\Controller\Base {

	public function controller() {
		
		$this->add_asset('css', 'reset.css');
        $this->add_asset('css', 'main.css');

        $this->add_asset('js', 'jquery.min.js');
        $this->add_asset('js', 'scrollspy.js');
        $this->add_asset('js', 'https://maps.googleapis.com/maps/api/js?sensor=false', 'remote');

        $this->add_asset('js', 'main.js');
        $this->add_meta('name', 'Get Fresh Company');
        
        $this->title = 'Get Fresh Company';
        $this->website = 'Get Fresh Company';
		
		$this->set_view('Site\Views\site');
		
	}
	
}