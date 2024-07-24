<?php
// Vérifie le paramètre 'page' dans l'URL, sinon utilise 'home' par défaut
$page = isset($_GET['page']) ? $_GET['page'] : 'index.php';

// Logique pour déterminer le contenu à renvoyer
switch ($page) {
    case 'home':
        include './home.php';
        break;
    case 'skills':
        include './skills.php';
        break;
    case 'projects':
        include './projects.php';
        break;
    case 'contact':
        include './contact.php';
        break;
    default:
        include './index.php';
        break;
}
