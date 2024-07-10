<?php
use App\Covoiturage\Lib\ConnexionUtilisateur;
?>

<form method="<?php echo App\Covoiturage\Configuration\ConfigurationSite::getMethodeForm();?>">

    <fieldset>

        <legend><h1>Inscription :</h1></legend>

        <!-- ENTÊTE -->

        <input type="hidden" name="controleur" value="utilisateur">
        <input type="hidden" name="action" value="creerDepuisFormulaire">

        <!-- LOGIN -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="login_id">Login&#42;</label>
            <input class="InputAddOn-field" type="text" placeholder="Doruo" name="login" id="login_id" required>
        </p>

        <!-- NOM -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="nom_id">Nom&#42;</label>
            <input class="InputAddOn-field" type="text" placeholder="Haye" name="nom" id="nom_id" required>
        </p>

        <!-- PRENOM -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="prenom_id">Prenom&#42;</label>
            <input class="InputAddOn-field" type="text" placeholder="Marc" name="prenom" id="prenom_id" required>
        </p>

        <!-- MAIL -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="email_id">Email&#42;</label>
            <input class="InputAddOn-field" type="email" value="" placeholder="toto@yopmail.com (pas encore de serveur mail pour la verification)" name="email" id="email_id" required>
        </p>

        <!-- MOT DE PASSE -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="(mdp aléatoire, connexion HTTP non sécurisée !)" name="mdp" id="mdp_id" required>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp2_id">Vérification du mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp2" id="mdp2_id" required>
        </p>

        <!-- ADMIN -->

        <?php
        if (ConnexionUtilisateur::estConnecte() && ConnexionUtilisateur::estAdministrateur())
            echo '        
                <p class="InputAddOn">
                    <label class="InputAddOn-item" for="estAdmin_id">Administrateur</label>
                    <input class="InputAddOn-field" type="checkbox" placeholder="" name="estAdmin" id="estAdmin_id">
                </p>';
        ?>

        <!-- ENOVOYER -->

        <p>
            <input class="InputAddOn-field" type="submit" value="Envoyer" />
        </p>
    </fieldset>

</form>

