<?php
if (empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] != "XMLHttpRequest") {
    if (realpath($_SERVER["SCRIPT_FILENAME"]) == __FILE__) { // direct access denied
        header("Location: /403");
        exit;
    }
}
session_start();
require_once("../config.php");
require_once("contact.php");

$link = connexion();
header('Content-type: application/json');
$response = array();
try {

    if (empty($_POST['email'])) {
        throw new Exception('Veuillez saisir un email');
    }
    if (empty($_POST['message'])) {
        throw new Exception('Vous n\'avez pas saisi de message');
    }

    $contact = new Contact($_POST['email'], $_POST['message']);
    $contact->Create();

    $response['response'] = 200;
    $response['message'] = 'Votre message a bien été envoyé';
    echo json_encode($response);
    exit;
} catch (Exception $e) {
    $response['response'] = 400;
    $response['message'] = $e->getMessage();
    echo json_encode($response);
    exit;
}
