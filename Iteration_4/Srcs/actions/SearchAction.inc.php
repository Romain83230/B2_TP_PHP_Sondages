<?php

require_once("actions/Action.inc.php");

class SearchAction extends Action {

	/**
	 * Construit la liste des sondages dont la question contient le mot clé
	 * contenu dans la variable $_POST["keyword"]. L'utilisateur est ensuite 
	 * dirigé vers la vue "ServeysView" permettant d'afficher les sondages.
	 *
	 * Si la variable $_POST["keyword"] est "vide", le message "Vous devez entrer un mot clé
	 * avant de lancer la recherche." est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
		/* TODO START */


        $pseudo = $this->getSessionLogin();

        if ($pseudo == null ) {
            $this->setView(getViewByName("Message"));
            $this->getView()->setMessage("Veuillez-vous connecter");
        } else {

        	if (isset($_POST['keyword'])) {
        		$word = $_POST['keyword'];
                $this->setView(getViewByName("Surveys"));
                $this->getView()->setSurveys($this->database->loadSurveysByKeyword($word));

			} else {
                $this->setView(getViewByName("Message"));
                $this->getView()->setMessage("Veuillez indiquer un terme à rechercher");
			}


        }


		/* TODO END */
	}

}

?>
