<?php $this->titre = "Ajout test"; ?>
<?php
require 'Vue/_Commun/navigation.php';
?>
<div class="container">
    <h2 class="text-center">Nouveau test d'étude</h2>
    <div class="well">
        <form class="form-horizontal" role="form" action="Tests/ajouter" method="post">
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Durée 1</label>
                <div class="col-sm-5 col-md-4">
                    <input name="duree_1" type="number" class="form-control" value="2013-11-28">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Durée 2</label>
                <div class="col-sm-5 col-md-4">
                    <input name="duree_2" type="number" class="form-control" value="2013-11-28">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">N_rep</label>
                <div class="col-sm-5 col-md-4">
                    <input name="n_rep" type="number" class="form-control" rows="2" value="24" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Date de début</label>
                <div class="col-sm-5 col-md-4">
                    <input name="date_debut" type="date" class="form-control" placeholder="YYYY-MM-DD" rows="4" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Date de fin</label>
                <div class="col-sm-5 col-md-4">
                    <input name="date_fin" type="date" class="form-control" placeholder="YYYY-MM-DD" rows="4" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Nombre de notifications par jour</label>
                <div class="col-sm-5 col-md-4">
                    <input name="nbNotif" type="number" value="3" class="form-control" rows="4" required>
                </div>
            </div>

            <!-- Ici, on génère autant de checkbox qu'il y a de moodPairs, avec comme value leurs ID respectif -->
            <div class="text-center">
                <label class="col-sm-3 col-sm-offset-2 control-label">Mood Pairs</label><br/><br/>
                <?php foreach ($moodPairs as $moodPair): ?>
                <input type='checkbox' id="<?= $moodPair->getObjectId() ?>" name='<?= $moodPair->getObjectId() ?>' value='<?= $moodPair->getObjectId() ?>' > 
                        <?= $moodPair->get("moodPositive_fr") . "-" . $moodPair->get("moodNegative_fr") ?><br/>
                <?php endforeach; ?>
            </div>
            <br/>
            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-5">
                    <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>
