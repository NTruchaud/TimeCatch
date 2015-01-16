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

    /*
     * Fonction permettant de récupérer le nom d'une Mood Pair
     * en fonction de l'ID passé en paramètre
     */
    public function getAMoodPairName($idMoodPair) {
        $query = new \Parse\ParseQuery("MoodPairs");
        try {
            $moodPair = $query->get($idMoodPair);
            // Concaténation des chaînes moodNegative et moodPositive, afin de simplifier l'affichage
            $moodPairName = $moodPair->get("moodNegative_fr") . "-" . $moodPair->get("moodPositive_fr");
        } catch (\Parse\ParseException $ex) {
            
        }
        return $moodPairName;
    }

    /*
     * Traitement de l'ajout d'une Mood Pair
     */
    public function ajouterMoodPair($moodPositive_fr, $moodNegative_fr, $moodPositive_en, $moodNegative_en) {
        $moodPair = new Parse\ParseObject("MoodPairs");

        $moodPair->set("moodPositive_fr", $moodPositive_fr);
        $moodPair->set("moodNegative_fr", $moodNegative_fr);
        $moodPair->set("moodPositive_en", $moodPositive_en);
        $moodPair->set("moodNegative_en", $moodNegative_en);

        $moodPair->save();
    }

    /*
     * Affichage de la page de modification d'une Mood Pair
     * avec récupération des données 
     */
    public function showModification($idMoodPair) {
        $query = new \Parse\ParseQuery('MoodPairs');
        $moodPair = $query->get($idMoodPair);
        return $moodPair;
    }

    /*
     * Traitement de la modification d'une Mood Pair
     */
    public function modify($idMoodPair, $moodPositive_fr, $moodNegative_fr, $moodPositive_en, $moodNegative_en) {
        $query = new \Parse\ParseQuery('MoodPairs');

        $moodPair = $query->get($idMoodPair);
        $moodPair->set("moodPositive_fr", $moodPositive_fr);
        $moodPair->set("moodNegative_fr", $moodNegative_fr);
        $moodPair->set("moodPositive_en", $moodPositive_en);
        $moodPair->set("moodNegative_en", $moodNegative_en);
        $moodPair->save();
    }

    /*
     * Traitement de la suppression d'une Mood Pair après
     * confirmation dans le pop up
     */
    public function delete($idMoodPair) {
        $query = new \Parse\ParseQuery('MoodPairs');

        $moodPair = $query->get($idMoodPair);
        $moodPair->destroy();
    }

}
