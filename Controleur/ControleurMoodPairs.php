<?php

require_once 'ControleurPersonnalise.php';
require_once 'ControleurSecurise.php';
require_once 'Modele/Tests.php';
require_once 'Modele/MoodPairs.php';

class ControleurMoodPairs extends ControleurSecurise {

    private $moodPairs;

    public function __construct() {
        $this->moodPairs = new MoodPairs();
    }

    // Affiche la page d'accueil
    public function index() {
        $moodPairsArray = $this->moodPairs->getMoodPairs();
        $this->genererVue(array('moodPairs' => $moodPairsArray));
    }

    // Génération de la page d'ajout d'une Mood Pair
    public function ajoutMoodPair() {
        $this->genererVue();
    }

    // Génération de la page de modification d'une Mood Pair, avec récupération des données
    public function modifierMoodPair() {
        if ($this->requete->existeParametre("id")) {
            $idMoodPair = $this->requete->getParametre("id");
            $modification = $this->moodPairs->showModification($idMoodPair);
            $this->genererVue(array('modifMoodPair' => $modification));
        } else {
            throw new Exception('Le compte rendu' . $idMoodPair . 'n\'existe pas');
        }
    }

    // Traitement de la modification
    public function modifier() {
        if ($this->requete->existeParametre("id")) {
            $idMp = $this->requete->getParametre("id");
            $mp1_fr = $this->requete->getParametre("positiveMood_fr");
            $mp2_fr = $this->requete->getParametre("negativeMood_fr");
            $mp1_en = $this->requete->getParametre("positiveMood_en");
            $mp2_en = $this->requete->getParametre("negativeMood_en");

            $moodPair = $this->moodPairs->modify($idMp, $mp1_fr, $mp2_fr, $mp1_en, $mp2_en);

            $message = 'Le modification a bien été effectuée !';
            $this->genererVue(array('message' => $message));
        } else {
            throw new Exception("La modification n'a pas pu être effectuée.");
        }
    }

    // Traitement de l'ajout
    public function ajouter() {
        if ($this->requete->existeParametre('moodPositive_fr') && $this->requete->existeParametre('moodNegative_fr') && $this->requete->existeParametre('moodPositive_en') &&
                $this->requete->existeParametre('moodNegative_en')) {
            $message = "La mood-pair a bien été ajoutée.";
            $moodPair = $this->moodPairs->ajouterMoodPair($this->requete->getParametre("moodPositive_fr"), $this->requete->getParametre("moodNegative_fr"), $this->requete->getParametre("moodPositive_en"), $this->requete->getParametre("moodNegative_en"));
        } else
            $message = "La mood-pair n'a pas pu être ajoutée.";
        $this->genererVue(array('message' => $message));
    }

    // Traitement de la suppression si l'utilisateur a confirmé
    public function supprimer() {
        // Vérification de l'existance de l'ID
        if ($this->requete->existeParametre("id")) {
            // Récupération de l'ID
            $idMp = $this->requete->getParametre("id");
            $mp = $this->moodPairs->getMoodPairs();
            $this->moodPairs->delete($idMp);
            $message = "Le test a bien été supprimé !";
        } else {
            throw new Exception("La suppression n'a pas pu être effectuée.");
        }
        $this->genererVue(array("message" => $message));
    }

}
