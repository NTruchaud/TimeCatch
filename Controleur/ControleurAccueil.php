<?php

require_once 'ControleurPersonnalise.php';
require_once 'ControleurSecurise.php';

class ControleurAccueil extends ControleurPersonnalise {

    // Affiche la page d'accueil
    public function index() {
        $this->genererVue();
    }
    
}