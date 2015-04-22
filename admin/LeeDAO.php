<?php
class LeeDAO{
	public static $DATABASE_ERROR = "Database Error!";
	public static $USER_NOT_FOUND = "User Not Found!";
	public static $UNKNOWN_ERROR = "Unknown Error!";
	
	/**
	 * Database host.
	 * @var String
	 */
	private static $DB_HOST = '127.0.0.1:3307';
	/**
	 * Database username.
	 * @var String
	 */
	private static $DB_USER = 'admin';
	/**
	 * Database password.
	 * @var String
	 */
	private static $DB_PASS = 'admin';
	/**
	 * Database name.
	 * @var String
	 */
	private static $DB_NAME = 'leedb';
	
	/**
	 * Mysqli object used to database communication.
	 * @var MySQLi
	 */
	protected $mysqli;
	
	/**
	 * Indicates whether or not there is a database connection error.
	 * @var boolean
	 */
	protected $connectionError = false;
	
	/**
	 * Indiates whether or not there is a MySQL error
	 * @var boolean
	 */
	protected $mysqlError = false;
	
	/**
	 * Constructor. Creates a MySQLi object and connects to the database.
	 */
	function __construct(){
		$this->connectionError = false;
		$this->mysqli = new mysqli(self::$DB_HOST, self::$DB_USER, self::$DB_PASS, self::$DB_NAME);
		if($this->mysqli->connect_errno){
			$this->connectionError = true;
		}
	}
	
	/**
	 * Returns true if there was a database connection issue, otherwise returns false.
	 * @return boolean
	 */
	public function hasConnectionError(){
		return $this->connectionError;
	}
	
	/**
	 * Returns true if there was a mysql error in the last statement, otherwise returns false.
	 * @return boolean
	 */
	public function hasMysqlError(){
		return $this->mysqlError;
	}
	
	/**
	 * Accepts a username and returns the password for that user if the user exists. Otherwise, returns self::$USER_NOT_FOUND.
	 * @param unknown $username
	 * @return String
	 */
	public function getUserPassword($username){
		$query = "SELECT password FROM authorized_users WHERE username = ?";
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('s', $username);
		$stmt->execute();
		
		if($stmt->error){
			$this->mysqlError = true;
		} else {
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			if($result->num_rows == 1){
				return $row['password'];
			} else {
				return self::$USER_NOT_FOUND;
			}
		}
		
	}
	/**
	 * Adds a user to the authorized_users table. Returns the username.
	 * @param String $username
	 * @param String $password
	 * @return AdminUser the new user.
	 */
	public function add_user($username, $password){
		$query = 'INSERT INTO authorized_users (username, password) VALUES (?,?)';
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();
		if($stmt->error){
			return self::$DATABASE_ERROR;
		} else {
			return new AdminUser($username, $password);
		}
	}
	
}
?>