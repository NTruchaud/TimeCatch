<?php

require "Framework/Modele.php";

class Admin extends Modele {

    /**
     * Vérifie qu'un utilisateur existe dans la BD
     *
     * @param string $login Le login
     * @param string $mdp Le mot de passe
     * @return boolean Vrai si l'utilisateur existe, faux sinon
     */
    public function connecter($login, $mdp) {
        //$user = Parse\ParseUser::logIn($login, $mdp);
        //$username = $user->getUsername();
        //if ($username == "admin") {
        if ($user = Parse\ParseUser::logIn($login, $mdp)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Renvoie un utilisateur existant dans la BD
     *
     * @param string $login Le login
     * @param string $mdp Le mot de passe
     * @return mixed L'utilisateur
     * @throws Exception Si aucun utilisateur ne correspond aux paramètres
     */
    public function getAdmin() {
        $user = Parse\ParseUser::getCurrentUser();
        return $user;
    }

}
