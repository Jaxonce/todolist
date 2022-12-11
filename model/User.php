<?php

class User
{
    private int $id;
    private string $nom;
    private string $email;
    private string $password;

    public function __construct(int $id, string $nom, string $password, string $email)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $password = password_hash($password, PASSWORD_DEFAULT);
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

    public function getPassword(): string
    {
        return $this->password;
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
