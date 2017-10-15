<?php
/*
Template Name: Tutorial
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

  . NullSidebarContent(
      NullWidgetArea('Page Sidebar')
      ,
      NullPostContent()
    )
  );


echo NullPostSchema();
echo NullFooter();
?>
