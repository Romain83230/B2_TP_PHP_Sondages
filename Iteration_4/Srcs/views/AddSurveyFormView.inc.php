<?php
require_once("views/View.inc.php");

class AddSurveyFormView extends View {

	private $list;

	/**
	 * Affiche le formulaire d'ajout de sondage.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() {

		require("templates/addsurveyform.inc.php");
	}


    public function setList($_list)
    {
        $this->list = $_list;
    }

}
?>


