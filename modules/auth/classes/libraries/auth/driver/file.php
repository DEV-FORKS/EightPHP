<?php
/**
 * File Auth driver.
 * @note		This Auth driver does not support roles nor auto-login.
 *
 * @package		Modules
 * @subpackage	Authentication
 * @author		EightPHP Development Team
 * @copyright	(c) 2009-2010 EightPHP
 * @license		http://license.eightphp.com
 */
class Auth_Driver_File_Core implements Auth_Driver {

	// User list
	protected $users;

	// Session instance
	protected $session;

	/**
	 * Constructor loads the user list into the class.
	 */
	public function __construct(array $config) {
		// Load user list
		$this->users = empty($config['users']) ? array() : $config['users'];

		// Load Session
		$this->session = Session::instance();
	}

	/**
	 * Logs a user in.
	 *
	 * @param   string   username
	 * @param   string   password
	 * @param   boolean  enable auto-login (not supported)
	 * @return  boolean
	 */
	public function login($username, $password, $remember)
	{
		// Validate username/password combination
		if (isset($this->users[$username]) AND $this->users[$username] === $password)
		{
			// Regenerate session_id
			$this->session->regenerate();

			// Store username in session
			$_SESSION['auth_user'] = $username;

			return TRUE;
		}

		// Login failed
		return FALSE;
	}

	/**
	 * Forces a user to be logged in, without specifying a password.
	 *
	 * @param   mixed    username
	 * @return  boolean
	 */
	public function force_login($username)
	{
		// Regenerate session_id
		$this->session->regenerate();

		// Store username in session
		$_SESSION['auth_user'] = $username;

		return TRUE;
	}

	/**
	 * Logs a user in, based on stored credentials. (not supported)
	 *
	 * @return  boolean
	 */
	public function auto_login()
	{
		return FALSE;
	}

	/**
	 * Log a user out.
	 *
	 * @param   boolean  completely destroy the session
	 * @return  boolean
	 */
	public function logout($destroy)
	{
		if ($destroy === TRUE)
		{
			// Destroy the session completely
			Session::instance()->destroy();
		}
		else
		{
			// Remove the user session
			unset($_SESSION['auth_user']);

			// Regenerate session_id
			$this->session->regenerate();
		}

		// Double check
		return ! $this->logged_in(NULL);
	}

	/**
	 * Checks if a session is active.
	 *
	 * @param   string   role name (not supported)
	 * @return  boolean
	 */
	public function logged_in($role)
	{
		return isset($_SESSION['auth_user']);
	}

	/**
	 * Get the stored password for a username.
	 *
	 * @param   mixed   username
	 * @return  string
	 */
	public function password($username)
	{
		return (isset($this->users[$username])) ? $this->users[$username] : FALSE;
	}

} // End Auth_File_Driver Class