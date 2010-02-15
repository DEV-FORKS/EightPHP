<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Formation phone number input library.
 *
 * @version		$Id: phonenumber.php 244 2010-02-11 17:14:39Z shaun $
 *
 * @package		Modules
 * @subpackage	Formation
 * @author		enormego
 * @copyright	(c) 2009-2010 enormego
 * @license		http://license.eightphp.com
 */
class Form_Phonenumber_Core extends Form_Input {

	protected $data = array(
		'name'  => '',
		'class' => 'phone_number',
	);

	protected $protect = array('type');

	// Precision for the parts, you can use @ to insert a literal @ symbol
	protected $parts = array(
		'area_code'   => '',
		'exchange'     => '',
		'last_four'    => '',
	);

	public function __construct($name, $formation) {
		// Set name
		$this->data['name'] = $name;
		$this->formation = $formation;
	}

	public function __call($method, $args) {
		if (isset($this->parts[substr($method, 0, -1)])) {
			// Set options for date generation
			$this->parts[substr($method, 0, -1)] = $args;
			return $this;
		}

		return parent::__call($method, $args);
	}

	public function html_element() {
		// Import base data
		$data = $this->data;

		$input = '';
		foreach($this->parts as $type => $val) {
			isset($data['value']) OR $data['value'] = '';
			$temp = $data;
			$temp['name'] = $this->data['name'].'['.$type.']';
			$offset = (strlen($data['value']) == 10) ? 0 : 3;
			switch ($type) {
				case 'area_code':
					if (strlen($data['value']) == 10) {
						$temp['value'] = substr($data['value'], 0, 3);
					} else
						$temp['value'] = '';
					$temp['class'] = 'area_code';
					$input .= form::input(array_merge(array('value' => $val), $temp)).'-';
					break;
				case 'exchange':
					$temp['value'] = substr($data['value'], (3-$offset), 3);
					$temp['class'] = 'exchange';
					$input .= form::input(array_merge(array('value' => $val), $temp)).'-';
					break;
				case 'last_four':
					$temp['value'] = substr($data['value'], (6-$offset), 4);
					$temp['class'] = 'last_four';
					$input .= form::input(array_merge(array('value' => $val), $temp));
					break;
			}
			
		}

		return $input;
	}

	protected function load_value() {
		if (is_bool($this->valid))
			return;

		$data = $this->input_value($this->name, $this->data['name']);

		$this->data['value'] = $data['area_code'].$data['exchange'].$data['last_four'];
	}
} // End Form Phonenumber