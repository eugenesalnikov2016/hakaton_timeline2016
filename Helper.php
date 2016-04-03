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
        if (abs($n) > 1000000000) return round(($n / 1000000000), 1) . ' млрд';
        else if (abs($n) > 1000000) return round(($n / 1000000), 1) . ' млн';
        else if (abs($n) >= 5000) return round(($n / 1000), 1) . ' тыс.';


        return number_format($n, 0, '.', '');
    }

    static function txt_trim($text)
    {
        mb_internal_encoding("UTF-8");
        if (mb_strlen($text) > 70) {
            $text = mb_substr($text, 0, 70);
            $text = rtrim($text, "!,.-");
            $text .= '…';
            return $text;
        }
    }


}