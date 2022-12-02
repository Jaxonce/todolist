<?php

class Liste
{
    private int $id;
    private string $nom;
    private string $dateModification;
    private int $userId;

    public function __construct(int $id, string $nom, string $dateModification, int $userId)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->dateModification = $dateModification;
        $this->userId = $userId;
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

    public function getDateModification() : string
    {
        return $this->dateModification;
    }

    public function getUserId() : int
    {
        return $this->userId;
    }
}

