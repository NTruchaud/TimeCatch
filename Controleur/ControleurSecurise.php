<?php

require_once 'ControleurPersonnalise.php';

abstract class ControleurSecurise extends ControleurPersonnalise {

    public function executerAction($action) {
        /*if ($this->requete->getSession()->existeAttribut("visiteur")) {
            parent::executerAction($action);
        }
        else {*/
            $this->rediriger("connexion");
        //}
    }

}