<?php

class Tache
{
    private int $id;
    private string $nom;
    private string $descriptionTache;
    private int $importance;
    private string $dateCreation;
    private string $dateModification;
    private int $listeId;

    public function __construct(int $id, string $nom, string $descriptionTache, int $importance, string $dateCreation, string $dateModification, int $listeId)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->descriptionTache = $descriptionTache;
        $this->importance = $importance;
        $this->dateCreation = $dateCreation;
        $this->dateModification = $dateModification;
        $this->listeId = $listeId;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getNom() : string
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function getDescriptionTache() : string
    {
        return $this->descriptionTache;
    }

    public function setDescriptionTache(string $descriptionTache)
    {
        $this->descriptionTache = $descriptionTache;
    }

    public function getImportance() : int
    {
        return $this->importance;
    }

    public function setImportance(int $importance)
    {
        $this->importance = $importance;
    }

    public function getDateCreation() : string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    public function getDateModification() : string
    {
        return $this->dateModification;
    }

    public function setDateModification(string $dateModification)
    {
        $this->dateModification = $dateModification;
    }

    public function getListeId(): int
    {
        return $this->listeId;
    }

}