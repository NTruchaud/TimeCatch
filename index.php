<?php

// Contrôleur frontal : instancie un routeur pour traiter la requête entrante
require 'vendor/autoload.php';

use Parse\ParseClient;
ParseClient::initialize('lakYfYrJz40bbOusSjWNSauW7WLBUy833T4XioDq', '5mmGy9xiEln3mNTFaIhAZfNOGvM67bjhbNeSMPFk', 'FigsQ4bEskYD06XJwex6aJaKWCWnaDfOAsyaZFr4');

require 'Framework/Routeur.php';

$routeur = new Routeur();
$routeur->routerRequete();


