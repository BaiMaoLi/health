<?php
require_once(dirname(__FILE__) . '/db.class.php');
class user {
	public function register($data) {
		try{
			$_DB = Database::getInstance();
			$db = $_DB->getConnection();
			$today = date('Y-m-d');

			$q = 'INSERT INTO `pti_users` (`first_name`, `last_name`, `email`, `password`, `phone_number`, `registered_date`)';
			$q.= ' VALUES ("'. $data['first_name'] .'", "'. $data['last_name'] .'", "'. $data['email'] .'", "'. md5($data['password']) .'", "'. $data['employee_number'] .'", "'. date('Y-m-d H:i:s') .'")';
			$db->query($q);

			return $db->insert_id;
		}
		catch(Exception $e){
			return false;
		}
	}
}
?>