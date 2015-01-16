<?php

require_once 'Framework/Controleur.php';
use Parse\ParseClient;

/**
 * Contrôleur abstrait pour les vues devant afficher les infos visiteur
 * 
 */
abstract class ControleurPersonnalise extends Controleur
{
    /**
     * Redéfinition permettant d'ajouter les infos visiteur aux données des vues 
     * 
     * @param type $donneesVue Données dynamiques
     * @param type $action Action associée à la vue
     */
    protected function genererVue($donneesVue = array(), $action = null)
    {
        $visiteur = null;
        // Si les infos visiteur sont présente dans la session...
        if ($this->requete->getSession()->existeAttribut("visiteur")) {
            // ... on les récupère ...
            $visiteur = $this->requete->getSession()->getAttribut("visiteur");
        }
        // ... et on les ajoute aux données de la vue
        parent::genererVue($donneesVue + array('visiteur' => $visiteur), $action);
        
    }

}