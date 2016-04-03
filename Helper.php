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



#    Output easy-to-read numbers
#    by james at bandit.co.nz
    static function bd_nice_number($n)
    {
        // first strip any formatting;
        $n = (0 + str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n > 1000000000000) return round(($n / 1000000000000), 1) . ' trillion';
        else if ($n > 1000000000) return round(($n / 1000000000), 1) . ' billion';
        else if ($n > 1000000) return round(($n / 1000000), 1) . ' million';
        else if ($n > 1000) return round(($n / 1000), 1) . ' thousand';

        return number_format($n);
    }

}