<?php use \App\EldenBuild\Lib\ConnexionUtilisateur; ?>

<div id="conteneurActions" class="container mt-5">

    <h1 id="titre-princiale" >-Elden Build-</h1>
    <h3 id="sous-titre">Create & Share Builds for Elden rinG.</h3>

    <div class="row">

        <div class="col-md-4">
            <div class="conteneur">
                <div class="card-body">

                    <h2 class="card-title"><u>Create a New Build</u></h2>
                    <p class="card-text">Start your very own build.</p>
                    <a href="<?=(ConnexionUtilisateur::estConnecte()) ? "/showFormCreate&controleur=build" : "/showFormCreate"?>"" class="btn btn-primary">Create</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="conteneur">
                <div class="card-body">
                    <h2 class="card-title"><u>Consult Builds</u></h2>
                    <p class="card-text">Explore builds shared by others.</p>
                    <a href="#" class="btn btn-primary">Consult</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="conteneur">
                <div class="card-body">
                    <h2 class="card-title"><u>Sort Builds</u></h2>
                    <p class="card-text">Search & sort builds.</p>
                    <a href="#" class="btn btn-primary">Search</a>
                </div>
            </div>
        </div>
    </div>
</div>