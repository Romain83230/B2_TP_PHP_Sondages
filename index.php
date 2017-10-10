<?php
var_dump("A ENLEVER");

session_start();

function getActionByName($name) {
	$name .= 'Action';
	require("actions/$name.inc.php");
	return new $name();
}

function getViewByName($name) {
	$name .= 'View';
	require("views/$name.inc.php");
	return new $name();
}

function getAction() {
	if (!isset($_REQUEST['action'])) $action = 'Default';
	else $action = $_REQUEST['action'];

<<<<<<< HEAD
	
	$actions = array('Default',
			/*'SignUpForm',
=======
	$actions = array(
	        'Default',
			'SignUpForm',
>>>>>>> 43c2be520a3b056932332c8bb2c050a0c4a752f7
			'SignUp',
			'Logout',
			'Login',
			'UpdateUserForm',
			'UpdateUser',
    		'AddSurveyForm',
			'AddSurvey',
			'GetMySurveys',
			'Search',
			'Vote'
	);

	if (!in_array($action, $actions)) $action = 'Default';
	return getActionByName($action);
}


$action = getAction();
$action->run();
$view = $action->getView();
$action->getView()->setLogin($action->getSessionLogin());
$view->run();
?>

