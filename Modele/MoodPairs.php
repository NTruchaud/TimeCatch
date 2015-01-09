<?php

require_once 'Framework/Modele.php';

class MoodPairs extends Modele {

    public function getMoodPairs() {
        $query = new Parse\ParseQuery("MoodPairs");
        try {

            $moodPairs = $query->find();
            // The object was retrieved successfully.
        } catch (Parse\ParseExceptioneException $ex) {
            // The object was not retrieved successfully.
            // error is a ParseException with an error code and message.
        }
        return $moodPairs;
    }

}
