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




		$keyword = $_POST['keyword'];
		$categori = $_POST['category'];

		if (($keyword == '' && $categori == 'category')) {
            $this->setView(getViewByName("Message"));
            $this->getView()->setMessage("Merci de rechercher un terme, et/ou une catégorie");
        } else {
		    // mot clé, sans catégori
		    if ($keyword != '' && $categori == 'category') {
                $this->setView(getViewByName("Surveys"));
                $this->getView()->setSurveys($this ->database -> loadSurveysByKeyword($keyword));

                // mot clé + catégori
            } elseif ($keyword != '' && $categori != 'category') {
                $this->setView(getViewByName("Surveys"));
                $this->getView()->setSurveys($this ->database -> loadSurveysByKeyword($keyword, $categori));

		        // sans mot clé, mais catégorie
            } else {
                $this->setView(getViewByName("Surveys"));
                $this->getView()->setSurveys($this ->database -> loadSurveysByKeyword($keyword="", $categori));
            }

        }


		/* TODO END */
	}

}

?>
