<?php
// config.php
define('SITE_NAME', 'My Portfolio');
define('ENV', 'mamp');

function connexion()
{
    switch (ENV) {
        case 'mamp':
            $host = 'localhost';
            $username = 'root';
            $password = 'root';
            $db = 'portfolio';
            break;
    };

    $link = mysqli_connect($host, $username, $password, $db);
    mysqli_set_charset($link, "utf8");

    if (!$link) {
        die("ERREUR : échec de connexion : " . mysqli_connect_error());
    }

    return $link;
}
