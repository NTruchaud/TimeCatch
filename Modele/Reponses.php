<?php

require_once "Framework/Modele.php";

class Reponses extends Modele {

    /*
     * Récupération de toutes les réponses
     */
    public function getAnswers() {
        $query = new Parse\ParseQuery("Answers");
        try {
            $answers = $query->find();
            // The object was retrieved successfully.
        } catch (Parse\ParseExceptioneException $ex) {
            // The object was not retrieved successfully.
            // error is a ParseException with an error code and message.
        }
        return $answers;
    }
    
    /*
     * Récupération de la réponse la plus récente
     */
    public function getMostRecentAnswer() {
        $query = new \Parse\ParseQuery("Answers");
        $query->descending("createdAt");
        $mostRecentAnswer = $query->find();
        return $mostRecentAnswer;
    }

    /*
     * Récupération d'un utilisateur en fonction de son ID
     */
    public function getUser($idUser) {
        $query = new Parse\ParseQuery("_User");
        $user = $query->get($idUser);
        return $user;
    }

    /*
     * Récupération de tous les utilisateurs
     */
    public function getUsers() {
        $query = new Parse\ParseQuery("_User");
        $users = $query->find();

        return $users;
    }

    /*
     * Récupération des réponses d'un utilisateur
     */
    public function getAnswersByUser($idUser) {
        $query = new Parse\ParseQuery("Answers");
        try {
            $query->equalTo("idUser", $idUser);
            $answers = $query->find();
            // The object was retrieved successfully.
        } catch (Parse\ParseExceptioneException $ex) {
            // The object was not retrieved successfully.
            // error is a ParseException with an error code and message.
        }
        return $answers;
    }

}
