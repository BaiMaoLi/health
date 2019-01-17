<?php
require_once(dirname(__FILE__) . '/user.class.php');

$user = new user();
$task = $_REQUEST['task'];
$data = $_POST['formData'];

switch ($task) {
	case 'register':
		unset($data['password_retype']);

		$isSave = $user->register($data);
		if($isSave) {
			$arr = array('status' => 'success', 'msg' => 'Register successfuly, we will contact to you soon as possible.');
		}
		else{
			$arr = array('status' => 'error', 'msg' => 'You have an error when try register, please refresh and try again.');
		}
		break;
}

die(json_encode($arr));
?>