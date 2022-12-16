<?php

/**
 *
 */
class Task
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
    private string $descriptionTache;
    /**
     * @var int
     */
    private int $importance;
    /**
     * @var string
     */
    private string $dateCreation;
    /**
     * @var string
     */
    private string $dateModification;
    /**
     * @var int
     */
    private int $listeId;
    /**
     * @var bool
     */
    private bool $done;


    /**
     * @param int $id
     * @param string $nom
     * @param string $descriptionTache
     * @param int $importance
     * @param string $dateCreation
     * @param string $dateModification
     * @param int $listeId
     * @param bool $done
     */
    public function __construct(int $id, string $nom, string $descriptionTache, int $importance, string $dateCreation, string $dateModification, int $listeId, bool $done)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->descriptionTache = $descriptionTache;
        $this->importance = $importance;
        $this->dateCreation = $dateCreation;
        $this->dateModification = $dateModification;
        $this->listeId = $listeId;
        $this->done = $done;
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
    public function getDescriptionTache() : string
    {
        return $this->descriptionTache;
    }

    /**
     * @param string $descriptionTache
     * @return void
     */
    public function setDescriptionTache(string $descriptionTache)
    {
        $this->descriptionTache = $descriptionTache;
    }

    /**
     * @return int
     */
    public function getImportance() : int
    {
        return $this->importance;
    }

    /**
     * @param int $importance
     * @return void
     */
    public function setImportance(int $importance)
    {
        $this->importance = $importance;
    }

    /**
     * @return string
     */
    public function getDateCreation() : string
    {
        return $this->dateCreation;
    }

    /**
     * @param string $dateCreation
     * @return void
     */
    public function setDateCreation(string $dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return string
     */
    public function getDateModification() : string
    {
        return $this->dateModification;
    }

    /**
     * @param string $dateModification
     * @return void
     */
    public function setDateModification(string $dateModification)
    {
        $this->dateModification = $dateModification;
    }

    /**
     * @return int
     */
    public function getListeId(): int
    {
        return $this->listeId;
    }

    /**
     * @param bool $done
     * @return void
     */
    public function setDone (bool $done)
    {
        $this->done = $done;
    }

    /**
     * @return bool
     */
    public function getDone () : bool
    {
        return $this->done;
    }
}