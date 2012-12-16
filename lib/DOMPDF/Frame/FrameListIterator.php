<?php

namespace DOMPDF\Frame;

use DOMPDF\Frame\Frame;

/**
 * Linked-list Iterator
 *
 * Returns children in order and allows for list to change during iteration,
 * provided the changes occur to or after the current element
 *
 * @access private
 * @package dompdf
 */
class FrameListIterator implements \Iterator
{
  /**
   * @var Frame
   */
  protected $_parent;

  /**
   * @var Frame
   */
  protected $_cur;

  /**
   * @var int
   */
  protected $_num;

  function __construct(Frame $frame) {
    $this->_parent = $frame;
    $this->_cur = $frame->get_first_child();
    $this->_num = 0;
  }

  function rewind() {
    $this->_cur = $this->_parent->get_first_child();
    $this->_num = 0;
  }

  /**
   * @return bool
   */
  function valid() {
    return isset($this->_cur);// && ($this->_cur->get_prev_sibling() === $this->_prev);
  }

  function key() { return $this->_num; }

  /**
   * @return Frame
   */
  function current() { return $this->_cur; }

  /**
   * @return Frame
   */
  function next() {

    $ret = $this->_cur;
    if ( !$ret ) {
      return null;
    }

    $this->_cur = $this->_cur->get_next_sibling();
    $this->_num++;
    return $ret;
  }
}