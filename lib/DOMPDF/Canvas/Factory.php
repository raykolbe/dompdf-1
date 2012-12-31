<?php

namespace DOMPDF\Canvas;

use DOMPDF\DOMPDF;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Abstract factory responsible for creating a canvas instance.
 */
class Factory
{
    /**
     * Class constructor. Private & final to implement singelton pattern.
     */
    private final function __construct()
    {        
    }

    /**
     * @param DOMPDF       $dompdf
     * @param string|array $paper
     * @param string       $orientation
     * @param string       $class
     *
     * @return Canvas
     */
    public static function get_instance(DOMPDF $dompdf, $paper = null, $orientation = null)
    {
        $renderer = $dompdf->getConfig()->getRenderingEngine();
        $class = null;
        
        switch (strtolower($renderer)) {
            case 'tcpdf' :
                $class = 'DOMPDF\Canvas\Adapter\TCPDF';
                break;
            case 'gd' :
                $class = 'DOMPDF\Canvas\Adapter\GD';
                break;
            case 'pdflib' :
            case 'auto' :
                $class = 'DOMPDF\Canvas\Adapter\GD';
                break;
            default:
                $class = 'DOMPDF\Canvas\Adapter\CPDF';
        }

        $canvas = new $class($paper, $orientation, $dompdf);
        
        if (!($canvas instanceof \DOMPDF\Canvas\Canvas)) {
            throw new \UnexpectedValueException(sprintf(
                "Rendering engine (canvas backend) must be an instance of " .
                "DOMPDF\Canvas\Canvas. We were given '%s'",
                get_class($canvas)
            ));
        }
        
        return $canvas;
    }
}