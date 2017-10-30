<?php
require_once("views/View.inc.php");

class CommentsView extends View {

	/**
	 * Affiche un seul sondage et ses commentaires
	 *
	 * @see View::displayBody()
	 */
	 public function setComments($comments)
 	{
 			$this->comments = $comments;
 	}

	public function displayBody() {
		require("templates/comments.inc.php");
	}

}
?>
