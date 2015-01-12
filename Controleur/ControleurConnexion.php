<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/Admin.php';

/**
 * Contrôleur gérant la connexion au site
 *
 */
class ControleurConnexion extends Controleur {

    private $admin;

    public function __construct() {
        $this->admin = new Admin();
    }

    public function index() {
        $this->genererVue();
    }

    public function connecter() {
        if ($this->requete->existeParametre("login") && $this->requete->existeParametre("mdp")) {
            $login = $this->requete->getParametre("login");
            $mdp = $this->requete->getParametre("mdp");
            if ($this->admin->connecter($login, $mdp)) {
                $this->rediriger("accueil");
            } else
                $this->genererVue(array('msgErreur' => 'Login ou mot de passe incorrects'), "index");
        } else
            throw new Exception("Action impossible : login ou mot de passe non défini");
    }

    public function deconnecter() {
        $this->requete->getSession()->detruire();
        $this->rediriger("connexion");
    }

}
