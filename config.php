<?php
// On indique à PHP quelle timezone on utilise
date_default_timezone_set('Europe/Paris');

define('ENV', ($_SERVER['HTTP_HOST'] === 'localhost') ? 'development' : 'production');

// On masque les erreurs (en production)
if (ENV !== 'development') {
    ini_set('display_errors', false);
}

const DIR_UPLOADS = 'public/uploads';

const DB_HOST = 'localhost';
const DB_NAME = 'greta_eval_php_poo';
const DB_USER = 'root';
const DB_PWD = '';

const PAGE_CHARACTER_LIST = 'tous-les-personnages';
const PAGE_CHARACTER_SEARCH = 'character_search';
const PAGE_CHARACTER_FIGHT = 'combat';
const PAGE_CHARACTER_FIGHT_ACTION = 'combat_action';
const PAGE_CHARACTER_SELECT_ACTION = 'combat_select';
const PAGE_HOME = PAGE_CHARACTER_LIST;

// Création d'un dictionnaire/tableau associant une fonction de classe à une page
const ROUTING = [
    PAGE_CHARACTER_LIST => '\App\Controller\CharacterController::list',
    PAGE_CHARACTER_SEARCH => '\App\Controller\CharacterController::search',
    PAGE_CHARACTER_FIGHT => '\App\Controller\CharacterController::fight',
    PAGE_CHARACTER_FIGHT_ACTION => '\App\Controller\CharacterController::fightAction',
    PAGE_CHARACTER_SELECT_ACTION => '\App\Controller\CharacterController::selectAction',
];
