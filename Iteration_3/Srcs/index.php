<?php
<<<<<<< HEAD
var_dump("");

=======
var_dump("A ENLEVER");
var_dump("A ENLEVER");
>>>>>>> 93fcf948cd2096c1fa0032fd24d67e1322355849

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

	$actions = array(
	        'Default',
			'SignUpForm',
			'SignUp',
			'Logout',
			'Login',
			'UpdateUserForm',
			'UpdateUser',
    		'AddSurveyForm',
			'AddSurvey',
			'GetMySurveys',
			'Search',
			'Vote',
<<<<<<< HEAD
            'UpdateSondage'
=======
			'SupprimerSondage'
>>>>>>> 93fcf948cd2096c1fa0032fd24d67e1322355849
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
