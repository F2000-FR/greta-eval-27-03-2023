<?php
namespace App\Repository;

use App\Manager\DbManager;
use App\Entity\Character;

/**
 * Repository : classe visant à regrouper des fonctions de gestion (load/save)
 * "static" : mot-clé permettant de définir la fonction comme générique au référentiel
 */
final class CharacterRepository extends AbstractRepository
{
    const TABLE = 'character';
    const NB_ELTS_PER_PAGE = 4;

    /**
     * @param Character $oCharacter
     *
     * @return bool
     */
    public static function save(Character $oCharacter): bool
    {
        $oPdo = DbManager::getInstance();

        if ($oCharacter->getId()) {
            // TODO
        } else {
            // TODO
        }

        // Pdo::lastInsertId() permet de récupérer l'identifiant inséré en base de données
        // $oCharacter->setId($oPdo->lastInsertId());

        return false;
    }

    /**
     * @return array
     */
    public static function findAll(): array
    {
        $oPdo = DbManager::getInstance();

        // Execution de la requête (query)
        $oPdoStatement = $oPdo->query('SELECT * FROM `'. static::TABLE .'` ORDER BY `created_at` DESC');

        return static::extracted($oPdoStatement);
    }

    /**
     * @param array $aCriterias
     * @param int   $iOffset
     * @param int   $iNbElts
     *
     * @return Character[]
     * @throws \Exception
     */
    public static function findBy(array $aCriterias, int $iOffset = 0, int $iNbElts = self::NB_ELTS_PER_PAGE): array
    {
        $oPdo = DbManager::getInstance();

        $aCriteriasInfo = static::buildCriterias($aCriterias);

        // -- Security
        if ($iOffset <= 0) {
            $iOffset = 0;
        }

        $sQuery = 'SELECT * FROM `'. static::TABLE .'`' . $aCriteriasInfo['where'];
        $sQuery .= ' ORDER BY `created_at` DESC ';
        $sQuery .= ' LIMIT ' . implode(', ', [$iOffset, $iNbElts]);

        // Execution de la requête (query)
        $oPdoStatement = $oPdo->prepare($sQuery);
        $oPdoStatement->execute($aCriteriasInfo['params']);

        // Parcours des résultats (while + fetch)
        return static::extracted($oPdoStatement);
    }

    /**
     * @param int $iId
     *
     * @return Character|null
     * @throws \Exception
     */
    public static function find(int $iId): ?Character
    {
        $oPdo = DbManager::getInstance();

        // Préparation de la requête
        $sQuery = 'SELECT * FROM `'. static::TABLE .'` WHERE `id` = :id';

        // Utilisation des "requêtes préparées" pour se prémunir des injections SQL
        $oPdoStatement = $oPdo->prepare($sQuery);
        $oPdoStatement->bindValue(':id', $iId, \PDO::PARAM_INT);
        $oPdoStatement->execute();

        // Récupérer le bon objet (tableau)
        $aDbInfo = $oPdoStatement->fetch();

        // On retourne soit l'objet hydraté, soit NULL
        return $aDbInfo ? static::hydrate($aDbInfo) : NULL;
    }

    /**
     * @param array $aDbInfo
     *
     * @return Character
     */
    protected static function hydrate(array $aDbInfo): Character
    {
        // TODO
        return new Character();
    }

    /**
     * @param array $aCriterias
     * @return array
     */
    protected static function buildCriterias(array $aCriterias): array
    {
        $aWhere = $aParams = [];

        // TODO

        $sWhere = '';
        if (count($aWhere) > 0) {
            // Si au moins un critère de recherche, on applique le WHERE et chaque condition (c1 AND c2 AND c3)
            $sWhere .= ' WHERE ' . implode(' AND ', $aWhere);
        }

        return [
            'where' => $sWhere,
            'params' => $aParams,
        ];
    }
}
