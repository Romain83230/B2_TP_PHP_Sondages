<?php

require_once("actions/Action.inc.php");


class GetMySurveysAction extends Action
{

    /**
     * Construit la liste des sondages de l'utilisateur et le dirige vers la vue "ServeysView"
     * de façon à afficher les sondages.
     *
     * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
     *
     * @see Action::run()
     */
     public function run()

     {
          /* TODO START */
         if ($this->getSessionLogin() == null) {
              $this->setView(getViewByName("Message"));
              $this->getView()->setMessage("Veuillez-vous connecter");
          } else {
              $surveys = $this->database->loadSurveysByOwner($this->getSessionLogin());
  //            var_dump($surveys);
              foreach ($surveys as $object) {
  			    $qs = new Survey($object["owner"], $object["owner"]);
              }
              $this->getView()->setSurveys($surveys);
  //			$rep->setResponses($this->database->loadRes)
  //            $reponse = $this->database -> loadResponses($surveys, $arrayResponses)
  //			var_dump($surveys);
  //
  //		$this->getView()->setSurveys($surveys);
              $this->setView(getViewByName("Surveys"));
          }
          /* TODO END */
      }

}

?>
