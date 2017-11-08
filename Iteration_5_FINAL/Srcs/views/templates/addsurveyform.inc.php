<?php

function generateInputForResponse($n)
{
    ?>
    <div class="control-group">
        <label class="control-label" for="responseSurvey<?php echo $n; ?>">Réponse <?php echo $n; ?></label>
        <div class="controls">
            <input class="span3" type="text" name="responseSurvey<?php echo $n; ?>"
                   placeholder="Réponse <?php echo $n; ?>">
        </div>
    </div>
    <?php
}

?>

<form method="post" action="index.php?action=AddSurvey" class="modal">
    <div class="modal-header">
        <h3>Création d'un sondage</h3>
    </div>
    <div class="form-horizontal modal-body">
        <?php if ($this->message !== "")
            echo '<div class="alert ' . $this->style . '">' . $this->message . '</div>';
        ?>
        <div class="control-group">
            <label class="control-label" for="questionSurvey">Question</label>
            <div class="controls">
                <input class="span3" type="text" name="questionSurvey" placeholder="Question">
            </div>
        </div>
        <br>
        <?php
        for ($i = 1; $i <= 5; $i++)
            generateInputForResponse($i);
        ?>
    </div>
    <div class="modal-footer">

        <input class="text-left" style="width: 150px; margin-top: 10px" type="text" placeholder="Nouvelle catégorie ?" name="nouvelleCatégorie"/>
        <select id="listCategory" name="category" class="list-group" style="width: 150px">
            <?php
            echo '<option id="categoryFirst" value="category"> --Categorie-- </option>';
            for ($i = 0; $i < sizeof($this->list); $i++) {

                echo '<option id="' . $this->list[$i] . '" name="category"  value="' . $this->list[$i] . '"> ' . $this->list[$i] . ' </option>';

            }

            ?>

        </select>

        <input class="btn btn-danger" type="submit" value="Poster le sondage"/>
    </div>
</form>



