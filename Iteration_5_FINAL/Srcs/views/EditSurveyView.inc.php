<?php
require_once("views/View.inc.php");

class EditSurveyView extends View {

    private $surveys;

    public function displayBody() {
        if (count($this->surveys) === 0) {
            echo '<div class="container">
                    <br><br><br>
                           <div style="text-align:center" class="alert">
                                Un problème est survenu lors du chargement de votre sondage à modifier.
                           </div>
                    </div>';
            return;
        }else {

            require("templates/updateSondages.inc.php");
        }

    }


    public function setSurveys($surveys)
    {
        $this->surveys = $surveys;
    }

}