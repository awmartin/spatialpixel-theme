<?php
/**
 * The template for displaying Category pages.
 * @package SpatialPixel
 */

echo NullHeader();

echo NullSection(
    NullBreadcrumb(array('before' => NullArchiveTitle()))
    . NullHeroText(NullArchiveDescription())
  );

echo NullLoop(array(
    'num_columns' => 3,
    'standard' => 'vertical-linkedfeatured-title-postedon-excerpt',
    'aside' => 'vertical-linkedexcerpt-title-postedon',
  ))
  . NullPagination();

echo NullFooter();
?>
