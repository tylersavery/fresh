<?php
namespace PinGenerator\Controller;

class Generator extends \Base\Controller\Base {

	public function controller() {

		if (isset($_POST['group_name'])) {

			$count = 0;
			while ($count <= $_POST['number_pins']) {
				$pin = $this->random($_POST['type'], $_POST['digits']);
				if (isset($_POST['head_tag'])) {
					$pin = $_POST['head_tag'].$pin;
				}
				try {
					\PinGenerator\Model\Pins::create(array(
						'group_name' => $_POST['group_name'],
						'key_code'   => $pin,
						'type'       => $_POST['type'],
						'head_tag'   => $_POST['head_tag']
					));
				} catch (\ActiveRecord\DatabaseException $e) {
					continue;
				}
				$count++;
			}

			$this->fields = $_POST;
		}

	}

    // Random number generator
    public function random($type = 'sha1', $len = 20) {
        if (phpversion() >= 4.2) {
            mt_srand();
        } else {
            mt_srand(hexdec(substr(md5(microtime()), - $len)) & 0x7fffffff);
        }
        switch ($type) {
            case 'basic':
                return mt_rand();
                break;
            case 'alpha':
            case 'numeric':
            case 'nozero':
                switch ($type) {
                    case 'alpha':
                        $param = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $param = '0123456789';
                        break;
                    case 'nozero':
                        $param = '123456789';
                        break;
                }
                $str = '';
                for ($i = 0; $i < $len; $i ++) {
                    $str .= substr($param, mt_rand(0, strlen($param) - 1), 1);
                }
                return $str;
                break;
            case 'md5':
                return md5(uniqid(mt_rand(), TRUE));
                break;
            case 'sha1':
                return sha1(uniqid(mt_rand(), TRUE));
                break;
        }
    }
	
}