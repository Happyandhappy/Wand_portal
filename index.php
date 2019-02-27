<?php
require_once('ApiClient/Client.php');
require_once('config.php');
function login($cred){
	session_unset();
	if (isset($cred['username']) && isset($cred['password'])){
		$_SESSION['USERNAME'] = $cred['username'];
		$_SESSION['PASSWORD'] = $cred['password'];
		$_SESSION['ORGID'] 	  = ORGID;
		$_SESSION['HOST'] 	  = HOST;
		$api = new ApiClient($_SESSION['HOST'], $_SESSION['ORGID'], $_SESSION['USERNAME'], $_SESSION['PASSWORD']);

		if ($api->Login()) {
			$_SESSION['api'] = $api;
			echo json_encode(array('status' => 'success','message' => 'Successfully logged in!'));
		}
		else {
			echo json_encode(array('status' => 'danger','message' => 'Invalid Credentials!'));			
		}
	}else{
		echo json_encode(array('status' => 'danger','message' => 'Invalid Credentials!'));		
	}
}
login(array('username' => username, 'password'=> password));

if (!isset($_SESSION['api'])){
    header("Location: login.php");
}else{
    header("Location: signup.php");
}
exit();
?>

