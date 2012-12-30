<?php

namespace DOMPDF\Color;

class Converter
{
    /**
     * Converts a CMYK color to RGB
     * 
     * @param float|float[] $c
     * @param float         $m
     * @param float         $y
     * @param float         $k
     *
     * @return float[]
     */
    public static function cmykToRgb($c, $m = null, $y = null, $k = null) {
        if (is_array($c)) {
            list($c, $m, $y, $k) = $c;
        }

        $c *= 255;
        $m *= 255;
        $y *= 255;
        $k *= 255;

        $r = (1 - round(2.55 * ($c + $k)));
        $g = (1 - round(2.55 * ($m + $k)));
        $b = (1 - round(2.55 * ($y + $k)));

        if ($r < 0)
            $r = 0;
        if ($g < 0)
            $g = 0;
        if ($b < 0)
            $b = 0;

        return array(
            $r, $g, $b,
            "r" => $r, "g" => $g, "b" => $b
        );
    }
}