<?php
/**
 * ---------------------------------------------------------------
 * PigeonMVC v0.5
 * ---------------------------------------------------------------
 * @author Pilot Interactive Inc.
 * @see http://www.pigeonmvc.com
 * @license Unreleased
 * @package Validator
 * ---------------------------------------------------------------
 * 
 * A custom validation class for Pigeon.
 *
 * @package Validator
 */
namespace Pigeon\Library;

class Validator {

    public static $regexes = Array(
        'date'         => "^[0-9]{4}[-/][0-9]{1,2}[-/][0-9]{1,2}\$",
        'amount'       => "^[-]?[0-9]+\$",
        'number'       => "^[-]?[0-9,]+\$",
        'alphanum'     => "^[0-9a-zA-Z ,.-_\\s\?\!]+\$",
        'not_empty'    => "[a-z0-9A-Z]+",
        'words'        => "^[A-Za-z]+[A-Za-z \\s]*\$",
        'phone'        => "^[0-9]{10,11}\$",
        'zipcode'      => "^[1-9][0-9]{3}[a-zA-Z]{2}\$",
        'plate'        => "^([0-9a-zA-Z]{2}[-]){2}[0-9a-zA-Z]{2}\$",
        'price'        => "^[0-9.,]*(([.,][-])|([.,][0-9]{2}))?\$",
        '2digitopt'    => "^\d+(\,\d{2})?\$",
        '2digitforce'  => "^\d+\,\d\d\$",
        'anything'     => "^[\d\D]{1,}\$"
    );

    private $validations;
    private $errors;
    private $corrects;
    private $fields;

    public function __construct($validations = array()) {
        $this->validations = $validations;
        $this->errors      = array();
        $this->corrects    = array();
    }
    
    public function add_field($key, $type, $msg) {
    	$this->validations[$key] = array($type, $msg);
    }

    public function validate($items) {
        
        $this->fields = $items;
        $errors = false;

        foreach ($items as $key => $val) {
        	if (! isset($this->validations[$key])) {
        		continue;
        	}
            $result = self::validate_item($val, $this->validations[$key][0]);
            if ($result === false) {
                $errors = true;
                $this->add_error($key, $this->validations[$key][1]);
            } else {
                $this->corrects[] = $key;
            }
        }
        if (count($this->errors) != 0) {
            $errors = true;
        }
        return ! $errors;
    }

    public function add_error($field, $msg) {
        $this->errors[] = array('field' => $field, 'message' => $msg);
    }

    public function get_errors() {
    	return $this->errors;
    }

    public function has_errors() {
    	if (count($this->errors) == 0) {
    		return false;
    	}
    	return true;
    }

    public function get() {
    	return $this->fields;
    }

    public static function validate_item($var, $type) {
    	if (array_key_exists($type, self::$regexes)) {
            $returnval = filter_var(
            	$var,
            	FILTER_VALIDATE_REGEXP,
            	array('options' => array('regexp' => '!' . self::$regexes[$type] . '!i'))) !== false;
            return $returnval;
        }
        $filter = false;
        switch($type) {
            case 'email':
                $var = substr($var, 0, 254);
                $filter = FILTER_VALIDATE_EMAIL;        
            	break;
            case 'int':
                $filter = FILTER_VALIDATE_INT;
            	break;
            case 'boolean':
                $filter = FILTER_VALIDATE_BOOLEAN;
            	break;
            case 'ip':
                $filter = FILTER_VALIDATE_IP;
            	break;
            case 'url':
                $filter = FILTER_VALIDATE_URL;
           		break;
        }
        return ($filter === false) ? false : filter_var($var, $filter) !== false ? true : false;
    }

}