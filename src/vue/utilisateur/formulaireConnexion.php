<form method="<?php echo App\Covoiturage\Configuration\ConfigurationSite::getMethodeForm();?>">

    <fieldset>

        <legend><h1>Connexion :</h1></legend>

        <input type="hidden" name="controleur" value="utilisateur">
        <input type="hidden" name="action" value="connecter">

        <!-- LOGIN -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="login_id">Login&#42;</label>
            <input class="InputAddOn-field" type="text" placeholder="Doruo" name="login" id="login_id" required>
        </p>

        <!-- MOT DE PASSE -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="(mdp aléatoire, connexion HTTP non sécurisée !)" name="mdp" id="mdp_id" required>
        </p>

        <!-- ENOVOYER -->

        <p>
            <input class="InputAddOn-field" type="submit" value="Envoyer" />
        </p>
    </fieldset>

</form>

