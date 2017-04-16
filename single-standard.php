<?php
/**
 * The Template for displaying all single posts.
 *
 * @package SpatialPixel
 */

echo NullArticle(
  NullArticleHeader(
    NullBreadcrumb(array('before' => NullPostTitle()))
    . NullHeroText(NullFirstParagraph())
    . NullPostThumbnail('large', false)
    )

  . NullContentSidebar(
      NullPostContentWithoutExcerpt()
      . NullArticleFooter(NullWidgetArea('Post Footer'))
      , NullWidgetArea('Post Sidebar')
    )
  );

?>
