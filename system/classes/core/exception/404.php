<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Creates a "Page Not Found" exception.
 *
 * @version		$Id: Eight_Exception_404.php 4679 2009-11-10 01:45:52Z isaiah $
 *
 * @package		System
 * @subpackage	Exceptions
 * @author		enormego
 * @copyright	(c) 2009-2010 enormego
 * @license		http://license.eightphp.com
 */

class Eight_Exception_404_Core extends Eight_Exception {

	protected $code = E_PAGE_NOT_FOUND;

	/**
	 * Set internal properties.
	 *
	 * @param  string  URI of page
	 * @param  string  custom error template
	 */
	public function __construct($page = NULL) {
		if ($page === NULL) {
			// Use the complete URI
			$page = Router::$complete_uri;
		}
		
		parent::__construct(strtr('The page you requested, %page%, could not be found.', array('%page%' => $page)));
	}

	/**
	 * Throws a new 404 exception.
	 *
	 * @throws  Eight_Exception_404
	 * @return  void
	 */
	public static function trigger($page = NULL) {
		// Silence 404 errors (as matched within the ignore array) and die quietly
		if(in_array(Router::$complete_uri, arr::c(Eight::config('config.ignore_page_not_found')))) Eight::shutdown();
		
		throw new Eight_Exception_404($page);
	}

	/**
	 * Sends 404 headers, to emulate server behavior.
	 *
	 * @return void
	 */
	public function sendHeaders() {
		// Send the 404 header
		header('HTTP/1.1 404 File Not Found');
	}

} // End Eight 404 Exception