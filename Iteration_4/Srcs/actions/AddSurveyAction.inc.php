<?php

require_once("model/Survey.inc.php");
require_once("model/Response.inc.php");
require_once("actions/Action.inc.php");

class AddSurveyAction extends Action
{

    /**
     * Traite les données envoyées par le formulaire d'ajout de sondage.
     *
     * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
     *
     * Sinon, la fonction ajoute le sondage à la base de données. Elle transforme
     * les réponses et la question à l'aide de la fonction PHP 'htmlentities' pour éviter
     * que du code exécutable ne soit inséré dans la base de données et affiché par la suite.
     *
     * Un des messages suivants doivent être affichés à l'utilisateur :
     * - "La question est obligatoire.";
     * - "Il faut saisir au moins 2 réponses.";
     * - "Merci, nous avons ajouté votre sondage.".
     *
     * Le visiteur est finalement envoyé vers le formulaire d'ajout de sondage en cas d'erreur
     * ou vers une vue affichant le message "Merci, nous avons ajouté votre sondage.".
     *  responseSurvey1
     * @see Action::run()
     */
    public function run()
    {

        /* TODO START */
        if ($this->getSessionLogin() === null) {
            $this->setView(getViewByName("Message"));
            $this->getView()->setMessage("Vous devez vous loger avant de poster un sondage");
        } else {
            if ($_POST['questionSurvey'] == null) {
                $this->setView(getViewByName("Message"));
                $this->getView()->setMessage("La question est obligatoire.");
            } else {
                $reponse = array();
                for ($i = 1; $i <= 6; $i++) {
                    if (($i == 6 || ($_POST['responseSurvey' . $i]) == null)) {
                        continue;
                    }
                    $reponse[$i] = htmlentities($_POST['responseSurvey' . $i]);
                }
                if (sizeof($reponse) < 2) {
                    $this->setView(getViewByName("Message"));
                    $this->getView()->setMessage("Il faut saisir au moins 2 réponses.");
                } else {

                    if ((!isset($_POST['category']) || ($_POST['category'] == "category") || ($_POST['category'] == "")) && ($_POST['nouvelleCatégorie'] == '')) {

                        $this->setView(getViewByName("Message"));
                        $this->getView()->setMessage("Vous devez sélectionner une catégorie pour votre sondage");

                    } else {

                        if ($_POST['nouvelleCatégorie'] != '') {

                            array_unshift($reponse, htmlentities($_POST['questionSurvey']));
                            if (($this->database->saveSurvey($reponse, htmlentities($_POST['nouvelleCatégorie']), ($this->getSessionLogin())) === true)) {
                                $this->setView(getViewByName("Message"));
                                $this->getView()->setMessage("Merci, nous avons ajouté votre sondage");
                            } else {
                                $this->setView(getViewByName("Message"));
                                $this->getView()->setMessage("Un problème est survenu lors de l'ajout de votre sondage à la base de donnée");
                            }
                        } else {
                            array_unshift($reponse, htmlentities($_POST['questionSurvey']));
                            if (($this->database->saveSurvey($reponse, $_POST['category'], ($this->getSessionLogin())) === true)) {
                                $this->setView(getViewByName("Message"));
                                $this->getView()->setMessage("Merci, nous avons ajouté votre sondage");
                            } else {
                                $this->setView(getViewByName("Message"));
                                $this->getView()->setMessage("Un problème est survenu lors de l'ajout de votre sondage à la base de donnée");
                            }
                        }
                    }
                }
            }
        }
        /* TODO END */
    }


    private function setAddSurveyFormView($message)
    {
        $this->setView(getViewByName("AddSurveyForm"));
        $this->getView()->setMessage($message, "alert-error");
    }

}

?>
