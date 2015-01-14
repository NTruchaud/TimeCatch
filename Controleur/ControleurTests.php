<?php

require_once 'ControleurPersonnalise.php';
require_once 'ControleurSecurise.php';
require_once 'Modele/Tests.php';
require_once 'Modele/MoodPairs.php';

class ControleurTests extends ControleurSecurise {

    private $tests;
    private $moodPairs;

    public function __construct() {
        $this->tests = new Tests();
        $this->moodPairs = new MoodPairs();
    }

    // Affiche la page d'accueil
    public function index() {
        $tests = $this->tests->getStudy();
        $this->genererVue(array('tests' => $tests));
    }

    public function ajoutTest() {
        $moodPairs = $this->moodPairs->getMoodPairs();
        $this->genererVue(array("moodPairs" => $moodPairs));
    }

    public function modifierTests() {
        if ($this->requete->existeParametre("id")) {
            $idTest = $this->requete->getParametre("id");
            $modification = $this->tests->showModification($idTest);
            $this->genererVue(array('modifTest' => $modification));
        } else {
            throw new Exception('Le compte rendu' . $idTest . 'n\'existe pas');
        }
    }

    public function modifier() {
        if ($this->requete->existeParametre("id")) {
            $idTest = $this->requete->getParametre("id");
            $duree_1 = $this->requete->getParametre("duree_1");
            $duree_2 = $this->requete->getParametre("duree_2");
            $n_rep = $this->requete->getParametre("n_rep");
            $dateDeb = $this->requete->getParametre("date_debut");
            $dateFin = $this->requete->getParametre('date_fin');
            $nbNotif = $this->requete->getParametre('nbNotif');
            
            $dateTimeDeb = DateTime::createFromFormat('Y-m-d', $dateDeb);
            $dateTimeFin = DateTime::createFromFormat('Y-m-d', $dateFin);

            $test = $this->tests->modify($idTest, intval($duree_1), intval($duree_2), intval($n_rep), $dateTimeDeb, $dateTimeFin, intval($nbNotif));

            $message = 'Le modification a bien été effectuée !';
            $this->genererVue(array('message' => $message));
        } else {
            throw new Exception("La modification n'a pas pu être effectuée.");
        }
    }

    public function ajouter() {
        if ($this->requete->existeParametre('duree_1') && $this->requete->existeParametre('duree_2') && $this->requete->existeParametre('n_rep') &&
                $this->requete->existeParametre('date_debut') && $this->requete->existeParametre('date_fin') && $this->requete->existeParametre('nbNotif') ) {
            $message = 'Le test d\'étude a bien été ajouté';
            $dateDeb = $this->requete->getParametre('date_debut');
            $dateFin = $this->requete->getParametre('date_fin');
            $dateTimeDeb = DateTime::createFromFormat('Y-m-d', $dateDeb);
            $dateTimeFin = DateTime::createFromFormat('Y-m-d', $dateFin);


            $moodPairs = $this->moodPairs->getMoodPairs();
            foreach ($moodPairs as $moodPair) {
                $idMoodPair = $moodPair->getObjectId();
                if ($this->requete->existeParametre($idMoodPair)) {
                    $checkbox = $this->requete->getParametre($idMoodPair);
                    if (isset($checkbox)) {
                        $arrayMoods[$idMoodPair] = $checkbox;
                    }
                }
            }

            $test = $this->tests->addStudy(intval($this->requete->getParametre('duree_1')), intval($this->requete->getParametre('duree_2')), 
                    intval($this->requete->getParametre('n_rep')), $dateTimeDeb, $dateTimeFin, intval($this->requete->getParametre('nbNotif')), $arrayMoods);
        } else {
            $message = "Le test d'étude n'a pas pu être ajouté";
        }
        $this->genererVue(array('message' => $message, 'test' => $test));
    }

    public function supprimer() {
        if ($this->requete->existeParametre("id")) {
            $idTest = $this->requete->getParametre("id");
            $tests = $this->tests->getStudy();
            $this->tests->delete($idTest);
            $message = "Le test a bien été supprimé !";
        } else {
            throw new Exception("La suppression n'a pas pu être effectuée.");
        }
        $this->genererVue(array("tests" => $tests, "message" => $message));
    }

    /*
     * Tentative d'implémentation de l'export CSV
     * Le problème étant que l'on va envoyer un tableau Parse, donc va savoir ce qu'il y a dedans, et donc ce qu'il va mette
     * dans e fichier CSV.
     * 
     */
    
    public function exportCSV() {
        $studies = $this->tests->getStudy();
        $arrayStudies = array();
        
        foreach ($studies as $study) {
            $arrayStudies[$study->getObjectId()] = array($study->getCreatedAt()->format('Y-m-d H:i:s'), strval($study->get("duree_1")), strval($study->get("duree_2")), 
                strval($study->get("n_rep")));
        }
        $this->array_to_csv_download($arrayStudies, $filename = "export.csv", $delimiter = ",");
    }
    
    public function array_to_csv_download($array, $filename = "export.csv", $delimiter = ";") {
        // open raw memory as file so no temp files needed, you might run out of memory though
        $f = fopen('php://output', 'w');
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
