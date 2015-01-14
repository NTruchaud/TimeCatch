<?php

require_once 'ControleurSecurise.php';
require_once 'Modele/Tests.php';
require_once 'Modele/MoodPairs.php';
require_once 'Modele/Reponses.php';

class ControleurReponses extends ControleurSecurise {

    private $tests;
    private $moodPairs;
    private $reponse;

    public function __construct() {
        $this->tests = new Tests();
        $this->moodPairs = new MoodPairs();
        $this->reponse = new Reponses();
    }

    // Affiche la page d'accueil
    public function index() {
        $answers = $this->reponse->getAnswers();

        /*
         * Pour les données sur l'utilisateur
         */
        foreach ($answers as $answer) {
            $idUser = $answer->get("idUser");
            $users = $this->reponse->getUser($idUser);
            $date = $users->get("ddn");
            $age = (int)((time() - strtotime($date->format('Y-m-d'))) / 3600 / 24 / 365.242);
            $mail = $users->get("email");
            $sexe = $users->get("sexe");
        }
        
        /*
         * Pour les mood pairs
         */

        foreach ($answers as $answer) {
            $moodPairsId = $answer->get("moodsId");
            foreach ($moodPairsId as $moodPairId) {
                $aMoodPairName = $this->moodPairs->getAMoodPairName($moodPairId);
                $moodPairs[$moodPairId] = $aMoodPairName;
            }
        }

        /*
         * Pour les réponses aux mood pairs
         */
        foreach ($answers as $answer) {
            $moodPairsValue[$answer->getObjectId()] = $answer->get("moodsValue");
            $moodPairsHeader = $answer->get("moodsValue");
        }

        /*
         * Pour les temps montrés
         */
        foreach ($answers as $answer) {
            $displayedDuration[$answer->getObjectId()] = $answer->get("displayedDuration");
            $displayedDurationHeader = $answer->get("displayedDuration");
        }

        /*
         * Pour les estimations de temps
         */
        foreach ($answers as $answer) {
            $estmations[$answer->getObjectId()] = $answer->get("estimatedDuration");
        }

        $this->genererVue(array('moodPairsName' => $moodPairs, 'moodPairsValue' => $moodPairsValue, 'displayed' => $displayedDuration, 'estimations' => $estmations,
            'answers' => $answers, 'displayDurationHeader' => $displayedDurationHeader, 'moodPairsHeader' => $moodPairsHeader, 'age' => $age, 'mail' => $mail, 'sexe' => $sexe));
    }

}
