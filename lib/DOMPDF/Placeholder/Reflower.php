<?php

namespace DOMPDF\Placeholder;

use DOMPDF\Frame\Frame;
use DOMPDF\Frame\Reflower as FrameReflower;
use DOMPDF\Block\Decorator as BlockDecorator;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Dummy reflower
 *
 * @access private
 * @package dompdf
 */
class Reflower extends FrameReflower 
{
    public function __construct(Frame $frame)
    {
        parent::__construct($frame);
    }

    public function reflow(BlockDecorator $block = null)
    {
        return;
    }
}