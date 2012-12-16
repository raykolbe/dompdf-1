<?php

namespace DOMPDF\Frame;

use DOMPDF\Frame\Frame;
use DOMPDF\Frame\FrameTreeIterator;

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

  function __construct(Frame $root) { $this->_root = $root; }

  /**
   * @return FrameTreeIterator
   */
  function getIterator() { return new FrameTreeIterator($this->_root); }
}