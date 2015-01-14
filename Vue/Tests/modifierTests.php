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
                Modification d'un test d'étude
            </h2>
            <div class="well">
                <form class="form-horizontal" role="form" action="Tests/modifier" method="post">
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-2 control-label">Durée 1</label>
                        <div class="col-sm-5 col-md-4">
                            <input name="duree_1" type="number" value='<?= $modifTest->get('duree_1') ?>' class="form-control" value="2013-11-28">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-2 control-label">Durée 2</label>
                        <div class="col-sm-5 col-md-4">
                            <input name="duree_2" type="number" class="form-control" value='<?= $modifTest->get('duree_2') ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-2 control-label">N_rep</label>
                        <div class="col-sm-5 col-md-4">
                            <input name="n_rep" type="number" class="form-control" value='<?= $modifTest->get('n_rep') ?>' required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-2 control-label">Date de début</label>
                        <div class="col-sm-5 col-md-4">
                            <input name="date_debut" type="date" class="form-control" value='<?= $modifTest->get('date_debut')->format('Y-m-d') ?>' placeholder="YYYY-MM-DD" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-2 control-label">Date de fin</label>
                        <div class="col-sm-5 col-md-4">
                            <input name="date_fin" type="date" class="form-control" value='<?= $modifTest->get('date_fin')->format('Y-m-d') ?>' placeholder="YYYY-MM-DD" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-offset-2 control-label">Nombre de notifications par jour</label>
                        <div class="col-sm-5 col-md-4">
                            <input name="nbNotif" type="date" class="form-control" value='<?= $modifTest->get('nbNotif') ?>' required>
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
                    <input type="hidden" value="<?= $modifTest->getObjectId() ?>" name="id">
                </form>
            </div>
        </div>
    </body>
</html>