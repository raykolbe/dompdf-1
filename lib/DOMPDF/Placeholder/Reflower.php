<?php

namespace DOMPDF\Placeholder;

use DOMPDF\Frame\Reflower as FrameReflower;

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
  function __construct(Frame $frame) { parent::__construct($frame); }

  function reflow(Block_Frame_Decorator $block = null) { return; }
  
}
