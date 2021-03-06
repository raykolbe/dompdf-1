<?php

namespace DOMPDF\Image;

use DOMPDF\DOMPDF;
use DOMPDF\ImageException;
use DOMPDF\Image\Cache as ImageCache;
use DOMPDF\Url\Url;
use DOMPDF\Uri\Uri;
use DOMPDF\Gd\ImageSize;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @author  Helmut Tischer <htischer@weihenstephan.org>
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Static class that resolves image urls and downloads and caches
 * remote images if required.
 *
 * @access private
 * @package dompdf
 */
class Cache
{
    /**
     * Array of downloaded images.  Cached so that identical images are
     * not needlessly downloaded.
     *
     * @var array
     */
    protected static $_cache = array();
    
    /**
     * Resolve and fetch an image for use.
     *
     * @param string $url        The url of the image
     * @param string $protocol   Default protocol if none specified in $url
     * @param string $host       Default host if none specified in $url
     * @param string $base_path  Default path if none specified in $url
     * @param DOMPDF $dompdf     The DOMPDF instance
     *
     * @throws DOMPDF_Image_Exception
     * @return array             An array with two elements: The local path to the image and the image extension
     */
    public static function resolve_url($url, $protocol, $host, $base_path, DOMPDF $dompdf)
    {
        $parsed_url = Url::explode($url);
        $message = null;

        $remote = ($protocol && $protocol !== "file://") || ($parsed_url['protocol'] != "");

        $data_uri = strpos($parsed_url['protocol'], "data:") === 0;
        $full_url = null;
        $enable_remote = $dompdf->getConfig()->getEnableRemote();

        try {

            // Remote not allowed and is not DataURI
            if (!$enable_remote && $remote && !$data_uri) {
                throw new ImageException("DOMPDF_ENABLE_REMOTE is set to FALSE");
            }

            // Remote allowed or DataURI
            else if ($enable_remote && $remote || $data_uri) {
                // Download remote files to a temporary directory
                $full_url = Url::build($protocol, $host, $base_path, $url);

                // From cache
                if (isset(self::$_cache[$full_url])) {
                    $resolved_url = self::$_cache[$full_url];
                }

                // From remote
                else {
                    $tmp_dir = $dompdf->getConfig()->getTemporaryDirectory();
                    $resolved_url = tempnam($tmp_dir, "ca_dompdf_img_");
                    $image = "";

                    if ($data_uri) {
                        if ($parsed_data_uri = Uri::parseDataUri($url)) {
                            $image = $parsed_data_uri['data'];
                        }
                    } else {
                        $image = file_get_contents($full_url);
                    }

                    // Image not found or invalid
                    if (strlen($image) == 0) {
                        $msg = ($data_uri ? "Data-URI could not be parsed" : "Image not found");
                        throw new ImageException($msg);
                    }

                    // Image found, put in cache and process
                    else {
                        //e.g. fetch.php?media=url.jpg&cache=1
                        //- Image file name might be one of the dynamic parts of the url, don't strip off!
                        //- a remote url does not need to have a file extension at all
                        //- local cached file does not have a matching file extension
                        //Therefore get image type from the content
                        file_put_contents($resolved_url, $image);
                    }
                }
            }

            // Not remote, local image
            else {
                $resolved_url = Url::build($protocol, $host, $base_path, $url);
            }

            // Check if the local file is readable
            if (!is_readable($resolved_url) || !filesize($resolved_url)) {
                throw new ImageException("Image not readable or empty");
            }

            // Check is the file is an image
            else {
                list($width, $height, $type) = ImageSize::execute($resolved_url);

                // Known image type
                if ($width && $height && in_array($type, array(IMAGETYPE_GIF, IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_BMP))) {
                    //Don't put replacement image into cache - otherwise it will be deleted on cache cleanup.
                    //Only execute on successful caching of remote image.
                    if ($enable_remote && $remote) {
                        self::$_cache[$full_url] = $resolved_url;
                    }
                }

                // Unknown image type
                else {
                    throw new ImageException("Image type unknown");
                }
            }
        } catch (ImageException $e) {
            $resolved_url = $dompdf->getConfig()->getResourceDirectory() . '/broken_image.png';
            $type = IMAGETYPE_PNG;
            $message = $e->getMessage() . " \n $url";
        }

        return array($resolved_url, $type, $message);
    }

    /**
     * Unlink all cached images (i.e. temporary images either downloaded
     * or converted)
     */
    public static function clear()
    {
        if (empty(self::$_cache) || DEBUGKEEPTEMP)
            return;

        foreach (self::$_cache as $file) {
            unlink($file);
        }

        self::$_cache = array();
    }

    public static function detect_type($file)
    {
        list(,, $type) = ImageSize::execute($file);
        return $type;
    }

    public static function type_to_ext($type)
    {
        $image_types = array(
            IMAGETYPE_GIF => "gif",
            IMAGETYPE_PNG => "png",
            IMAGETYPE_JPEG => "jpeg",
            IMAGETYPE_BMP => "bmp",
        );

        return (isset($image_types[$type]) ? $image_types[$type] : null);
    }
}
