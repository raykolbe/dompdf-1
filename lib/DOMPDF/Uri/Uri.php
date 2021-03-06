<?php

namespace DOMPDF\Uri;

class Uri 
{
    /**
     * Parses a data URI scheme
     * http://en.wikipedia.org/wiki/Data_URI_scheme
     *
     * @param string $data_uri The data URI to parse
     *
     * @return array The result with charset, mime type and decoded data
     */
    public static function parseDataUri($data_uri)
    {
        if (!preg_match('/^data:(?P<mime>[a-z0-9\/+-.]+)(;charset=(?P<charset>[a-z0-9-])+)?(?P<base64>;base64)?\,(?P<data>.*)?/i', $data_uri, $match)) {
            return false;
        }

        $match['data'] = rawurldecode($match['data']);
        $result = array(
            'charset' => $match['charset'] ? $match['charset'] : 'US-ASCII',
            'mime' => $match['mime'] ? $match['mime'] : 'text/plain',
            'data' => $match['base64'] ? base64_decode($match['data']) : $match['data'],
        );

        return $result;
    }
}