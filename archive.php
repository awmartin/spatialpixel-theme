<?php
/**
 * The template for displaying Archive pages.
 * @package SpatialPixel
 */

echo NullHeader();

echo NullSection(
    NullBreadcrumb(array('before' => NullArchiveTitle()))
    . NullHeroText(NullArchiveDescription())
  );

echo NullLoop(array(
    'num_columns' => 3,
    'standard'    => 'linkedfeatured/title/postedon/excerpt',
    'aside'       => 'linkedexcerpt/title/postedon',
  ))
  . NullPagination();

echo NullFooter();
?>
