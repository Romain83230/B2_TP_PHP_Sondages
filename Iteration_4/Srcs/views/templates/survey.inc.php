
<li class="media well">
    <div class="media-body">


        <form class="form-group-lg" style="position: relative; left: 420px" method="post"
              action="<?php echo $_SERVER['PHP_SELF'] . '?action=UpdateSondage'; ?>">
            <button class="fa fa-trash-o" name="Delete" value="<?php echo $survey->getId() ?>" type="submit">
            </button>
            <button class="fa fa-pencil-square-o" name="Modifier" value="<?php echo $survey->getId() ?>" type="submit">
            </button>
        </form>

        <h4 name="<?php echo $survey->getID() ?>" class="media-heading"><?php echo $survey->getQuestion() ?></h4>
        <br>
        <?php
        foreach ($survey->getResponses() as $response) {
        /* TODO START */
        $response->computePercentage($total);

        echo '<div class="fluid-row">
                    <div class="span2">' . $response->getTitle() . '</div>
                    <div class="span2 progress progress-striped active">
            <div class="bar" style="width: ' . $response->getPercentage() . '%"></div>
            </div>
            <span class="span1">(' . round($response->getPercentage()) . '%)</span>'
        ?>
        <form class=".span1." method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?action=Vote'; ?>">
            <input type="hidden" name="responseId" value="<?php echo $response->getID() ?>">
            <input type="submit" style="margin-left:5px" class="span1 btn btn-small btn-danger" value="Voter">
        </form>



    </div>
    <?php
    /* TODO END */
    }
    ?>
    <form class="form-group-lg" style="position: relative;" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?action=Commentaire'; ?>">
        <input type="hidden" name="comments" value="<?php echo $survey->getId() ?>">
        <input type="submit" id = "commentaire" value="Afficher les commentaires">
    </form>

    </div>
</li>



