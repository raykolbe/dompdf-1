<?php

namespace DOMPDF\Renderer;

use DOMPDF\Canvas\Canvas;
use DOMPDF\Frame\Frame;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Executes inline PHP code during the rendering process
 *
 * @access private
 * @package dompdf
 */
class PHPEvaluator 
{
    /**
     * @var Canvas
     */
    protected $_canvas;

    public function __construct(Canvas $canvas)
    {
        $this->_canvas = $canvas;
    }

    public function evaluate($code, $vars = array())
    {
        if (!$this->_canvas->_dompdf->getConfig()->setEnableRenderPhp())
            return;

        // Set up some variables for the inline code
        $pdf = $this->_canvas;
        $PAGE_NUM = $pdf->get_page_number();
        $PAGE_COUNT = $pdf->get_page_count();

        // Override those variables if passed in
        foreach ($vars as $k => $v) {
            $$k = $v;
        }

        //$code = html_entity_decode($code); // @todo uncomment this when tested
        eval($code);
    }

    public function render(Frame $frame)
    {
        $this->evaluate($frame->get_node()->nodeValue);
    }
}