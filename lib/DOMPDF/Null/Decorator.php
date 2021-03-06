<?php

namespace DOMPDF\Null;

use DOMPDF\Frame\Frame;
use DOMPDF\Frame\Decorator as FrameDecorator;
use DOMPDF\DOMPDF;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Dummy decorator
 *
 * @access private
 * @package dompdf
 */
class Decorator extends FrameDecorator
{
    public function __construct(Frame $frame, DOMPDF $dompdf) {
        parent::__construct($frame, $dompdf);
        $style = $this->_frame->get_style();
        $style->width = 0;
        $style->height = 0;
        $style->margin = 0;
        $style->padding = 0;
    }
}