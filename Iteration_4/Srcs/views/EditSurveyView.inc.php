<?php
require_once("views/View.inc.php");

class EditSurveyView extends View {

    private $surveys;

    public function displayBody() {
        require("templates/editSurvey.inc.php");
    }


    public function setSurveys($surveys)
    {
        $this->surveys = $surveys;
    }

}