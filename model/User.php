<?php

class User
{
    private int $id;
    private string $nom;
    private string $email;

    public function __construct(int $id, string $nom, string $email)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

}
