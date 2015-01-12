<?php

require_once 'ControleurPersonnalise.php';
require_once 'ControleurSecurise.php';

class ControleurAccueil extends ControleurSecurise {

    // Affiche la page d'accueil
    public function index() {
        $this->genererVue();
    }
    
}