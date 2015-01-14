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

        foreach ($answers as $answer) {

            /*
             * Pour les données sur l'utilisateur
             */
            $idUser = $answer->get("idUser");
            $users = $this->reponse->getUser($idUser);
            $date = $users->get("ddn");
            $age = (int) ((time() - strtotime($date->format('Y-m-d'))) / 3600 / 24 / 365.242);
            $mail = $users->get("email");
            $sexe = $users->get("sexe");

            /*
             * Pour les mood pairs
             */
            $moodPairsId = $answer->get("moodsId");
            foreach ($moodPairsId as $moodPairId) {
                $aMoodPairName = $this->moodPairs->getAMoodPairName($moodPairId);
                $moodPairs[$moodPairId] = $aMoodPairName;
            }

            /*
             * Pour les réponses aux mood pairs
             */
            $moodPairsValue[$answer->getObjectId()] = $answer->get("moodsValue");
            $moodPairsHeader = $answer->get("moodsValue");

            /*
             * Pour les temps montrés
             */
            $displayedDuration[$answer->getObjectId()] = $answer->get("displayedDuration");
            $displayedDurationHeader = $answer->get("displayedDuration");

            /*
             * Pour les estimations de temps
             */
            $estmations[$answer->getObjectId()] = $answer->get("estimatedDuration");
        }
        $this->genererVue(array('moodPairsName' => $moodPairs, 'moodPairsValue' => $moodPairsValue, 'displayed' => $displayedDuration, 'estimations' => $estmations,
            'answers' => $answers, 'displayDurationHeader' => $displayedDurationHeader, 'moodPairsHeader' => $moodPairsHeader, 'age' => $age, 'mail' => $mail, 'sexe' => $sexe));
    }

    public function resultat() {
        $idUserRecherche = $this->requete->getParametre("id");
        $answers = $this->reponse->getAnswersByUser($idUserRecherche);
        if (sizeof($answers) != 0) {
            foreach ($answers as $answer) {

                /*
                 * Pour les données sur l'utilisateur
                 */
                $idUser = $answer->get("idUser");
                $users = $this->reponse->getUser($idUser);
                $date = $users->get("ddn");
                $age = (int) ((time() - strtotime($date->format('Y-m-d'))) / 3600 / 24 / 365.242);
                $mail = $users->get("email");
                $sexe = $users->get("sexe");

                /*
                 * Pour les mood pairs
                 */
                $moodPairsId = $answer->get("moodsId");
                foreach ($moodPairsId as $moodPairId) {
                    $aMoodPairName = $this->moodPairs->getAMoodPairName($moodPairId);
                    $moodPairs[$moodPairId] = $aMoodPairName;
                }

                /*
                 * Pour les réponses aux mood pairs
                 */
                $moodPairsValue[$answer->getObjectId()] = $answer->get("moodsValue");
                $moodPairsHeader = $answer->get("moodsValue");

                /*
                 * Pour les temps montrés
                 */
                $displayedDuration[$answer->getObjectId()] = $answer->get("displayedDuration");
                $displayedDurationHeader = $answer->get("displayedDuration");

                /*
                 * Pour les estimations de temps
                 */
                $estmations[$answer->getObjectId()] = $answer->get("estimatedDuration");
                
                $this->genererVue(array('moodPairsName' => $moodPairs, 'moodPairsValue' => $moodPairsValue, 'displayed' => $displayedDuration, 'estimations' => $estmations,
            'answers' => $answers, 'displayDurationHeader' => $displayedDurationHeader, 'moodPairsHeader' => $moodPairsHeader, 'age' => $age, 'mail' => $mail, 'sexe' => $sexe));
            }
        } else {
            $message = "Cette utilisateur n'a pas encore effectué de tests.";
            $this->genererVue(array('message' => $message));
        }
        
    }

    public function recherche() {
        $users = $this->reponse->getUsers();

        $this->genererVue(array('users' => $users));
    }

}
