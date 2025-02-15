<?php

/**
 *
 */
class Clean
{
    /**
     * @param string $string
     * @return string
     */
    public static function cleanString(string $string) : string
    {        
        // Nettoyage de l'input
        $string = filter_var($string, FILTER_SANITIZE_STRING);
        $string = strip_tags($string);
        $string = trim($string);


        return $string;
    }
    /**
     * @param int $int
     * @return int
     */
    public static function cleanInt(string $int) : int
    {
        // Nettoyage de l'input
        $int = filter_var($int, FILTER_SANITIZE_NUMBER_INT);

        return $int;
    }

    /**
     * @param string $mail
     * @return string
     */
    public static function cleanMail(string $mail) : string
    {        
        // Nettoyage de l'input
        $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
        return $mail;
    }

}