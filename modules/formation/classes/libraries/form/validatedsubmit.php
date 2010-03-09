<?php
/**
 * Formation submit input library.
 *
 * @package		Modules
 * @subpackage	Formation
 * @author		EightPHP Development Team
 * @copyright	(c) 2009-2010 EightPHP
 * @license		http://license.eightphp.com
 */
class Form_Validatedsubmit_Core extends Form_Input {

	protected $data = array(
		'type'  => 'submit',
		'class' => 'submit'
	);

	protected $protect = array('type');

	public function __construct($value, $formation) {
		$this->data['value'] = $value;
		$this->formation = $formation;
	}

	public function render() {
		$data = $this->data;
		unset($data['label']);

		return form::button($data);
	}

} // End Form Submit