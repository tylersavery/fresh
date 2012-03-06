<?php
namespace Nest\Controller;
	
class Packages_Edit extends \Nest\Controller\Nest {
	
	public static function get_package_files($dir) {
		
	    $root = @scandir($dir);
	    $result = array();
	    
	    if (! is_array($root) || count($root) == 0) { return array(); }
	    
	    foreach ($root as $value) {
	    	// Skip unnecessary files
	        if ($value === '.'
	            || $value === '..'
	            || $value === 'js'
	            || $value === 'img'
	            || $value === '.DS_Store'
	            || $value === '.svn'
	            || $value === 'css') {
		        continue;
		    }
	        if (is_file("$dir/$value")) {
		        $result[] = "$dir".DS."$value";
		        continue;
		    }
	        foreach (static::get_package_files("$dir".DS."$value") as $value) {
	            $result[] = $value;
	        }
	    }
	    return @$result;
	}
	
	public function get_mvc_files($type) {

		$files = array();
		$controller_dir = PACKAGE_ROOT.$this->uri['package'].DS.$type;

		foreach (static::get_package_files($controller_dir) as $key => $file) {
			$path = $file;
			if (strpos($file, '.ini') === false) {
				// TODO: Change this to regex query
				$file = str_replace('.php', '',
				            str_replace('_', ' ',
				                str_replace($controller_dir.DS, '', $file)));
				$file_data = array(
					'name' => str_replace(' ', ' ', ucwords($file)),
					'path' => str_replace(PACKAGE_ROOT, '', $path)
				);
				if ($type == 'models') {
					$file_data['path_ini'] = str_replace('.php', '.ini', str_replace(PACKAGE_ROOT, '', $path));
				}
				$files[] = $file_data;
			}
		}
		usort($files, function($a, $b) {
		    return strcmp($a['name'], $b['name']);
		});
		return $files;
	}

	public function controller() {
		
		$this->add_asset('js', 'edit_file.js');
		$this->add_asset('js', 'ace/ace.js');
		$this->add_asset('js', 'ace/theme-twilight.js');
		$this->add_asset('js', 'ace/mode-php.js');
		
		$this->controllers = $this->get_mvc_files('controllers');
        $this->views       = $this->get_mvc_files('views');
        $this->models      = $this->get_mvc_files('models');
        
        $this->package = ucfirst($this->uri['package']);

        $this->package_path = str_replace('\\', '\\\\', $this->uri['package'].DS.$this->uri['package'].'.php');
	}
	
}