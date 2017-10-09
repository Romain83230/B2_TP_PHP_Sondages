<?php

require_once("actions/Action.inc.php");

class LoginAction extends Action {

	/**
	 * Traite les données envoyées par le visiteur via le formulaire de connexion
	 * (variables $_POST['nickname'] et $_POST['password']).
	 * Le mot de passe est vérifié en utilisant les méthodes de la classe Database.
	 * Si le mot de passe n'est pas correct, on affiche le message "Pseudo ou mot de passe incorrect."
	 * Si la vérification est réussie, le pseudo est affecté à la variable de session.
	 *
	 * @see Action::run()
	 */
	public function run() {
  	/* TODO START */
        $nickname = $_POST['nickname'];
        if ($this->database->checkPassword($nickname, $_POST['password']) === true) {

            $this->setView(getViewByName("Message"));
            $this->getView()->setMessage("Vous êtes connecté");

            $this->setSessionLogin($nickname);

        } else {
            $this->setView(getViewByName("Message"));
            $this->getView()->setMessage("Pseudo ou mot de passe incorrect.");
        }

  	/* TODO END */
	}

}

?>
