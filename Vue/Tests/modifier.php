<?php $this->titre = "Test d'etude"; ?>
<?php
require_once 'Vue/_Commun/navigation.php';
?>
<div class="container">
    <h2 class="text-center">Modification d'un test d'étude</h2>
    <div class="well">
        <div class="alert alert-success">
            <?= $this->nettoyer($message) ?>
        </div>
    </div>
</div>