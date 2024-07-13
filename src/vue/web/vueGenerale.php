<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    use App\EldenBuild\Lib\ConnexionUtilisateur;
    ?>

    <title>
        <?php
        /** @var $pagetitle */
        if (is_null($pagetitle)) echo "Elden Build";
        else echo "Elden Build - ".$pagetitle; ?>
    </title>

    <!-- Boostrap, favicon & stylesheet CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="/ressources/css/styles.css" rel="stylesheet">

    <!-- scripts JS -->
    <script defer="defer" src="/ressources/js/base.js"></script>
    <script defer="defer" src="/ressources/js/requetesAPI.js"></script>
</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <!-- TITRE -->
        <a id="titre-princiale-menu" class="navbar-brand" href="#">Elden Build</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">

                <!-- RECHERCHE -->
                <li>
                    <div>
                        <label for="search-input"></label>
                        <input type="text" id="search-input" placeholder="Build or User"/>
                    </div>
                </li>

                <!-- HOME -->
                <li class="nav-item">
                    <a class="nav-link" href="home">Home</a>
                </li>

                <!-- INSCRIPTION -->
                <?php if (!ConnexionUtilisateur::estConnecte() || ConnexionUtilisateur::estAdministrateur())
                    echo '<li class="nav-item"><a class="nav-link" href="/afficherFormulaireCreation">Sign Up</a></li>';
                ?>

                <!-- CONNEXION -->
                <?php if (!ConnexionUtilisateur::estConnecte())
                    echo '<li class="nav-item"><a class="nav-link" href="/afficherFormulaireConnexion">Login</a></li>';
                ?>

            </ul>
        </div>
    </nav>

    <!-- MESSAGES FLASH -->

    <div>
        <?php
        /** @var string[][] $messagesFlash */
        foreach($messagesFlash as $type => $messagesFlashPourUnType)
        {
            // $type est l'une des valeurs suivantes : "success", "info", "warning", "danger"
            // $messagesFlashPourUnType est la liste des messages flash d'un type

            foreach ($messagesFlashPourUnType as $messageFlash) {
                echo <<< HTML
            <div class="alert alert-$type">
             $messageFlash
            </div>
            HTML;
            }
        }
        ?>
    </div>

</header>

<main>


    <div id="conteneurActions" class="container mt-5">

        <h1 id="titre-princiale" >Elden Build</h1>
        <h3 id="sous-titre">Create & Share Builds for Elden rinG.</h3>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">

                        <h2 class="card-title">Create a New Build</h2>
                        <p class="card-text">Start Your Very Own Build.</p>
                        <a href="#" class="btn btn-primary">Creer</a>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Consulter les Builds</h2>
                        <p class="card-text">Explore Builds Shared by Other Users.</p>
                        <a href="#" class="btn btn-primary">Consulte</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Search Builds</h2>
                        <p class="card-text">Search & Sort Builds.</p>
                        <a href="#" class="btn btn-primary">Search</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<footer class="bg-dark">
    &copy;2024 ~WORK IN PROGRESS~ Marc Haye.
    <a>Contact</a>
</footer>

</body>
</html>