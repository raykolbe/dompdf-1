<?php

namespace DOMPDF\Javascript;

use DOMPDF\DOMPDF;
use DOMPDF\Frame\Frame;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Embeds Javascript into the PDF document
 *
 * @access private
 * @package dompdf
 */
class Embedder 
{
    /**
     * @var DOMPDF
     */
    protected $_dompdf;

    public function __construct(DOMPDF $dompdf)
    {
        $this->_dompdf = $dompdf;
    }

    public function insert($script)
    {
        $this->_dompdf->get_canvas()->javascript($script);
    }

    public function render(Frame $frame)
    {
        if (!$this->_dompdf->getConfig()->getEnableJavascript()) {
            return;
        }

        $this->insert($frame->get_node()->nodeValue);
    }
}