<?php

require_once 'ControleurPersonnalise.php';

abstract class ControleurSecurise extends Controleur {

    private $admin;
    
    public function _construct() {
        $this->admin = new Admin();
    }
    
    public function executerAction($action) {
// Vérifie si les informations utilisateur sont présents dans la session
// Si oui, l'utilisateur s'est déjà authentifié : l'exécution de l'action continue normalement
// Si non, l'utilisateur est renvoyé vers le contrôleur de connexion
        if ($this->requete->getSession()->existeAttribut("admin")) {
            parent::executerAction($action);
        } else {
            $this->rediriger("connexion");
        }
    }

    public function connecter() {
        if ($this->requete->existeParametre("login") && $this->requete->existeParametre("mdp")) {
            $login = $this->requete->getParametre("login");
            $mdp = $this->requete->getParametre("mdp");
            if ($this->admin->connecter($login, $mdp)) {
                $admin = $this->admin->getAdmin();
                $this->requete->getSession()->setAttribut("admin", $admin);
                var_dump($admin);
                $this->rediriger("accueil");
            } else
                $this->genererVue(array('msgErreur' => 'Login ou mot de passe incorrects'));
        } else
            throw new Exception("Action impossible : login ou mot de passe non défini");
    }

}
