<?php

//Begge linjene forbedrer sikkerhetet rundt session og informasjon
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

//Instillinger for session og sikkerhet
session_set_cookie_params([
    //session varer i 8 timer
    'lifetime' => 28800,
    //Sikrer kommunikasjonen mellom serveren og localhost/nettsiden
    'domain' => '10.200.1.163',
    //Passer på alle sidene
    'path' => '/',
    //Passer på at session brukes i en sikker tilkobling med https
    'secure' => false,
    //Beskytter mot JavaScript-manipulasjon ved bruk av http-protokoll
    'httponly' => true
]);

//Starter session
session_start();

//Genererer ny session id og sletter den gamle
session_regenerate_id(true);

//Sjekker hvis tiden for session-id eksisterer i nettsiden
if (!isset($_SESSION['last_regen'])) {
    session_regenerate_id(true);
    //Tar tiden og setter det i session
    $_SESSION['last_regen'] = time();
} else {
    //Lager tidsinterval på 8 timer
    $interval = 60 * 480;
    //Sjekker hvis det har gått over tiden siden siste id, da lages ny id
    if (time() - $_SESSION['last_regen'] >= $interval) {
        session_regenerate_id(true);
        $_SESSION['last_regen'] = time();
    }
}
