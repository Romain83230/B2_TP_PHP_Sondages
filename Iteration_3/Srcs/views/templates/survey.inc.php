<li class="media well">
    <div class="media-body">


        <form class=".span1." method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?action=UpdateSondage'; ?>">
            <button class="fa fa-trash-o" name="Delete" value="<?php echo $survey -> getId()?>" type="submit">
                <i class="glyphicon glyphicon-trash"></i>
            </button>
            <button class="fa fa-modify-o" name="Modifier"  value="<?php echo $survey -> getId()?>" type="submit">
                <i class="glyphicon glyphicon-trash"></i>
            </button>
        </form>
        <h4 class="media-heading"><?php echo $survey->getQuestion() ?></h4>
        <input class="btn" name="connexionConnexion" type="submit" value="Connexion" />
        <br>
        <?php
        foreach ($survey->getResponses() as $response) {
        /* TODO START */
        $response->computePercentage($total);

        echo '<div class="fluid-row">
                    <div class="span2">' . $response->getTitle() . '</div>
                    <div class="span2 progress progress-striped active">
<<<<<<< HEAD
            <div class="bar" style="width: ' . $response->getPercentage() . '%"></div>
            </div>
            <span class="span1">(' . round($response->getPercentage()) . '%)</span>'
=======
            <div class="bar" style="width: '.$response->getPercentage().'%"></div>
            </div>
            <span class="span1">('.round($response->getPercentage()).'%)</span>'
>>>>>>> 93fcf948cd2096c1fa0032fd24d67e1322355849
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


    </div>
</li>