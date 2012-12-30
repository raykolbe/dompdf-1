<?php

namespace DOMPDF\Number;

class IsPercent
{
    public static function validate($value) {
        return false !== mb_strpos($value, "%");
    }
}