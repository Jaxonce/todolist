<?php

/**
 *
 */
class Liste
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $nom;
    /**
     * @var string
     */
    private string $dateModification;
    /**
     * @var int
     */
    private int $userId;
    /**
     * @var array
     */
    private array $taches;

    /**
     * @param int $id
     * @param string $nom
     * @param string $dateModification
     * @param int $userId
     * @param array $taches
     */
    public function __construct(int $id, string $nom, string $dateModification, int $userId, array $taches = array())
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->dateModification = $dateModification;
        $this->userId = $userId;
        $this->taches = $taches;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom() : string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return void
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getDateModification() : string
    {
        return $this->dateModification;
    }

    /**
     * @return int
     */
    public function getUserId() : int
    {
        return $this->userId;
    }

    /**
     * @return array
     */
    public function getTaches() : array
    {
        return $this->taches;
    }

}

