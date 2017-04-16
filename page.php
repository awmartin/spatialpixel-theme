<?php
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
    . NullHeroText(NullFirstParagraph())
    . NullPostThumbnail('large', false)
    )

  . NullContentSidebar(
      NullPostContentWithoutExcerpt()
      . NullArticleFooter(NullWidgetArea('Page Footer'))
      , NullWidgetArea('Page Sidebar')
    )
  );


echo NullPostSchema();
echo NullFooter();
?>
