<?php

require_once("actions/Action.inc.php");

class SupprimerSondage extends Action {

	public function run() {
  	/* TODO START */
		if (isset($_POST['Modifier'])) {
				$statueSondage = $_POST['Modifier'];

				$this->getView()->setSurveys($this->database->loadSurveysByOwner($pseudo));
				$this->setView(getViewByName("EditSurvey"));

		} else {
				$statueSondage = false;
				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Un probleme est survenu durant la recuperation du sondage à modifier");
  	/* TODO END */
	}

}

?>
