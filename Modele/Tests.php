<?php

require_once 'Framework/Modele.php';

class Tests extends Modele {

    public function getStudy() {
        $query = new Parse\ParseQuery("Study");
        try {
            
            $tests = $query->find();
            // The object was retrieved successfully.
        } catch (Parse\ParseExceptioneException $ex) {
            // The object was not retrieved successfully.
            // error is a ParseException with an error code and message.
        }
        return $tests;
    }

    public function addStudy($duree_1, $duree_2, $n_rep, $dateDeb, $dateFin, $nbNotif, $arrayMoods) {
        $test = new Parse\ParseObject("Study");

        $test->set("duree_1", $duree_1);
        $test->set("duree_2", $duree_2);
        $test->set("n_rep", $n_rep);
        $test->set("date_debut", $dateDeb);
        $test->set("date_fin", $dateFin);
        $test->set("nbNotif", $nbNotif);
        
        foreach ($arrayMoods as $key => $value) {
            $test->add("MoodPairs", [$key]);
        }

        $test->save();
    }
    
    public function showModification($idTest) {
        $query = new \Parse\ParseQuery('Study');
        $test = $query->get($idTest);
        return $test;
    }
    
    public function modify($idTest, $duree_1, $duree_2, $n_rep, $dateDeb, $dateFin, $nbNotif) {
        $query = new \Parse\ParseQuery('Study');
        
        $test = $query->get($idTest);
        $test->set("duree_1", $duree_1);
        $test->set("duree_2", $duree_2);
        $test->set("n_rep", $n_rep);
        $test->set("date_debut", $dateDeb);
        $test->set("date_fin", $dateFin);
        $test->set("nbNotif", $nbNotif);
        $test->save();
    }

    public function delete($idTest) {
        $query = new \Parse\ParseQuery('Study');
        
        $test = $query->get($idTest);
        $test->destroy();
    }
    
}


