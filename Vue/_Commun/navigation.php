<!-- Barre de navigation en haut de la page -->
<div class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Partie de la barre toujours affichée -->
    <div class="navbar-header">
        <!-- Bouton affiché à droite si la zone d'affichage est trop petite -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Activer la navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- Lien de retour à la page d'accueil -->
        <a class="navbar-brand" href="Accueil/index">Time Catch</a>
    </div>
    <!-- Partie de la barre masquée en fonction de la zone d'affichage -->
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-left">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-book"></span> Tests <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="Tests/index">Consulter les tests</a></li>
                        <li><a href="Tests/ajoutTest">Ajouter un tests</a></li>
                    </ul>
                </li>
            </ul>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span> Mon compte <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="visiteur/">Informations personnelles</a></li>
                    <li class="divider"></li>
                    <li><a href="connexion/deconnecter">Se déconnecter</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>