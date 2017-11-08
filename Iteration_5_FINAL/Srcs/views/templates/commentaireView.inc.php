<li class="media well">
    <div class="media-body">


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

    <form class=".span1." method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?action=AddCommentaire'; ?>">

        <?php
        $sizeCom = sizeof($this->comm);
        for ($i = 0; $i < $sizeCom; $i++) {
            echo '<label for="message"> <strong> ' . $this->comm[$i]["owner"] . '</strong> ' . $this->comm[$i]["heure"] . ' </label>';
            echo '<textarea readonly name="commentaire" >';
            echo $this->comm[$i]["commentaire"];
            echo '</textarea>';
        }
        ?>
        <textarea name="textarea" >
        </textarea>
        <input type="hidden" name="idSurvey" value="<?php echo $survey->getID() ?>">
        <input type="submit" style="margin-left:5px" class="btn btn-danger" value="Poster commentaire">
    </form>

    </div>
</li>