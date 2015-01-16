<?php $this->titre = "Consultation des réponses"; ?>
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
            <h2 class="text-center">Liste de vos réponses</h2><br/>
            <a class="btn btn-info" title="Exporter" href="Tests/exportCSV" type="button">Exporter</a><br/>
            <div class="table-responsive">
                <table class="table">
                    <thead>

                        <tr>
                            <th>ID Utilisateur</th>
                            <th>Age</th>
                            <th>Sexe</th>
                            <th>Date complétion du test</th>

                            <?php
                            /*
                             * Pour les champs Mood Pairs, Valeur des Mood Pairs, 
                             * Temps présentés et Temps estimés, on génère autant 
                             * de header qu'il y a d'élément dans le tableau envoyé
                             */
                            for ($i = 1; $i <= sizeof(($moodPairsHeader)); $i++) {
                                ?>
                                <th>MoodPairs<?= $i ?> </th>
                            <?php } ?>
                            <?php
                            for ($i = 1; $i <= sizeof(($moodPairsHeader)); $i++) {
                                ?>
                                <th>Valeur moodPairs <?= $i ?> </th>
                            <?php } ?>
                            <?php
                            for ($i = 1; $i <= sizeof(($displayDurationHeader)); $i++) {
                                ?>
                                <th>Temps affiché <?= $i ?> </th>
                            <?php } ?>
                            <?php
                            for ($i = 1; $i <= sizeof(($displayDurationHeader)); $i++) {
                                ?>
                                <th>Temps estimé <?= $i ?> </th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($answers as $answer):
                            ?>
                            <tr>
                                <?php
                                foreach ($users[$answer->getObjectId()] as $user):
                                    ?>
                                    <td class="vert-align"><?= $this->nettoyer($user->get("email")) ?></td>
                                    <td class="vert-align"><?= $this->nettoyer($user->get("ddn")->format('Y-m-d H:i:s')) ?></td>
                                    <td class="vert-align"><?= $this->nettoyer($user->get("sexe")) ?></td>
                                <?php endforeach; ?>
                                <td class="vert-align"><?= $this->nettoyer($answer->getCreatedAt()->format('Y-m-d H:i:s')) ?></td>
                                <?php
                                foreach ($moodPairsName as $key => $moodPairName):
                                    ?>
                                    <td class="vert-align"><?= $moodPairName ?></td>
                                <?php endforeach; ?>
                                <?php
                                foreach ($moodPairsValue[$answer->getObjectId()] as $key => $moodPairValue):
                                    ?>
                                    <td class="vert-align"><?= $moodPairValue ?></td>
                                <?php endforeach; ?>
                                <?php
                                foreach ($displayed[$answer->getObjectId()] as $key => $display):
                                    ?>
                                    <td class="vert-align"><?= $this->nettoyer($display) ?></td>
                                <?php endforeach; ?>
                                <?php
                                foreach ($estimations[$answer->getObjectId()] as $key => $estimation):
                                    ?>
                                    <td class="vert-align"><?= $this->nettoyer($estimation) ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
