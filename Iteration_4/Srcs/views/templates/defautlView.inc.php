<div class="container">
    <br>
    <br>
    <br>
    <div class="span7 offset2">
        <ul class="media-list">
            <?php
            foreach ($this->surveys as $survey) {

                $total = $survey->computePercentages();

                require("index.inc.php");
            }
            ?>
        </ul>
    </div>
</div>
