<form method="post" action="index.php?action=SignUp" class="modal">
	<div class="modal-header">
		<h3>Inscription</h3>
	</div>
	<div class="form-horizontal modal-body">
<?php	if ($this->message!=="")
			echo '<div class="alert "'.$this->style.'">'.$this->message.'</div>';
?>
		<div class="control-group">
			<label class="control-label" for="signUpLogin">Pseudo</label>
			<div class="controls">
				<input type="text" name="signUpLogin" placeholder="Pseudo">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="signUpPassword">Mot de passe</label>
			<div class="controls">
				<input type="password" name="signUpPassword" placeholder="Mot de passe">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="signUpPassword2">Confirmation</label>
			<div class="controls">
				<input type="password" name="signUpPassword2" placeholder="Confirmation">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input class="btn btn-danger" type="submit" value="Créer mon compte" />
	</div>
</form>


