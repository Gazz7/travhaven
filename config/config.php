<?php

// Osnovna podesavanja
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]. '/Blog-');

// Ostala podesavanja
define("ENV_FAJL", ABSOLUTE_PATH . "/config/.env");
define("LOG_FAJL", ABSOLUTE_PATH . "/assets/data/log.txt");
define('ERROR_LOG', ABSOLUTE_PATH . '/assets/data/error_log.txt');
define('LOGIN_LOG', ABSOLUTE_PATH . '/assets/data/login_log.txt');
define('SEPARATOR', "\t");
// Podesavanja za bazu
define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($naziv)
{
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach ($podaci as $key => $value) {
        $konfig = explode("=", $value);
        if ($konfig[0] == $naziv) {
            $vrednost = trim($konfig[1]); // trim() zbog \n
        }
    }
    return $vrednost;
}
