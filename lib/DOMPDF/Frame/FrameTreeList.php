<?php

namespace DOMPDF\Frame;

use DOMPDF\Frame\Frame;
use DOMPDF\Frame\FrameTreeListIterator;

/**
 * Pre-order IteratorAggregate
 *
 * @access private
 * @package dompdf
 */
class FrameTreeList implements \IteratorAggregate
{
    /**
     * @var Frame
     */
    protected $_root;

    public function __construct(Frame $root)
    {
        $this->_root = $root;
    }

    /**
     * @return FrameTreeListIterator
     */
    public function getIterator()
    {
        return new FrameTreeListIterator($this->_root);
    }
}