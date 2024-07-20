<?php
use App\EldenBuild\Lib\ConnexionUtilisateur;
?>


<form method="<?php echo App\EldenBuild\Configuration\ConfigurationSite::getMethodeForm();?>">

    <fieldset>

        <legend><h1><U>Sign up</U></h1></legend>

        <!-- ENTÊTE -->
        <input type="hidden" name="controleur" value="utilisateur">
        <input type="hidden" name="action" value="create">

        <!-- LOGIN -->
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="login_id">Login&#42;</label>
            <input class="InputAddOn-field" type="text" placeholder="" name="login" id="login_id" required>
        </p>

        <!-- MAIL -->
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="email_id">Email&#42;</label>
            <input class="InputAddOn-field" type="email" value="" placeholder="toto@yopmail.com" name="email" id="email_id" required>
        </p>

        <!-- MOT DE PASSE -->
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Password&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="RANDOM PLS !" name="mdp" id="mdp_id" required>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp2_id">Password Validation&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp2" id="mdp2_id" required>
        </p>

        <!-- ADMIN -->
        <?php
        if (ConnexionUtilisateur::estConnecte() && ConnexionUtilisateur::estAdministrateur())
            echo '        
                <p class="InputAddOn">
                    <label class="InputAddOn-item" for="estAdmin_id">Admin</label>
                    <input class="InputAddOn-field" type="checkbox" placeholder="" name="estAdmin" id="estAdmin_id">
                </p>';
        ?>

        <p class="InputAddOn">
            <a class="alert-link" href="/showFormConnect">Already have an account ?</a>
        </p>

        <!-- ENOVOYER -->
        <p class="InputAddOn">
            <input class="InputAddOn-field" type="submit" value="Create Account" />
        </p>
    </fieldset>

</form>