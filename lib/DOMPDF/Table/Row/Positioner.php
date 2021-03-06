<?php

namespace DOMPDF\Table\Row;

use DOMPDF\Positioner\AbstractPositioner;
use DOMPDF\Frame\Decorator as FrameDecorator;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Positions table rows
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
        $cb = $this->_frame->get_containing_block();
        $p = $this->_frame->get_prev_sibling();

        if ($p)
            $y = $p->get_position("y") + $p->get_margin_height();

        else
            $y = $cb["y"];

        $this->_frame->set_position($cb["x"], $y);
    }
}