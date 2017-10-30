<?php

function generateInputForResponse($count, $question) {

    ?>
    <div class="control-group">

        <label class="control-label" for="responseSurvey<?php echo $count ?>">Réponse <?php  ?></label>
        <div class="controls">
            <input class="span3" type="text" name="responseSurvey<?php echo $count ?>" value="<?php echo $question  ?>">
        </div>
    </div>
    <?php
}
?>

<form method="post" action="index.php?action=ModifierSondage" class="modal">
    <div class="modal-header">
        <h3>Edition d'un sondage</h3>
    </div>
    <div class="form-horizontal modal-body">
        <?php	if ($this->message!=="")
            echo '<div class="alert '.$this->style.'">'.$this->message.'</div>';
        ?>
        <div style="text-align:center" class="alert">
            Le changement d'une réponse réinitialise les votes à 0.
        </div>
        <div class="control-group">
            <label class="control-label" for="questionSurvey">Question</label>
            <div class="controls">
                <input class="span3" type="text" name="questionSurvey" value="<?php echo $survey -> getQuestion() ?>">
            </div>
        </div>
        <br>
        <?php
        $count = 1;
        foreach ($survey->getResponses() as $response) {
            generateInputForResponse($count, $response->getTitle());
            $count++;
        }
        ?>
    </div>
    <div class="modal-footer">
        <input class="btn btn-danger" type="submit"	value="Editer" />
    </div>
</form>



