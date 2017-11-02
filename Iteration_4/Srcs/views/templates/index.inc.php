
<div class="media-body">
    <li class="media well">


        <h4 class="media-heading"><?php echo $survey->getQuestion() ?></h4>
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


</div>
</li>



