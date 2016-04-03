<?php

class Helper
{
    public static function process($string)
    {
        $string = trim($string);
        $string = strip_tags($string);
        $string = htmlspecialchars($string, ENT_QUOTES);
        $db = new DB();
        $string = mysqli_real_escape_string($db->link, $string);
        return $string;
    }
}