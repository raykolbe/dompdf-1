<?php

namespace DOMPDF\String;

class UniChr 
{
    public static function execute($c)
    {
        if ($c <= 0x7F) {
            return chr($c);
        } else if ($c <= 0x7FF) {
            return chr(0xC0 | $c >> 6) . chr(0x80 | $c & 0x3F);
        } else if ($c <= 0xFFFF) {
            return chr(0xE0 | $c >> 12) . chr(0x80 | $c >> 6 & 0x3F)
                    . chr(0x80 | $c & 0x3F);
        } else if ($c <= 0x10FFFF) {
            return chr(0xF0 | $c >> 18) . chr(0x80 | $c >> 12 & 0x3F)
                    . chr(0x80 | $c >> 6 & 0x3F)
                    . chr(0x80 | $c & 0x3F);
        }
        return false;
    }
}