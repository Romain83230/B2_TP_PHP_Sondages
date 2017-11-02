<?php
/**
 * Created by IntelliJ IDEA.
 * User: Romai
 * Date: 02/11/2017
 * Time: 07:34
 */

require_once("views/View.inc.php");

class SearchView extends View
{
    private $list;

    public function displayBody() {
        require "templates/searchSurvey.inc.php";
    }

    public function setList($_list)
    {
        $this->list = $_list;
    }
}