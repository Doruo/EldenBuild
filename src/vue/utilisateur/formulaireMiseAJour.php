<?php
use App\EldenBuild\Lib\ConnexionUtilisateur;
?>

<form method="<?php echo App\EldenBuild\Configuration\ConfigurationSite::getMethodeForm();?>">

    <fieldset>

        <legend><h1>Modifier un Utilisateur :</h1></legend>

        <!-- ENTÊTE -->

        <input type="hidden" name="action" value="mettreAJour">
        <input type="hidden" name="controleur" value="utilisateur">

        <!-- LOGIN -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="login_id">Login&#42;</label>

            <input class="InputAddOn-field" type="text" readonly name="login"  id="login_id" required
                   value="<?=/** @var $login */$login ?>">
        </p>

        <!-- MAIL -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="email_id">Email</label>
            <input class="InputAddOn-field" type="email" name="email" id="email_id"
                   value="<?=/** @var string $mail */ $mail ?>">
        </p>

        <!-- ANCIEN MOT DE PASSE -->

        <?php if(!ConnexionUtilisateur::estAdministrateur())
            echo '
            <p class="InputAddOn">
                <label class="InputAddOn-item" for="ancienMdp_id">Ancien Mot de Passe&#42;</label>
                <input class="InputAddOn-field" type="password" name="ancienMdp" id="ancienMdp_id" required value="">
            </p>';
        ?>

        <!-- NOUVEAU MOT DE PASSE -->

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Nouveau Mot de Passe&#42;</label>

            <input class="InputAddOn-field" type="password" name="mdp" id="mdp_id" required value="">
        </p>

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp2_id">Resaisissez Mot de Passe&#42;</label>

            <input class="InputAddOn-field" type="password" name="mdp2" id="mdp2_id" required value="">
        </p>

        <!-- ADMIN -->

        <?php if(ConnexionUtilisateur::estAdministrateur())
            echo '
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="estAdmin_id">Administrateur</label>
            <input class="InputAddOn-field" type="checkbox" placeholder="" name="estAdmin" id="estAdmin_id" ';
            // Suspect
            if(ConnexionUtilisateur::estAdministrateur() && ConnexionUtilisateur::estUtilisateur($login)) echo "checked";
        echo '></p>';
        ?>

        <!-- ENOVOYER -->

        <p><input class="InputAddOn-field" type="submit" value="Envoyer" /></p>

    </fieldset>

</form>

