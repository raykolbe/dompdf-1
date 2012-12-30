<?php

namespace DOMPDF\Frame;

use DOMPDF\Frame\FrameListIterator;

/**
 * Linked-list IteratorAggregate
 *
 * @access private
 * @package dompdf
 */
class FrameList implements \IteratorAggregate
{
    protected $_frame;

    public function __construct($frame)
    {
        $this->_frame = $frame;
    }

    public function getIterator()
    {
        return new FrameListIterator($this->_frame);
    }
}