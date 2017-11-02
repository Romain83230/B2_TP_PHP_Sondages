<?php

/**
 * Created by IntelliJ IDEA.
 * User: Romain
 * Date: 02/11/2017
 * Time: 11:24
 */

require_once("views/View.inc.php");
class CommentaireView extends View
{
    private $surveys;
    private $comm;


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

            require("templates/commentaires.inc.php");
        }

    }


    public function setComSurvey($surveys)
    {
        $this->surveys = $surveys;
    }
    public function setCom($_comm)
    {
        $this->comm = $_comm;
    }

}