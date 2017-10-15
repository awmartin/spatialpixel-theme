<?php
/*
Template Name: Full Width
*/
/**
 * The Template for displaying pages.
 *
 * @package SpatialPixel
 */

echo NullHeader();

the_post();

echo NullArticle(
  NullArticleHeader(
    NullBreadcrumb(array('before' => NullPostTitle()))
    . NullPostThumbnail('large', false)
    )
  . NullPostContent()
  );

echo NullPostSchema();
echo NullFooter();
?>
