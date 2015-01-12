<?php $this->titre = "Ajout test"; ?>
<?php
require 'Vue/_Commun/navigation.php';
?>
<div class="container">
    <h2 class="text-center">Nouvelle mood-pair</h2>
    <div class="well">
        <form class="form-horizontal" role="form" action="MoodPairs/ajouter" method="post">
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Humeur 1 français :</label>
                <div class="col-sm-5 col-md-4">
                    <input name="moodPositive_fr" type="text" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Humeur 2 français :</label>
                <div class="col-sm-5 col-md-4">
                    <input name="moodNegative_fr" type="text" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Humeur 1 anglais :</label>
                <div class="col-sm-5 col-md-4">
                    <input name="moodPositive_en" type="text" class="form-control" rows="2" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-2 control-label">Humeur 2 anglais :</label>
                <div class="col-sm-5 col-md-4">
                    <input name="moodNegative_en" type="text" class="form-control" rows="4" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-5">
                    <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>
