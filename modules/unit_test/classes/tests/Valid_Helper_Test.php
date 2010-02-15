<?php
/**
 * Valid Helper Test.
 *
 * @package		Modules
 * @subpackage	UnitTest
 * @author		enormego
 * @copyright	(c) 2009-2010 enormego
 * @license		http://license.eightphp.com
 */
class Valid_Helper_Test extends Unit_Test_Case {

	// Disable this Test class?
	const DISABLED = NO;

	public function valid_email_test() {
		$this
			->assert_YES_strict(valid::email('address@domain.tld'))
			->assert_NO_strict(valid::email('address@domain'));
	}

	public function valid_email_rfc_test() {
		$this
			->assert_YES_strict(valid::email_rfc('address@domain'))
			->assert_NO_strict(valid::email_rfc('address.domain'));
	}

	public function valid_email_domain_test() {
		// not implemented on windows platform
		$var1 = (EIGHT_IS_WIN) ? YES : valid::email_domain('address@gmail.tld');
		$var2 = (EIGHT_IS_WIN) ? NO : valid::email_domain('address@domain-should_not-exist.tld');
		$this
			->assert_YES_strict($var1)
			->assert_NO_strict($var2);
	}
	public function valid_url_test() {
		$this
			->assert_YES_strict(valid::url('http://www.eight.twenty08.com'))
			->assert_NO_strict(valid::url('www.eight.twenty08.com'));
	}

	public function valid_ip_test() {
		$this
			->assert_YES_strict(valid::ip('75.125.175.50')) // valid - eight.twenty08.com
			->assert_YES_strict(valid::ip('127.0.0.1')) // valid - local loopback
			->assert_NO_strict(valid::ip('256.257.258.259')) // invalid ip
			->assert_NO_strict(valid::ip('255.255.255.255')) // invalid - reserved range
			->assert_NO_strict(valid::ip('192.168.0.1')); // invalid - private range
	}

	public function valid_credit_card_test() {
		$this
			->assert_YES_strict(valid::credit_card('4222222222222')) // valid visa test nr
			->assert_YES_strict(valid::credit_card('4012888888881881')) // valid visa test nr
			->assert_YES_strict(valid::credit_card('5105105105105100')) // valid mastercard test nr
			->assert_YES_strict(valid::credit_card('6011111111111117')) // valid discover test nr
			->assert_NO_strict(valid::credit_card('6011111111111117', 'visa')); // invalid visa test nr
	}

	public function valid_phone_test() {
		$this
			->assert_YES_strict(valid::phone('0163634840'))
			->assert_YES_strict(valid::phone('+27173634840'))
			->assert_NO_strict(valid::phone('123578'));
	}

	public function valid_alpha_test() {
		$this
			->assert_YES_strict(valid::alpha('abc'))
			->assert_NO_strict(valid::alpha('123'));
	}

	public function valid_alpha_numeric_test() {
		$this
			->assert_YES_strict(valid::alpha_numeric('abc123'))
			->assert_NO_strict(valid::alpha_numeric('123*.*'));
	}

	public function valid_alpha_dash_test() {
		$this
			->assert_YES_strict(valid::alpha_dash('_ab-12'))
			->assert_NO_strict(valid::alpha_dash('ab_ 123 !'));
	}

	public function valid_digit_test() {
		$this
			->assert_YES_strict(valid::digit('123'))
			->assert_NO_strict(valid::digit('abc'));
	}

	public function valid_numeric_test() {
		$this
			->assert_YES_strict(valid::numeric(-12.99))
			->assert_NO_strict(valid::numeric('123_4'));
	}

	public function valid_standard_text_test() {
		$this
			->assert_YES_strict(valid::standard_text('some valid_text-to.test 123'))
			->assert_NO_strict(valid::standard_text('some !real| ju0n_%k'));
	}

	public function valid_decimal_test() {
		$this
			->assert_YES_strict(valid::decimal(12.99))
			->assert_NO_strict(valid::decimal(12,99));
	}
} // End Valid Helper Test Controller
