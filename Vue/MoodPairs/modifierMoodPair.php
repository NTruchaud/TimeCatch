<?php $this->titre = "Modification des test d'étude"; ?>
<?php
$menuCompteRendu = true;
require_once 'Vue/_Commun/navigation.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2 class="text-center">
                Modification d'une mood-pair
            </h2>
            <div class="well">
                <form class="form-horizontal" role="form" action="MoodPairs/modifier" method="post">
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-2 control-label">Humeur 1 français :</label>
                        <div class="col-sm-5 col-md-4">
                            <input name="positiveMood_fr" type="text" value='<?= $modifMoodPair->get('moodPositive_fr') ?>' class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-2 control-label">Humeur 2 français :</label>
                        <div class="col-sm-5 col-md-4">
                            <input name="negativeMood_fr" type="text" class="form-control" value='<?= $modifMoodPair->get('moodNegative_fr') ?>' required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-2 control-label">Humeur 1 anglais :</label>
                        <div class="col-sm-5 col-md-4">
                            <input name="positiveMood_en" type="text" class="form-control" value='<?= $modifMoodPair->get('moodPositive_en') ?>' required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-2 control-label">Humeur 2 anglais :</label>
                        <div class="col-sm-5 col-md-4">
                            <input name="negativeMood_en" type="text" class="form-control" value='<?= $modifMoodPair->get('moodNegative_en') ?>'  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-5">
                            <button class="btn btn-default btn-primary" type="submit">
                                <span class="glyphicon glyphicon-edit"></span>
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                    <input type="hidden" value="<?= $modifMoodPair->getObjectId() ?>" name="id">
                </form>
            </div>
        </div>
    </body>
</html>