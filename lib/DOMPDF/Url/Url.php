<?php

namespace DOMPDF\Url;

class Url
{
    public static function build($protocol, $host, $base_path, $url)
    {
        if (strlen($url) == 0) {
            return $protocol . $host . $base_path;
        }

        // Is the url already fully qualified or a Data URI?
        if (mb_strpos($url, "://") !== false || mb_strpos($url, "data:") === 0) {
            return $url;
        }

        $ret = $protocol;

        if (!in_array(mb_strtolower($protocol), array("http://", "https://", "ftp://", "ftps://"))) {
            //On Windows local file, an abs path can begin also with a '\' or a drive letter and colon
            //drive: followed by a relative path would be a drive specific default folder.
            //not known in php app code, treat as abs path
            //($url[1] !== ':' || ($url[2]!=='\\' && $url[2]!=='/'))
            if ($url[0] !== '/' && (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN' || ($url[0] !== '\\' && $url[1] !== ':'))) {
                // For rel path and local acess we ignore the host, and run the path through realpath()
                $ret .= realpath($base_path) . '/';
            }
            $ret .= $url;
            $ret = preg_replace('/\?(.*)$/', "", $ret);
            return $ret;
        }

        // remote urls with backslash in html/css are not really correct, but lets be genereous
        if ($url[0] === '/' || $url[0] === '\\') {
            // Absolute path
            $ret .= $host . $url;
        } else {
            // Relative path
            $ret .= $host . $base_path . $url;
        }

        return $ret;
    }

    public static function explode($url)
    {
        $protocol = "";
        $host = "";
        $path = "";
        $file = "";

        $arr = parse_url($url);

        // Exclude windows drive letters...
        if (isset($arr["scheme"]) && $arr["scheme"] !== "file" && strlen($arr["scheme"]) > 1) {
            $protocol = $arr["scheme"] . "://";

            if (isset($arr["user"])) {
                $host .= $arr["user"];

                if (isset($arr["pass"])) {
                    $host .= ":" . $arr["pass"];
                }

                $host .= "@";
            }

            if (isset($arr["host"])) {
                $host .= $arr["host"];
            }

            if (isset($arr["port"])) {
                $host .= ":" . $arr["port"];
            }

            if (isset($arr["path"]) && $arr["path"] !== "") {
                // Do we have a trailing slash?
                if ($arr["path"][mb_strlen($arr["path"]) - 1] === "/") {
                    $path = $arr["path"];
                    $file = "";
                } else {
                    $path = rtrim(dirname($arr["path"]), '/\\') . "/";
                    $file = basename($arr["path"]);
                }
            }

            if (isset($arr["query"])) {
                $file .= "?" . $arr["query"];
            }

            if (isset($arr["fragment"])) {
                $file .= "#" . $arr["fragment"];
            }
        } else {

            $i = mb_strpos($url, "file://");
            if ($i !== false) {
                $url = mb_substr($url, $i + 7);
            }

            $protocol = ""; // "file://"; ? why doesn't this work... It's because of
            // network filenames like //COMPU/SHARENAME

            $host = ""; // localhost, really
            $file = basename($url);

            $path = dirname($url);

            // Check that the path exists
            if ($path !== false) {
                $path .= '/';
            } else {
                // generate a url to access the file if no real path found.
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

                $host = isset($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : php_uname("n");

                if (substr($arr["path"], 0, 1) === '/') {
                    $path = dirname($arr["path"]);
                } else {
                    $path = '/' . rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/') . '/' . $arr["path"];
                }
            }
        }

        $ret = array($protocol, $host, $path, $file,
            "protocol" => $protocol,
            "host" => $host,
            "path" => $path,
            "file" => $file);
        return $ret;
    }
}