<?php

namespace DOMPDF\Table\Cell;

use DOMPDF\Positioner\AbstractPositioner;
use DOMPDF\Frame\Decorator as FrameDecorator;
use DOMPDF\Table\Decorator as TableDecorator;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Positions table cells
 *
 * @access private
 * @package dompdf
 */
class Positioner extends AbstractPositioner
{
  function __construct(FrameDecorator $frame) { parent::__construct($frame); }
  
  //........................................................................

  function position() {

    $table = TableDecorator::find_parent_table($this->_frame);
    $cellmap = $table->get_cellmap();
    $this->_frame->set_position($cellmap->get_frame_position($this->_frame));

  }
}
