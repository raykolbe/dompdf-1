<?php

namespace DOMPDF\Placeholder;

use DOMPDF\Frame\Decorator as FrameDecorator;
use DOMPDF\Positioner\AbstractPositioner;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Dummy positioner
 *
 * @access private
 * @package dompdf
 */
class Positioner extends AbstractPositioner 
{
    public function __construct(FrameDecorator $frame)
    {
        parent::__construct($frame);
    }

    public function position()
    {
        return;
    }
}