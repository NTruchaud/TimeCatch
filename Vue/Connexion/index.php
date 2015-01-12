<?php $this->titre = "Time Catch - Connexion" ?>
<div class="container">
    <?php if (isset($msgErreur)) : ?>
        <div class="container">
            <div class="alert alert-danger alert-dismissable">
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">
                    x
                </button><strong>
                    Erreur !
                </strong>
                <?= $this->nettoyer($msgErreur) ?>
            </div>
        </div>
    <?php endif; ?>
    <h2 class="text-center">Connexion à Time Catch</h2>
    <div class="well">
        <form class="form-signin form-horizontal" role="form" action="connexion/connecter" method="post">
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <input name="login" type="text" class="form-control" placeholder="Entrez votre login" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <input name="mdp" type="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Connexion</button>
                </div>
            </div>
        </form>
    </div>
</div>