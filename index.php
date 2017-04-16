<?php
/**
 * The "main" template file.
 * @package SpatialPixel
 */

echo NullHeader();

echo NullLoop(array(
    'num_columns' => 3,
    'standard'    => 'linkedfeatured/title/postedon/excerpt',
    'sticky'      => 'linkedfeatured/excerpt/title/postedon',
    'aside'       => 'linkedexcerpt/title/postedon',
    'stickies'    => true,
  ))
  . NullPagination();

echo NullFooter();
?>
