<?php

namespace App\Covoiturage\Lib;

use App\Covoiturage\Modele\HTTP\Session;

class MessageFlash {
    private static string $cleFlash = 'messagesFlash';

    public static function ajouter(string $type, string $message): void {
        $session = Session::getInstance();

        if (!self::contientMessage($type)){
            $messagesFlash = $session->lire(self::$cleFlash) ?? [];
            $messagesFlash[$type][] = $message;
            $session->enregistrer(self::$cleFlash, $messagesFlash);
        }
    }

    public static function contientMessage(string $type): bool{
        return Session::getInstance()->contient($type);
    }

    // Attention : la lecture doit détruire le message
    public static function lireMessages(string $type): array {
        $session = Session::getInstance();

        if (!$session->contient(self::$cleFlash)) return [];

        $messagesFlash = $session->lire(self::$cleFlash);
        if (!isset($messagesFlash[$type])) return [];

        $messages = $messagesFlash[$type];
        unset($messagesFlash[$type]);

        if (empty($messagesFlash)) $session->supprimer(self::$cleFlash);
        else $session->enregistrer(self::$cleFlash, $messagesFlash);

        return $messages;
    }

    public static function lireTousMessages(): array {

        $session = Session::getInstance();
        if (!$session->contient(self::$cleFlash)) return [];

        $messagesFlash = $session->lire(self::$cleFlash);
        if (!$messagesFlash) return [];

        $tousMessages = [];
        foreach (array_keys($messagesFlash) as $type) {
            $tousMessages[$type] = self::lireMessages($type);
        }
        return $tousMessages;
    }
}
