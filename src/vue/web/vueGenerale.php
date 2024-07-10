<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../../ressources/css/stylesTD.css">
    <link rel="icon" type="image/x-icon" href="/ressources/images/favicon.ico">
    <title>
        <?php
        use App\Covoiturage\Lib\ConnexionUtilisateur;
        /** @var $pagetitle */echo $pagetitle; ?>
    </title>
</head>

<body>

<header>
    <?php if (App\Covoiturage\Configuration\ConfigurationSite::getDebug()) echo "<div><h2>MODE DEBUG ACTIF (SITE EN CONSTRUCTION)</h2></div>";?>
    <nav>
        <ul>

            <!-- HOME -->

            <li>
                <a href="controleurFrontal.php?action=afficherListe">
                    <img src="../../../ressources/images/home.png" alt="home" />
                </a>
            </li>

            <!-- VOITURES -->

            <li>
                <a href="controleurFrontal.php?action=afficherListe&controleur=voiture">
                    Voitures
                </a>
            </li>

            <!-- UTILISATEURS -->

            <li>
                <a href="controleurFrontal.php?action=afficherListe&controleur=utilisateur">
                    Utilisateurs
                </a>
            </li>

            <!-- TRAJETS -->

            <li>
                <a href="controleurFrontal.php?action=afficherListe&controleur=trajet">
                    Trajets
                </a>
            </li>

            <!-- INSCRIPTION -->

            <?php
            if (!ConnexionUtilisateur::estConnecte() || ConnexionUtilisateur::estAdministrateur())
                echo '
                    <li>
                        <a href="controleurFrontal.php?action=afficherFormulaireCreation&controleur=utilisateur" id="add-user">
                            <img src="../../../ressources/images/add-user.png" alt="Inscription" />
                        </a>
                    </li>';
            ?>

            <!-- CONNEXION -->

            <?php
            if (!ConnexionUtilisateur::estConnecte())
                echo '            
                <li>
                    <a href="controleurFrontal.php?action=afficherFormulaireConnexion&controleur=utilisateur" id="enter">
                        <img src="../../../ressources/images/enter.png" alt="Connexion" />
                    </a>
                </li>';
            ?>

            <!-- DECONNEXION -->

            <?php
            if (ConnexionUtilisateur::estConnecte())
                echo '            
                <li>
                    <a href="controleurFrontal.php?action=deconnecter&controleur=utilisateur" id="logout">
                        <img src="../../../ressources/images/logout.png" alt="logout" />
                    </a>
                </li>';
            ?>

            <!-- PREFERENCE -->

            <li>
                <a href="controleurFrontal.php?action=afficherFormulairePreference" id="heart-link">
                    <img src="../../../ressources/images/heart.png" alt="Préférences" />
                </a>
            </li>

            <!-- QUITTER -->

            <li>
                <a href="/" id="quit">
                    <img src="../../../ressources/images/quit.png" alt="Préférences" />
                </a>
            </li>
        </ul>

    </nav>

    <!-- MESSAGES FLASH -->

    <?php
    if (ConnexionUtilisateur::estConnecte()) {
        echo "<div class=\"encadre\"> 
        <h2>".ConnexionUtilisateur::getLoginUtilisateurConnecte()."</h2>";
        if (ConnexionUtilisateur::estAdministrateur()) echo "<h2>Admin</h2>";
        echo "</div> ";
    } else echo "<h2>Non Connecté</h2>"
    ?>

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
    <?php /** @var $cheminVueBody */ require __DIR__ . $cheminVueBody ?>
</main>

<footer>
    <p>Site de covoiturage de Marc Haye</p>
</footer>

</body>
</html>