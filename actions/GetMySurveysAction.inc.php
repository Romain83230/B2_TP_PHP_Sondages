<?php

require_once("actions/Action.inc.php");

class GetMySurveysAction extends Action {

	/**
	 * Construit la liste des sondages de l'utilisateur et le dirige vers la vue "SurveysView" 
	 * de façon à afficher les sondages.
	 *
	 * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
	 *
	 * @see Action::run()
	 */
	public function run() {
		/* TODO START */
		$db = new database;
		if ($this->getSessionLogin() == null) {
			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("Vous devez vous loger pour consulter vos sondages");
		}

		else {
			if ($db->loadSurveysByOwner($this->getSessionLogin()) != false) {
				$db->loadSurveysByOwner($this->getSessionLogin());
			} else {
				// var_dump($db->loadSurveysByOwner($this->getSessionLogin()));
				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Vous n'avez pas fait de sondages");
			}


			// $this->setView(getViewByName("GetMySurveys"));

		}


		/* TODO END */
	}

}

?>
