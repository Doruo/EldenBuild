<form method="get">

    <fieldset>

        <legend>
            <h1>Choisissez une préference :</h1>
        </legend>

        <input type="hidden" name="action" value="enregistrerPreference">

        <input type="radio" id="voitureId" name="controleur_defaut" value="voiture"
            <?php /** @var string $controleurPreference */ if ($controleurPreference == "voiture") echo "checked" ?>>

        <label for="voitureId">Voiture</label>

        <input type="radio" id="utilisateurId" name="controleur_defaut" value="utilisateur"
            <?php /** @var string $controleurPreference */ if ($controleurPreference == "utilisateur") echo "checked" ?>>

        <label for="utilisateurId">Utilisateur</label>

        <input type="radio" id="trajetId" name="controleur_defaut" value="trajet"
            <?php /** @var string $controleurPreference */ if ($controleurPreference == "trajet") echo "checked" ?>>

        <label for="trajetId">Trajet</label>

        <p>
            <input class="InputAddOn-field" type="submit" value="Envoyer" />
        </p>
    </fieldset>

</form>

