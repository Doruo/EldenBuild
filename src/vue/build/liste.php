<?php
use App\EldenBuild\Modele\DataObject\Build;

/** @var array $builds */
/** @var Build $build */
foreach ($builds as $build) {
    echo $build->getNomBuild();
}


