<?php
namespace Nest\Controller;
	
class Nest extends \Base\Controller\Base {
	
	public $logged_in = false;
	
    public function __construct($uri, $data) {

    	$this->password     = 'fly';

        $this->uri          = $uri;
        $this->data         = $data;

        $this->css          = new \SplFixedArray(0);
        $this->head_js      = new \SplFixedArray(0);
        $this->foot_js      = new \SplFixedArray(0);
        $this->meta         = new \SplFixedArray(0);

		$this->add_asset('js',  'jquery-1.7.1.min.js');
		$this->add_asset('js',  'bootstrap.min.js');
		$this->add_asset('js',  'bootstrap-transition.js');		
		$this->add_asset('css', 'bootstrap.css');
		$this->add_asset('css', 'style.css');
		$this->title = 'Nest (Pigeon Configurator)';

		static::check_logged_in();

		$this->add_asset('js', 'create_package.js');
		$this->add_asset('js', 'create_view.js');
		$this->add_asset('js', 'create_controller.js');
		$this->add_asset('js', 'create_model.js');

	}

	public function check_logged_in($display_authenticate = true) {

		session_start();

		if (isset($_POST['pass']) && $_POST['pass'] == $this->password) {
			$_SESSION['admin'] = true;
		}

		if (! isset($_SESSION['admin'])) {
			if ($display_authenticate) {
				$this->set_view('Nest\Views\Authenticate');
				$this->logged_in = false;
				die($this->render_view());
			} else {
				return false;
			}
		} else {
			$this->logged_in = true;
		}
		return true;
	}
	
	public function get_packages() {

		// Get the current package information
		$packages = scandir(PACKAGE_ROOT);
		$packs = array();
		$count = 0;

		foreach ($packages as $i => $package) {
			if (ctype_alnum($package)) {
				$packs[$count] = get_class_vars('Pigeon\Package\\'.$package);
				if (count($packs[$count]['dependencies']) == 0) {
					$packs[$count]['dependencies'] = 'None';
				} else {
					$packs[$count]['dependencies'] = join(',', $packs[$count]['dependencies']);
				}
	            $packs[$count]['package_name'] = $package;
	            $packs[$count]['route_count'] = @count($packs[$count]['routes']);
	            $count++;
			}
        }
        return $packs;
	}
	
	public function controller() {

        $this->packages = $this->get_packages();

        global $packages;

        $this->configurations = array(
        	'0'  => array('name' => 'Current Environment', 'value' => \ENVIRONMENT),
        	'1'  => array('name' => 'Database Username',   'value' => \DB_USER),
        	'2'  => array('name' => 'Database Host',       'value' => \DB_HOST),
        	'3'  => array('name' => 'Database Name',       'value' => \DB_NAME),
        	'4'  => array('name' => 'Active Packages',     'value' => \Pigeon\Core\Config::$packages->getSize())
	    );

	}
	
}