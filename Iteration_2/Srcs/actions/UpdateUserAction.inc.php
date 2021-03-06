<?php

require_once("actions/Action.inc.php");

class UpdateUserAction extends Action {

	/**
	 * Met à jour le mot de passe de l'utilisateur en procédant de la façon suivante :
	 *
	 * Si toutes les données du formulaire de modification de profil ont été postées
	 * ($_POST['updatePassword'] et $_POST['updatePassword2']), on vérifie que
	 * le mot de passe et la confirmation sont identiques.
	 * S'ils le sont, on modifie le compte avec les méthodes de la classe 'Database'.
	 *
	 * Si une erreur se produit, le formulaire de modification de mot de passe
	 * est affiché à nouveau avec un message d'erreur.
	 *
	 * Si aucune erreur n'est détectée, le message 'Modification enregistrée.'
	 * est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
		/* TODO START */
		if ($_POST['updatePassword'] === $_POST['updatePassword2']) {
			if ($this->database->updateUser($this->getSessionLogin(), $_POST['updatePassword']) === true) {
                $this->setView(getViewByName("Message"));
                $this->getView()->setMessage("Modification enregistrée");
            }
            else {
                $this->setView(getViewByName("Message"));
                $this->getView()->setMessage($this->database->updateUser($this->getSessionLogin(), $_POST['updatePassword']));
            }
		} else {
            $this->setView(getViewByName("Message"));
            $this->getView()->setMessage("les deux mots de passes entrés ne sont pas concordants");
		}
		/* TODO END */
	}

	private function setUpdateUserFormView($message) {
		$this->setView(getViewByName("UpdateUserForm"));
		$this->getView()->setMessage($message, "alert-error");
	}

}

?>
