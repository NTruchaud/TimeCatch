<?php $this->titre = "Consultation des tests"; ?>
<?php
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
            <?php
            /*if (isset($message))
                echo $this->nettoyer($message);*/
            ?>
            <h2 class="text-center">Liste de vos tests d'étude</h2>
            <div class="table-responsive">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Intervalle court</th>
                            <th>Intervalle long</th>
                            <th>Nombre de répétition de la procédure</th>
                            <th>MoodPairs</th>
                            <th></th> <!-- Colonne des boutons d'action -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $moodPairs = new MoodPairs();
                        foreach ($tests as $test): ?>
                        <tr>
                            <td class="vert-align"><?= $this->nettoyer($test->getCreatedAt()->format('Y-m-d H:i:s'))  ?></td>
                            <td class="vert-align"><?= $this->nettoyer($test->get("duree_1"))  ?></td>
                            <td class="vert-align"><?= $this->nettoyer($test->get("duree_2"))  ?></td>
                            <td class="vert-align"><?= $this->nettoyer($test->get("n_rep"))  ?></td>
                            <td class="vert-align"><?php foreach($test->get("MoodPairs") as $moodPair) {
                                echo $this->nettoyer($moodPairs->getAMoodPairName($moodPair)) . ", ";
                                } 
                                ?></td>
                            
                            <td>
                                <a href="Tests/modifierTests/<?= $test->getObjectId() ?>" class="btn btn-info" title="Modifier">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <button class="btn btn-danger" data-target="#dlgConfirmation<?= $test->getObjectId() ?>" data-toggle="modal" title="Supprimer" type="button">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                                <!--
                                Dialogue modal de confirmation de suppression
                                -->
                                <!--
                                Doit être numéroté pour être associé à chaque CR
                                -->
                                <div id="dlgConfirmation<?= $test->getObjectId() ?>" class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">
                                                    ×
                                                </button>
                                                <h4 id="myModalLabel" class="modal-title">
                                                    Demande de confirmation
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous vraiment supprimer ce test d'étude ?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-default" data-dismiss="modal" type="button">
                                                    Annuler
                                                </button>
                                                <a class="btn btn-danger" href="Tests/supprimer/<?= $test->getObjectId() ?>">
                                                    Supprimer
                                                </a>
                                            </div>
                                        </div>
                                        <!--
                                        /.modal-content
                                        -->
                                    </div>
                                    <!--
                                    /.modal-dialog
                                    -->
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>