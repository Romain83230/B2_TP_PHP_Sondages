<?php


require_once("actions/Action.inc.php");
class AddCommentaireAction extends Action {


    /**
     * Méthode qui doit être implémentée par chaque action afin de décrire
     * son comportement.
     */
    public function run()
    {
        $commentaire = trim($_POST['textarea']);
        $idsurvey = $_POST['idSurvey'];

        if ($this->database->storeCommentaire($idsurvey, $commentaire) === true) {
            $this->setView(getViewByName("Message"));
            $this->getView()->setMessage("Commentaire ajouté");
        } else {
            $this->setView(getViewByName("Message"));
            $this->getView()->setMessage("Un problème est survenu lors de l'ajout du commentaire");
        }

    }
}