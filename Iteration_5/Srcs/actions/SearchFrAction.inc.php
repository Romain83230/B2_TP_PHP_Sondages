<?php
/**
 * Created by IntelliJ IDEA.
 * User: Romai
 * Date: 02/11/2017
 * Time: 07:19
 */

require_once("actions/Action.inc.php");
class SearchFrAction extends Action
{

    /**
     * Méthode qui doit être implémentée par chaque action afin de décrire
     * son comportement.
     */
    public function run()
    {

        $this->setView(getViewByName("Search"));
        $this->getView()->setList($this->database->dropDownListCatagory());
    }


}