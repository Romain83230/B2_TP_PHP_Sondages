<li class="media well">
    <div class="media-body">
        <h4 class="media-heading"><?php echo $survey->getQuestion() ?></h4>
        <br>
        <?php
        foreach ($survey->getResponses() as $response) {
        /* TODO START */
        //var_dump($response->getTitle());

        echo '<div class="fluid-row">
                    <div class="span2">' . $response->getTitle() . '</div>
                    <div class="span2 progress progress-striped active">
            <div class="bar" style="width: 60%"></div>
            </div>
            <span class="span1">(60%)</span>'
        ?>
        <form class=".span1." method="post" action="<?php echo $_SERVER['PHP_SELF'].'?action=Vote';?>">
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



