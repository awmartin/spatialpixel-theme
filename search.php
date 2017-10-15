<?php
/**
 * The template for displaying Search Results pages.
 * @package SpatialPixel
 */

echo NullHeader();

echo NullSection(
  NullBreadcrumb(array('before' => NullTag('h1', 'Search')))
  . NullHeroText(NullTag('p', 'Searching for &ldquo;' . get_search_query() . '.&rdquo;'))
);

echo NullLoop(array(
    'num_columns' => 3,
    'standard' => 'vertical-linkedfeatured-title-postedon-excerpt',
    'aside' => 'vertical-linkedexcerpt-title-postedon',
  ))
  . NullPagination();

echo NullFooter();
?>
