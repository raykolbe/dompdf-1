<?php

namespace DOMPDF\Gd;

class ImageSize
{
    /**
     * PHP's getimagesize doesn't give a good size for 32bit BMP image v5
     * 
     * @param string $filename
     * @return array The same format as getimagesize($filename)
     */
    public static function execute($filename) {
        static $cache = array();

        if (isset($cache[$filename])) {
            return $cache[$filename];
        }

        list($width, $height, $type) = getimagesize($filename);

        if ($width == null || $height == null) {
            $data = file_get_contents($filename, null, null, 0, 26);

            if (substr($data, 0, 2) === "BM") {
                $meta = unpack('vtype/Vfilesize/Vreserved/Voffset/Vheadersize/Vwidth/Vheight', $data);
                $width = (int) $meta['width'];
                $height = (int) $meta['height'];
                $type = IMAGETYPE_BMP;
            }
        }

        return $cache[$filename] = array($width, $height, $type);
    }
}