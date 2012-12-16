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

  function __construct($frame) { $this->_frame = $frame; }
  function getIterator() { return new FrameListIterator($this->_frame); }
}