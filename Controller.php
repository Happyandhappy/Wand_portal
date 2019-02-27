<?php
include "ApiClient/Client.php";
include "config.php";



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

function signup($fields){
	$api = $_SESSION['api'];
	
	$mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME, 3306);
	if ($mysqli->connect_errno) {
	    echo json_encode(array('status' => 'danger','message' => 'Database Connection Error!'));
	    exit;
	}

	$res = $mysqli->query("SELECT COUNT(*) from Organization_Info__c WHERE Hipaa_contact_email__c='" . $fields['Email'] . "'");
	if ($res && $res->fetch_assoc()['COUNT(*)'] > 0){
		echo json_encode(array('status' => 'danger','message' => 'Email is already registered!'));
	    exit;
	}

	if ($fields['Mobile_Phone']=='') $fields['Mobile_Phone'] = '12345678';
	if ($fields['Work_Phone']=='') 	$fields['Work_Phone'] = $fields['Mobile_Phone'];
	if ($fields['Title']=='') 		$fields['Title'] = 'Title';
	if ($fields['Lead_Website']=='') $fields['Lead_Website'] = 'wand.com';
	$fields['Organization_Name'] = $fields['First_Name'] . " " . $fields['Last_Name'];
	$data = array(
		"id" => "",
		"data" => $fields,
	);
	
	$res = $api->_Insert('lead', array($data));	
	echo json_encode($res);
}

$api = $_SESSION['api'];
$action = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$fields = $_POST;
	if (isset($fields['action'])) {
		$action = $fields['action'];
		unset($fields['action']);
	}
}else{
	if (isset($_GET['action']))
		$action = 'convert';
}

switch ($action) {
	case 'signup':
		signup($fields);
		break;
	case 'login':
		login($fields);
		break;	
	default:
		echo "Not allowed method";
		break;
}

