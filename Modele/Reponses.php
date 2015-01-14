<?php

require_once "Framework/Modele.php";

class Reponses extends Modele {

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

    public function getUser($idUser) {
        $query = new Parse\ParseQuery("_User");
        $user = $query->get($idUser);
        return $user;
    }

}
