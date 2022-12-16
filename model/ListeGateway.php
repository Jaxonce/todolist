<?php

require_once 'config/config.php';

/**
 *
 */
class ListeGateway
{
    /**
     * @var Connection
     */
    protected $con;

    /**
     * @param Connection $con
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * @param Liste $liste
     * @return void
     */
    public function insertPublic(Liste $liste): void
    {
        $query = "INSERT INTO Liste (nom, possesseur) VALUES (:nom, NULL)";
        $this->con->executeQuery($query, array(
            ':nom' => array($liste->getNom(), PDO::PARAM_STR)
        ));
    }

    /**
     * @param string $nom
     * @param int $userId
     * @return void
     */
    public function insert(string $nom, int $userId): void
    {
        $query = "INSERT INTO Liste (nom, possesseur) VALUES (:nom, :possesseur)";
        $this->con->executeQuery($query, array(
            ':nom' => array($nom, PDO::PARAM_STR),
            ':possesseur' => array($userId, PDO::PARAM_INT)
        ));
    }

    /**
     * @param Liste $liste
     * @return void
     */
    public function update(Liste $liste): void
    {
        $query = "UPDATE Liste SET nom = :nom WHERE id = :id";
        $this->con->executeQuery($query, array(
            ':nom' => array($liste->getNom(), PDO::PARAM_STR),
            ':id' => array($liste->getId(), PDO::PARAM_INT)
        ));
    }

    /**
     * @param int $idUser
     * @param int $idListe
     * @return void
     */
    public function delete(int $idUser, int $idListe): void
    {
        $query = "DELETE FROM Liste WHERE id = :id AND possesseur = :possesseur";
        $this->con->executeQuery($query, array(
            ':id' => array($idListe, PDO::PARAM_INT),
            ':possesseur' => array($idUser, PDO::PARAM_INT)
        ));
    }

    /**
     * @param int $id
     * @return void
     */
    public function deletePublicList(int $id): void
    {
        $query = "DELETE FROM Liste WHERE id = :id AND possesseur IS NULL";
        $this->con->executeQuery($query, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));
    }

    /**
     * @return array
     */
    public function getAllPublic(): array
    {
        $query = "SELECT * FROM Liste WHERE possesseur IS NULL";
        $this->con->executeQuery($query);

        $result = $this->con->getResults();
        return $result;
    }

    /**
     * @param int $possesseur
     * @param $currentPage
     * @param $nbListeParPage
     * @return array
     */
    public function getPrivateList (int $possesseur, $currentPage, $nbListeParPage): array
    {
        $query = "SELECT * FROM Liste WHERE possesseur = :possesseur LIMIT :premier, :nbListeParPage";
        $this->con->executeQuery($query, array(
            ':possesseur' => array($possesseur, PDO::PARAM_INT),
            ':premier' => array(($currentPage - 1) * $nbListeParPage, PDO::PARAM_INT),
            ':nbListeParPage' => array($nbListeParPage, PDO::PARAM_INT)
        ));
        $result = $this->con->getResults();
        return $result;
    }

    /**
     * @param $currentPage
     * @param $nbListeParPage
     * @return array
     */
    public function getListPublic($currentPage, $nbListeParPage): array
    {
        $query = "SELECT * FROM Liste WHERE possesseur IS NULL LIMIT :premier, :nbListeParPage";
        $this->con->executeQuery($query, array(
            ':premier' => array(($currentPage - 1) * $nbListeParPage, PDO::PARAM_INT),
            ':nbListeParPage' => array($nbListeParPage, PDO::PARAM_INT)
        ));
        $result = $this->con->getResults();
        return $result;
    }

    /**
     * @return int
     */
    public function getNbListPublic(): int
    {
        $query = "SELECT COUNT(*) FROM Liste WHERE possesseur IS NULL";
        $this->con->executeQuery($query);
        $result = $this->con->getResults();
        return $result[0][0];
    }

    /**
     * @param int $possesseur
     * @return int
     */
    public function getNbPrivateList(int $possesseur): int
    {
        $query = "SELECT COUNT(*) FROM Liste WHERE possesseur = :possesseur";
        $this->con->executeQuery($query, array(
            ':possesseur' => array($possesseur, PDO::PARAM_INT)
        ));
        $result = $this->con->getResults();
        return $result[0][0];
    }
}