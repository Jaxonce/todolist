<?php

class Clean
{
    public static function cleanString(string $string) : string
    {


        // Vérification du type de l'input
        if (is_string($string)) {
            // Traitement de l'input
        } else {
            throw new Exception("Clean::cleanString() : \$string n'est pas une chaîne de caractères");      
        }
        
        // Nettoyage de l'input
        $string = filter_var($string, FILTER_SANITIZE_STRING);
        return $string;
    }

    public static function cleanInt(int $int) : int
    {
        // Vérification du type de l'input
        if (is_int($int)) {
            // Traitement de l'input
        } else {
            throw new Exception("Clean::cleanInt() : \$int n'est pas un entier");      
        }
        
        // Nettoyage de l'input
        $int = filter_var($int, FILTER_SANITIZE_NUMBER_INT);
        return $int;
    }

    public static function cleanMail(string $mail) : string
    {
        // Vérification du type de l'input
        if (is_string($mail)) {
            // Traitement de l'input
        } else {
            throw new Exception("Clean::cleanMail() : \$mail n'est pas une chaîne de caractères");      
        }
        
        // Nettoyage de l'input
        $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
        return $mail;
    }
}