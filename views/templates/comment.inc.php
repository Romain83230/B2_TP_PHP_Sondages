<li>
  <div class="media-body">
    <h4 class="media-heading">Commentaires</h4>
    <br/>
    <?php
    foreach ($comments->getComments() as $comm) {
      echo '<div class="fluid-row">
              <div class="span2">'.$comm->getWriter().'</div>
              <div class="span2">'.$comm->getComments().'</div>
            </div>';

     ?>
</div>
</li>
<li>
  <div class="media-body">
     <form class=".span1." method="post" action="<?php echo $_SERVER['PHP_SELF'].'?action=AddComment';?>">
         <input type="hidden" name="responseId" value="<?php echo $comm->getID() ?>">
         <textarea label="Commentaire"></textarea>
         <input type="submit" style="margin-left:5px" class="span1 btn btn-small btn-danger" value="Commenter">
     </form>

     <?php

     }
     ?>
</div>
</li>
