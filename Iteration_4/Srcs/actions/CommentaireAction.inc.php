<?php

require_once("actions/Action.inc.php");
class CommentaireAction extends Action
{

    /**
     * Méthode qui doit être implémentée par chaque action afin de décrire
     * son comportement.
     */
    public function run()

    {

        $idSurvey = $_POST['comments'];


        $this->setView(getViewByName("Commentaire"));
        $this->getView()->setCom($this->database->listAllCommentaireForOneSurvey($idSurvey));
        $this->getView()->setComSurvey($this->database->loadOneSurvey($idSurvey));

    }
}