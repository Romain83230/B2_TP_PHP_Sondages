<?php
require_once("model/Survey.inc.php");
require_once("model/Response.inc.php");
require_once("actions/Action.inc.php");

class AddCommentAction extends Action {

  public function run(){
    $this->setView(getViewByName("Comments"));
  }
}

 ?>
