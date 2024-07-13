<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    use App\EldenBuild\Lib\ConnexionUtilisateur;
    use App\EldenBuild\Configuration\ConfigurationSite;
    ?>

    <title>
        <?php
        /** @var $pagetitle */
        if (!isset($pagetitle)) echo "Elden Build";
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
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">

        <!-- TITRE -->
        <a id="titre-princiale-menu" class="navbar-brand" href="home">Elden Build</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">

                <!-- RECHERCHE -->
                <li class="nav-item navbar-text">
                    <div>
                        <label for="search-input"></label>
                        <input type="text" id="search-input" placeholder="🔍 Build or User"/>
                    </div>
                </li>

                <!-- INSCRIPTION -->
                <?php if (!ConnexionUtilisateur::estConnecte() || ConnexionUtilisateur::estAdministrateur()){
                    echo '<li class="nav-item"><h2 class="navbar-text">-</h2></li>';
                    echo
                    '<li class="nav-item">
                        <a class="nav-link" href="/afficherFormulaireCreation">Sign Up</a>
                    </li>';
                }
                ?>

                <!-- CONNEXION -->
                <?php if (!ConnexionUtilisateur::estConnecte()){
                    echo '<li class="nav-item"><h2 class="navbar-text">-</h2></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="/afficherFormulaireConnexion">Log In</a></li>';
                }
                ?>

                <!-- DECONNEXION -->

                <?php
                if (ConnexionUtilisateur::estConnecte()){
                    echo '<li class="nav-item"><h2 class="navbar-text">-</h2></li>';
                    echo '            
                <li class="nav-item">
                    <a class="navbar-text" href="controleurFrontal.php?controleur=utilisateur&action=deconnecter" id="logout">
                        <img class="img-icon" src="/ressources/images/buttons/logout.png" alt="logout" >
                        Log Out
                    </a>
                </li>';
                }

                ?>

                <li class="nav-item"><h2 class="navbar-text">-</h2></li>

                <!-- USERS -->
                <li class="nav-item">
                    <a class="nav-link" href="/afficherListe">
                        <img class="img-icon" src="/ressources/images/icons/furlcalling_finger_remedy.png" alt="furlcalling_finger_remedy"/>
                        Users
                    </a>
                </li>

                <li class="nav-item"><h2 class="navbar-text">-</h2></li>

                <!-- TEST API -->
                <li class="nav-item">
                    <a class="nav-link" href="/afficherListe">
                        <img class="img-icon" src="/ressources/images/icons/furlcalling_finger_remedy.png" alt="furlcalling_finger_remedy"/>
                        Test API
                    </a>
                </li>

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

    <?php if (ConfigurationSite::getDebug()) echo "<div><h1>MODE DEBUG ACTIF</h1></div>";

    /** @var $cheminVueBody */ require __DIR__ . $cheminVueBody ?>
</main>

<!--
<footer > class="bg-dark">
    &copy;2024 - WORK IN PROGRESS - Marc Haye.
</footer> -->

</body>
</html>