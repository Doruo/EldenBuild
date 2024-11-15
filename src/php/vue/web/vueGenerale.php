<!DOCTYPE html>
<html lang="fr">

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
        if (isset($pagetitle)) echo "Elden Build - ".$pagetitle;
        else echo "Elden Build";?>
    </title>

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- stylesheet CSS -->
    <link href="/src/css/styles.css" rel="stylesheet">

    <!-- scripts JS -->
    <script defer="defer" src="/src/js/main.js"></script>
    <script defer="defer" src="/src/js/requests.js"></script>

</head>

<body>

<header>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">

        <!-- TITRE -->
        <a id="titre-princiale-menu" class="navbar-brand" href="/home">Elden builD</a>

        <div class="collapse navbar-collapse">

            <!-- ELEMENTS NAVBAR -->
            <ul class="navbar-nav ml-auto" id="main-menu">

                <!-- RECHERCHE -->
                <li class="nav-item navbar-text">
                    <div>
                        <label for="search-input"></label>
                        <input type="text" id="search-input" autocomplete="false" placeholder="🔍 Build or User"/>
                        <div id="autocompletion"></div>
                    </div>
                </li>

                <!-- INSCRIPTION -->
                <?php if (!ConnexionUtilisateur::estConnecte() || ConnexionUtilisateur::estAdministrateur()){
                    echo '';
                    echo '<li class="nav-item"><h2 class="navbar-text">-</h2></li>
                    <li class="nav-item">
                        <a class="nav-link" href="/showFormCreate">
                            <img class="img-icon" src="/ressources/images/icons/hosts-mirror-trick.png" alt="hosts-mirror-trick"/>  
                            Sign up
                        </a>
                    </li>';
                }
                ?>

                <!-- CONNEXION -->
                <?=(ConnexionUtilisateur::estConnecte()) ?
                    '
                            <!-- PROFILE -->
                            <li class="nav-item">
                                <a class="nav-link" href="/info&login='.ConnexionUtilisateur::getLoginUtilisateurConnecte().'">
                                    <img class="img-icon" src="/ressources/images/icons/carian-inverted-statue.webp" alt="carian-inverted-statue"/>  
                                    Profile
                                </a> 
                            </li>   
                            
                            <!-- DECONNEXION -->
                            <li class="nav-item">
                                <a class="nav-link" href="/disconnect">
                                    <img class="img-icon" src="/ressources/images/icons/memory-of-grace.webp" alt="memory-of-grace"/>  
                                    Sign out
                                </a> 
                            </li>  
                            '
                    :
                    '
                    <li class="nav-item"><h2 class="navbar-text">-</h2></li>
                    <!-- CONNEXION -->
                    <li class="nav-item">
                        <a class="nav-link" href="/showFormConnect">
                            <img class="img-icon" src="/ressources/images/icons/carian-inverted-statue.webp" alt="carian-inverted-statue"/>  
                                Sign in
                        </a> 
                    </li>'
                ?>

                <!-- MENU -->
                <li class="nav-item"><a class="nav-link menuOff" id="menu-toggle">▽</a></li>

                <li class="nav-item navbar-text hidden"><h2 class="navbar-text">-</h2></li>

                <!-- PARAMETRES -->
                <li class="nav-item hidden">
                    <a class="nav-link" onclick="optionsToolTip()">
                        <img class="img-icon" src="/ressources/images/icons/telescope.webp" alt="telescope"/>
                        Options
                    </a>
                    <div class="tooltip-content" id="param-content">
                        Coming Soon !
                    </div>
                </li>

                <!-- USERS -->
                <li class="nav-item hidden">
                    <a class="nav-link" href="/showList">
                        <img class="img-icon" src="/ressources/images/icons/furlcalling_finger_remedy.webp" alt="furlcalling_finger_remedy"/>
                        Test Users
                    </a>
                </li>

                <li class="nav-item navbar-text hidden"><h2 class="navbar-text">-</h2></li>

                <!-- INFO REQUETE API -->
                <li class="nav-item hidden">
                    <a class="nav-link" href="/info&controleur=equipement">
                        <img class="img-icon" src="/ressources/images/icons/telescope.webp" alt="telescope"/>
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

    <?=(ConnexionUtilisateur::estAdministrateur()) ? "<div><h3>ADMIN</h3></div>" : "" ?>

</header>

<main>
    <?=(ConfigurationSite::getDebug()) ?? "<div><h1>MODE DEBUG ACTIF</h1></div>";
    /** @var $cheminVueBody */ require __DIR__ . $cheminVueBody ?>
</main>


<footer class="bg-dark">
    &copy;2024 - WORK IN PROGRESS -
</footer>

</body>
</html>