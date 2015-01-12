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
            /* if (isset($message))
              echo $this->nettoyer($message); */
            ?>
            <h2 class="text-center">Liste de vos mood-pairs</h2>
            <div class="table-responsive">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Humeur 1 français</th>
                            <th>Humeur 2 français</th>
                            <th>Humeur 1 anglais</th>
                            <th>Humeur 2 anglais</th>
                            <th></th> <!-- Colonne des boutons d'action -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($moodPairs as $moodPair):
                            ?>
                            <tr>
                                <td class="vert-align"><?= $this->nettoyer($moodPair->get("moodPositive_fr")) ?></td>
                                <td class="vert-align"><?= $this->nettoyer($moodPair->get("moodNegative_fr")) ?></td>
                                <td class="vert-align"><?= $this->nettoyer($moodPair->get("moodPositive_en")) ?></td>
                                <td class="vert-align"><?= $this->nettoyer($moodPair->get("moodNegative_en")) ?></td>
                                <td>
                                    <a href="MoodPairs/modifierMoodPair/<?= $moodPair->getObjectId() ?>" class="btn btn-info" title="Modifier">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <button class="btn btn-danger" data-target="#dlgConfirmation<?= $moodPair->getObjectId() ?>" data-toggle="modal" title="Supprimer" type="button">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <!--
                                    Dialogue modal de confirmation de suppression
                                    -->
                                    <!--
                                    Doit être numéroté pour être associé à chaque CR
                                    -->
                                    <div id="dlgConfirmation<?= $moodPair->getObjectId() ?>" class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
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
                                                    Voulez-vous vraiment supprimer cette mood-pair ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-default" data-dismiss="modal" type="button">
                                                        Annuler
                                                    </button>
                                                    <a class="btn btn-danger" href="MoodPairs/supprimer/<?= $moodPair->getObjectId() ?>">
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