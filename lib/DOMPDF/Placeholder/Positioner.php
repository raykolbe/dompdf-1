<?php

namespace DOMPDF\Placeholder;

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
  function __construct(Frame_Decorator $frame) {
    parent::__construct($frame);
  }

  function position() { return; }
  
}
