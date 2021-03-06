<?php

namespace DOMPDF\Image;

use DOMPDF\DOMPDF;
use DOMPDF\Frame\Frame;
use DOMPDF\Frame\Decorator as FrameDecorator;
use DOMPDF\Image\Cache as ImageCache;
use DOMPDF\Font\Metrics as FontMetrics;

/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

/**
 * Decorates frames for image layout and rendering
 *
 * @access private
 * @package dompdf
 */
class Decorator extends FrameDecorator
{
    /**
     * The path to the image file (note that remote images are
     * downloaded locally to DOMPDF_TEMP_DIR).
     *
     * @var string
     */
    protected $_image_url;

    /**
     * The image's file error message
     *
     * @var string
     */
    protected $_image_msg;

    /**
     * Class constructor
     *
     * @param Frame $frame the frame to decorate
     * @param DOMPDF $dompdf the document's dompdf object (required to resolve relative & remote urls)
     */
    public function __construct(Frame $frame, DOMPDF $dompdf)
    {
        parent::__construct($frame, $dompdf);
        $url = $frame->get_node()->getAttribute("src");

        list($this->_image_url, /* $type */, $this->_image_msg) = ImageCache::resolve_url(
                        $url, $dompdf->get_protocol(), $dompdf->get_host(), $dompdf->get_base_path(), $dompdf
        );

        if ($dompdf->getConfig()->getResourceDirectory() . '/broken_image.png' == $this->_image_url &&
                $alt = $frame->get_node()->getAttribute("alt")) {
            $style = $frame->get_style();
            $style->width = (4 / 3) * FontMetrics::get_text_width($alt, $style->font_family, $style->font_size, $style->word_spacing);
            $style->height = FontMetrics::get_font_height($style->font_family, $style->font_size);
        }
    }

    /**
     * Return the image's url
     *
     * @return string The url of this image
     */
    public function get_image_url()
    {
        return $this->_image_url;
    }

    /**
     * Return the image's error message
     *
     * @return string The image's error message
     */
    public function get_image_msg()
    {
        return $this->_image_msg;
    }
}
