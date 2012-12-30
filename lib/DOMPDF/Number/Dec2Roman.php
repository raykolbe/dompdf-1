<?php

namespace DOMPDF\Number;

use DOMPDF\Exception;

class Dec2Roman 
{
    public static function convert($num)
    {
        static $ones = array("", "i", "ii", "iii", "iv", "v", "vi", "vii", "viii", "ix");
        static $tens = array("", "x", "xx", "xxx", "xl", "l", "lx", "lxx", "lxxx", "xc");
        static $hund = array("", "c", "cc", "ccc", "cd", "d", "dc", "dcc", "dccc", "cm");
        static $thou = array("", "m", "mm", "mmm");

        if (!is_numeric($num)) {
            throw new Exception(sprintf("%s requires a numeric argument.", __METHOD__));
        }

        if ($num > 4000 || $num < 0) {
            return "(out of range)";
        }

        $num = strrev((string) $num);

        $ret = "";
        switch (mb_strlen($num)) {
            case 4: $ret .= $thou[$num[3]];
            case 3: $ret .= $hund[$num[2]];
            case 2: $ret .= $tens[$num[1]];
            case 1: $ret .= $ones[$num[0]];
            default: break;
        }

        return $ret;
    }
}