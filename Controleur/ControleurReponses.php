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
        // Récupération de l'ID de l'utilisateur recherché
        $idUserRecherche = $this->requete->getParametre("id");
        // Récupération des réponses de cet utilisateur
        $answers = $this->reponse->getAnswersByUser($idUserRecherche);
        if (sizeof($answers) != 0) {
            foreach ($answers as $answer) {

                /*
                 * Pour les données sur l'utilisateur
                 * On récupère ces données dans la classe _User de Parse
                 * On transforme sa date de naissance en âge
                 */
                $idUser = $answer->get("idUser");
                $users = $this->reponse->getUser($idUser);
                $date = $users->get("ddn");
                $age = (int) ((time() - strtotime($date->format('Y-m-d'))) / 3600 / 24 / 365.242);
                $mail = $users->get("email");
                $sexe = $users->get("sexe");

                /*
                 * Pour les mood pairs
                 * On récupère les id des mood pairs dans la table dans la classe "answer" de Parse
                 * On va chercher leur nom dans la classe "MoodPairs" de Parse
                 */
                $moodPairsId[] = $answer->get("moodsId");
                foreach ($moodPairsId as $key => $moodPairId) {
                    foreach ($moodPairId as $key => $anId) {
                        $moodPairsName[$anId] = $this->moodPairs->getAMoodPairName($anId);
                    }
                }

                /*
                 * Pour les réponses aux mood pairs
                 * On récupère le tableau de réponses aux moodPairs
                 * On les classe par ID de réponse
                 */
                $moodPairsValue[$answer->getObjectId()] = $answer->get("moodsValue");
                $moodPairsHeader = $answer->get("moodsValue");

                /*
                 * Pour les temps montrés
                 * On récupère le tableau de temps présenté à l'utilisateur
                 * On les classe par ID de réponse
                 */
                $displayedDuration[$answer->getObjectId()] = $answer->get("displayedDuration");
                $displayedDurationHeader = $answer->get("displayedDuration");

                /*
                 * Pour les estimations de temps
                 * On récupère le tableau de temps estimés par l'utilisateur
                 * On les classe par ID de réponse
                 */
                $estmations[$answer->getObjectId()] = $answer->get("estimatedDuration");
            }
            // On génère la vue avec toutes les données récupérées
            $this->genererVue(array('moodPairsName' => $moodPairsName, 'moodPairsValue' => $moodPairsValue, 'displayed' => $displayedDuration, 'estimations' => $estmations,
                'answers' => $answers, 'displayDurationHeader' => $displayedDurationHeader, 'moodPairsHeader' => $moodPairsHeader, 'age' => $age, 'mail' => $mail, 'sexe' => $sexe,
                'users' => $users));
        } else {
            // Si le tableau initial (de réponse) est vide, alors on sait que l'utilisateur n'a pas encore réalisé de test
            $message = "Cette utilisateur n'a pas encore effectué de tests.";
            $this->genererVue(array('message' => $message));
        }
    }

    public function recherche() {
        // Récupération de la liste des utilisateurs pour les mettre dans le combobox
        $users = $this->reponse->getUsers();

        $this->genererVue(array('users' => $users));
    }

    // Fonction lancée quand on appuie sur le bouton "Export"
    public function exportCSV() {
        /*
         * On récupère l'ID de l'utilisateur sélectionné dans la recherche
         * On récupère ses réponses
         * On récupère l'utilisateur afin d'avoir accès à ses données
         */
        $idUserRecherche = $this->requete->getParametre("id");
        $answers = $this->reponse->getAnswersByUser($idUserRecherche);
        $user = $this->reponse->getUser($idUserRecherche);

        /*
         * On récupère la réponse a plus récente afin de savoir quelles moodPairs il va falloir affichées
         */
        $mostRecentAnswers = $this->reponse->getMostRecentAnswer();
        foreach ($mostRecentAnswers as $mostRecentAnswer) {
            $moodPairsId = $mostRecentAnswer->get("moodsId");
        }
        $arrayAnswers = array();

        foreach ($answers as $answer) {
            // Pour chaque ID de moodPairs, on va chercher son nom dans la table moodPairs grâce à la fonction getMoodPairName()
            foreach ($moodPairsId as $moodPairId) {
                $moodPairsName[$moodPairId] = $this->moodPairs->getAMoodPairName($moodPairId);
            }
            /*
             * On récupère ensuite toutes les données présentent dans la réponse afin d'en faire un tableau contenant toutes les données
             * des différentes classes regroupées
             * La fonction implode() me permet de faire d'un tableau une grosse chaine String avec chaque élément du tableau séparé par une virgule
             */
            $moodPairsValue = $answer->get("moodsValue");
            $displayedDuration = $answer->get("displayedDuration");
            $estmations = $answer->get("estimatedDuration");
            $arrayAnswers[$answer->getObjectId()] = array($user->get("email"), $user->get("sexe"), $user->get("ddn")->format('Y-m-d'),
                $answer->getCreatedAt()->format('Y-m-d H:i:s'), implode(", ", $moodPairsName), implode(", ", $moodPairsValue),
                implode(", ", $displayedDuration), implode(", ", $estmations));
        }

        /*
         * Ici, on s'occupe de générer le header du fichier CSV, de manière à savoir quoi 
         * correspond quelle donnée
         */
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

        /* Finalement, on appelle la fonction permettant de générer le fichier CSV,
         * en lui faisant passer es deux tableaux construit ci-dessus
         */
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
