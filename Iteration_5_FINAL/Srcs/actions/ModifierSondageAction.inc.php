<?php

require_once("actions/Action.inc.php");

class ModifierSondageAction extends Action
{
    /**
     * Traite les données envoyées par le formulaire de modification de sondage.
     *
     * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
     *
     * Sinon, la fonction modifie le sondage dans la base de données. Elle transforme
     * les réponses et la question à l'aide de la fonction PHP 'htmlentities' pour éviter
     * que du code exécutable ne soit inséré dans la base de données et affiché par la suite.
     *
     * Un des messages suivants doivent être affichés à l'utilisateur :
     * - "La question est obligatoire.";
     * - "Il faut saisir au moins 2 réponses.";
     * - "Merci, nous avons mis à jour votre sondage.".
     * @see Action::run()
     */
    public function run()
    {




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
                    if (isset($_POST['responseSurvey' . $i])) {
                        $reponse[$i] = htmlentities($_POST['responseSurvey' . $i]);
                    }
                }
                if (sizeof($reponse) < 2) {
                    $this->setView(getViewByName("Message"));
                    $this->getView()->setMessage("Il faut saisir au moins 2 réponses.");
                } else {
                    array_unshift($reponse, htmlentities($_POST['questionSurvey']));


                    if ($this->database -> modiferSondage($reponse, $_POST['idSurvey']) === true) {
                        $this->setView(getViewByName("Message"));
                        $this->getView()->setMessage("Merci, nous avons ajouté votre sondage");
                    } else {
                        $this->setView(getViewByName("Message"));
                        $this->getView()->setMessage("Un problème est survenu lors de la modification de votre sondage");
                    }

                }
            }
        }
    }


}