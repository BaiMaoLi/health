<?php
class Database {
	public $host = "localhost";
	public $user = "j8i7cba1_upti";
	public $pass = "wcxZ4id~~nHk";
	public $dbname = "j8i7cba1_pti";
	
	protected $die = "Connection failed.";   
	protected $notdata = "Could not find database.";

	private $_connection;
	private static $_instance; //The single instance

	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
		$this->_connection = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
	
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to connect to MySQL: " . mysql_connect_error(), E_USER_ERROR);
		}
		
		$this->_connection->set_charset("utf8");
	}  

    public function getConnection() {
		return $this->_connection;
	}

    public function num_rows(){   
        if($this->result){   
            return mysql_num_rows($this->result);   
        }
        else{   
            return 0;   
        }   

    }   

    public function fetch(){   
        if($this->result){   
            return mysql_fetch_assoc($this->result);   
        }
        else{   
            return 0;   
        }   

    }  

    public function charset(){  
        if($this->_connection){   
            mysql_query('SET NAMES "utf8"',$this->_connection);  
        }   
    } 
}
?>