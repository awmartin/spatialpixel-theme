<?php
/**
 * The "main" template file.
 * @package SpatialPixel
 */

echo NullHeader();

echo NullLoop(array(
    'num_columns' => 3,
    'standard' => 'vertical-linkedfeatured-title-postedon-excerpt',
    'sticky' => 'vertical-linkedfeatured-excerpt-title-postedon',
    'aside' => 'vertical-linkedexcerpt-title-postedon',
    'stickies' => true,
  ))
  . NullPagination();

echo NullFooter();
?>
