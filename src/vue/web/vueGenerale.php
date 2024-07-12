<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Elden Build</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="/ressources/css/styles.css" rel="stylesheet">
    <script defer="defer" src="/ressources/js/scripts.js"></script>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a id="titre-princiale-menu" class="navbar-brand" href="#">Elden Build</a>

    <button class="navbar-toggler" type="button">
        <span ></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="/src/vue/web/controleurFrontal.php?action=home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Builds</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
        </ul>
    </div>

</nav>

<div id="conteneurActions" class="container mt-5">

    <h1 id="titre-princiale" >Elden Build</h1>
    <h3 id="sous-titre">Creer et partager vos builds pour Elden Ring.</h3>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">

                    <h2 class="card-title">Creer un Build</h2>
                    <p class="card-text">Commencez à creer votre build personnalise.</p>
                    <a href="#" class="btn btn-primary">Creer</a>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Consulter les Builds</h2>
                    <p class="card-text">Explorez les builds partages par d'autres joueurs.</p>
                    <a href="#" class="btn btn-primary">Consulter</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Rechercher des Builds</h2>
                    <p class="card-text">Trouvez des builds en fonction de vos preferences.</p>
                    <a href="#" class="btn btn-primary">Rechercher</a>
                </div>
            </div>
        </div>

    </div>
</div>

<footer class="bg-dark">
    &copy; 2024 Elden Build. Tous droits reserves.
</footer>

</body>
</html>