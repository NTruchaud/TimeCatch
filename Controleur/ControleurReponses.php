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
            $users[$answer->getObjectId()] = $this->reponse->getUser($idUser);
            /* $dateAge = $users->get("ddn");
              $date[$answer->getObjectId()] = $users->get("ddn");
              $age[$answer->getObjectId()] = (int) ((time() - strtotime($dateAge->format('Y-m-d'))) / 3600 / 24 / 365.242);
              $mail[$answer->getObjectId()] = $users->get("email");
              $sexe[$answer->getObjectId()] = $users->get("sexe");
              var_dump($users->get("email")); */
            /*
             * Pour les mood pairs
             */
            $moodPairsId[] = $answer->get("moodsId");
            foreach ($moodPairsId as $key => $moodPairId) {
                foreach ($moodPairId as $key => $anId) {
                    $moodPairsName[$anId] = $this->moodPairs->getAMoodPairName($anId);
                }
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
        $this->genererVue(array('moodPairsName' => $moodPairsName, 'moodPairsValue' => $moodPairsValue, 'displayed' => $displayedDuration, 'estimations' => $estmations,
            'answers' => $answers, 'displayDurationHeader' => $displayedDurationHeader, 'moodPairsHeader' => $moodPairsHeader, 'users' => $users));
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
                $moodPairsId[] = $answer->get("moodsId");
                foreach ($moodPairsId as $key => $moodPairId) {
                    foreach ($moodPairId as $key => $anId) {
                        $moodPairsName[$anId] = $this->moodPairs->getAMoodPairName($anId);
                    }
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
            $this->genererVue(array('moodPairsName' => $moodPairsName, 'moodPairsValue' => $moodPairsValue, 'displayed' => $displayedDuration, 'estimations' => $estmations,
                'answers' => $answers, 'displayDurationHeader' => $displayedDurationHeader, 'moodPairsHeader' => $moodPairsHeader, 'age' => $age, 'mail' => $mail, 'sexe' => $sexe,
                'users' => $users));
        } else {
            $message = "Cette utilisateur n'a pas encore effectué de tests.";
            $this->genererVue(array('message' => $message));
        }
    }

    public function recherche() {
        $users = $this->reponse->getUsers();

        $this->genererVue(array('users' => $users));
    }

    public function exportCSV() {
        $idUserRecherche = $this->requete->getParametre("id");
        $answers = $this->reponse->getAnswersByUser($idUserRecherche);
        $user = $this->reponse->getUser($idUserRecherche);

        $mostRecentAnswers = $this->reponse->getMostRecentAnswer();
        foreach ($mostRecentAnswers as $mostRecentAnswer) {
            $moodPairsId = $mostRecentAnswer->get("moodsId");
        }
        $arrayAnswers = array();

        foreach ($answers as $answer) {

            foreach ($moodPairsId as $moodPairId) {
                $moodPairsName[$moodPairId] = $this->moodPairs->getAMoodPairName($moodPairId);
            }
            $moodPairsValue = $answer->get("moodsValue");
            $displayedDuration = $answer->get("displayedDuration");
            $estmations = $answer->get("estimatedDuration");
            $arrayAnswers[$answer->getObjectId()] = array($user->get("email"), $user->get("sexe"), $user->get("ddn")->format('Y-m-d'),
                $answer->getCreatedAt()->format('Y-m-d H:i:s'), implode(", ", $moodPairsName), implode(", ", $moodPairsValue),
                implode(", ", $displayedDuration), implode(", ", $estmations));
        }
        $headerCsv = array();
        $headerCsv[] = array(
            0 => 'Mail',
            1 => 'Sexe',
            2 => 'Date de naissance',
            3 => 'Date et heure de complétion du test',
            4 => 'Mood Pairs',
            5 => 'Valeur des moodPairs',
            6 => 'Temps présentés',
            7 => 'Temps éstimés');
        $this->array_to_csv_download($headerCsv, $arrayAnswers, $filename = "export.csv", $delimiter = ",");
    }

    public function array_to_csv_download($arrayHeader, $array, $filename = "export.csv", $delimiter = ";") {
// open raw memory as file so no temp files needed, you might run out of memory though
        $f = fopen('php://output', 'w');
        foreach ($arrayHeader as $lineHeader) {
// generate csv lines from the inner arrays
            fputcsv($f, $lineHeader, $delimiter);
        }

// loop over the input array
        foreach ($array as $line) {
// generate csv lines from the inner arrays
            fputcsv($f, $line, $delimiter);
        }

// rewrind the "file" with the csv lines
//fseek($f, 0);
// tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
// tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachement; filename="' . $filename . '";');
// make php send the generated csv lines to the browser
        fpassthru($f);
    }

}
