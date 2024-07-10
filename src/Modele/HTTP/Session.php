<?php
namespace App\Covoiturage\Modele\HTTP;

use App\Covoiturage\Configuration\ConfigurationSite;
use Exception;

class Session
{
    private static ?self $instance = null;

    /** @throws Exception */
    private function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            if (session_start() === false) {
                throw new Exception("La session n'a pas réussi à démarrer.");
            }
        }
    }

    public static function getInstance(): self {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        self::verifierDerniereActivite();
        return self::$instance;
    }

    public function contient($nom): bool {
        return isset($_SESSION[$nom]);
    }

    public function enregistrer(string $nom, mixed $valeur): void {
        $_SESSION[$nom] = $valeur;
    }

    public function lire(string $nom): mixed {
        return $_SESSION[$nom] ?? null;
    }

    public function supprimer($nom): void {
        unset($_SESSION[$nom]);
    }

    public static function detruire(): void {
        session_unset();     // unset $_SESSION variable for the run-time
        session_destroy();   // destroy session data in storage
        Cookie::supprimer(session_name()); // deletes the session cookie
        self::$instance = null;
    }

    public static function verifierDerniereActivite(): void {
        $dureeExpiration = ConfigurationSite::getDureeExpiration();

        if (isset($_SESSION['derniereActivite']) && (time() - $_SESSION['derniereActivite'] > $dureeExpiration)) {
            self::detruire();     // unset $_SESSION variable for the run-time
        }

        $_SESSION['derniereActivite'] = time(); // update last activity time stamp
    }
}
