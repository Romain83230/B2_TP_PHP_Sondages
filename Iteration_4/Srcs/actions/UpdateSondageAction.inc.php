<?php
require_once("actions/Action.inc.php");
/**
 * Created by IntelliJ IDEA.
 * User: Romain
 * Date: 23/10/2017
 * Time: 18:26
 */


class UpdateSondageAction extends Action
{

    public function run() {

        if (isset($_POST['Delete'])) {
            $statueSondage = $_POST['Delete'];

            $suppresion = $this->database->deleteSondage($this->getSessionLogin(), $statueSondage);

            if ($suppresion) {
                $this->setView(getViewByName("Message"));
                $this->getView()->setMessage("Le sondage a bien été supprimé", "alert-success");
            } else {
                $this->setView(getViewByName("Message"));
                $this->getView()->setMessage("Un problème est survenu lors de la suppression du sondage", "alert-error");
            }

        } elseif (isset($_POST['Modifier'])) {
            $statueSondage = $_POST['Modifier'];
            var_dump($statueSondage);

            $this->setView(getViewByName("EditSurvey"));
            $this->getView()->setSurveys($this->database->loadOneSurvey($this->getSessionLogin(), $statueSondage));


        } else {
            $statueSondage = false;
            $this->setView(getViewByName("Message"));
            $this->getView()->setMessage("Un probleme est survenu durant la recuperation du sondage à modifier");
        }


    }

}