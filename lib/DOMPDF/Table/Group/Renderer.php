<?php

namespace DOMPDF\Table\Group;

use DOMPDF\Block\Renderer as BlockRenderer;
use DOMPDF\Frame\Frame;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Renders block frames
 *
 * @access private
 * @package dompdf
 */
class Renderer extends BlockRenderer 
{
    public function render(Frame $frame)
    {
        $style = $frame->get_style();

        $this->_set_opacity($frame->get_opacity($style->opacity));

        $this->_render_border($frame);
        $this->_render_outline($frame);
    }
}