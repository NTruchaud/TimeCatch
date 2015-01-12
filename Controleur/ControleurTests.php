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
            $date = $this->requete->getParametre("date");

            $dateTime = DateTime::createFromFormat('Y-m-d', $date);

            $test = $this->tests->modify($idTest, intval($duree_1), intval($duree_2), intval($n_rep), $dateTime);

            $message = 'Le modification a bien été effectuée !';
            $this->genererVue(array('message' => $message));
        } else {
            throw new Exception("La modification n'a pas pu être effectuée.");
        }
    }

    public function ajouter() {
        if ($this->requete->existeParametre('duree_1') && $this->requete->existeParametre('duree_2') && $this->requete->existeParametre('n_rep') &&
                $this->requete->existeParametre('date')) {
            $message = 'Le test d\'étude a bien été ajouté';
            $date = $this->requete->getParametre('date');
            $dateTime = DateTime::createFromFormat('Y-m-d', $date);


            $moodPairs = $this->moodPairs->getMoodPairs();
            foreach ($moodPairs as $moodPair) {
                $idMoodPair = $moodPair->getObjectId();
                if ($this->requete->existeParametre($idMoodPair)) {
                    $checkbox = $this->requete->getParametre($idMoodPair);
                    if (isset($checkbox)) {
                        $arrayMoods[$idMoodPair] =  $checkbox;
                    }
                }
            }

            var_dump($arrayMoods);

            $test = $this->tests->addStudy(intval($this->requete->getParametre('duree_1')), intval($this->requete->getParametre('duree_2')), intval($this->requete->getParametre('n_rep')), $dateTime, $arrayMoods);
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

}
