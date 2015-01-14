<?php $this->titre = "Réponses"; ?>
<?php
$menuMedicaments = true;
require 'Vue/_Commun/navigation.php';
?>
<div class="container">
    <h2 class="text-center">Recherche d'un utilisateur</h2>
    <div class="well">
        <form class="form-horizontal" role="form" action="Reponses/resultat" method="post">
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Utilisateurs</label>
                <div class="col-sm-5 col-md-4">
                    <select class="form-control" name="id">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $this->nettoyer($user->getObjectId()) ?>"><?= $this->nettoyer($user->get("email")) ?> 
                                - <?= $this->nettoyer($user->get("username")) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-5">
                    <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-search"></span> Rechercher</button>
                </div>
            </div>
        </form>
    </div>
</div>