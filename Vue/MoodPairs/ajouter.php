<?php $this->titre = "Test d'etude"; ?>
<?php
require_once 'Vue/_Commun/navigation.php';
?>
<div class="container">
    <h2 class="text-center">Nouvelle mood-pair</h2>
    <div class="well">
        <div class="alert alert-success">
            <?= $this->nettoyer($message) ?>
        </div>
    </div>
</div>