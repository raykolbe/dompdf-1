<?php

namespace DOMPDF;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Image exception thrown by DOMPDF
 *
 * @package dompdf
 */
class ImageException extends Exception 
{
    /**
     * Class constructor
     *
     * @param string $message Error message
     * @param int $code Error code
     */
    public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
    }
}