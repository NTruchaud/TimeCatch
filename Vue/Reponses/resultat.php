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
        <?php if (isset($message)) { ?>
            <div class = "container">
                <div class = "alert alert-danger">
                    <?= $this->nettoyer($message); ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="container">
                <h2 class="text-center">Liste de vos réponses</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>

                            <tr>
                                <th>ID Utilisateur</th>
                                <th>Age</th>
                                <th>Sexe</th>
                                <th>Date complétion du test</th>

                                <?php
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
                                    <td class="vert-align"><?= $this->nettoyer($mail) ?></td>
                                    <td class="vert-align"><?= $this->nettoyer($age) ?></td>
                                    <td class="vert-align"><?= $this->nettoyer($sexe) ?></td>
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
            <?php } ?>
        </div>
    </body>
</html>