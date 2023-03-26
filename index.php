<?php
// Chargement de l'autoload de Composer
require 'vendor/autoload.php';

// On indique à PHP que l'on veut utiliser le concept des "sessions" ($_SESSION)
session_start();

require_once 'config.php';

// Préparation de la session (création des données utiles)
if (!isset($_SESSION['id'])) {
    // Création des données basiques de session pour la première fois
    $_SESSION['id'] = uniqid();

    // Tableau permettant des messages pour l'utilisateur (solution persistante)
    $_SESSION['flashes'] = [];
    $_SESSION['fight_characters'] = [];
    $_SESSION['fight_messages'] = [];
}

// Composant "Router" avec vérifications des erreurs
$sPage = $_GET['page'] ?? PAGE_HOME;
if (!array_key_exists($sPage, ROUTING)) {
    $sPage = PAGE_HOME;
}
[$sClass, $sFunction] = explode('::', ROUTING[$sPage]);
echo (new $sClass())->$sFunction();
