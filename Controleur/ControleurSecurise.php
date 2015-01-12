<?php

require_once 'ControleurPersonnalise.php';

abstract class ControleurSecurise extends Controleur {

    public function executerAction($action) {
// Vérifie si les informations utilisateur sont présents dans la session
// Si oui, l'utilisateur s'est déjà authentifié : l'exécution de l'action continue normalement
// Si non, l'utilisateur est renvoyé vers le contrôleur de connexion
        if ($this->requete->getSession()->existeAttribut("idAdmin")) {
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
                $admin = $this->admin->getAdmin($login, $mdp);
                $this->requete->getSession()->setAttribut("idAdmin", $admin->getObjectId());
                $this->requete->getSession()->setAttribut("login", $admin->get('username'));
                $this->rediriger("accueil");
            } else
                $this->genererVue(array('msgErreur' => 'Login ou mot de passe incorrects'), "index");
        } else
            throw new Exception("Action impossible : login ou mot de passe non défini");
    }

}
