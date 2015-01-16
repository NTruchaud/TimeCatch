<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/Admin.php';

/**
 * Contrôleur gérant la connexion au site
 *
 */
class ControleurConnexion extends Controleur {

    private $admin;

    // Constructeur
    public function __construct() {
        $this->admin = new Admin();
    }

    // Génération de la page de connexion
    public function index() {
        $this->genererVue();
    }

    // Gestion de la connexion et enregistrement de l'utilisateur en session
    public function connecter() {
        if ($this->requete->existeParametre("login") && $this->requete->existeParametre("mdp")) {
            $login = $this->requete->getParametre("login");
            $mdp = $this->requete->getParametre("mdp");
            if ($this->admin->connecter($login, $mdp)) {
                $admin = $this->admin->getAdmin();
                $this->requete->getSession()->setAttribut("admin", $admin);
                $this->rediriger("accueil");
            } else
                $this->genererVue(array('msgErreur' => 'Login ou mot de passe incorrects'));
        } else
            throw new Exception("Action impossible : login ou mot de passe non défini");
    }

    
    // déconnexion de l'utilisateur, destruction de la variable de session, redirection sur l'accueil
    public function deconnecter() {
        $this->requete->getSession()->detruire();
        $this->rediriger("connexion");
    }

}
