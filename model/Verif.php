<?php

class Verif{
    public static function verifMail(string $mail) : bool
    {
        return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }

}