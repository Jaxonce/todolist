<?php

class Tache
{
    private $id;
    private $titre;
    private $description;
    private $createdAt;
    private $updatedAt;
    private $priorite;

    public function __construct(int $id, string $titre, string $description, string $createdAt, string $updatedAt, int $priorite)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->priorite = $priorite;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getPriorite()
    {
        return $this->priorite;
    }
}