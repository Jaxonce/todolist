<?php

/**
 *
 */
class Verif{
    /**
     * @param string $mail
     * @return bool
     */
    public static function verifMail(string $mail) : bool
    {
        return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }

}