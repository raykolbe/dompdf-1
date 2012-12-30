<?php

namespace DOMPDF\BulletList;

use DOMPDF\Frame\Reflower as FrameReflower;
use DOMPDF\Frame\Decorator as FrameDecorator;
use DOMPDF\Block\Decorator as BlockDecorator;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Reflows list bullets
 *
 * @access private
 * @package dompdf
 */
class Reflower extends FrameReflower
{
    public function __construct(FrameDecorator $frame)
    {
        parent::__construct($frame);
    }
    
    public function reflow(BlockDecorator $block = null)
    {
        $style = $this->_frame->get_style();

        $style->width = $this->_frame->get_width();
        $this->_frame->position();

        if ($style->list_style_position === "inside") {
            $p = $this->_frame->find_block_parent();
            $p->add_frame_to_line($this->_frame);
        }
    }
}