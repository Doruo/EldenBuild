
<div class="formulaire form-group">
<form method="<?php echo App\EldenBuild\Configuration\ConfigurationSite::getMethodeForm();?>">

    <fieldset>

        <legend><h1>Log In :</h1></legend>

        <input type="hidden" name="controleur" value="utilisateur">
        <input type="hidden" name="action" value="connecter">

        <!-- LOGIN -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="login_id">Login&#42;</label>
            <input class="InputAddOn-field" type="text" placeholder="Doruo" name="login" id="login_id" required>
        </p>

        <!-- MOT DE PASSE -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Password&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="Random !" name="mdp" id="mdp_id" required>
        </p>

        <!-- ENOVOYER -->

        <p>
            <input class="InputAddOn-field" type="submit" value="Envoyer" />
        </p>
    </fieldset>

</form>
</div>