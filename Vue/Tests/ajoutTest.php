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
                    <input name="n_rep" type="number" class="form-control" rows="2" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Date</label>
                <div class="col-sm-5 col-md-4">
                    <input name="date" type="date" class="form-control" placeholder="YYYY-MM-DD" rows="4" required>
                </div>
            </div>

            <div>
                <label class="col-sm-3 col-sm-offset-2 control-label">Mood Pairs</label> 
                <br>
                <?php foreach ($moodPairs as $moodPair): ?>
                    <div class="col-sm-5 col-md-4">
                        <input type='checkbox' id="<?= $moodPair->getObjectId() ?>" name='<?= $moodPair->getObjectId() ?>' value='<?= $moodPair->getObjectId() ?>'  > 
                        <?= $moodPair->get("moodPositive_fr") . "-" . $moodPair->get("moodNegative_fr") ?>
                    </div>
                <?php endforeach; ?>

            </div>

            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-5">
                    <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>
