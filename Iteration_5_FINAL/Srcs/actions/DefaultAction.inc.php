<?php
require_once("actions/Action.inc.php");

class DefaultAction extends Action {

	/**
	 * Traite l'action par défaut. 
	 * Elle dirige l'utilisateur vers une page avec un contenu vide.
	 *
	 * @see Action::run()
	 */
	public function run() {
		$this->database->dropDownListCatagory();
        $this->setView(getViewByName("Default"));
        $this->getView()->setSurveys($this->database->loadSurveys());
	}
}
?>
