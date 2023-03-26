<?php
namespace App\Controller;

use App\Manager\GameManager;
use App\Repository\CharacterRepository;

class CharacterController extends AbstractController
{
    /**
     * @return string
     */
    public function list(): string
    {
        // Est-ce que le formulaire de création a été soumis ?
        if (isset($_POST['field_type'], $_POST['field_name'], $_POST['field_description'])) {
            // Récupérer (+ nettoyer) les données du formulaire
            $sCleanType = filter_input(INPUT_POST, 'field_type', FILTER_SANITIZE_STRING);
            $sCleanName = filter_var($_POST['field_name'], FILTER_SANITIZE_STRING);
            $sCleanDescription = filter_var($_POST['field_description'], FILTER_SANITIZE_STRING);

            $oCharacter = new $sCleanType($sCleanName, $sCleanDescription);

            // On regarde si un fichier a été uploadé
            if (isset($_FILES['field_picture'])) {
                // Contrôle de l'upload
                if ($_FILES['field_picture']['error'] === UPLOAD_ERR_OK) {
                    $sFilepathTmp = $_FILES['field_picture']['tmp_name']; // D:\Temp\php89F1.tmp

                    $sFilenameNew = uniqid() . '.' . pathinfo($_FILES['field_picture']['name'], PATHINFO_EXTENSION);
                    $sFilepathNew = DIR_UPLOADS . DIRECTORY_SEPARATOR . $sFilenameNew;
                    // uniqid() : permet "d'anonymiser" le nom du fichier
                    // pathinfo() : permet de récupérer des informations sur le fichier (ici l'extension du nom donné par l'utilisateur)

                    // Contrôle de l'image
                    $aPictureInfo = getimagesize($sFilepathTmp); // Array ([0] => 1920, [1] => 1280, ..)
                    if ($aPictureInfo) {
                        // Le fichier est bien une image : on accepte/déplace le fichier
                        if (move_uploaded_file($sFilepathTmp, $sFilepathNew)) {
                            // On associe l'image (nom du fichier) à l'article
                            $oCharacter->setPicture($sFilenameNew);
                        }
                    }
                }
            }

            // On sauvegarde l'objet
            CharacterRepository::save($oCharacter);

            // redirection vers la page d'accueil
            $this->redirectAndDie('index.php?page='. PAGE_HOME);
        }

        return $this->render('characters.php', [
            'seo_title' => 'Tous les personnages',
        ]);
    }

    /**
     * @return string
     */
    public function fight(): string
    {
        (new GameManager())->prepareFight();

        return $this->render('fight.php', [
            'seo_title' => 'Combat !',
            'characters' => $_SESSION['fight_characters'] ?? [],
        ]);
    }

    /**
     * Fonction appelée lors de la sélection d'un personnage
     * @return string
     */
    public function selectAction(): string
    {
        // TODO
        // Si le joueur est déjà sélectionné, le de-sélectionner
        // Sinon le sélectionner (si on a moins de 2 joueurs sélectionnés)

        return '';
    }

    /**
     * Fonction appelée lors du clic sur "Fight!"
     * @return string
     */
    public function fightAction(): string
    {
        // Debug : On force un délai d'attente pour laisser le loader s'afficher
        sleep(3);

        // TODO
        // Si 2 joueurs sont sélectionnés
        // -- Si l'un est mort, recommencer le combat (prepareFight)
        // -- Sinon effectuer le combat (fight)

        return '';
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function search(): string
    {
        // Debug : On force un délai d'attente pour laisser le loader s'afficher
        sleep(1);

        // Récupération (+ nettoyage des données POST)
        $aCriterias = [
            'magic-search' => strip_tags($_POST['magic-search']),
            'type' => strip_tags($_POST['type']),
        ];

        // Stockage en session des critères pour la pagination
        $_SESSION['characters_criterias'] = $aCriterias;

        // 1. Calculer l'offset
        $iPage = ($_POST['page'] ?? 1);
        $iNbEltsPerPage = CharacterRepository::NB_ELTS_PER_PAGE;
        $iOffset = ($iPage - 1) * $iNbEltsPerPage;

        $aParams =  [
            'characters' => CharacterRepository::findBy($aCriterias, $iOffset, $iNbEltsPerPage),
            'page' => $iPage,
            'site_page' => PAGE_CHARACTER_LIST,
            'nb_results' => CharacterRepository::countBy($aCriterias),
            'nb_results_per_page' => $iNbEltsPerPage,
        ];

        // 2. Récupérer les utilisateurs et renvoyer la vue HTML
        return $this->render('_characters.php', $aParams, true);
    }
}
