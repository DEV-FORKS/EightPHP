<?php
/**
 * Default Eight controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package		DemoApplication
 * @subpackage	Controllers
 * @author		EightPHP Development Team
 * @copyright	(c) 2009-2010 EightPHP
 * @license		http://license.eightphp.com
 */
class Controller_Welcome extends Controller_Template {

	// Disable this controller when Eight is set to production mode.
	const ALLOW_PRODUCTION = NO;

	// Set the name of the template to use
	public $wrapper = 'eight/template';

	public function index() {
		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->set_title('Welcome to Eight!', TRUE);

		// In Eight, all views are loaded and treated as objects.
		$view = new View('welcome/content');

		// An array of links to display. Assiging variables to views is completely
		// asyncronous. Variables can be set in any order, and can be any type
		// of data, including objects.
		$view->links = array(
			'Home Page'     => 'http://github.com/enormego/EightPHP/',
			'Documentation' => 'http://enormego.pbworks.com/FrontPage',
			'API Docs'      => 'http://docs.eightphp.com/docs/',
			'Issues'        => 'https://github.com/enormego/EightPHP/issues',
			'License'       => 'http://license.eightphp.com',
		);
		
		// Append it onto the HTML content stack
		$this->html .= $view;
	}

	public function __call($method, $arguments) {
		// Disable auto-rendering
		$this->auto_render = NO;

		// By defining a __call method, all pages routed to this controller
		// that result in 404 errors will be handled by this method, instead of
		// being displayed as "Page Not Found" errors.
		echo 'This text is generated by __call. If you expected the index page, you need to use: welcome/index/'.substr(Router::$current_uri, 8);
	}

} // End Welcome Controller