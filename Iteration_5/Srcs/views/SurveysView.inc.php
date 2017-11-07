<?php
require_once("views/View.inc.php");

class SurveysView extends View
{

    private $surveys;
    private $bool;

    /**
     * @return mixed
     */
    public function getBool()
    {
        return $this->bool;
    }

    /**
     * @param mixed $bool
     */
    public function setBool($bool)
    {
        $this->bool = $bool;
    }

    /**
     * Affiche la liste des sondages.
     *
     * @see View::displayBody()
     */
    public function displayBody()
    {

        if (count($this->surveys) === 0) {
            echo '<div class="container">
                    <br><br><br>
                           <div style="text-align:center" class="alert">
                           
                           
                                Aucun sondage ne correspond à votre demande.
                           </div>
                    </div>';
            return;
        }else {
            require("templates/surveys.inc.php");
        }
    }

    /**
     * Fixe les sondages à afficher.
     *
     * @param array <Survey> $surveys Sondages à afficher.
     *
     */
    public function setSurveys($surveys)
    {
        $this->surveys = $surveys;
    }



}

?>
